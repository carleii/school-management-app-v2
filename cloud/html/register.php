<?php
require_once 'class_package.php';
function page_name($value): void
{
   echo $value;
   // code...
}
//Check if the cookie Already existe
if (isset($_COOKIE['user'])) {
   header('location: ./');
   // code...
}
//create new account
$message = "";
if (isset($_POST['create_new_acc'])) {
   $user_ = new user_(addslashes(htmlentities($_POST['f_name'])), addslashes(htmlentities($_POST['l_name'])), addslashes(htmlentities($_POST['u_name'])), addslashes(htmlentities($_POST['pssw'])), addslashes(htmlentities($_POST['phrase_r'])));
   $result = $user_->auth_register(1);
   switch ($result) {
      case 1:
         header("location: login.php");
         exit();
         // code...
         break;
      case 3:
         $message .= "<h5 class=\" text-warning\"><i class=\"icon-user-unfollow text-warning\"></i> <span>User name Already existe. if is you please Sign in instead.</span></h5>";
         break;
      case 2:
         $message .= "<h5 class=\" text-danger\"><span>Please try with correct text format without any punctuation</span></h5>";
         break;
      default:
         // code...
         break;
   }
   // code...
}
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link rel="icon" href="favicon.ico" type="image/x-icon" />

   <title><?php page_name("User Register") ?></title>

   <!-- Bootstrap Core and vandor -->
   <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />


   <!-- Core css -->
   <link rel="stylesheet" href="../assets/css/style.min.css" />
   <link rel="stylesheet" href="assets/css/default.css" />

</head>

<body class="font-muli dark-mode gradient">
   <div class="auth option2">
      <div class="auth_left">
         <div class="card">
            <div class="card-body">
               <div class="text-center">
                  <a class="header-brand" href="index.html"><i class="fa fa-graduation-cap brand-logo"></i></a>
                  <h4>THIB SECURED FILES SERVER</h4>
                  <div class="card-title">Create new account</div>
               </div>
               <form class="form" action="" method="post">
                  <div class="form-group">
                     <label class="form-label">First Name</label>
                     <input type="text" name="f_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Last Name</label>
                     <input type="text" name="l_name" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label class="form-label">User Name</label>
                     <input type="text" class="form-control" name="u_name" required>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Password</label>
                     <input type="password" class="form-control" name="pssw" required>
                  </div>
                  <div class="form-group">
                     <label class="form-label">In case of password lost</label>
                     <input type="text" class="form-control" placeholder="What is your best friend's name?" name="phrase_r" required>
                  </div>
                  <div class="form-group">
                     <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" checked required />
                        <span class="custom-control-label">Agree the <a href="#">terms and policy</a></span>
                     </label>
                  </div>
                  <div class="text-center">
                     <button type="submit" name="create_new_acc" class="btn btn-primary btn-block">Create new account</button>
                     <?php echo $message; ?>
                     <div class="text-muted mt-4">Already have account? <a href="login.php">Sign in</a></div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Start Main project js, jQuery, Bootstrap -->
   <script src="../assets/bundles/lib.vendor.bundle.js"></script>

   <!-- Start Plugin Js -->
   <script src="../assets/bundles/fullcalendar.bundle.js"></script>

   <!-- Start project main js  and page js -->
   <script src="../assets/js/core.js"></script>
   <script src="assets/js/page/calendar.js"></script>
</body>

</html>