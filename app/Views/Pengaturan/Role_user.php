<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 ">
            <div class="card p-5">
                <div class="btngrp-zaam mt-2  w-100">
                    <a href="" class="btn btn-danger mr-2">Unduh PDF</a>
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


                    <a href="<?= base_url('Tambah_role_user'); ?>" class="btn btn-info float-right"> Tambah</a>
                </div>

                <table class="table table-hover  table-borderless">
                    <thead>
                        <th>Nama Role</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($RoleUser as $R) : ?>
                            <tr>
                                <td><?= $R['Jabatan']; ?></td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm">edit</a>

                                    <form action="/Role_user/<?= $R['ID_role_user']; ?>" method="POST" class="d-inline">
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


<?= $this->endSection(); ?>