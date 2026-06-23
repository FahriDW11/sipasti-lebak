<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Napi;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class NapiSeeder extends Seeder
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

        // Membuat 20 data dummy
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                // Asumsi pembina_id sudah ada di tabel pembinas dengan ID 1-5
                'pembina_id'    => $faker->numberBetween(1, 5), 
                'nama'          => $faker->name(),
                'nama_ayah'     => $faker->name('male'), // Menghasilkan nama laki-laki
                'tgl_lahir'     => $faker->date('Y-m-d', '2005-01-01'), // Maksimal tahun lahir 2005
                'jenis_kelamin' => $faker->randomElement(['L', 'P']), // Atau sesuaikan dengan enum: 'L', 'P'
                'alamat'        => $faker->address(),
                'photo'         => null, // Anda bisa menggunakan $faker->imageUrl() jika ingin URL gambar acak
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
        }

        // Insert data ke tabel (asumsi nama tabelnya 'napis')
        // Jika nama tabel Anda berbeda, ubah 'napis' menjadi nama tabel yang sesuai
        Napi::insert($data);
    }
}