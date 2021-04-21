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
                    <h4>Smartwatch</h4>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#jabatanModal">
                        Tambah
                    </button>
                </div>

                <table class="table table-hover table-borderless">
                    <thead>
                        <th>Nama Smartwatch</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($Smartwatch as $S) : ?>
                            <tr>
                                <td><?= $S['merek']; ?></td>
                                <td><?= $S['longitude']; ?></td>
                                <td><?= $S['latitude']; ?></td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm">edit</a>

                                    <form action="/Smartwatch/<?= $S['ID_jam']; ?>" method="POST" class="d-inline">
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
<div class="modal fade" id="jabatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Smartwatch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Smartwatch/save" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="merek">Nama Smartwatch</label>
                        <input name="merek" type="text" class="form-control" id="merek" aria-describedby="emailHelp" placeholder="Masukkan Nama Smartwatch">
                    </div>
                    <div class="form-group">
                        <label for="Longitude">Longitude</label>
                        <input name="longitude" type="text" class="form-control" id="longitude" aria-describedby="emailHelp" placeholder="Masukkan Area">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input name="latitude" type="text" class="form-control" id="latitude" aria-describedby="emailHelp" placeholder="Masukkan Area">
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