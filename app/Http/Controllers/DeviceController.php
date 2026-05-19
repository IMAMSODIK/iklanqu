<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function sync(Request $request)
    {
        $board = $request->attributes->get('board');

        return response()->json([
            'ok' => true,

            'board' => [
                'id' => $board->id,
                'name' => $board->name,
                'kode' => $board->kode,
            ],

            'people_counting_enabled' => true,

            'required_assets' => [],

            'active_playlist' => [
                'items' => []
            ]
        ]);
    }
}
