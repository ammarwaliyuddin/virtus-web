<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
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
                    <a href="/aturshift_pdf" class="btn btn-danger mr-2">Unduh PDF</a>
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-success">Excel</button>
                        <button type="button" class="btn btn-success dropdown-toggle excel dropdown-toggle-split" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <!-- Button trigger modal -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#import_excel" href="#">
                                Import
                            </a>
                            <a class="dropdown-item" href="">
                                Export
                            </a>
                        </div>
                    </div>
                </div>
                <div class="jabatan-header mt-4 mb-2">
                    <h4>Atur Shift Personil</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#shiftModal">
                        Tambah
                    </button>
                </div>
                <div class="card-content card-table">
                    <table class="table card-table-setting table-hover table-borderless">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Personil</th>
                            <th scope="col">Nama Area</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam</th>
                            <th scope="col">action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($atur_shift as $atur) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $atur['Nama']; ?></td>
                                    <td><?= $atur['Nama_area']; ?></td>
                                    <td><?= $atur['Hari']; ?></td>
                                    <td><?= $atur['Jam']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm btn-edit " data-id="<?= $atur['ID_shift']; ?>" data-nik="<?= $atur['NIK']; ?>" data-idshift="<?= $atur['id']; ?>">edit</a>
                                        <form action="/Atur_shift/<?= $atur['id']; ?>" method="POST" class="d-inline">
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

<!-- modal tambah shift -->
<div class="modal fade" id="shiftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Shift Pada personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Shift/atur_shit_save" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="Nama">Nama Personil</label>
                        <select class="form-control " name="NIK">
                            <?php foreach ($nama_personil as $personil) : ?>
                                <option value="<?= $personil['NIK']; ?>"><?= $personil['Nama']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shift">Jadwal Shift</label>
                        <select class="form-control " name="shift">
                            <?php foreach ($data_shift as $shift) : ?>
                                <option value="<?= $shift['ID_shift']; ?>"><?= $shift['Nama_area']; ?> <p>||</p> <?= $shift['jam']; ?> <p>||</p> <?= $shift['hari']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
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

<!-- update atur shift -->
<div class="modal fade" id="shiftModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Update atur shift</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editForm">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="Nama">Nama Personil</label>
                        <select class="form-control nik" name="NIK">
                            <?php foreach ($nama_personil as $personil) : ?>
                                <option value="<?= $personil['NIK']; ?>"><?= $personil['Nama']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="shift">Jadwal Shift</label>
                        <select class="form-control id" name="shift">
                            <?php foreach ($data_shift as $shift) : ?>
                                <option value="<?= $shift['ID_shift']; ?>"><?= $shift['Nama_area']; ?> <p>||</p> <?= $shift['jam']; ?> <p>||</p> <?= $shift['hari']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
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
            const nik = $(this).data('nik');
            const idshift = $(this).data('idshift');
            const id = $(this).data('id');
            const URL = '/Shift/atur_shit_edit/' + idshift;

            console.log(URL);
            // Set data to Form Edit
            $('.nik').val(nik);
            $('.id').val(id);

            $('#editForm').attr('action', URL)
            $('#shiftModalEdit').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>