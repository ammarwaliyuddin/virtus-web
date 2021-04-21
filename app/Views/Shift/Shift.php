<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="text-center mt-2">DAFTAR SHIFT</h4>
                <div class="card-content">
                    <div class="shift-card">
                        <?php foreach ($Shift as $S) : ?>
                            <div class="time">
                                <div class="row">
                                    <div class="col-9">
                                        <p>Senin, 30 November 2020</p>
                                        <p>Shift Jam <?= $S['jam']; ?></p>
                                    </div>

                                    <div class="col-3">
                                        <img src="/img/ico/Add User.png" alt="" srcset="">
                                    </div>

                                </div>
                            </div>
                            <div class="personil">
                                <?php foreach ($Shift as $S) : ?>
                                    <p><?= $S['Nama']; ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>