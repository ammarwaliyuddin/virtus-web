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
                                <td>
                                    <a href="" class="btn btn-danger btn-sm">Detail</a>
                                    <a href="" class="btn btn-danger btn-sm">Tambah</a>
                                    <a href="" class="btn btn-danger btn-sm">Edit</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>