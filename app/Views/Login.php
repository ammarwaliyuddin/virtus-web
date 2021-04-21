<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">

    <title>Login - Virtus web</title>
</head>

<body>
    <div class="login">
        <div class="container-fluid">
            <div class="row ">
                <div class=" col-xl-6 min-screen left">
                    <a href=""><img src="/img/login/logo.svg" alt=""></a>
                    <div class="myauto d-flex justify-content-center w-100 flex-column">
                        <img src="/img/login/Security.svg" alt="">
                        <div class="judul-login">
                            <p>SECURITY MONITORING SYSTEM</p>
                        </div>
                    </div>

                </div>
                <div class="col-zaam-12 col-xl-6  d-flex justify-content-center item-align-center flex-column">
                    <div class="login-box">
                        <div class="form-login">
                            <h1>Selamat Datang</h1>
                            <h6>silahkan masuk</h6>
                            <form action="/login/auth" method="post">
                                <div class="form-group">
                                    <input type="text" name="NIK" class="form-control" placeholder="NIK" >
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" 
                                        placeholder="password">
                                </div>
                                <button type="submit" class=" btn-form">masuk</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="footer-login">

                <div class="row">
                    <div class="col-6 col-hidden"></div>
                    <div class="col-footer-12 col-6">
                        <div class="container-logo">
                            <a href="">
                                <div class="logo">
                                    <div class="img-logo">
                                        <img src="/img/login/browser.svg" alt="">
                                    </div>
                                    <div class="tittle-logo">virtusway.co.id</div>
                                </div>
                            </a>

                            <a href="">
                                <div class="logo">
                                    <div class="img-logo">
                                        <img src="/img/login/ig.svg" alt="">
                                    </div>
                                    <div class="tittle-logo">firtusway_fs</div>
                                </div>
                            </a>

                            <a href="">
                                <div class="logo">
                                    <div class="img-logo">
                                        <img src="/img/login/telp.svg" alt="">
                                    </div>
                                    <div class="tittle-logo ">(021) 27939505</div>
                                </div>
                            </a>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>


</body>

</html>