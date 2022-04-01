<?php include 'index_php.php'; ?>
<?php
$nom_matiere = null;
$code_matiere = null;
?>
<?php
if (isset($_GET['ktsp'])) {
    $matter_id = $_GET['ktsp'];
    $query = mysqli_query($database, "SELECT * FROM matiere WHERE id = '$matter_id' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
    if (mysqli_num_rows($query) != 1) {
        header("Location: matiere.php");
        # code...
    } else {
        $result = mysqli_fetch_assoc($query);
        $nom_matiere = $result['nom_matiere'];
        $code_matiere = addslashes($result['code_matiere']);
    }
    # code...
} else {
    header("Location: matiere.php");
    exit();
}

if (isset($_POST['add_dis'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $dis_name = addslashes($_POST['dis_name']);
        $result = $user->add_dis($dis_name, $code_matiere, $date_academique, $matricule_etablissement);
    } else {
        include 'access_denieted.php';
    }
    # code...
}

if (isset($_POST['delete_dis'])) {
    if ($role == 'admin' or $role = 'headmaster') {
        $code_delete_dis = addslashes($_POST['delete_dis']);
        $result = $user->delete_dis($code_delete_dis, $code_matiere, $matricule_etablissement, $date_academique);
        switch ($result) {
            case 1: ?>
                <!-- <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-content">
                            <div id="swal2-content" style="display: block;"><?php echo ' The Course have been deleted'; ?></div>
                            <input class="swal2-input" style="display: none;">
                            <input type="file" class="swal2-file" style="display: none;">
                            <div class="swal2-range" style="display: none;">
                                <input type="range"><output></output>
                            </div>
                            <select class="swal2-select" style="display: none;"></select>
                            <div class="swal2-radio" style="display: none;"></div>
                            <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox">
                                <span class="swal2-label"></span>
                            </label>
                            <textarea class="swal2-textarea" style="display: none;"></textarea>
                            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                        </div>
                        <div class="swal2-actions" style="display: flex;">
                            <a href=""><button type="button" class="swal2-confirm btn btn-success" aria-label="">ok</button></a>
                        </div>
                    </div>
                </div> -->

            <?php
                # code...
                break;
            case 0: ?>
                <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-header">
                            <ul class="swal2-progresssteps" style="display: none;"></ul>
                            <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                                    <span class="swal2-x-mark-line-right"></span></span>
                            </div>
                            <div class="swal2-icon swal2-question" style="display: none;">
                                <span class="swal2-icon-text">?</span>
                            </div>
                            <div class="swal2-icon swal2-warning" style="display: none;">
                                <span class="swal2-icon-text">!</span>
                            </div>
                            <div class="swal2-icon swal2-info" style="display: none;">
                                <span class="swal2-icon-text">i</span>
                            </div>
                            <div class="swal2-icon swal2-success" style="display: none;">
                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                <span class="swal2-success-line-tip"></span>
                                <span class="swal2-success-line-long"></span>
                                <div class="swal2-success-ring"></div>
                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                            </div>
                            <img class="swal2-image" style="display: none;">
                            <h2 class="swal2-title" id="swal2-title" style="display: flex;">Oops...</h2>
                            <button type="button" class="swal2-close" style="display: none;">×</button>
                        </div>
                        <div class="swal2-content">
                            <div id="swal2-content" style="display: block;"><?php echo ' The Course have not been deleted. Try in a few minutes'; ?></div>
                            <input class="swal2-input" style="display: none;">
                            <input type="file" class="swal2-file" style="display: none;">
                            <div class="swal2-range" style="display: none;">
                                <input type="range"><output></output>
                            </div>
                            <select class="swal2-select" style="display: none;"></select>
                            <div class="swal2-radio" style="display: none;"></div>
                            <label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox">
                                <span class="swal2-label"></span>
                            </label>
                            <textarea class="swal2-textarea" style="display: none;"></textarea>
                            <div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div>
                        </div>
                        <div class="swal2-actions" style="display: flex;">
                            <a href=""><button type="button" class="swal2-confirm btn btn-primary" aria-label="">ok</button></a>
                        </div>
                        <div class="swal2-footer" style="display: flex;"><a href="">Why do I have this issue?</a></div>
                    </div>
                </div>
<?php
                # code...
                break;

            default:
                # code...
                break;
        }
        # code..
        # code...
    } else {
        include 'access_denieted.php';
    }

    # code...
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Matter | <?php include 'site_title.php'; ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-user-profile.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<?php

if (isset($_POST['csv_upload'])) {
    ?>
	<script type="text/javascript" language="javascript">
        alert ("Wait while data are loading....");
    </script>
    <?php
    $file = $_FILES['csv_file']['tmp_name'];
    $ext = explode(".", $_FILES['csv_file']['name']);
    $handle = fopen($file, "r");
    $i = 0;
    if ($ext[1] == "csv") {
            while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
                if ($i == 0) {
                    $i++;
                    continue;
                }
            $result = $user->add_dis($cont[1], $code_matiere, $date_academique, $matricule_etablissement);
            $i++;
            # code...
        }

        # code...
    }else {
        ?>
        	<script type="text/javascript" language="javascript">
                alert ("Fatal error: incorrect file format \n Download the template and use it.");
            </script>

        <?php
        # code...
    }
    # code...
}

?>

<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static menu-expanded " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <!-- INCLUDING THE HEADER NAVBAR -->
    <?php include 'header_nav.php'; ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <?php include 'main_nav.php'; ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- page user profile start -->
                <section class="page-user-profile">
                    <div class="row">
                        <div class="col-12">
                            <!-- user profile heading section start -->
                            <div class="card">
                                <div class="card-content">
                                    <div class="user-profile-images">
                                        <img src="../../../app-assets/images/profile/post-media/profile-banner-co.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                        <img src="logo_data/<?php echo $logo ?>" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color"><?php echo $nom_matiere; ?></h4>
                                        <small><?php echo $nom_etablissement; ?></small>
                                    </div>
                                    <!-- user profile nav tabs start -->
                                    <div class="card-body px-0">
                                        <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                            <li class="nav-item pb-0">
                                                <a class=" nav-link d-flex px-1 active" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Courses of <?php echo $nom_matiere; ?></span></a>
                                            </li>
                                            <!--  <li class="nav-item pb-0">
                                                <a class="nav-link d-flex px-1" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-user"></i><span class="d-none d-md-block">List</span></a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <!-- user profile nav tabs ends -->
                                </div>
                            </div>
                            <!-- user profile heading section ends -->

                            <!-- user profile content section start -->
                            <div class="row">
                                <!-- user profile nav tabs content start -->
                                <div class="col-lg-12">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                            <!-- user profile nav tabs feed start -->
                                            <div class="row">
                                                <!-- user profile nav tabs feed middle section start -->
                                                <div class="col-lg-12">
                                                    <!-- user profile nav tabs feed middle section post card start -->
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div class="tab-content pl-0">
                                                                    <div class="tab-pane active" id="user-status" aria-labelledby="user-status-tab" role="tabpanel">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <form action="" method="post">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-1 col-2">
                                                                                            <div class="avatar">
                                                                                                <img src="logo_data/<?php echo $logo ?>" alt="user image" width="32" height="32">
                                                                                                <span class="avatar-status-online"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-9 col-9">
                                                                                            <input type="text" required name="dis_name" class="form-control border-0 shadow-none" id="user-post-textarea" placeholder="Add the Course here..."></input>
                                                                                        </div>
                                                                                        <div class="col-sm-2 col-2">
                                                                                            <span class=" float-sm-right d-flex flex-sm-row flex-column justify-content-end">
                                                                                                <!-- <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button> -->
                                                                                                <button type="submit" name="add_dis" class="btn btn-primary">Add Discipline</button>
                                                                                            </span>

                                                                                        </div>

                                                                                    </div>
                                                                                </form>

                                                                                <hr>
                                                                                <center>
                                                                                    <h6>Or upload a data file</h6>
                                                                                </center>
                                                                                <div class="card-footer p-0">
                                                                                    <!-- compose button  -->
                                                                                    <button type="button" class="btn btn-warning btn-block my-2">
                                                                                        <a href="template/discipline.csv" download=""> Download the template
                                                                                        </a>
                                                                                    </button>
                                                                                    <small>do not modify the header</small>

                                                                                    <form action="#" method="post" enctype="multipart/form-data">
                                                                                        <div class="form-group mt-2">
                                                                                            <div class="custom-file">
                                                                                                <input type="file" required class="custom-file-input" name="csv_file" accept="csv" id="emailAttach">
                                                                                                <label class="custom-file-label" for="emailAttach">Attach File</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <button type="submit" name="csv_upload" class="btn btn-success btn-block my-2">
                                                                                            Upload file's data
                                                                                        </button>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- user profile middle section blogpost nav tabs card ends -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section post card ends -->
                                                    <!-- user profile nav tabs activity start -->
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form action="" method="post">
                                                                    <!-- timeline widget start -->
                                                                    <ul class="widget-timeline">
                                                                        <?php
                                                                        $query = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                        while ($result = mysqli_fetch_assoc($query)) { ?>
                                                                            <li class="timeline-items timeline-icon-success active">
                                                                                <div class="timeline-time"><?php echo $date_academique; ?></div>
                                                                                <h6 class="timeline-title" style="text-transform: uppercase;"><?php echo $result['nom_discipline']; ?></h6>
                                                                                <p class="timeline-text">
                                                                                    <button type="submit" name="delete_dis" value="<?php echo $result['code_discipline']; ?>" class="btn btn-icon action-icon">
                                                                                        <span class="fonticon-wrap">
                                                                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                            </i>
                                                                                        </span>
                                                                                    </button>
                                                                                    on <a href="JavaScript:void(0);"><?php echo $nom_matiere; ?></a>
                                                                                </p>
                                                                                <!--  <div class="timeline-content">
                                                                                        Welcome to vedio game and lame is very creative
                                                                                    </div> -->
                                                                            </li>


                                                                        <?php
                                                                            # code...
                                                                        }
                                                                        ?>

                                                                    </ul>
                                                                    <!-- timeline widget ends -->
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs activity start -->
                                                </div>
                                                <!-- user profile nav tabs feed middle section ends -->
                                            </div>
                                            <!-- user profile nav tabs feed ends -->
                                        </div>
                                    </div>
                                </div>
                                <!-- user profile nav tabs content ends -->
                            </div>
                            <!-- user profile content section start -->
                        </div>
                    </div>
                </section>
                <!-- page user profile ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php include 'footer.php'; ?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-user-profile.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-email.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/sweet-alerts.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>