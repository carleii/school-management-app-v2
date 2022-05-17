<?php require 'classe_package.php'; ?>
<?php include 'database_connection.php'; ?>
<?php
if (isset($_GET['ktsp'])) {
    // Suppression du cookie designPrefere
    setcookie('user_cookie');
    // Suppression de la valeur du tableau $_COOKIE
    unset($_COOKIE['user_cookie']);
    // code...
}

?>
<?php
//VERIFY IF THE COOKIE EXIST EITHER GO TO HOME PAGE
if (isset($_COOKIE['user_cookie'])) {
    header("Location: index.php");
    # code...
}

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title>Login <?php include 'site_title.php'; ?> </title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/toastr.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->
<?php
// CONNECTING TREATMENT
if (isset($_POST["connect"])) {
    $user_email =get_safe_input($_POST["user_email"]);
    $user_pssw =get_safe_input(base64_encode($_POST["user_pssw"]));
    $date_academique =($_POST["date_academique"]);
    $user = new user;
    //SEND THE USER CONNECTION REQUEST
    $result = $user->user_connection($user_pssw, $user_email, $date_academique);
    switch ($result) {
        case 'user_not_found':
?>
            <div id="toast-container" class="toast-container toast-top-right">
                <div class="toast toast-warning" aria-live="assertive" style="display: block; opacity: 0.732461;">
                    <div class="toast-progress" style="width: 0%;"></div>
                    <div class="toast-title">Warning</div>
                    <div class="toast-message">User not found! Verify The pasword and the User name !</div>
                </div>
            </div>
        <?php
            # code...
            break;
        case 'school_not_found':
            $user_email = base64_encode($user_email);
        ?>
            <div id="toast-container" class="toast-container toast-top-right">
                <div class="toast toast-warning" aria-live="assertive" style="display: block; opacity: 0.732461;">
                    <div class="toast-progress" style="width: 0%;"></div>
                    <div class="toast-title">Warning</div>
                    <div class="toast-message">School not found! <em>Doen't have a school?
                            <a href="auth-register-school.php?kpjsc=<?php echo $user_email ?>"><i><span style="color : black;"><u>Add your school here</u></span></i></a></em></div>
                </div>
            </div>
            <?php
            # code...
            break;

        default:

            if ($result == false) {
            ?>
                <div id="toast-container" class="toast-container toast-top-right">
                    <div class="toast toast-info" aria-live="assertive" style="display: block; opacity: 0.732461;">
                        <div class="toast-progress" style="width: 0%;"></div>
                        <div class="toast-title">Info</div>
                        <div class="toast-message">There is a problem with this account! we are already fixing it! please wait while.</div>
                    </div>
                </div>
<?php
                # code...
            } elseif ($result == true) {
                //SET COOKIE
                $cookie = new cookie_session($date_academique, $user_email);

                //GET THE PLAFORM USER
                header("Location: index.php");
                # code...
                //CREATION OF THE ACTIVE USER SESSION

                # code...
            }

            break;
    }
}
?>



<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Welcome Back</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <!--  <div class="d-flex flex-md-row flex-column justify-content-around">
                                                    <a href="#" class="btn btn-social btn-google btn-block font-small-3 mr-md-1 mb-md-0 mb-1">
                                                        <i class="bx bxl-google font-medium-3"></i><span class="pl-50 d-block text-center">Google</span></a>
                                                    <a href="#" class="btn btn-social btn-block mt-0 btn-facebook font-small-3">
                                                        <i class="bx bxl-facebook-square font-medium-3"></i><span class="pl-50 d-block text-center">Facebook</span></a>
                                                </div> -->
                                                <form method="POST">
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" autofill  for="user_email">User Name or Email</label>
                                                        <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Nom d'utilisateur" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="user_pssw">Password</label>
                                                        <input type="password" class="form-control" id="user_pssw" name="user_pssw" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="date_academique">Date academique</label>
                                                        <input type="text" class="form-control" id="date_academique" name="date_academique" placeholder="Date academique" required="">
                                                    </div>
                                                    <button type="submit" name="connect" class="btn btn-primary glow w-100 position-relative">Login<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                    <!-- <center>Or</center> -->
                                                </form>
                                                <br>
                                                <span>
                                                    Create a new school here
                                                </span>
                                                <a href="auth-register.php"> Register<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                                </a>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        <img class="img-fluid" src="../../../app-assets/images/pages/login.png" alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/extensions/toastr.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>