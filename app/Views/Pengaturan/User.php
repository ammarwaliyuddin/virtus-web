<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 ">
            <div class="card p-5">
                <div class="btngrp-zaam mt-2  w-100">
                    <a href="" class="btn btn-danger mr-2">Unduh PDF</a>
                    <a href="" class="btn btn-success mr-2">Unduh Excel</a>
                    <a href="" class="btn btn-dark">Print</a>
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
                                    <a href="" class="btn btn-warning btn-sm">edit</a>

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


<!-- Modal jabatan -->
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
                        <input name="NIK" type="text" class="form-control" id="NIK" aria-describedby="emailHelp" placeholder="Masukkan NIK">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama Lengkap</label>
                        <input name="Nama" type="text" class="form-control" id="Nama" aria-describedby="emailHelp" placeholder="Masukkan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="Jabatan">Jabatan</label>
                        <input name="Jabatan" type="text" class="form-control" id="Jabatan" aria-describedby="emailHelp" placeholder="Masukkan Jabatan">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input name="Email" type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Masukkan Email ">
                    </div>
                    <div class="form-group">
                        <label for="Password">Masukkan Password</label>
                        <input name="Password" type="password" class="form-control" id="Password" aria-describedby="emailHelp" placeholder="Masukkan AMasukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto (upload foto)</label>
                        <input name="Foto" type="text" class="form-control" id="Foto" aria-describedby="emailHelp" placeholder="Masukkan Foto">
                    </div>
                    <div class="form-group">
                        <label for="Expiredate">Expiredate</label>
                        <input name="Expiredate" type="text" class="form-control" id="Expiredate" aria-describedby="emailHelp" placeholder="Masukkan Expiredate">
                    </div>
                    <div class="form-group">
                        <label for="Status">Status (0/1)</label>
                        <input name="Status" type="text" class="form-control" id="Status" aria-describedby="emailHelp" placeholder="Masukkan Status">
                    </div>
                    <div class="form-group">
                        <label for="Keterangan">Keterangan</label>
                        <input name="Keterangan" type="text" class="form-control" id="Keterangan" aria-describedby="emailHelp" placeholder="Masukkan Keterangan">
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

<?= $this->endSection(); ?>