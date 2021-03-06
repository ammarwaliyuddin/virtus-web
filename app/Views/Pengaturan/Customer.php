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
                    <a href="/Customer_reportpdf" class="btn btn-danger mr-2">Unduh PDF</a>
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
                            <a class="dropdown-item" href="/Customer_export">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="jabatan-header mt-4 mb-2">
                    <h4>Customer</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#customerModal">
                        Tambah
                    </button>
                </div>

                <div class="card-content card-table">
                    <table class="table card-table-setting table-hover table-borderless">
                        <thead>
                            <th>Nama Area</th>
                            <th>Nama Customer</th>
                            <th>Telepon Customer</th>
                            <th>Nama PIC</th>
                            <th>Telepon PIC</th>
                            <th>Email PIC</th>
                            <th>Alamat PIC</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($Customer as $C) : ?>
                                <tr>
                                    <td><?= $C['Area']; ?></td>
                                    <td><?= $C['Nama_customer']; ?></td>
                                    <td><?= $C['Telepon_customer']; ?></td>
                                    <td><?= $C['Nama_PIC']; ?></td>
                                    <td><?= $C['Telepon_PIC']; ?></td>
                                    <td><?= $C['Email_PIC']; ?></td>
                                    <td><?= $C['Alamat_PIC']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-edit btn-sm" data-id="<?= $C['ID_customer']; ?>" data-area="<?= $C['Area']; ?>" data-nama="<?= $C['Nama_customer']; ?>" data-PIC="<?= $C['Nama_PIC']; ?>" data-teleponcs="<?= $C['Telepon_customer']; ?>" data-telepon="<?= $C['Telepon_PIC']; ?>" data-email="<?= $C['Email_PIC']; ?>" data-alamat="<?= $C['Alamat_PIC']; ?>">edit</a>
                                        <a href="/Customer_delete/<?= $C['ID_customer']; ?>" class="btn btn-danger btn-sm swt">hapus</a>

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
                <?= form_open_multipart('Customer/import') ?>

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
                        <input name="Nama_customer" type="text" class="form-control" placeholder="Masukkan Nama Customer" required>
                    </div>
                    <div class="form-group">
                        <label for="Nama_PIC">Nama PIC</label>
                        <input name="Nama_PIC" type="text" class="form-control" placeholder="Masukkan Nama PIC" required>
                    </div>
                    <div class="form-group">
                        <label for="Telepon_customer">Nomor tlp Kantor Customer</label>
                        <input name="Telepon_customer" type="text" class="form-control" placeholder="Masukkan Nomor tlp Kantor Customer" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="Telepon_PIC">Nomor Telpon PIC</label>
                        <input name="Telepon_PIC" type="text" class="form-control" placeholder="Masukkan Nomor Telpon PIC" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="Email_PIC">Email PIC</label>
                        <input name="Email_PIC" type="email" class="form-control" placeholder="Masukkan Email PIC" required>
                    </div>
                    <div class="form-group">
                        <label for="Alamat_PIC">Alamat Lengkap</label>
                        <input name="Alamat_PIC" type="textarea" class="form-control" id="Alamat_PIC" aria-describedby="emailHelp" placeholder="Masukkan Alamat Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="Area">Area(s)</label>
                        <input name="Area" type="text" class="form-control" placeholder="Masukkan Area(s)" required>
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

<div class="modal fade" id="customerModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/Customer/update/<?= $C['ID_customer']; ?>" method="POST">
                    <div class="form-group">
                        <label for="Nama_customer">Nama Customer</label>
                        <input name="Nama_customer" type="text" class="form-control Nama_customer" placeholder="Masukkan Nama Customer" required>
                    </div>
                    <div class="form-group">
                        <label for="Nama_PIC">Nama PIC</label>
                        <input name="Nama_PIC" type="text" class="form-control Nama_PIC" placeholder="Masukkan Nama PIC" required>
                    </div>
                    <div class="form-group">
                        <label for="Telepon_customer">Nomor tlp Kantor Customer</label>
                        <input name="Telepon_customer" type="text" class="form-control Telepon_customer" placeholder="Masukkan Nomor tlp Kantor Customer" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="Telepon_PIC">Nomor Telpon PIC</label>
                        <input name="Telepon_PIC" type="text" class="form-control Telepon_PIC" id="Telepon_PIC" aria-describedby="emailHelp" placeholder="Masukkan Nomor Telpon PIC" required maxlength="12">
                    </div>
                    <div class="form-group">
                        <label for="Email_PIC">Email PIC</label>
                        <input name="Email_PIC" type="email" class="form-control Email_PIC" id="Email_PIC" aria-describedby="emailHelp" placeholder="Masukkan Email PIC" required>
                    </div>
                    <div class="form-group">
                        <label for="Alamat_PIC">Alamat Lengkap</label>
                        <input name="Alamat_PIC" type="textarea" class="form-control Alamat_PIC" id="Alamat_PIC" aria-describedby="emailHelp" placeholder="Masukkan Alamat Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="Area">Area(s)</label>
                        <input name="Area" type="text" class="form-control Area" id="Area" aria-describedby="emailHelp" placeholder="Masukkan Area(s)" required>
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
            const nama = $(this).data('nama');
            const teleponcs = $(this).data('teleponcs');
            const pic = $(this).data('pic');
            const telepon = $(this).data('telepon');
            const alamat = $(this).data('alamat');
            const email = $(this).data('email');
            // Set data to Form Edit
            $('.ID_customer').val(id);
            $('.Area').val(area);
            $('.Nama_customer').val(nama);
            $('.Telepon_customer').val(teleponcs);
            $('.Nama_PIC').val(pic);
            $('.Telepon_PIC').val(telepon);
            $('.Alamat_PIC').val(alamat);
            $('.Email_PIC').val(email);
            // Call Modal Edit
            $('#customerModal2').modal('show');
        });

    });
</script>

<script>
    // const swt = document.querySelector('#swt');

    // console.log(swt);
    $('.swt').on('click', function(e) {
        // console.log('ok')
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