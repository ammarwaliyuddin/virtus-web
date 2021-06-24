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
                    <a href="/Jabatan/reportpdf" class="btn btn-danger mr-2">Unduh PDF</a>
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
                    <h4>Jabatan</h4>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#jabatanModal">
                        Tambah
                    </button>
                </div>

                <table class="table table-hover table-borderless">
                    <thead>
                        <th>Nama Jabatan</th>
                        <th>Area</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($Jabatan as $J) : ?>
                            <tr>
                                <td><?= $J['Jabatan']; ?></td>
                                <td><?= $J['Nama_area']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm btn-edit " data-id="<?= $J['ID_jabatan']; ?>" data-jabatan="<?= $J['Jabatan']; ?>" data-lokasi="<?= $J['Nama_area']; ?>" data-deskripsi="<?= $J['Deskripsi']; ?>">edit</a>

                                    <form action="/Jabatan/<?= $J['ID_jabatan']; ?>" method="POST" class="d-inline">
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

<!-- modal import excel -->


<!-- Modal -->
<div class="modal fade" id="import_excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Jabatan/import_excel') ?>

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

<!-- Modal jabatan -->
<div class="modal fade" id="jabatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Jabatan/save" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="Jabatan">Nama Jabatan</label>
                        <input name="Jabatan" type="text" class="form-control" placeholder="Masukkan Nama Jabatan" required>

                    </div>
                    <div class="form-group">
                        <label for="Deskripsi">Deskripsi</label>
                        <input name="Deskripsi" type="text" class="form-control" placeholder="Masukkan Deskripsi">
                    </div>
                    <div class="form-group">
                        <label for="Nama_area">Nama Area</label>
                        <select class="form-control" name="Nama_area">
                            <?php foreach ($Area as $a) : ?>
                                <option><?= $a['Nama_area']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <!-- <input name="Nama_area" type="text" class="form-control" id="Nama_area" aria-describedby="emailHelp" placeholder="Masukkan Nama Area"> -->
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
<!-- modal edit -->
<div class="modal fade" id="jabatanModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Update Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Jabatan/edit/<?= $J['ID_jabatan']; ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="Jabatan">Nama Jabatan</label>
                        <input name="Jabatan" type="text" class="form-control Jabatan" id="Jabatan" placeholder="Masukkan Nama Area" required>
                    </div>
                    <div class="form-group">
                        <label for="Nama_area">Lokasi</label>
                        <select class="form-control Nama_area" name="Nama_area">

                            <?php foreach ($Area as $a) : ?>
                                <option><?= $a['Nama_area']; ?></option>
                            <?php endforeach ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input name="deskripsi" type="text" class="form-control deskripsi" id="deskripsi" placeholder="Masukkan deskripsi" required>
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
            const id = $(this).data('id');
            const jabatan = $(this).data('jabatan');
            const lokasi = $(this).data('lokasi');
            const deskripsi = $(this).data('deskripsi');

            console.log(lokasi);
            // Set data to Form Edit
            $('.ID_Jabatan').val(id);
            $('.Jabatan').val(jabatan);
            $('.Nama_area').val(lokasi);
            $('.deskripsi').val(deskripsi);

            $('#jabatanModal2').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>