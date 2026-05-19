<?php

namespace App\Http\Controllers;

use App\Models\KampanyeIklan;
use App\Models\Board;
use App\Models\LokasiKampanyeIklan;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KampanyeIklanController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:40960',
                'boards' => 'required',
            ]);

            $boards = json_decode($request->boards, true);
            if (!$boards || count($boards) < 1) {
                throw new \Exception('Board belum dipilih');
            }

            $totalPrice = 0;
            $mediaPath = null;
            if ($request->hasFile('media')) {
                $file = $request->file('media');
                $filename = time() . '_' . $file->getClientOriginalName();

                $mediaPath = $file->storeAs(
                    'campaigns',
                    $filename,
                    'public'
                );
            }

            $campaign = KampanyeIklan::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'media' => $mediaPath,
                'payment_status' => 'pending',
                'is_active' => false,
            ]);

            foreach ($boards as $index => $board) {
                $boardModel = Board::findOrFail($board['board_id']);
                $start = Carbon::parse($board['tanggal_mulai']);
                $end = Carbon::parse($board['tanggal_selesai']);
                $days = $start->diffInDays($end) + 1;
                $subtotal = $days * $boardModel->price;
                $totalPrice += $subtotal;

                LokasiKampanyeIklan::create([
                    'kampanye_iklan_id' => $campaign->id,
                    'lokasi_id' => $boardModel->lokasi_id,
                    'tanggal_mulai' => $board['tanggal_mulai'],
                    'tanggal_selesai' => $board['tanggal_selesai'],
                ]);

                DB::table('board_kampanye_iklan')->insert([
                    'board_id' => $boardModel->id,
                    'kampanye_iklan_id' => $campaign->id,
                    'start_at' => Carbon::parse($board['tanggal_mulai'])->startOfDay(),
                    'end_at' => Carbon::parse($board['tanggal_selesai'])->endOfDay(),
                    'urutan' => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $campaign->update([
                'total_price' => $totalPrice
            ]);

            $payment = Payment::create([
                'kampanye_iklan_id' => $campaign->id,
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'amount' => $totalPrice,
                'status' => 'pending',
            ]);

            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
            \Midtrans\Config::$appendNotifUrl = config('midtrans.notification_url');

            $params = [
                'transaction_details' => [
                    'order_id' => $payment->invoice_number,
                    'gross_amount' => (int) $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'callbacks' => [
                    'finish' =>
                    'https://iklanqu.forumrektorptkin2026.com/payment-success'
                ]
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $payment->update([
                'snap_token' => $snapToken
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Campaign berhasil dibuat',
                'campaign_id' => $campaign->id,
                'invoice' => $payment->invoice_number,
                'total' => $payment->amount,
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        $hash = hash(
            'sha512',
            $request->order_id .
                $request->status_code .
                $request->gross_amount .
                $serverKey
        );

        if ($hash !== $request->signature_key) {
            return response()->json(['message' => 'Invalid'], 403);
        }

        $payment = Payment::where('invoice_number', $request->order_id)->first();

        if (!$payment) return;

        if ($request->transaction_status == 'settlement') {

            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
                'transaction_id' => $request->transaction_id
            ]);

            $payment->campaign->update([
                'is_active' => true,
                'payment_status' => 'paid',
                'paid_at' => now(),
                'payment_method' => $request->payment_type
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
