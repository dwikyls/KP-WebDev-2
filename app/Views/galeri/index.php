<?= $this->extend('layoutGaleri/template'); ?>

<?= $this->section('content'); ?>

<div class="container">

</div>
<div class="container">
    <div class="row">
        <div class="col">
            <?= $pager->links('galeri', 'galeri_pagination'); ?>
        </div>
    </div>
    <div class="row">
        <?php foreach ($galeri as $g) : ?>
            <div class="col-3">
                <div class="row justify-content-center"><a href="/galeri/detail/<?= $g['id']; ?>"><img width="200px" height="200px" src="<?= $g['gambar']; ?>"></a></div>
                <div class="row">
                    <div class="col"><?= $g['nama_pengupload']; ?></div>
                    <div class="col"><?= $g['created_at']; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col">
            <?= $pager->links('galeri', 'galeri_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>