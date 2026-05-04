<?php

namespace App\Http\Controllers;

use App\Models\KampanyeIklan;
use App\Http\Requests\StoreKampanyeIklanRequest;
use App\Http\Requests\UpdateKampanyeIklanRequest;
use App\Models\Lokasi;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class KampanyeIklanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'media' => 'required|file',
            'locations' => 'required'
        ]);

        $path = $request->file('media')->store('campaigns', 'public');
        $locations = json_decode($request->locations, true);
        $totalPrice = 0;

        foreach ($locations as $loc) {
            $lokasi = Lokasi::find($loc['location_id']);

            $start = Carbon::parse($loc['tanggal_mulai']);
            $end = Carbon::parse($loc['tanggal_selesai']);
            $days = $start->diffInDays($end) + 1;

            $totalPrice += $lokasi->harga * $days;
        }

        $campaign = KampanyeIklan::create([
            'user_id' => auth()->user()->id,
            // 'user_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'media' => $path,
            'total_price' => $totalPrice,
            'is_active' => false
        ]);

        foreach ($locations as $loc) {
            $campaign->lokasi()->attach($loc['location_id'], [
                'tanggal_mulai' => $loc['tanggal_mulai'],
                'tanggal_selesai' => $loc['tanggal_selesai'],
            ]);
        }

        // MIDTRANS CONFIG
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'INV-' . time();

        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name ?? 'User',
                'email' => auth()->user()->email ?? 'user@mail.com',
                // 'first_name' => 'User',
                // 'email' => 'user@mail.com',
            ]
        ];

        $snapToken = Snap::getSnapToken($transaction);

        Payment::create([
            'kampanye_iklan_id' => $campaign->id,
            'invoice_number' => $orderId,
            'amount' => $totalPrice,
            'status' => 'pending',
            'snap_token' => $snapToken
        ]);

        return response()->json([
            'success' => true,
            'snap_token' => $snapToken
        ]);
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
