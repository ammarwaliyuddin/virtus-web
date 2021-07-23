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
                    <a href="/Area_reportpdf" class="btn btn-danger mr-2">Unduh PDF</a>
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
                            <a class="dropdown-item" href="/Area_exportexcel">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="jabatan-header mt-4 mb-2">
                    <h4>Area</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#areaModal">
                        Tambah
                    </button>
                </div>
                <div class="card-content card-table">
                    <table class="table card-table-setting table-hover table-borderless">
                        <thead>
                            <th>Nama Area</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($Area as $A) : ?>
                                <tr>
                                    <td><?= $A['Nama_area']; ?></td>
                                    <td><?= $A['Lokasi']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-edit btn-sm" data-id="<?= $A['ID_area']; ?>" data-area="<?= $A['Nama_area']; ?>" data-lokasi="<?= $A['Lokasi']; ?>">edit</a>
                                        <a href="/Area_delete/<?= $A['ID_area']; ?>" class="btn btn-danger btn-sm swt">hapus</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- modal import excel -->
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
                <?= form_open_multipart('Area/import') ?>

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
<div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Area/save" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="Nama_area">Nama Area</label>
                        <input name="Nama_area" type="text" class="form-control" id="Nama_area" placeholder="Masukkan Nama Area" required>
                    </div>
                    <div class="form-group">
                        <label for="Lokasi">Lokasi</label>
                        <input name="Lokasi" type="text" class="form-control" id="Lokasi" aria-describedby="emailHelp" placeholder="Masukkan Lokasi" required>
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

<!-- update area -->
<div class="modal fade" id="areaModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Update Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Area/update/<?= $A['ID_area']; ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="Nama_area">Nama Area</label>
                        <input name="Nama_area" type="text" class="form-control Nama_area" aria-describedby="emailHelp" placeholder="Masukkan Nama Area" required>
                    </div>
                    <div class="form-group">
                        <label for="Lokasi">Lokasi</label>
                        <input name="Lokasi" type="text" class="form-control Lokasi" aria-describedby="emailHelp" placeholder="Masukkan Lokasi" required>
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

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const area = $(this).data('area');
            const lokasi = $(this).data('lokasi');
            // Set data to Form Edit
            $('.ID_area').val(id);
            $('.Nama_area').val(area);
            $('.Lokasi').val(lokasi);

            $('#areaModal2').modal('show');
        });

    });
</script>

<script>
    // const swt = document.querySelector('#swt');

    // console.log(swt);
    $('.swt').on('click', function(e) {
        console.log('ok')
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Anda Yakin ingin menghapus?',
            text: "Data Akan Dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: `Tidak`
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
                // Swal.fire(
                //     'Deleted!',
                //     'Your file has been deleted.',
                //     'success'
                // )
            }
        })

    });
</script>

<?= $this->endSection(); ?>