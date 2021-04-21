<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <h4 class="text-center mt-2">DAFTAR LOKASI</h4>
                <div class="input-group mb-3 zaam-input w-80-zaam">
                    <input type="text" class="form-control " placeholder="Masukkan Nama / NIK / Area" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-content h-100">
                    <nav class="nav-security w-75">
                        <div class="nav nav-tabs nav-zaam" id="nav-tab" role="tablist">
                            <?php foreach ($Lokasi as $L) : ?>
                                <a class="nav-item nav-link active mt-3" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><?= $L['Nama_area']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </nav>
                </div>


            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card daftar-personil">
                <h4 class="text-center mt-2">DAFTAR PERSONIL</h4>
                <div class="input-group mb-3 zaam-input w-80-zaam">
                    <input type="text" class="form-control " placeholder="Masukkan Nama / NIK / Area" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card-content profil">
                            <div class="row w-75">
                                <div class="col-12">
                                    <?php foreach ($Personil as $P) : ?>
                                        <a href="#sas" class="btn btn-zaam w-100 mb-2">
                                            <div class="row ">
                                                <div class="col-2">
                                                    <img src="/img/ico/1.png" alt="" srcset="">
                                                </div>
                                                <div class="col-8  nama-personil">
                                                    <span class=""><?= $P['Nama']; ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-profile-tab">
                        3
                    </div>
                    <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-profile-tab">
                        4
                    </div>
                    <div class="tab-pane fade" id="nav-5" role="tabpanel" aria-labelledby="nav-profile-tab">
                        5
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>