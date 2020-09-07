<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class GaleriSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('en_US');

        //DUMMY DATA
        for ($i = 0; $i < 20; $i++) {
            $data = [
                'nama_pengupload'       => $faker->name,
                'jabatan_pengupload'    => $faker->jobTitle,
                'detail'                => $faker->text($maxNbChars = 1000),
                'gambar'                => $faker->image($dir = 'img', $width = 250, $height = 250, 'city', false),
                'kategori'              => $faker->randomElement($array = array('Jalan Tol', 'Jembatan', 'Underpass')),
                'created_at'            => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'            => Time::now()
            ];

            $this->db->table('galeri')->insert($data);
        }
    }
}
