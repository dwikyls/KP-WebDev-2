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
                    <a href="" data-toggle="modal" data-target="#detailImage">
                        <img data-id="<?= $g['id']; ?>" data-nama="<?= $g['nama_pengupload']; ?>" data-jabatan="<?= $g['jabatan_pengupload']; ?>" data-detail="<?= $g['detail']; ?>" data-gambar="<?= $g['gambar']; ?>" data-kategori="<?= $g['kategori']; ?>" data-created="<?= $g['created_at']; ?>" data-updated="<?= $g['updated_at']; ?>" class="button-image" width="250px" height="250px" src="/img/<?= $g['gambar']; ?>">
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

<!-- Modal -->
<div class="modal fade" id="detailImage" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container mt-5">
                    <div class="row justify-content-center">

                        <!-- TAMPILAN GAMBAR -->
                        <div class="col-md-6 m-2 detail-image"></div>

                        <div class="col-md-5 m-3">
                            <div class="row">

                                <!-- DATA DIRI PENGUPLOAD -->
                                <div class="col-8 identitas"></div>

                                <!-- MENU DROPDOWN TITIK-TITIK -->
                                <div class="col-3">
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                            <h3>...</h3>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right opsi" aria-labelledby="dropdownMenuButton">
                                            <!-- modal.js EDIT BUTTON DELETE FORM -->
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="edit" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body edit-form">
                                                        <h1>Upload File</h1>

                                                        <!-- modal.js EDIT FORM -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TOMBOL X POJOK KANAN ATAS MODAL -->
                                <div class="col-1">
                                    <a href="" type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>

                            <!-- DESKRIPSI GAMBAR -->
                            <div class="row image-detail"></div>

                            <!-- TANGGAL DIBUAT -->
                            <div class="row tanggal-dibuat"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>