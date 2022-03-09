<?php
require 'class_package.php';
function page_name($value):void
{
   echo $value;
   // code...
}
//deconnexion
if (isset($_GET['ktsp'])) {
    // Suppression du cookie
    setcookie('user');
    // Suppression de la valeur du tableau $_COOKIE
    unset($_COOKIE['user']);
    // code...
}
//Check if the cookie still existe
if (isset($_COOKIE['user'])) {
   header('location: ./');
   // code...
}
$message = "";
if (isset($_POST['sign'])) {
   $u_name =addslashes(htmlentities($_POST['u_name'])) ;
   $pssw =addslashes(htmlentities($_POST['pssw'])) ;
   $user_ = new user_("", "", $u_name, $pssw);
   $result = $user_->auth_login();
   switch ($result) {
      case 2:
         $message.= "<h6 class=\" text-warning\"><i class=\"icon-user-unfollow text-warning\"></i> <span>Wrong password.</span></h6>";
         break;
      case 3:
         $message.= "<h6 class=\" text-warning\"><i class=\"icon-user-unfollow text-warning\"></i> <span>User not found.</span></h6>";
         break;
      case 4:
         $message.= "<h6 class=\" text-danger\"><span>Please try with correct text format without any punctuation</span></h6>";
         break;
      default:
         // code...
         break;
   }

   // code...
}
?>
<!doctype html>
<html lang="en" dir="html">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title><?php echo page_name('Login') ?></title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />

<!-- Core css -->
<link rel="stylesheet" href="../assets/css/style.min.css"/>

</head>
<body class="font-muli dark-mode gradient">

<div class="auth option2">
    <div class="auth_left">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <a class="header-brand" href="index.php"><i class="fa fa-graduation-cap brand-logo"></i></a>
                    <h4>THIB SECURED FILES SERVER</h4>
                    <div class="card-title mt-3">Login to your account</div>
                </div>
                <form class="form" action="" method="post">
                   <div class="form-group">
                      <input type="text" class="form-control" name="u_name" required id="" aria-describedby="Username" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                      <label class="form-label"><a href="forgot-password.php" class="float-right small">I forgot password</a></label>
                      <input type="password" class="form-control" name="pssw" required id="" placeholder="Password">
                  </div>
                  <!-- <div class="form-group">
                      <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                      </label>
                  </div> -->
                  <div class="text-center">
                      <button class="btn btn-primary btn-block" type="submit" name="sign">Sign in</button>
                      <?php echo $message; ?>
                      <div class="text-muted mt-4">Don't have account yet? <a href="register.php">Sign up</a></div>
                  </div>
               </form>

            </div>
        </div>
    </div>
</div>

<!-- Start Main project js, jQuery, Bootstrap -->
<script src="../assets/bundles/lib.vendor.bundle.js"></script>

<!-- Start project main js  and page js -->
<script src="../assets/js/core.js"></script>
</body>
</html>
