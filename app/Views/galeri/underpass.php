<?= $this->extend('layoutGaleri/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col text-center mt-3">
            <a href="/galeri" class="btn btn-light">All<span class="sr-only">(current)</span></a>
            <a href="/jalanTol" class="btn btn-light">Jalan Tol</a>
            <a href="/jembatan" class="btn btn-light">Jembatan</a>
            <a href="/underpass" class="btn btn-success">Underpass</a>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <?php foreach ($galeri as $g) : ?>
            <div class="col-3">
                <div class="row justify-content-center">
                    <a href="/galeri/detail/<?= $g['id']; ?>">
                        <img width="250px" height="250px" src="/img/<?= $g['gambar']; ?>">
                    </a>
                </div>
                <div class="row">
                    <div class="col"><b><?= $g['nama_pengupload']; ?></b></div>
                    <div class="col text-right"><?= $g['created_at']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?= $this->endSection(); ?>