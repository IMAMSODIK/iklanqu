<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lokasi::create([
            'nama' => 'Kilat Kuphi',
            'alamat' => 'Jl. Garuda No.79, Sei Sikambing B, Kec. Medan Sunggal, Kota Medan, Sumatera Utara 20122',
            'gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTO-pHWa0n2GyQ1ckE3dTg5N2HtnWIbmHOb4g&s',
            'link_maps' => 'https://maps.app.goo.gl/qGh3PtMtKe5WA1Fz7'
        ]);

        Lokasi::create([
            'nama' => 'Candu Kuphi',
            'alamat' => 'Jl. T. Amir Hamzah No.216, Helvetia Tim., Kec. Medan Helvetia, Kota Medan, Sumatera Utara 20211',
            'gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpFf1X8AMXvvG0Gx0Hy4Qe-Hwtq44ItooPrA&s',
            'link_maps' => 'https://maps.app.goo.gl/n4UpdoEdVomNRMmV7'
        ]);
    }
}
