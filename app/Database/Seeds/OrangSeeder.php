<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 25; $i++) {
            $data = [
                'nama_pengupload'       => $faker->name,
                'jabatan_pengupload'    => $faker->jobTitle,
                'detail'                => $faker->text,
                'gambar'                => $faker->imageUrl($width = 200, $height = 200),
                'kategori'              => 'Jalan Tol',
                'created_at'            => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'            => Time::now()
            ];

            $this->db->table('galeri')->insert($data);
        }
        // $data = [
        //     [
        //         'nama'          => 'awd',
        //         'alamat'        => 'jember utara',
        //         'created_at'    => Time::now(),
        //         'updated_at'    => Time::now()
        //     ],
        //     [
        //         'nama'          => 'dwiky kedua',
        //         'alamat'        => 'jember timur',
        //         'created_at'    => Time::now(),
        //         'updated_at'    => Time::now()
        //     ],
        //     [
        //         'nama'          => 'dwiky ketiga',
        //         'alamat'        => 'jember selatan',
        //         'created_at'    => Time::now(),
        //         'updated_at'    => Time::now()
        //     ]
        // ];

        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
        //     $data
        // );

        // Using Query Builder
        // $this->db->table('orang')->insert($data);
    }
}
