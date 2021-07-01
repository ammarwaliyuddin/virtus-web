<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <h4 class="text-center mt-2 mb-4">Profile</h4>

                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="profile-img">

                            <img src="<?= base_url('img') . '/' . $RoleUser['Foto'] ?> " alt="Foto" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">

                        <table class="table table-borderless">
                            <tr>
                                <th>NIK</th>
                                <td>:</td>
                                <td> <?= $RoleUser['NIK']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td> <?= $RoleUser['Nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>:</td>
                                <td> <?= $RoleUser['Jabatan']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td> <?= $RoleUser['Email']; ?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>:</td>
                                <td> <span class="badge badge-info"><?= $RoleUser['role']; ?></span></td>
                            </tr>

                        </table>

                    </div>
                </div>


            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>