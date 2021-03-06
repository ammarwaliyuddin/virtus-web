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
                <ul class="list-unstyled components nav-sidebar">

                    <li class="home-ul ">
                        <a href="<?= base_url('Dashboard'); ?>">DASHBOARD</a>
                    </li>
                    <li>
                        <a href="<?= base_url('Security'); ?> ">SECURITY</a>
                    </li>

                    <li>
                        <a href="<?= base_url('Shift'); ?>">SHIFT</a>
                    </li>

                    <?php if ($_SESSION['role'] == 'super admin' or $_SESSION['role'] == 'admin') : ?>
                        <li class="nav-item dropright drop-zaam">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                SETTING
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?= base_url('Jabatan'); ?>">JABATAN</a></li>

                                <?php if ($_SESSION['role'] == 'super admin') : ?>
                                    <li><a href="<?= base_url('Role_user'); ?>" class="dropdown-item">ROLE USER</a></li>
                                <?php endif ?>

                                <li><a href="<?= base_url('user'); ?>" class="dropdown-item">USER</a></li>
                                <li><a href="<?= base_url('Area'); ?>" class="dropdown-item">AREA</a></li>
                                <li><a href="<?= base_url('Customer'); ?>" class="dropdown-item">CUSTOMER</a></li>
                                <li><a href="<?= base_url('Smartwatch'); ?>" class="dropdown-item">SMARTWATCH</a></li>
                                <li><a href="<?= base_url('Security/setting_personil'); ?>" class="dropdown-item">PERSONIL</a></li>
                                <li class="dropdown-submenu submenu-active"><a class="dropdown-item dropdown-toggle" href="#">SHIFT PERSONIL</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= base_url('Shift/setting_shift'); ?>">SHIFT</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('Shift/setting_atur_shift'); ?>">ATUR SHIFT</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
        <div id="content">
            <button type="button" id="sidebarCollapse" class="btn bg-transparent text-danger mb-2">
                <i class="fas fa-align-left"></i>
                <span></span>
            </button>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <h3>TOTAL PETUGAS <span><?= $_SESSION['jumlah'][0]['NIK']  ?></span></h3>

                    <!-- login panel -->
                    <div class="login-panel">


                        <div style=" text-transform: capitalize;cursor: context-menu;">
                            <?= $_SESSION['Nama']  ?>
                        </div>
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle btn-profile" data-toggle="dropdown">
                                <div class="img-profil">
                                    <img src="<?= base_url('img') . '/' . $_SESSION['Foto'] ?> " alt="" class="img-thumbnail">
                                </div>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?= base_url('/Profile'); ?>" class="dropdown-item">ACCOUNT</a>
                                <a href="<?= base_url('logout'); ?>" class="dropdown-item">LOGOUT</a>

                            </div>
                        </div>
                    </div>

                </div>
            </nav>

            <?= $this->renderSection('content'); ?>

        </div>


        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> -->
        <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
        </script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
        </script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
        </script>
        <script src="/js/Chart.js"></script>

        <script>
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
                $('#sidebarCollapse').on('click', function() {
                    $('#content').toggleClass('active');
                });

                // if ($(window).width() < 960) {
                //     alert('Less than 960');
                // } else {
                //     alert('More than 960');
                // }

                // if (screen.width <script 768) {
                //     $('#sidebar').on('click', function() {
                //         $('#sidebar').removeClass('active');
                //         $('#content').removeClass('active');
                //     });
                // }

            });

            // $(function() {
            //     $('#sidebar ul li a').filter(function() {
            //         return this.href == location.href

            //     }).parent().addClass('active').siblings().removeClass('active')
            //     $('#sidebar ul li a').click(function() {
            //        $(this).parent().addClass('active').siblings().removeClass('active')

            //     })
            // })

            $(document).ready(function() {
                $("[href]").each(function() {
                    if (this.href == location.href) {

                        $(this).parents('li').addClass("active");
                    }
                });
            });
        </script>
        <script>
            $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
                if (!$(this).next().hasClass('show')) {
                    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
                }
                var $subMenu = $(this).next(".dropdown-menu");
                $subMenu.toggleClass('show');


                $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
                    $('.dropdown-submenu .show').removeClass("show");
                });


                return false;
            });
        </script>

        <?= $this->renderSection('datatable'); ?>
        <?= $this->renderSection('script'); ?>

</body>

</html>