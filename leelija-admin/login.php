<?php
session_start(); 
require_once dirname(__DIR__) ."/includes/constant.inc.php";

if(isset($_SESSION[ADM_SESS])){
	header("Location: index.php");
	exit;
}

require_once ROOT_DIR.'_config/dbconnect.php';
require_once ROOT_DIR.'/classes/adminLogin.class.php';
require_once ROOT_DIR.'/classes/date.class.php';
require_once ROOT_DIR.'/classes/utility.class.php';


$AdminLogin     = new AdminLogin();
$DateUtil      	= new DateUtil();
$Utility        = new Utility();


if(isset($_POST)){
   
  if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username']; 
    $password = $_POST['password'];
    
    // echo $password;exit;
    
    if(($username == '') || ($password == '')){

      header("Location: ".$_SERVER['PHP_SELF']."?msg=invalid username or password");

    }else{
      $AdminLogin->validate($username, $password, 'username', 'password', 'admin_users');
    }

  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo/favicon.png" type="image/png">
    <title> Leelija - Sign In Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">

            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain my-3"
                                style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <?php
                                    if (isset($_GET['msg'])) {
                                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Failed!</strong> '.$_GET["msg"].'
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';
                                    }
                                    ?>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form  action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <label>Username</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Username"
                                                aria-label="Username" aria-describedby="username-addon" name="username">
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" placeholder="Password"
                                                aria-label="Password" aria-describedby="password-addon" name="password">
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign
                                                in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign
                                            up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div> -->
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js"></script>
</body>

</html>