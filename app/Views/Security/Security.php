<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <h4 class="text-center mt-2">DAFTAR PERSONIL</h4>
                <div class="input-group mb-3 zaam-input w-80-zaam">
                    <input type="text" class="form-control " placeholder="Masukkan Nama / NIK / Area" aria-label="" aria-describedby="basic-addon1">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="card-content h-100 p-0">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Area</th>
                                <th scope="col">Nama Personil</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Pakuwon</td>
                                <td>Axel</td>
                                <td><a href="" class="btn btn-danger btn-sm">Detail</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        <!-- <div class="col-12 col-lg-6">
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

        </div> -->
    </div>
</div>

<?= $this->endSection(); ?>