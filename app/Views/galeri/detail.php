<?= $this->extend('layoutGaleri/template2'); ?>

<?= $this->section('content'); ?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <!-- TOMBOL KEMBALI -->
        <div class="col-5"><a href="/galeri" class="btn btn-primary">Kembali</a></div>

        <!-- NOTIFIKASI BERHASIL -->
        <div class="col-5">
            <?php if (session()->getFlashData('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan'); ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<div class="container mt-5">
    <div class="row">

        <!-- TAMPILAN GAMBAR -->
        <div class="col-6 text-center border-right">
            <img width="400px" src="/img/<?= $galeri['gambar']; ?>">
            <div class="row">
                <div class="col">
                </div>
            </div>
        </div>

        <div class="col-5 ml-5">
            <div class="row">

                <!-- DATA DIRI PENGUPLOAD -->
                <div class="col-8">
                    <b><?= $galeri['nama_pengupload']; ?></b><br>
                    <b class="text-warning"><?= $galeri['jabatan_pengupload']; ?></b>
                </div>

                <!-- MENU DROPDOWN TITIK-TITIK -->
                <div class="col-3">
                    <div class="dropdown">
                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            <h3>...</h3>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <!-- EDIT -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#edit" href="">Edit</a>

                            <!-- DELETE -->
                            <form action="/galeri/<?= $galeri['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="dropdown-item bg-danger text-white" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                            </form>
                        </div>


                        <div class="modal fade" id="edit" tabindex="-1">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- HEADER MODAL -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit data gambar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <!-- BODY MODAL -->
                                    <div class="modal-body">
                                        <form action="/galeri/update/<?= $galeri['id']; ?>" method="POST" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="sampulLama" value="<?= $galeri['gambar']; ?>">
                                            <div class="container">
                                                <div class="row">
                                                    <div class=" col dropzone-wrapper">
                                                        <div class="dropzone-desc">

                                                            <!-- PREVIEW GAMBAR -->
                                                            <i class="glyphicon glyphicon-download-alt"></i>
                                                            <img src="/img/<?= $galeri['gambar']; ?>" class="img-thumbnail img-preview">
                                                            <br><b><label id="label" for="gambar"><?= $galeri['gambar']; ?></label></b>
                                                        </div>

                                                        <!-- INPUT GAMBAR -->
                                                        <input type="file" class="dropzone form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" onchange="previewImg()">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('gambar'); ?>
                                                        </div>
                                                    </div>

                                                    <!-- EDIT NAMA PENGUPLOAD -->
                                                    <div class="col preview-zone hidden">
                                                        <div class="row m-2">
                                                            <input type="text" class="form-control <?= ($validation->hasError('nama_pengupload')) ? 'is-invalid' : ''; ?>" id="nama_pengupload" name="nama_pengupload" placeholder="Nama" value="<?= (old('nama_pengupload')) ? old('nama_pengupload') : $galeri['nama_pengupload'] ?>" autofocus>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError('nama_pengupload'); ?>
                                                            </div>
                                                        </div>

                                                        <!-- EDIT JABATAN PENGUPLOAD -->
                                                        <div class="row m-2">
                                                            <input type="text" id="jabatan_pengupload" name="jabatan_pengupload" placeholder="Jabatan" class="form-control" value="<?= (old('jabatan_pengupload')) ? old('jabatan_pengupload') : $galeri['jabatan_pengupload'] ?>">
                                                        </div>

                                                        <!-- EDIT DESKRIPSI GAMBAR -->
                                                        <div class="row m-2">
                                                            <div class="col"><textarea placeholder="Tambahkan deskripsi..." name="detail" id="detail" cols="70" maxlength="1000" rows="5"><?= (old('detail')) ? old('detail') : $galeri['detail'] ?></textarea></div>
                                                        </div>

                                                        <!-- EDIT KATEGORI GAMBAR -->
                                                        <div class="row m-2">
                                                            <div class="col-12">
                                                                <select class="custom-select" name="kategori" id="kategori">
                                                                    <option value="<?= (old('kategori')) ? old('kategori') : $galeri['kategori'] ?>" selected><?= ($galeri['kategori']) ? ($galeri['kategori']) : 'Pilih Kategori' ?></option>
                                                                    <option value="Jalan Tol">Jalan Tol</option>
                                                                    <option value="Jembatan">Jembatan</option>
                                                                    <option value="Underpass">Underpass</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- BUTTON SUBMIT -->
                                                        <div class="row mt-2">
                                                            <div class="col">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-warning text-white">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL X POJOK KANAN ATAS MODAL -->
                <div class="col-1">
                    <a href="/galeri" type="button" class="close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
            </div>

            <!-- DESKRIPSI GAMBAR -->
            <div class="row">
                <p class="text-justify"><?= $galeri['detail']; ?></p>
            </div>

            <!-- TANGGAL DIBUAT -->
            <div class="row">
                <b class="text-warning"><?= $galeri['created_at']; ?></b>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>