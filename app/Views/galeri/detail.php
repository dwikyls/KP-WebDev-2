<?= $this->extend('layoutGaleri/template2'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-6 text-center border-right"><img width="400px" src="<?= $galeri['gambar']; ?>"></div>
        <div class="col-5 ml-5">
            <div class="row">
                <div class="col-8">
                    <b><?= $galeri['nama_pengupload']; ?></b><br>
                    <b><?= $galeri['jabatan_pengupload']; ?></b>
                </div>
                <div class="col-4">
                    <div class="dropdown">
                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            <h1>...</h1>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/galeri/edit/<?= $galeri['id']; ?>">Edit</a>
                            <form action="/galeri/<?= $galeri['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?= $galeri['detail']; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>