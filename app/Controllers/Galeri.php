<?php

namespace App\Controllers;

use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;
    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
    }

    public function index()
    {

        $current_page = $this->request->getVar('page_galeri') ? $this->request->getVar('page_galeri') : 1;
        $data = [
            'title' => 'Galeri',
            'galeri' => $this->galeriModel->paginate(16, 'galeri'),
            'pager' => $this->galeriModel->pager,
            'current_page' => $current_page,
            'validation' => \Config\Services::validation()
        ];

        return view('galeri/index', $data);
    }
    public function detail($id)
    {
        $data = [
            'title' => 'Detail gambar',
            'galeri' => $this->galeriModel->getGaleri($id),
            'validation' => \Config\Services::validation()
        ];

        if (empty($data['galeri'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Gambar ' . $id . ' tidak ditemukan.');
        }

        return view('galeri/detail', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'nama_pengupload' => [
                'rules' => 'required[galeri.nama_pengupload]',
                'errors' => [
                    'required' => 'Nama Pengupload harus diisi!'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Batas maximum upload 1MB!',
                    'is_image' => 'File yang dipilih harus gambar!',
                    'mime_in' => 'Kesalahan ekstensi!'
                ]
            ]
        ])) {

            return redirect()->to('/galeri')->withInput();
        }

        $file_sampul = $this->request->getFile('gambar');

        if ($file_sampul->getError() == 4) {

            $nama_sampul = 'default.jpg';
        } else {
            $nama_sampul = $file_sampul->getRandomName();

            $file_sampul->move('img', $nama_sampul);
        }

        $this->galeriModel->save([
            'nama_pengupload' => $this->request->getVar('nama_pengupload'),
            'jabatan_pengupload' => $this->request->getVar('jabatan_pengupload'),
            'detail' => $this->request->getVar('detail'),
            'kategori' => $this->request->getVar('kategori'),
            'gambar' => $nama_sampul
        ]);

        session()->setFlashData('pesan', 'Data berhasil ditambahkan!');
        return redirect()->to('/galeri');
    }
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data',
            'validation' => \Config\Services::validation(),
            'galeri' => $this->galeriModel->find($id)
        ];

        return view('galeri/edit', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'nama_pengupload' => [
                'rules' => 'required[galeri.nama_pengupload]',
                'errors' => [
                    'required' => '{field} harus diisi!'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB!',
                    'is_image' => '{field} harus gambar!',
                    'mime_in' => '{field} ekstensi anda salah!'
                ]
            ]
        ])) {
            return redirect()->to('/galeri/edit/' . $this->request->getVar('id'))->withInput();
        }

        $file_gambar = $this->request->getFile('gambar');

        //cek gambar, apakah tetap gambar lama
        if ($file_gambar->getError() == 4) {
            $nama_gambar = $this->request->getVar('sampulLama');
        } else {
            //generate nama file random 
            $nama_gambar = $file_gambar->getRandomName();
            //pindahkan gambar
            $file_gambar->move('img', $nama_gambar);
            //karena gambarnya baru, berarti hapus gambar lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $this->galeriModel->save([
            'id' => $id,
            'nama_pengupload' => $this->request->getVar('nama_pengupload'),
            'jabatan_pengupload' => $this->request->getVar('jabatan_pengupload'),
            'detail' => $this->request->getVar('detail'),
            'kategori' => $this->request->getVar('kategori'),
            'gambar' => $nama_gambar
        ]);

        session()->setFlashData('pesan', 'Data berhasil diubah!');
        return redirect()->to('/galeri');
    }
    public function delete($id)
    {
        $galeri = $this->galeriModel->find($id);
        if ($galeri['gambar'] != 'default.jpg') {
            unlink('img/' . $galeri['gambar']);
        }
        $this->galeriModel->delete($id);

        session()->setFlashData('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/galeri');
    }
    public function jalanTol()
    {
        $data = [
            'title' => 'Jalan Tol',
            'validation' => \Config\Services::validation()

        ];

        return view('/galeri/jalanTol', $data);
    }
    public function jembatan()
    {
        $data = [
            'title' => 'Jembatan',
            'validation' => \Config\Services::validation()
        ];

        return view('/galeri/jembatan', $data);
    }
    public function underpass()
    {
        $data = [
            'title' => 'Underpass',
            'validation' => \Config\Services::validation()
        ];

        return view('/galeri/underpass', $data);
    }
    public function video()
    {
        $data = [
            'title' => 'Video',
            'validation' => \Config\Services::validation()
        ];

        return view('/galeri/video', $data);
    }
    //--------------------------------------------------------------------

}
