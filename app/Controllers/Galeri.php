<?php

namespace App\Controllers;

use App\Models\GaleriModel;
use App\Models\UploadsModel;
use App\Models\VideoModel;

class Galeri extends BaseController
{
    protected $galeriModel;
    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->uploadsModel = new UploadsModel();
        $this->videoModel = new VideoModel();
    }

    //INDEX TAMPILKAN SEMUA DATA
    public function index()
    {

        $current_page = $this->request->getVar('page_galeri') ? $this->request->getVar('page_galeri') : 1;

        $data = [
            'title' => 'Galeri',
            'galeri' => $this->galeriModel->paginate(16, 'galeri'),
            'pager' => $this->galeriModel->pager,
            'current_page' => $current_page,
            'validation' => \Config\Services::validation(),
            'page' => $this->galeriModel->getGaleri()
        ];

        return view('galeri/index', $data);
    }


    //SIMPAN DATA BARU
    public function save()
    {
        if (!$this->validate([
            'nama_pengupload' => [
                'rules' => 'required[galeri.nama_pengupload]',
                'errors' => [
                    'required' => 'Nama Pengupload harus di isi!'
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Batas maximum upload 2MB!',
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

    //UPDATE DATA
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
            return redirect()->to('/galeri/detail/' . $this->request->getVar('id'))->withInput();
        }

        $file_gambar = $this->request->getFile('gambar');

        if ($file_gambar->getError() == 4) {
            $nama_gambar = $this->request->getVar('sampulLama');
        } else {

            $nama_gambar = $file_gambar->getRandomName();
            $file_gambar->move('img', $nama_gambar);
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

    //DELETE DATA
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

    //TAMPILKAN DATA KATEGORI JALAN TOL SAJA
    public function jalanTol()
    {

        $current_page = $this->request->getVar('page_galeri') ? $this->request->getVar('page_galeri') : 1;

        $data = [
            'title' => 'Galeri',
            'validation' => \Config\Services::validation(),
            'galeri' => $this->galeriModel->getKategori('Jalan Tol'),
            'current_page' => $current_page,
            'pager' => $this->galeriModel->pager
        ];

        return view('/galeri/jalanTol', $data);
    }

    //TAMPILKAN DATA KATEGORI JEMBATAN SAJA
    public function jembatan()
    {

        $current_page = $this->request->getVar('page_galeri') ? $this->request->getVar('page_galeri') : 1;

        $data = [
            'title' => 'Galeri',
            'validation' => \Config\Services::validation(),
            'galeri' => $this->galeriModel->getKategori('Jembatan'),
            'current_page' => $current_page,
            'pager' => $this->galeriModel->pager
        ];

        return view('/galeri/jembatan', $data);
    }

    //TAMPILKAN DATA KATEGORI UNDERPASS SAJA
    public function underpass()
    {

        $current_page = $this->request->getVar('page_galeri') ? $this->request->getVar('page_galeri') : 1;

        $data = [
            'title' => 'Underpass',
            'validation' => \Config\Services::validation(),
            'galeri' => $this->galeriModel->getKategori('Underpass'),
            'current_page' => $current_page,
            'pager' => $this->galeriModel->pager
        ];

        return view('/galeri/underpass', $data);
    }

    //DATA VIDEO
    public function video()
    {
        $data = [
            'title' => 'Video',
            'validation' => \Config\Services::validation(),
            helper('form')
        ];

        return view('/galeri/video', $data);
    }

    public function process()
    {
        $title = $this->request->getPost('title');
        // dapatkan input file berupa array
        $files = $this->request->getFiles();

        if ($files) {

            // buat value id random di table uploads
            $random = rand(000, 999);

            $data_uploads = [
                'id' => $random,
                'title' => $title
            ];

            $this->uploadsModel->insertUpload($data_uploads);

            // ulangi insert gambar ke table galery menggunakan foreach
            foreach ($files['file_upload'] as $img) {

                $data_galery = [
                    'upload_id' => $random,
                    'gambar' => $img->getRandomName()
                ];

                $this->videoModel->insertGalery($data_galery);
                // upload dengan random name
                $img->move('img', $img->getRandomName());
            }
            session()->setFlashdata('success', 'Berhasil upload ' . count($files['file_upload']) . ' files');
            return redirect()->to('/video');
        }
    }
    //--------------------------------------------------------------------

}
