<?= $this->extend('layoutGaleri/template'); ?>

<?= $this->section('content'); ?>

<!-- MENU -->
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

<?= $this->endSection(); ?>