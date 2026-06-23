<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembina;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Tambahkan Hash untuk mengenkripsi password
use Faker\Factory as Faker;
use Carbon\Carbon;

class PembinaSeeder extends Seeder
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

        // Membuat 5 data dummy pembina dan user
        for ($i = 0; $i < 5; $i++) {
            $nama = $faker->name();
            $email = $faker->unique()->safeEmail();

            // 1. Buat data di tabel users terlebih dahulu dan ambil ID-nya
            $userId = User::insertGetId([
                'username'   => $faker->userName(),
                'password'   => Hash::make('admin123'), // Default password 'admin123'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // 2. Insert data ke tabel pembinas menggunakan $userId yang baru dibuat
            Pembina::insert([
                'user_id'       => $userId, 
                'nama'          => $nama,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'no_telp'       => $faker->phoneNumber(),
                'email'         => $email,
                'photo'         => null, 
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}