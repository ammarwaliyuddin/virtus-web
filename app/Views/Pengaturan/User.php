<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 ">
            <?php
            $session = \Config\Services::session();
            if (!empty($session->getFlashdata('pesan'))) {

                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $session->getFlashdata('pesan') . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
            ?>
            <div class="card p-5">
                <div class="btngrp-zaam mt-2  w-100">
                    <a href="/User_reportpdf" class="btn btn-danger mr-2">Unduh PDF</a>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-success">Excel</button>
                        <button type="button" class="btn btn-success dropdown-toggle excel dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <!-- Button trigger modal -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#import_excel" href="#">
                                Import
                            </a>
                            <a class="dropdown-item" href="/Jabatan/export_excel">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="jabatan-header mt-4 mb-2">
                    <h4>Users</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#userModal">
                        Tambah
                    </button>
                </div>

                <table class="table table-hover table-borderless">
                    <thead>
                        <th>NIK</th>
                        <th>Nama </th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>


                        <?php foreach ($User as $U) : ?>
                            <tr>
                                <td><?= $U['NIK']; ?></td>
                                <td><?= $U['Nama']; ?></td>
                                <td><?= $U['Jabatan']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-edit" data-nik="<?= $U['NIK']; ?>" data-nama="<?= $U['Nama']; ?>" data-jabatan="<?= $U['Jabatan']; ?>" data-email="<?= $U['Email']; ?>" data-password="<?= $U['Password']; ?>" data-foto="<?= $U['Foto']; ?>" data-expiredate="<?= $U['Expiredate']; ?>" data-status="<?= $U['Status']; ?>" data-keterangan="<?= $U['Keterangan']; ?>">edit</a>

                                    <form action="/User/<?= $U['NIK']; ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<!-- Modal tambah user -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/User/save" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input name="NIK" type="text" class="form-control" id="NIK" placeholder="Masukkan NIK" required>
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama </label>
                        <input name="Nama" type="text" class="form-control" id="Nama" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group">

                        <label for="Jabatan">Jabatan</label>
                        <select class="form-control" name="Jabatan">
                            <?php foreach ($Jabatan as $j) : ?>
                                <option><?= $j['Jabatan']; ?></option>
                            <?php endforeach ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input name="Email" type="email" class="form-control" id="Email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Masukkan Password</label>
                        <input name="Password" type="password" class="form-control" id="Password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto (upload foto)</label>
                        <input name="Foto" type="file" class="form-control-file" id="Foto" placeholder="Masukkan Foto">
                    </div>
                    <div class="form-group">
                        <label for="Expiredate">Expiredate</label>
                        <input name="Expiredate" type="text" class="form-control" id="Expiredate" placeholder="Masukkan Expiredate">
                    </div>
                    <div class="form-group">
                        <label for="Status">Status (0/1)</label>
                        <input name="Status" type="text" class="form-control" id="Status" placeholder="Masukkan Status" required>
                    </div>
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <input name="Keterangan" type="text" class="form-control" id="Keterangan" placeholder="Masukkan Keterangan">
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

<!-- modal edit user  -->
<div class="modal fade" id="userModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/User/edit/<?= $U['NIK']; ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input name="NIK" type="text" class="form-control NIK" placeholder="Masukkan NIK">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama Lengkap</label>
                        <input name="Nama" type="text" class="form-control Nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="Jabatan">Jabatan</label>
                        <select class="form-control Jabatan" name="Jabatan">
                            <?php foreach ($Jabatan as $j) : ?>
                                <option><?= $j['Jabatan']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input name="Email" type="email" class="form-control Email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Masukkan Password</label>
                        <input name="Password" type="password" class="form-control Password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto (upload foto)</label>
                        <input name="Foto" type="file" class="form-control-file" placeholder="Masukkan Foto">
                    </div>
                    <div class="form-group">
                        <label for="Expiredate">Expiredate</label>
                        <input name="Expiredate" type="text" class="form-control Expiredate" placeholder="Masukkan Expiredate">
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control Status" name="Status">
                            <option value="1">aktiv</option>
                            <option value="0">tidak aktiv</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <input name="Keterangan" type="text" class="form-control Keterangan" placeholder="Masukkan Keterangan">
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

<!-- <script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script> -->
<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {

            // get data from button edit
            const NIK = $(this).data('nik');
            const Nama = $(this).data('nama');
            const Jabatan = $(this).data('jabatan');
            const Email = $(this).data('email');
            const Password = $(this).data('password');
            const Foto = $(this).data('foto');
            const Expiredate = $(this).data('expiredate');
            const Status = $(this).data('status');
            const Keterangan = $(this).data('keterangan');

            console.log(Email);

            // Set data to Form Edit
            $('.NIK').val(NIK);
            $('.Nama').val(Nama);
            $('.Jabatan').val(Jabatan);
            $('.Email').val(Email);
            $('.Password').val(Password);
            $('.Foto').val(Foto);
            $('.Expiredate').val(Expiredate);
            $('.Status').val(Status);
            $('.Keterangan').val(Keterangan);

            $('#userModalEdit').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>