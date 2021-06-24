<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 ">
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
                    <a href="/role_reportpdf" class="btn btn-danger mr-2">Unduh PDF</a>
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
                    <h4>Role User</h4>

                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#roleModal">
                        Tambah
                    </button>
                </div>
                <table class="table table-hover  table-borderless">
                    <thead>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>

                    <tbody>
                        <?php foreach ($RoleUser as $r) : ?>
                            <tr>
                                <td><?= $r['Nama']; ?></td>
                                <td><?= $r['NIK']; ?></td>
                                <td><?= $r['Jabatan']; ?></td>
                                <td><?= $r['role']; ?></td>
                                <td>
                                    <?php if ($r['Status'] == 0) : ?>
                                        <span class="badge badge-warning">Tidak Aktiv</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Aktiv</span>
                                    <?php endif ?>
                                </td>
                                <td>

                                    <a href="#" class="btn btn-warning btn-sm btn-edit " data-nik="<?= $r['NIK']; ?>" data-nama="<?= $r['Nama']; ?>" data-jabatan="<?= $r['Jabatan']; ?>" data-role="<?= $r['role']; ?>" data-status="<?= $r['Status']; ?>" data-email="<?= $r['Email']; ?>" data-ker="<?= $r['Keterangan']; ?>">edit</a>
                                    <form action="/Role_user/<?= $r['NIK']; ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">hapus</button>
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

<!-- modal tambah role -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Role_user/save" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input name="Nama" type="text" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input name="NIK" type="text" class="form-control" placeholder="Masukkan NIK" required maxlength="8" minlength="8">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input name="Password" type="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input name="Email" type="email" class="form-control" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="Jabatan">Jabatan</label>
                        <select class="form-control " name="Jabatan">
                            <?php foreach ($Jabatan as $j) : ?>
                                <option><?= $j['Jabatan']; ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Role">Role</label>
                        <select class="form-control " name="Role">

                            <option>super admin</option>
                            <option>Admin</option>
                            <option>User</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <textarea name="Keterangan" class="form-control" rows="4"></textarea>
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

<!-- update role -->
<div class="modal fade" id="roleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editForm">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input name="Nama" type="text" class="form-control nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input name="NIK" type="text" class="form-control NIK" placeholder="Masukkan NIK" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input name="Password" type="password" class="form-control password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input name="Email" type="email" class="form-control email" placeholder="Masukkan Email" required>
                    </div>
                    <div class="form-group">
                        <label for="Jabatan">Jabatan</label>
                        <select class="form-control jabatan" name="Jabatan">
                            <?php foreach ($Jabatan as $j) : ?>
                                <option><?= $j['Jabatan']; ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Role">Role</label>
                        <select class="form-control role" name="role">
                            <option>super admin</option>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control status" name="status">
                            <option value="1">aktiv</option>
                            <option value="0">tidak aktiv</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <textarea name="Keterangan" class="form-control ket" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <input name="Foto" type="file" class="form-control-file" placeholder="Masukkan Foto">
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
            const nama = $(this).data('nama');
            const jabatan = $(this).data('jabatan');
            const email = $(this).data('email');
            const ket = $(this).data('ket');
            const role = $(this).data('role');
            const status = $(this).data('status');
            const NIK = $(this).data('nik');
            const URL = '/Role_user/edit/' + NIK;
            // console.log(URL);


            // Set data to Form Edit
            $('.nama').val(nama);
            $('.jabatan').val(jabatan);
            $('.email').val(email);
            $('.ket').val(ket);
            $('.role').val(role);
            $('.status').val(status);
            $('.NIK').val(NIK);

            $('#editForm').attr('action', URL)
            $('#roleModalEdit').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>