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
    <div class="row justify-content-center">

        <!-- TAMPILAN GAMBAR -->
        <div class="col-md-6 m-2">
            <img class="w-100" src="/img/<?= $galeri['gambar']; ?>">
        </div>

        <div class="col-md-5 m-3">
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

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <!-- EDIT -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#edit" href="">Edit</a>

                            <!-- DELETE -->
                            <form action="/galeri/<?= $galeri['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="dropdown-item bg-danger text-white" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                            </form>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="edit" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h1>Upload File</h1>
                                        <form action="/galeri/update/<?= $galeri['id']; ?>" method="POST" enctype="multipart/form-data">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="sampulLama" value="<?= $galeri['gambar']; ?>">
                                            <div class="container justify-content-center">
                                                <div class="row justify-content-center">

                                                    <!-- input gambar -->
                                                    <div class="col-lg-6 dropzone-wrapper">
                                                        <div class="dropzone-desc">
                                                            <i class="glyphicon glyphicon-download-alt"></i>
                                                            <img src="/img/<?= $galeri['gambar']; ?>" class="img-thumbnail img-preview">
                                                            <b><label id="label" for="gambar"><?= $galeri['gambar']; ?></label></b>
                                                        </div>
                                                        <input type="file" id="gambar" name="gambar" class="dropzone form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" onchange="previewImg()">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('gambar'); ?>
                                                        </div>
                                                    </div>

                                                    <!-- input nama pengupload -->
                                                    <div class="col-lg-6 preview-zone hidden">
                                                        <div class="row m-2">
                                                            <div class="col">
                                                                <input type="text" maxlength="30" class="form-control <?= ($validation->hasError('nama_pengupload')) ? 'is-invalid' : ''; ?>" id="nama_pengupload" name="nama_pengupload" placeholder="Nama" value="<?= (old('nama_pengupload')) ? old('nama_pengupload') : $galeri['nama_pengupload'] ?>" autofocus>
                                                                <div class="invalid-feedback">
                                                                    <?= $validation->getError('nama_pengupload'); ?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- input jabatan pengupload -->
                                                        <div class="row m-2">
                                                            <div class="col">
                                                                <input type="text" id="jabatan_pengupload" name="jabatan_pengupload" maxlength="30" placeholder="Jabatan" class="form-control" value="<?= (old('jabatan_pengupload')) ? old('jabatan_pengupload') : $galeri['jabatan_pengupload'] ?>">
                                                            </div>
                                                        </div>

                                                        <!-- input deskripsi gambar -->
                                                        <div class="row m-2">
                                                            <div class="col">
                                                                <textarea class="form-control" placeholder="Tambahkan deskripsi..." cols="30" maxlength="1000" rows="4" name="detail" id="detail"><?= (old('detail')) ? old('detail') : $galeri['detail'] ?></textarea>
                                                            </div>
                                                        </div>

                                                        <!-- input kategori gambar -->
                                                        <div class="row m-2">
                                                            <div class="col">
                                                                <select class="custom-select" name="kategori" id="kategori">
                                                                    <option value="<?= (old('kategori')) ? old('kategori') : $galeri['kategori'] ?>" selected><?= ($galeri['kategori']) ? ($galeri['kategori']) : 'Pilih Kategori' ?></option>
                                                                    <option value="Jalan Tol">Jalan Tol</option>
                                                                    <option value="Jembatan">Jembatan</option>
                                                                    <option value="Underpass">Underpass</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- simpan -->
                                                        <div class="row m-2">
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