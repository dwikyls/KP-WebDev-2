<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="col-4"><a class="btn btn-warning text-white" href="" data-toggle="modal" data-target="#tambah">Tambah gambar</a></div>
            <div class="col-3">
                <?php if (session()->getFlashData('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashData('pesan'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-1"><a class="btn btn-success" href="/galeri">Foto</a></div>
            <div class="col-2"><a class="btn btn-light" href="/video">Video</a></div>
            <div class="col-2">
                <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1>Upload File</h1>
                            <form action="/galeri/save" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="container">
                                    <div class="row">
                                        <div class=" col dropzone-wrapper">
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
                                        <div class="col preview-zone hidden">
                                            <div class="row m-2">
                                                <input type="text" class="form-control <?= ($validation->hasError('nama_pengupload')) ? 'is-invalid' : ''; ?>" id="nama_pengupload" name="nama_pengupload" placeholder="Nama" value="<?= old('nama_pengupload'); ?>" autofocus>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_pengupload'); ?>
                                                </div>
                                            </div>
                                            <div class="row m-2">
                                                <input type="text" id="jabatan_pengupload" name="jabatan_pengupload" placeholder="Jabatan" class="form-control" value="<?= old('jabatan_pengupload'); ?>">
                                            </div>
                                            <div class="row m-2">
                                                <div class="col"><textarea placeholder="Tambahkan deskripsi..." name="detail" id="detail" cols="70" rows="5"> <?= old('detail'); ?></textarea></div>
                                            </div>
                                            <div class="row box box-solid m-2">
                                                <div class=" col with-border">
                                                    <div class="box-tools pull-right"></div>
                                                </div>
                                                <div class="box-body">
                                                </div>
                                            </div>
                                            <div class="row m-2">
                                                <div class="col-12">
                                                    <select class="custom-select" name="kategori" id="kategori">
                                                        <option selected>Pilih Kategori</option>
                                                        <option value="Jalan Tol">Jalan Tol</option>
                                                        <option value="Jembatan">Jembatan</option>
                                                        <option value="Underpass">Underpass</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
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