<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <h4 class="text-center mt-2">DAFTAR LOKASI</h4>
                <div class="input-group mb-3 zaam-input" style="width:80%;">
                    <input type="text" class="form-control " placeholder="Masukkan Nama / NIK / Area" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                </div>

                <div class="card-content">
                    <form action="" method="" class="w-100">
                        <?php foreach ($Lokasi as $L) : ?>
                            <div class="status-card" onclick="window.location='<?= base_url("/Dashboard2/" . $L['ID_area']) ?>';">

                                <div class="row">
                                    <div class="col-12">
                                        <h6><?= $L['Nama_area']; ?></h6>
                                    </div>
                                </div>
                                <div class="row m-1 mt-2">
                                    <div class="col-4">
                                        <div class="row align-items-center">
                                            <div class="col-12 ">
                                                <img src="/img/ico/tidur.png" class="ico-50px">
                                                <div class="d-inline-block ico-persentase">

                                                    <?= $L['persentase_tidur']; ?>%</div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-4">
                                        <div class="row align-items-center">
                                            <div class="col-12 ">
                                                <img src="/img/ico/ngantuk.png" class="ico-50px">
                                                <div class="d-inline-block ico-persentase">

                                                    <?= $L['persentase_ngantuk']; ?>%</div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 ">
                                        <div class="row align-items-center">
                                            <div class="col-12 ">
                                                <img src="/img/ico/kerja.png" class="ico-50px">
                                                <div class="d-inline-block ico-persentase">

                                                    <?= $L['persentase_kerja']; ?>%</div>

                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 h-margin">
            <div class="card">
                <h4 class="text-center mt-2">HISTORI PELANGGARAN</h4>
                <div class="card-content">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Jam</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pelanggaran</th>
                                <th scope="col">Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($History as $H) : ?>
                                <tr>
                                    <td><?= $H['jam']; ?></td>
                                    <td><?= $H['Nama']; ?></td>
                                    <td><?= $H['Jenis_pelanggaran']; ?></td>
                                    <td><?= $H['Nama_area']; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>

<?= $this->endSection(); ?>