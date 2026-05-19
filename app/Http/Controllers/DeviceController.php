<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function sync(Request $request)
    {
        try {

            $board = $request->attributes->get('board');

            $items = DB::table('board_kampanye_iklan')
                ->join(
                    'kampanye_iklans',
                    'kampanye_iklans.id',
                    '=',
                    'board_kampanye_iklan.kampanye_iklan_id'
                )

                ->where(
                    'board_kampanye_iklan.board_id',
                    $board->id
                )

                ->where(
                    'kampanye_iklans.payment_status',
                    'paid'
                )

                ->where(
                    'kampanye_iklans.is_active',
                    true
                )

                ->where(
                    'board_kampanye_iklan.start_at',
                    '<=',
                    now()
                )

                ->where(
                    'board_kampanye_iklan.end_at',
                    '>=',
                    now()
                )

                ->orderBy('urutan')

                ->get();

            $required_assets = [];

            $playlist_items = [];

            foreach ($items as $item) {

                $path = storage_path(
                    'app/public/' . $item->media
                );

                if (!file_exists($path)) {
                    continue;
                }

                $required_assets[] = [

                    'asset_id' => $item->asset_id,

                    'filename' => basename($path),

                    'mime_type' => mime_content_type($path),

                    'sha256' => hash_file('sha256', $path),

                    'signed_url' => route(
                        'asset.download',
                        [
                            'asset_id' => $item->asset_id
                        ]
                    ),
                ];

                $playlist_items[] = [
                    'asset_id' => $item->asset_id
                ];
            }

            return response()->json([

                'people_counting_enabled' => true,

                'required_assets' => $required_assets,

                'active_playlist' => [
                    'items' => $playlist_items
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([

                'error' => true,

                'message' => $e->getMessage(),

                'line' => $e->getLine(),

                'file' => $e->getFile()

            ], 500);
        }
    }

    public function heartbeat(Request $request)
    {
        $board = $request->attributes->get('board');

        $board->update([
            'ip' => $request->ip,
            'stream_url' => $request->stream_url,
            'free_disk_mb' => $request->free_disk_mb,
            'app_version' => $request->app_version,
            'last_seen_at' => now(),
        ]);

        return response()->json([
            'ok' => true
        ]);
    }
}
