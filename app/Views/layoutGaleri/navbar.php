<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Tambah gambar -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="col-4"><a class="btn btn-warning text-white" href="" data-toggle="modal" data-target="#tambah">Tambah gambar</a></div>
            <div class="col-3">
                <?php if (session()->getFlashData('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashData('pesan'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Foto -->
            <div class="col-1"><a class="btn btn-success" href="/galeri">Foto</a></div>

            <!-- Video -->
            <div class="col-2"><a class="btn btn-light" href="/video">Video</a></div>

            <!-- Filter By DROPDOWN-->
            <div class="col-2">
                <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                    Filter By
                </button>
                <div class="dropdown">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Date</a>
                        <a class="dropdown-item" href="#">Uploader</a>
                        <a class="dropdown-item" href="#">Rank</a>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="tambah" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1>Upload File</h1>
                            <form action="/galeri/save" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="container justify-content-center">
                                    <div class="row">

                                        <!-- input gambar -->
                                        <div class="col-lg-6 dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                <img src="/img/default.jpg" class="img-thumbnail img-preview">
                                                <b><label id="label" for="gambar"></label></b>
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
                                                    <input type="text" maxlength="30" class="form-control <?= ($validation->hasError('nama_pengupload')) ? 'is-invalid' : ''; ?>" id="nama_pengupload" name="nama_pengupload" placeholder="Nama" value="<?= old('nama_pengupload'); ?>" autofocus>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('nama_pengupload'); ?>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- input jabatan pengupload -->
                                            <div class="row m-2">
                                                <div class="col">
                                                    <input type="text" id="jabatan_pengupload" name="jabatan_pengupload" maxlength="30" placeholder="Jabatan" class="form-control" value="<?= old('jabatan_pengupload'); ?>">
                                                </div>
                                            </div>

                                            <!-- input deskripsi gambar -->
                                            <div class="row m-2">
                                                <div class="col">
                                                    <textarea class="form-control" placeholder="Tambahkan deskripsi..." cols="30" maxlength="1000" rows="4" name="detail" id="detail"> <?= old('detail'); ?></textarea>
                                                </div>
                                            </div>

                                            <!-- input kategori gambar -->
                                            <div class="row m-2">
                                                <div class="col">
                                                    <select class="custom-select" name="kategori" id="kategori">
                                                        <option selected>Pilih Kategori</option>
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
</nav>