<?= $this->extend('layoutGaleri/template2'); ?>

<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="/galeri/update/<?= $galeri['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="sampulLama" value="<?= $galeri['gambar']; ?>">
                <div class="container">
                    <div class="row">
                        <div class=" col dropzone-wrapper">
                            <div class="dropzone-desc">

                                <i class="glyphicon glyphicon-download-alt"></i>
                                <img src="<?= $galeri['gambar']; ?>" class="img-thumbnail img-preview">
                                <br><b><label id="label" for="gambar"><?= $galeri['gambar']; ?></label></b>

                            </div>

                            <input type="file" class="dropzone form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" onchange="previewImg()">

                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>

                        </div>
                        <div class="col preview-zone hidden">
                            <div class="row m-2">
                                <input type="text" class="form-control <?= ($validation->hasError('nama_pengupload')) ? 'is-invalid' : ''; ?>" id="nama_pengupload" name="nama_pengupload" placeholder="Nama" value="<?= (old('nama_pengupload')) ? old('nama_pengupload') : $galeri['nama_pengupload'] ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_pengupload'); ?>
                                </div>
                            </div>
                            <div class="row m-2">
                                <input type="text" id="jabatan_pengupload" name="jabatan_pengupload" placeholder="Jabatan" class="form-control" value="<?= (old('jabatan_pengupload')) ? old('jabatan_pengupload') : $galeri['jabatan_pengupload'] ?>">
                            </div>
                            <div class="row m-2">
                                <div class="col"><textarea placeholder="Tambahkan deskripsi..." name="detail" id="detail" cols="70" rows="5"><?= (old('detail')) ? old('detail') : $galeri['detail'] ?></textarea></div>
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
                                        <option value="<?= (old('kategori')) ? old('kategori') : $galeri['kategori'] ?>" selected><?= ($galeri['kategori']) ? ($galeri['kategori']) : 'Pilih Kategori' ?></option>
                                        <option value="Jalan Tol">Jalan Tol</option>
                                        <option value="Jembatan">Jembatan</option>
                                        <option value="Underpass">Underpass</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <a href="/galeri" type="button" class="btn btn-secondary">Close</a>
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
<?= $this->endSection(); ?>