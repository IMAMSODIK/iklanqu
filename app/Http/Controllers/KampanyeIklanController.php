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
                'media' => 'nullable',
                'boards' => 'required|array|min:1',
            ]);

            $totalPrice = 0;

            $campaign = KampanyeIklan::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'media' => $request->media,
                'payment_status' => 'pending',
                'is_active' => false,
            ]);

            foreach ($request->boards as $board) {

                $boardModel = Board::findOrFail($board['board_id']);

                $start = Carbon::parse($board['tanggal_mulai']);

                $end = Carbon::parse($board['tanggal_selesai']);

                $days = $start->diffInDays($end) + 1;

                $subtotal = $days * $boardModel->harga;

                $totalPrice += $subtotal;

                LokasiKampanyeIklan::create([
                    'kampanye_iklan_id' => $campaign->id,
                    'lokasi_id' => $boardModel->lokasi_id,
                    'tanggal_mulai' => $board['tanggal_mulai'],
                    'tanggal_selesai' => $board['tanggal_selesai'],
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

            $params = [
                'transaction_details' => [
                    'order_id' => $payment->invoice_number,
                    'gross_amount' => (int) $payment->amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
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
                'is_active' => true
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}
