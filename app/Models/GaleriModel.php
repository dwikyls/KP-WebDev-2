<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_pengupload', 'jabatan_pengupload', 'detail', 'gambar', 'kategori'];

    public function getGaleri($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getKategori($kategori)
    {
        return $this->where(['kategori' => $kategori])->paginate(16, 'galeri');
    }
}
