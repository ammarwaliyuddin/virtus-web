<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Virtus</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="/img/logo-virtus.png" alt="" style="width: 95%;">
            </div>
            <div class="sidebar-content">
                <ul class="list-unstyled components">
                    <li class="home-ul active">
                        <a href="<?= base_url('Dashboard'); ?>">DASHBOARD</a>
                    </li>
                    <li>
                        <a href="<?= base_url('Security'); ?> ">SECURITY</a>
                    </li>

                    <li>
                        <a href="<?= base_url('Shift'); ?>">SHIFT</a>
                    </li>
                    <li>
                        <a href="<?= base_url('Location'); ?>">LOCATION</a>
                    </li>
                    <li>
                        <div class=" dropright drop-zaam">
                            <a href="" class="btn dropdown-toggle tombolsetting" data-toggle="dropdown">SETTING</a>
                            <div class="dropdown-menu">
                                <a href="<?= base_url('Jabatan'); ?>" class="dropdown-item">JABATAN</a>
                                <a href="<?= base_url('Role_user'); ?>" class="dropdown-item">ROLE USER</a>
                                <a href="<?= base_url('user'); ?>" class="dropdown-item">USER</a>
                                <a href="<?= base_url('Area'); ?>" class="dropdown-item">AREA</a>
                                <a href="<?= base_url('Customer'); ?>" class="dropdown-item">CUSTOMER</a>
                                <a href="<?= base_url('Smartwatch'); ?>" class="dropdown-item">SMARTWATCH</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <h3>TOTAL PETUGAS <span>1000</span></h3>
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <!-- login panel -->
                    <div class="login-panel">
                        <div class="img-profil"></div>
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">ADMIN</button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item">ACCOUNT</a>
                                <a href="<?= base_url(); ?>" class="dropdown-item">LOGOUT</a>
                            </div>
                        </div>
                    </div>

                </div>
            </nav>

            <?= $this->renderSection('content'); ?>

        </div>


        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>


        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
        </script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
        </script>
        <script src="/js/Chart.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        {{--Firebase Tasks--}}
        <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
        <script>
            // Initialize Firebase
            var config = {
                apiKey: "AIzaSyDs7SdTvMQPTNqqYOvcOxcEOMGvFiJvJ_c",
                authDomain: "smartsystemsecurity-45be9.firebaseapp.com",
                databaseURL: "https://smartsystemsecurity-45be9.firebaseio.com",
                storageBucket: "smartsystemsecurity-45be9.appspot.com",
            };
            firebase.initializeApp(config);

            var database = firebase.database();
            database.ref('users/12345678').on('value', function(snapshot) {
                var value = snapshot.val();
                $('#detakfajar').html(value.heartrate + " bpm");
                $('#lokasifajar').html(value.location);
                $('#statefajar').html(value.state);
                console.log("User UID : " + value.heartrate);
                console.log(value.state)
                card = document.querySelector('.card-monitoring');
                if (value.state == 'NORMAL') {
                    // card.classList.remove('siang');
                    card.classList.add('bg-success');
                    var src1 = '/img/ico/ICON WORK 1.png';
                    $("#card_logo_status").attr("src", src1);
                } else if (value.state == 'TIDUR') {
                    // card.classList.remove('siang');
                    card.classList.add('bg-zaamorange');
                    var src1 = '/img/ico/[red}ICON SLEEP 1.png';
                    $("#card_logo_status").attr("src", src1);
                } else {
                    // card.classList.remove('siang');
                    card.classList.add('bg-warning');
                    var src1 = '/img/ico/ICON DOZY 1.png';
                    $("#card_logo_status").attr("src", src1);
                }
            });

            var database2 = firebase.database();
            database2.ref('users/23456789').on('value', function(snapshot) {
                var value = snapshot.val();
                $('#detakaxel').html(value.heartrate + " bpm");
                $('#lokasiaxel').html(value.location);
                $('#stateaxel').html(value.state);
                console.log("User UID : " + value.heartrate);
                value.state = 'TIDUR';
                card = document.querySelector('.card-monitoring.card-axel');
                if (value.state == 'NORMAL') {
                    // card.classList.remove('siang');
                    card.classList.add('bg-success');
                    var src1 = '/img/ico/ICON WORK 1.png';
                    $(".card-axel #card_logo_status").attr("src", src1);
                } else if (value.state == 'TIDUR') {
                    // card.classList.remove('siang');
                    card.classList.add('bg-zaamorange');
                    var src1 = '/img/ico/[red}ICON SLEEP 1.png';
                    $(".card-axel #card_logo_status").attr("src", src1);
                } else {
                    // card.classList.remove('siang');
                    card.classList.add('bg-warning');
                    var src1 = '/img/ico/ICON DOZY 1.png';
                    $(".card-axel #card_logo_status").attr("src", src1);
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
                $('#sidebarCollapse').on('click', function() {
                    $('#content').toggleClass('active');
                });
            });

            $(function() {
                $('#sidebar a').filter(function() {
                    return this.href == location.href
                }).parent().addClass('active').siblings().removeClass('active')
                $('#sidebar a').click(function() {
                    $(this).parent().addClass('active').siblings().removeClass('active')
                })
            })
        </script>
        <script type="text/javascript">
            var ctx = document.getElementById("piechart").getContext("2d");
            var data = {
                labels: ['Semangat', 'Mengantuk', 'Tidur'],
                datasets: [{
                    label: "grafik pelanggaran",
                    data: [1, 0, 1],
                    backgroundColor: [
                        '#1AB394',
                        '#F8AB59',
                        '#EC644C',

                    ],
                    hoverOffset: 4
                }]
            };

            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true
                }
            });
        </script>
        <?= $this->renderSection('datatable'); ?>

</body>

</html>