<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="text-center mt-2">DAFTAR SHIFT</h4>

                <form action="" method="POST" class="w-100 d-flex justify-content-center">
                    <div class="input-group mb-3 zaam-input w-80-zaam">
                        <input type="text" class="form-control " placeholder="Masukkan Nama / NIK / Area ......" name="keyword">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <?php if (isset($_POST['keyword'])) : ?>
                            <div class="input-group-prepend">
                                <a href="">
                                    <button class="btn btn-outline-secondary" type="button"> Reset filter
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>


                <div class="card-content p-0">
                    <table class="table table-hover table-borderless">
                        <thead>

                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Area</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Nama Personil</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($Shift as $s) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $s['Nama_area']; ?></td>
                                    <td><?= $s['tanggali']; ?></td>
                                    <td><?= $s['jam']; ?></td>
                                    <td><?= $s['Nama']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>