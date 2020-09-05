<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Galeri extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          		=> [
				'type'          => 'INT',
				'constraint'    => 11,
				'unsigned'      => true,
				'auto_increment' => true,
			],
			'nama_pengupload'   => [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],
			'jabatan_pengupload' => [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],
			'detail'       		=> [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],
			'gambar'       		=> [
				'type'          => 'VARCHAR',
				'constraint'    => '255',
			],
			'kategori'       	=> [
				'type'          => 'ENUM',
				'constraint'   	=> ['Jalan Tol', 'Jembatan', 'Underpass'],
			],
			'created_at'       	=> [
				'type' 			=> 'DATETIME',
				'null'     		=> true,
			],
			'updated_at'       	=> [
				'type'          => 'DATETIME',
				'null'     		=> true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('galeri');
	}

	public function down()
	{
		$this->forge->dropTable('galeri');
	}
}
