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
                    <h4>Customer</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#customerModal">
                        Tambah
                    </button>
                </div>

                <table class="table table-hover table-borderless">
                    <thead>
                        <th>Nama Area</th>
                        <th>Nama Customer</th>
                        <th>Telepon Customer</th>
                        <th>Nama PIC</>
                        </th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($Customer as $C) : ?>
                            <tr>
                                <td><?= $C['Area']; ?></td>
                                <td><?= $C['Nama_customer']; ?></td>
                                <td><?= $C['Telepon_customer']; ?></td>
                                <td><?= $C['Nama_PIC']; ?></td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm">edit</a>

                                    <form action="/Customer/<?= $C['ID_customer']; ?>" method="POST" class="d-inline">
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
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Customer/save" method="POST">
                    <div class="form-group">
                        <label for="Nama_customer">Nama Customer</label>
                        <input name="Nama_customer" type="text" class="form-control" id="Nama_customer" aria-describedby="emailHelp" placeholder="Masukkan Nama Customer">
                    </div>
                    <div class="form-group">
                        <label for="Nama_PIC">Nama PIC</label>
                        <input name="Nama_PIC" type="text" class="form-control" id="Nama_PIC" aria-describedby="emailHelp" placeholder="Masukkan Nama PIC">
                    </div>
                    <div class="form-group">
                        <label for="Telepon_customer">Nomor tlp Kantor Customer</label>
                        <input name="Telepon_customer" type="text" class="form-control" id="Telepon_customer" aria-describedby="emailHelp" placeholder="Masukkan Nomor tlp Kantor Customer">
                    </div>
                    <div class="form-group">
                        <label for="Telepon_PIC">Nomor Telpon PIC</label>
                        <input name="Telepon_PIC" type="text" class="form-control" id="Telepon_PIC" aria-describedby="emailHelp" placeholder="Masukkan Nomor Telpon PIC">
                    </div>
                    <div class="form-group">
                        <label for="Email_PIC">Email PIC</label>
                        <input name="Email_PIC" type="email" class="form-control" id="Email_PIC" aria-describedby="emailHelp" placeholder="Masukkan Email PIC">
                    </div>
                    <div class="form-group">
                        <label for="Alamat_PIC">Alamat Lengkap</label>
                        <input name="Alamat_PIC" type="textarea" class="form-control" id="Alamat_PIC" aria-describedby="emailHelp" placeholder="Masukkan Alamat Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="Area">Area(s)</label>
                        <input name="Area" type="text" class="form-control" id="Area" aria-describedby="emailHelp" placeholder="Masukkan Area(s)">
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