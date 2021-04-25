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
                <nav>
                    <div class="nav nav-tabs nav-zaam" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Data Monitoring</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Persentase</a>
                    </div>
                </nav>
                <div class="card-content">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-6 text-white">
                                    <a href="<?= base_url('Security_personil'); ?> ">
                                        <div class="card-monitoring ">
                                            <div class="ico-cardmonitoring">
                                                <img src="" id="card_logo_status">
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <i class="fas fa-user fa-2x"></i>
                                                </div>
                                                <div class="col-9">
                                                    <p class="text-white">A12345678</p>
                                                    <p class="text-white">Fajar Hamid Embutara</p>
                                                </div>
                                                <div class="col-4">
                                                    <img src="/img/ico/[WHITE ICON] smartwatch 1.png" alt="" srcset="">
                                                    <p>001</p>
                                                </div>
                                                <div class="col-4">
                                                    <img src="/img/ico/[WHITE ICON] heart rate 1.png" alt="" srcset="">
                                                    <p id="detakfajar">0</p>
                                                </div>
                                                <div class="col-4">
                                                    <img src="/img/ico/[WHITE ICON] location 1.png" alt="" srcset="">
                                                    <p id="lokasifajar">Jakarta</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 text-white">
                                    <a href="<?= base_url('Security_personil'); ?> ">
                                        <div class="card-monitoring card-axel">
                                            <div class="ico-cardmonitoring ">
                                                <img src="" id="card_logo_status">
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <i class="fas fa-user fa-2x"></i>
                                                </div>
                                                <div class="col-9">
                                                    <p class="text-white">2345678</p>
                                                    <p class="text-white">Ananda Rebel</p>
                                                </div>
                                                <div class="col-4">
                                                    <img src="/img/ico/[WHITE ICON] smartwatch 1.png" alt="" srcset="">
                                                    <p>001</p>
                                                </div>
                                                <div class="col-4">
                                                    <img src="/img/ico/[WHITE ICON] heart rate 1.png" alt="" srcset="">
                                                    <p id="detakaxel">0 bpm</p>
                                                </div>
                                                <div class="col-4">
                                                    <img src="/img/ico/[WHITE ICON] location 1.png" alt="" srcset="">
                                                    <p id="lokasiaxel">None</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="piechart" width="100%" height="100"></canvas>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <h4 class="text-center mt-2">HISTORY PELANGGARAN</h4>
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

<?= $this->endSection(); ?>