<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="text-center mt-2">DETAIL PERSONIL</h4>
                <div class="card-content">
                    <div class="col-3">
                        <div class="personil-bio">
                            <div class="img-personil-bio">
                                <img src="/img/poto_pajar.png" alt="" srcset="">
                            </div>
                            <div class="content-personil-bio">
                                <table class="table">
                                    <tr>
                                        <td>NIK</td>
                                        <td><span class="font-weight-bold">A12345678</span></td>
                                    </tr>
                                    <tr>
                                        <td>NAMA</td>
                                        <td><span class="font-weight-bold">Fajar Hamid E.</span></td>
                                    </tr>
                                    <tr>
                                        <td>AREA</td>
                                        <td><span class="font-weight-bold">BOTANICA</span></td>
                                    </tr>
                                    <tr>
                                        <td>SHIFT</td>
                                        <td><span class="font-weight-bold">PAGI</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-center mt-2">Monitoring</h6>
                                <div class="row mx-0">
                                    <div class="col-6 my-1">
                                        <div class="m-personil p-1 ">
                                            <div class="m-personil-ico d-inline-block text-center" style="width:35px;">
                                                <img src="/img/ico/m_peringatan.svg" alt=""></div>
                                            <div class="m-personil-status d-inline-block">Tidur</div>
                                        </div>

                                    </div>
                                    <div class="col-6 my-1">
                                        <div class="m-personil p-1 ">
                                            <div class="m-personil-ico d-inline-block text-center" style="width:35px;">
                                                <img src="/img/ico/m_smart_id.svg" alt="">
                                            </div>
                                            <div class="m-personil-status d-inline-block">001</div>
                                        </div>
                                    </div>
                                    <div class="col-6 my-1">
                                        <div class="m-personil p-1 ">
                                            <div class="m-personil-ico d-inline-block text-center" style="width:35px;">
                                                <img src="/img/ico/m_detak.svg" alt="">
                                            </div>
                                            <div class="m-personil-status d-inline-block">40 bpm</div>
                                        </div>
                                    </div>
                                    <div class="col-6 my-1">
                                        <div class="m-personil p-1 ">
                                            <div class="m-personil-ico d-inline-block text-center" style="width:35px;">
                                                <img src="/img/ico/m_jejak.svg" alt="">
                                            </div>
                                            <div class="m-personil-status d-inline-block">125</div>
                                        </div>
                                    </div>
                                    <div class="col-6 my-1">
                                        <div class="m-personil p-1 ">
                                            <div class="m-personil-ico d-inline-block text-center" style="width:35px;">
                                                <img src="/img/ico/m_lokasi.svg" alt="">
                                            </div>
                                            <div class="m-personil-status d-inline-block">125</div>
                                        </div>
                                    </div>
                                    <div class="col-6 my-1">
                                        <a href="" class="badge badge-pill badge-success">aktif</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <h6 class="text-center mt-2">Lokasi</h6>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.295875820612!2d106.80172191529527!3d-6.224663762697352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14e455ccd9f%3A0xd635e33c7c001b3d!2sfX%20Sudirman!5e0!3m2!1sen!2sid!4v1613277246018!5m2!1sen!2sid" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                            <div class="col-12">
                                <hr>
                                <h6 class="text-center mt-2">History Pelanggaran</h6>
                                <table border="0" cellspacing="5" cellpadding="5">
                                    <tbody>
                                        <tr>
                                            <td>Minimum date:</td>
                                            <td><input type="text" id="min" name="min"></td>
                                        </tr>
                                        <tr>
                                            <td>Maximum date:</td>
                                            <td><input type="text" id="max" name="max"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Pelanggaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2021/01/11</td>
                                            <td>10 : 05 : 32</td>
                                            <td>Tidur</td>
                                        </tr>
                                        <tr>
                                            <td>2020/10/10</td>
                                            <td>08 : 16 : 01</td>
                                            <td>Tidur</td>
                                        </tr>
                                        <tr>
                                            <td>2020/09/03</td>
                                            <td>10 : 57 : 44</td>
                                            <td>Mengantuk</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('datatable'); ?>
<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[0]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });

        // DataTables initialisation
        var table = $('#example').DataTable();

        // Refilter the table
        $('#min, #max').on('change', function() {
            table.draw();
        });
    });
</script>

<?= $this->endSection(); ?>