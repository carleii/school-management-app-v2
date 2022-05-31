<?php
require 'classe_package.php';
//GET THE USER FOR WHO THE SCHOOL IS CREATED
$email = null;
if (isset($_GET['kpjsc']) and !empty($_GET['kpjsc'])) {
    $email = base64_decode($_GET['kpjsc']);
    # code...
} else {
    header("Location: auth-login.php");
    exit();
}

?>
<?php include 'database_connection.php'; ?>
<?php
//ADD SCHOOL
if (isset($_POST["add_school"])) {
    $full_name =get_safe_input($_POST["full_name"]);
    $slogan = get_safe_input($_POST["slogan"]);
    $location =get_safe_input($_POST["location"]);
    $email_s =get_safe_input($_POST["email"]);
    $tel =get_safe_input($_POST["tel"]);
    $director =get_safe_input($_POST["director"]);
    $web =get_safe_input($_POST["web"]);
    $logo_name = ($_FILES["logo"]["name"]);
    $logo_path = ($_FILES["logo"]["tmp_name"]);
    $statut =  $_POST['statut'];
    $user = new user;
    $result = $user->creat_school($full_name, $logo_name, $logo_path, $statut, $slogan,$location,$email_s,$tel,$director,$web);
    if ($result == false) {
        # code...
    } else {
        $result = explode("|", $result);
        $matricule_etablissement = $result[0];
        $date_academique = $result[1];
        //UPDATE THE USER WHO CREATED THE SCHOOL BY ADDIND THE SCHOOL CODE
        $query = mysqli_query($database, "UPDATE utilisateur SET matricule_etablissement = '$matricule_etablissement' WHERE email_utilisateur = '$email'");
        //UPDATE THE CLOUD
        $query = mysqli_query($database, "UPDATE clduser_ SET MATRICULE_ETABLISSEMENT = '$matricule_etablissement' WHERE CODE_USER = '$email' ");
        //IF THE QUERY WORK SET THE COOKIE
        if ($query) {
            $cookie = new cookie_session($date_academique, $email);
            header("Location: index.php");
            # code...
        }
    }
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title>Creat a School | <?php include 'site_title.php'; ?></title>
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

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">CREAT YOUR SHOOL</h4>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p> <small> Please enter your details to Add a school and be part of our great community</small>
                                            </p>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="inputfirstname4">Full Name</label>
                                                            <input type="text" class="form-control" name="full_name" required="" id="inputfirstname4" placeholder="School Full name">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="">Slogan</label>
                                                            <input type="text" class="form-control" name="slogan" required="" id="" placeholder="">
                                                        </div>
                                                    </div>
                                                                                                        <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="">Location</label>
                                                            <input type="text" class="form-control" name="location" required="" id="" placeholder="">
                                                        </div>
                                                    </div>
                                                                                                        <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="">Email</label>
                                                            <input type="email" class="form-control" name="email" required="" id="" placeholder="">
                                                        </div>
                                                    </div>
                                                                                                        <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="">Phone (international format)</label>
                                                            <input type="tel" class="form-control" name="tel"  placeholder="">
                                                        </div>
                                                    </div>
                                                                                                        <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="">Director name</label>
                                                            <input type="text" class="form-control" name="director" required="" id="" placeholder="">
                                                        </div>
                                                    </div>
                                                                                                                                                            <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="">Website</label>
                                                            <input type="text" class="form-control" name="web"  id="" placeholder="">
                                                        </div>
                                                    </div>


                                                    <div class="form-row">
                                                        <div class="form-group col-md-12 mb-50">
                                                            <label for="l1">Lycee/College</label>
                                                            <input type="radio" name="statut" value="1" class="" required id="l1" title="What is your type of school"><br>
                                                            <label for="l2">University/Superior School</label>
                                                            <input type="radio" name="statut" value="2" class="" required checked id="l2" title="What is your type of school">

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <fieldset class="form-group">
                                                            <label for="basicInputFile">Logo</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="logo" class="custom-file-input" id="inputGroupFile01">
                                                                <label class="custom-file-label" for="inputGroupFile01">Choose logo</label>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <button type="submit" name="add_school" class="btn btn-primary glow position-relative w-100">Create<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Already have a School?</small><a href="auth-login.php"><small>Sign in</small> </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="../../../app-assets/images/pages/register.png" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
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
    <script src="../../../app-assets/js/scripts/forms/form-tooltip-valid.js"></script>

    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>