document.addEventListener("click", function (e) {
  if (e.target.classList.contains("button-image")) {
    let id = e.target.dataset.id;
    let nama = e.target.dataset.nama;
    let jabatan = e.target.dataset.jabatan;
    let detail = e.target.dataset.detail;
    let gambar = e.target.dataset.gambar;
    let kategori = e.target.dataset.kategori;
    let created_at = e.target.dataset.created;
    let updated_at = e.target.dataset.updated;

    const detailImage = document.querySelector(".detail-image");
    detailImage.innerHTML = `
        <img class="w-100" src="/img/${gambar}">
    `;

    const identitas = document.querySelector(".identitas");
    identitas.innerHTML = `
        <b>${nama}</b><br>
        <b class="text-warning">${jabatan}</b>
    `;

    const opsi = document.querySelector(".opsi");
    opsi.innerHTML = `
        <a class="dropdown-item" data-toggle="modal" data-target="#edit" href="">Edit</a>
        <form action="/galeri/${id}" method="POST" class="d-inline">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="dropdown-item bg-danger text-white" onclick="return confirm('Apakah anda yakin?')">Delete</button>
        </form>
    `;

    const editForm = document.querySelector(".edit-form");
    editForm.innerHTML = `
        <form action="/galeri/update/${id}" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="sampulLama" value="${gambar}">
            <div class="container justify-content-center">
                <div class="row justify-content-center">

                    <!-- input gambar -->
                    <div class="col-lg-6 dropzone-wrapper">
                        <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <img src="/img/${gambar}" class="img-thumbnail image-preview">
                            <b><label id="label2" for="gambar">${gambar}</label></b>
                        </div>
                        <input type="file" id="gambar2" name="gambar" class="dropzone form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('gambar'); ?>
                        </div>
                    </div>

                    <!-- input nama pengupload -->
                    <div class="col-lg-6 preview-zone hidden">
                        <div class="row m-2">
                            <div class="col">
                                <input type="text" maxlength="30" class="form-control <?= ($validation->hasError('nama_pengupload')) ? 'is-invalid' : ''; ?>" id="nama_pengupload" name="nama_pengupload" placeholder="Nama" value="${
                                  nama.oldValue ? nama.oldValue : nama
                                }" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_pengupload'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- input jabatan pengupload -->
                        <div class="row m-2">
                            <div class="col">
                                <input type="text" id="jabatan_pengupload" name="jabatan_pengupload" maxlength="30" placeholder="Jabatan" class="form-control" value="${
                                  jabatan.oldValue ? jabatan.oldValue : jabatan
                                }">
                            </div>
                        </div>

                        <!-- input deskripsi gambar -->
                        <div class="row m-2">
                            <div class="col">
                                <textarea class="form-control" placeholder="Tambahkan deskripsi..." cols="30" maxlength="1000" rows="4" name="detail" id="detail">${
                                  detail.oldValue ? detail.oldValue : detail
                                }</textarea>
                            </div>
                        </div>

                        <!-- input kategori gambar -->
                        <div class="row m-2">
                            <div class="col">
                                <select class="custom-select" name="kategori" id="kategori">
                                    <option value="${
                                      kategori.oldValue
                                        ? kategori.oldValue
                                        : kategori
                                    }" selected>${
      kategori.oldValue ? kategori.oldValue : kategori
    }</option>
                                    <option value="Jalan Tol">Jalan Tol</option>
                                    <option value="Jembatan">Jembatan</option>
                                    <option value="Underpass">Underpass</option>
                                </select>
                            </div>
                        </div>

                        <!-- simpan -->
                        <div class="row m-2">
                            <div class="col">
                                <button type="submit" class="btn btn-warning text-white">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    `;

    const imageDetail = document.querySelector(".image-detail");
    imageDetail.innerHTML = `
        <p class="text-justify">${detail}</p>
    `;

    const tanggalDibuat = document.querySelector(".tanggal-dibuat");
    tanggalDibuat.innerHTML = `
        <b class="text-warning">${created_at}</b>
    `;
  }
});

function previewImage() {
  const sampul = document.querySelector("#gambar2");
  const sampulLabel = document.querySelector("#label2");
  const imgPreview = document.querySelector(".image-preview");

  sampulLabel.textContent = sampul.files[0].name;

  const fileSampul = new FileReader();
  fileSampul.readAsDataURL(sampul.files[0]);

  fileSampul.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}
