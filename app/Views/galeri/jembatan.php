<?= $this->extend('layoutGaleri/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col text-center mt-3">
            <a href="/galeri" class="btn btn-light">All<span class="sr-only">(current)</span></a>
            <a href="/jalanTol" class="btn btn-light">Jalan Tol</a>
            <a href="/jembatan" class="btn btn-success">Jembatan</a>
            <a href="/underpass" class="btn btn-light">Underpass</a>
        </div>
    </div>
    <hr>
</div>

<!-- TOMBOL HALAMAN ATAS -->
<div class="container">
    <div class="row">
        <div class="col">
            <?= $pager->links('galeri', 'galeri_pagination'); ?>
        </div>
    </div>

    <!-- GAMBAR -->
    <div class="row">
        <?php foreach ($galeri as $g) : ?>
            <div class="col-3">
                <div class="row justify-content-center">
                    <a href="/galeri/detail/<?= $g['id']; ?>">
                        <img width="250px" height="250px" src="/img/<?= $g['gambar']; ?>">
                    </a>
                </div>

                <!-- NAMA PENGUPLOAD DAN TANGGAL POST -->
                <div class="row">
                    <div class="col"><b><?= $g['nama_pengupload']; ?></b></div>
                    <div class="col text-right"><?= $g['created_at']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- TOMBOL HALAMAN BAWAH -->
    <div class="row">
        <div class="col">
            <?= $pager->links('galeri', 'galeri_pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>