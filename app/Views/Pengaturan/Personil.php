<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-lg-12">
            <?php
            $session = \Config\Services::session();
            if (!empty($session->getFlashdata('pesan'))) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $session->getFlashdata('pesan') . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            ?>
            <div class="card p-5">
                <div class="btngrp-zaam mt-2  w-100">
                    <a href="/personil_reportpdf" class="btn btn-danger mr-2">Unduh PDF</a>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-success">Excel</button>
                        <button type="button" class="btn btn-success dropdown-toggle excel dropdown-toggle-split" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <!-- Button trigger modal -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#import" href="#">
                                Import
                            </a>
                            <a class="dropdown-item" href="/personil_export">
                                Export
                            </a>
                        </div>
                    </div>
                </div>
                <div class="jabatan-header mt-4 mb-2">
                    <h4>DAFTAR PERSONIL</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#PersonilModal">
                        Tambah
                    </button>
                </div>

                <div class="card-content card-table">
                    <table class="table card-table-setting table-hover table-borderless">
                        <th scope="col">No</th>
                        <th scope="col">Nama Personil</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($personilAll as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $p['Nama']; ?></td>
                                    <td><?= $p['NIK']; ?></td>
                                    <td><?= $p['Email']; ?></td>

                                    <td>
                                        <a href="#" class="btn btn-warning btn-edit btn-sm" data-nik="<?= $p['NIK']; ?>" data-nama="<?= $p['Nama']; ?>" data-pin="<?= $p['PIN']; ?>" data-Umur="<?= $p['Umur']; ?>" data-nomor="<?= $p['Nomor_HP']; ?>" data-email="<?= $p['Email']; ?>" data-foto="<?= $p['Foto']; ?>">edit</a>
                                        <form action="/Security/<?= $p['NIK']; ?>" method="POST" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin untuk menghapus?');">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal import excel -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Security/import') ?>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="file" name="fileimport" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import data</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal personil -->
<div class="modal fade" id="PersonilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Security/save" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input name="NIK" type="text" class="form-control" id="NIK" placeholder="Masukkan NIK" required maxlength="8">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input name="Nama" type="text" class="form-control" id="Nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="PIN">PIN</label>
                        <input name="PIN" type="text" class="form-control" id="PIN" placeholder="Masukkan PIN" required>
                    </div>
                    <div class="form-group">
                        <label for="Umur">Umur</label>
                        <input name="Umur" type="text" class="form-control" id="Umur" placeholder="Masukkan Umur" required>
                    </div>
                    <div class="form-group">
                        <label for="Nomor_HP">Nomor HP</label>
                        <input name="Nomor_HP" type="text" class="form-control" id="Nomor_HP" placeholder="Masukkan Nomor HP" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input name="Email" type="text" class="form-control" id="Email" placeholder="Masukkan Email" required>
                    </div>

                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <input name="Foto" type="file" class="form-control-file" placeholder="Masukkan Foto">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
                <button type="submit" class="btn btn-primary">simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- update personil -->
<div class="modal fade" id="personilModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Update Personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input name="NIK" type="text" class="form-control NIK" placeholder="Masukkan NIK" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="nama">nama</label>
                        <input name="Nama" type="text" class="form-control nama" placeholder="Masukkan nama" required>
                    </div>
                    <div class="form-group">
                        <label for="pin">pin</label>
                        <input name="PIN" type="text" class="form-control pin" placeholder="Masukkan pin" required>
                    </div>
                    <div class="form-group">
                        <label for="umur">umur</label>
                        <input name="Umur" type="text" class="form-control umur" placeholder="Masukkan umur" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor">nomor</label>
                        <input name="Nomor_HP" type="text" class="form-control nomor" placeholder="Masukkan nomor" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input name="Email" type="text" class="form-control email" placeholder="Masukkan email" required>
                    </div>
                    <div class="form-group">
                        <label for="Foto">Upload</label>
                        <input type="file" name="Foto" class="form-control-file">
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="AreaLama" type="text" class="form-control Nama_area" id="AreaLama" aria-describedby="emailHelp" placeholder="Masukkan Nama Area">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
                <button type="submit" class="btn btn-primary">simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const NIK = $(this).data('nik');
            const nama = $(this).data('nama');
            const pin = $(this).data('pin');
            const umur = $(this).data('umur');
            const nomor = $(this).data('nomor');
            const email = $(this).data('email');
            const foto = $(this).data('foto');
            const URL = '/Security/edit/' + NIK;


            console.log(URL);


            // Set data to Form Edit
            $('.NIK').val(NIK);
            $('.nama').val(nama);
            $('.pin').val(pin);
            $('.umur').val(umur);
            $('.nomor').val(nomor);
            $('.email').val(email);
            $('.foto').val(foto);

            $('#editForm').attr('action', URL)
            $('#personilModalEdit').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>