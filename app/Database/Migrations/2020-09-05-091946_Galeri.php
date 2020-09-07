<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Galeri extends Migration
{
	public function up()
	{
		$this->forge->addField([
			//SET MIGRASI ID
			'id'          		=> [
				'type'          => 'INT',
				'constraint'    => 11,
				'unsigned'      => true,
				'auto_increment' => true,
			],

			//SET MIGRASI NAMA PENGUPLOAD
			'nama_pengupload'   => [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],

			//SET MIGRASI JABATAN PENGUPLOAD
			'jabatan_pengupload' => [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],

			//SET MIGRASI DESKRIPSI GAMBAR
			'detail'       		=> [
				'type'          => 'VARCHAR',
				'constraint'    => '1000',
			],

			//SET MIGRASI GAMBAR
			'gambar'       		=> [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],

			//SET MIGRASI KATEGORI GAMBAR
			'kategori'       	=> [
				'type'          => 'ENUM',
				'constraint'   	=> ['Jalan Tol', 'Jembatan', 'Underpass'],
			],

			//SET MIGRASI KAPAN DIBUAT
			'created_at'       	=> [
				'type' 			=> 'DATETIME',
				'null'     		=> true,
			],

			//SET MIGRASI KAPAN DIUPDATE
			'updated_at'       	=> [
				'type'          => 'DATETIME',
				'null'     		=> true,
			],
		]);

		//SET MIGRASI PRIMARY KEY & TABEL
		$this->forge->addKey('id', true);
		$this->forge->createTable('galeri');
	}

	//SET MIGRASI DROP TABEL
	public function down()
	{
		$this->forge->dropTable('galeri');
	}
}
