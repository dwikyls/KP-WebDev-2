<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class GaleriSeeder extends \CodeIgniter\Database\Seeder
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
    }
}
