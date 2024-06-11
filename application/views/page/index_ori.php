

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Property management, rent house and collect tenant rental bills becomes convenient when your house leasing is powered by IoT devices" />
        <meta name="keywords" content="rent, property, rumah sewa, house leasing, tenant, smart meter" />
        <meta name="author" content="iSewa" />
        
        <title>Phone Book</title>
        <link rel="icon" href="" type="image/x-icon">

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">

        <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap/css/bootstrap2.min.css" type="text/css" >

        <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/css/style.css" type="text/css">

        <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/css/pages/style_landing.css" type="text/css">

        <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/icon/font-awesome/css/font-awesome.min.css" type="text/css">

         <!-- themify icon -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap/icon/themify-icons/themify-icons.css" type="text/css">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script src="<?= base_url(); ?>assets/bootstrap/js/popper.js/popper.min.js"></script>

        <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap/js/bootstrap.min.js"></script>

    </head>

    <style>
        html {
            scroll-behavior: smooth;
            }
    </style>

    <body style="padding:0px;">

        <div style="height:60px;" id="scroll_home">
            <nav class="navbar navbar-expand-sm navbar-light fixed-top" style="background-color:#4e73df;">
                <div class="container px-3" >
                    <a class="navbar-brand fw-bold row" href="" style="align-items:center;">
                        <h3 class="text-white">PHONE BOOK &copy; </h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-right:30px;">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-menu" href="#scroll_home" style="font-size:18px;">HOME </a>
                            </li>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav-menu" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="font-size:18px;">
                                    ABOUT US 
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#scroll_aboutus">Menu</a>
                                <div class="dropdown-divider">
                                </div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-menu" href="#scroll_gallery" style="font-size:18px;">GALLERY </a>
                            </li>
                        </ul>
                        <div class="form-inline my-2 my-lg-0">
                            <button class="btn btn-success btn-sm" type="" onclick="login()" style="width:150px; height:50px; font-size:18px;">LOGIN</button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="row" style="background-color:#f3f3f3;">
            <div style="width:100%;">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 j-img" src="<?= base_url(); ?>/assets/bootstrap/images/banner7.jpg" alt="" style="min-height:250px; max-height:250px; overflow:auto; width:100%;object-fit:cover; border-width:2px; border-style:solid; border-color:red;">
                            <div class="carousel-caption">
                                <div class="row pt-5" style="text-align:center; align-items:center;">
                                    <div class="col-sm-12 pb-5" style="padding:0px; text-align:center; color:rgb(9, 25, 98)">
                                        <h1>WELCOME TO MY PHONE BOOK SYSTEM</h1>
                                        <h3>Greater Technology, Better Experience!</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row pt-3" style="height:auto; color:white; background-color:white;" id="scroll_aboutus">
            <div class="container">
                <div class="row" style="text-align:center;">
                    <div class="col-sm-12 p-3" style="">
                        <h2 class="text-danger"><b>ABOUT US</b></h2></br>
                        <h3 class="text-dark">The System Contains A Login, Register</h3></br>
                        <h3 class="text-dark">Once Login, User will able to see a dashboard and some menu</h3></br>
                    </div>
                </div>
                <div class="row pt-3" style="text-align:center; background-color:red; border-radius:10px;">
                    <div class="col-sm-12 p-3" style="">
                        <h2 class="text-white"><b>MENU</b></h2></br>
                    </div>
                    <div class="col-sm-12" style="text-align:center;">
                        <div class="row justify-content-between m-3">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4 m-3 p-3" style="background-color:white; border-style: double; border-color:rgb(59, 118, 220); border-width: 0px; border-style: solid; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                <h3 class="text-danger">Phone</h3></br>
                                <h3 class="text-dark">Create, Edit Or Delete</h3></br>
                                <h3 class="text-dark">Upload image</h3>
                            </div>
                            <div class="col-sm-4 m-3 p-3" style="background-color:white; border-style: double; border-color:rgb(59, 118, 220); border-width: 0px; border-style: solid; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                <h3 class="text-danger">Logout</h3></br>
                                <h3 class="text-dark">Logout User</h3>
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>
                        <div class="row justify-content-between m-3">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4 m-3 p-3" style="background-color:white; border-style: double; border-color:rgb(59, 118, 220); border-width: 0px; border-style: solid; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                <h3 class="text-danger">Phone</h3></br>
                                <h3 class="text-dark">Create, Edit Or Delete</h3>
                            </div>
                            <div class="col-sm-4 m-3 p-3" style="background-color:white; border-style: double; border-color:rgb(59, 118, 220); border-width: 0px; border-style: solid; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                <h3 class="text-danger">Logout</h3></br>
                                <h3 class="text-dark">Logout User</h3>
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-5" style="height:auto; color:white; background-color:white;" id="scroll_gallery">
            <div class="container">
                <div class="row" style="text-align:center;">
                    <div class="col-sm-12 p-3" style="">
                        <h2 class="text-danger"><b><u>GALLERY</u></b></h2>
                    </div>
                </div>
                <div class="row" style="text-align:center;">
                    <div class="col-sm-12" style="text-align:center;">
                        <div class="row justify-content-between m-3">
                            <?php foreach( $list as $k => $v ) { ?>
                            <div class="col-sm-4 pb-5">
                                <span class="text-dark" style="font-size:25px; font-weight:800;"><b><?= $v['name'] ?></b></span></br>
                                <span class="text-dark" style="font-size:20px;"><?= $v['value'] ?></span></br>
                                <div class="col-12" style="background-color:white; border-style: double; border-color:rgb(59, 118, 220); border-width: 0px; border-style: solid; border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                    <img src="<?= base_url().$v['image_url']; ?>" style="width:250px; height:250; object-fit:contain;" alt="No image">
                                </div>
                            </div>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    <script>

        function login(){
            window.location.replace("<?= base_url(); ?>user/login");
        }


    </script>

</html>
