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
            <div class="col-md-3">
                <div class="row justify-content-center">
                    <a href="/galeri/detail/<?= $g['id']; ?>">
                        <img width="250px" height="250px" src="/img/<?= $g['gambar']; ?>">
                    </a>
                </div>

                <!-- NAMA PENGUPLOAD DAN KAPAN DI POSTING -->
                <div class="row justify-content-around">
                    <b><?= $g['nama_pengupload']; ?></b>
                    <p><?= $g['created_at']; ?></p>
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