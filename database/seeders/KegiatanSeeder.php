<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan Faker dengan locale Indonesia
        $faker = Faker::create('id_ID');

        $data = [];

        // Membuat 5 data dummy kegiatan
        for ($i = 0; $i < 5; $i++) {
            $data[] = [
                'nama'          => $faker->sentence(3), // Nama kegiatan berupa kalimat singkat (3 kata)
                'deskripsi'     => $faker->paragraph(), // Deskripsi kegiatan acak
                'photo'         => null, 
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
        }

        // Insert data ke tabel kegiatans
        Kegiatan::insert($data);
    }
}