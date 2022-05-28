<?php require 'index_php.php' ?>
<?php
$full_name = null;
$matri_teacher = null;
$disponibilite = null;
$telephone = null;
$email = null;
$adresse = null;
$nom_enseignant = null;
$prenom_enseignant = null;
$matricule_enseignant = null;
?>
<?php
if (isset($_GET['ktsp'])) {
    $id = base64_decode($_GET['ktsp']);
    $query = mysqli_query($database, "SELECT * FROM enseignant WHERE id = '$id' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
    if (mysqli_num_rows($query) != 1) {
        header("Location: teacher.php");
        # code...
    } else {
        $result = mysqli_fetch_assoc($query);
        $full_name = $result['nom_enseignant'] . ' ' . $result['prenom_enseignant'];
        $matri_teacher = addslashes($result['matricule_enseignant']);
        $disponibilite = $result['disponibilite'];
        $telephone = $result['telephone'];
        $email = $result['email'];
        $adresse = $result['adresse'];
        $nom_enseignant = $result['nom_enseignant'];
        $prenom_enseignant = $result['prenom_enseignant'];
        $matricule_enseignant = addslashes($result['matricule_enseignant']);
    }
    # code...
} else {
    header("Location: teacher.php");
    exit();
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
    <title> <?php echo $nom_enseignant . " " . $prenom_enseignant; ?> | <?php include 'site_title.php'; ?> </title>
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
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
                                        <!-- user timeline image -->
                                        <img src="../../../app-assets/images/profile/post-media/profile-banner-co.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                        <!-- user profile image -->
                                        <img src="logo_data/<?php echo "$logo" ?>" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color">TEACHER PROFILE</h4>
                                        <small>##############################</small>
                                    </div>
                                    <!-- user profile nav tabs start -->
                                    <div class="card-body px-0">
                                        <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                            <li class="nav-item pb-0">
                                                <a class=" nav-link d-flex px-1 active" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Feed</span></a>
                                            </li>
                                            <!--  <li class="nav-item pb-0">
                                                <a class="nav-link d-flex px-1 active" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-user"></i><span class="d-none d-md-block">Discipline</span></a>
                                            </li>
                                            <li class="nav-item pb-0">
                                                <a class="nav-link d-flex px-1" id="friends-tab" data-toggle="tab" href="#friends" aria-controls="friends" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Students</span></a>
                                            </li>
                                            <li class="nav-item pb-0 mr-0">
                                                <a class="nav-link d-flex px-1" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false"><i class="bx bx-copy-alt"></i><span class="d-none d-md-block">Time Table</span></a>
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
                                <div class="col-lg-9">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                            <!-- user profile nav tabs profile start -->
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-3 text-center mb-1 mb-sm-0">
                                                                        <img src="../../../app-assets/images/logo/logo.png" class="rounded" alt="group image" height="120" width="120" />
                                                                    </div>
                                                                    <div class="col-12 col-sm-9">
                                                                        <div class="row">
                                                                            <div class="col-12 text-center text-sm-left">
                                                                                <h6 class="media-heading mb-0"><?php echo $prenom_enseignant; ?><i class="cursor-pointer bx bxs-star text-warning ml-50 align-middle"></i></h6>
                                                                                <small class="text-muted align-top"><?php echo $nom_enseignant; ?></small>
                                                                            </div>
                                                                            <div class="col-12 text-center text-sm-left">
                                                                                <div class="mb-1">
                                                                                    <?php
                                                                                    $query = mysqli_query($database, "SELECT * FROM discipline_classe WHERE matricule_enseignant = '$matricule_enseignant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                                                    $num_dis = mysqli_num_rows($query);
                                                                                    $num_hours = 0;
                                                                                    $num_classes = 0;
                                                                                    $classes_chec = null;
                                                                                    $nums_student = 0;
                                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                                        $num_hours = $num_hours + intval($result['heure']);
                                                                                        if ($result['code_classe'] != $classes_chec) {
                                                                                            $num_classes = $num_classes + 1;
                                                                                            $classes_chec = $result['code_classe'];
                                                                                            $query_1 = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$classes_chec' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                            $nums_student = $nums_student + mysqli_num_rows($query_1);
                                                                                            # code...
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <span class="mr-1"><?php echo $num_hours; ?> <small>Hours</small></span>
                                                                                    <span class="mr-1"><?php echo $num_classes; ?> <small>Specialties</small></span>
                                                                                    <span class="mr-1"><?php echo $num_dis; ?> <small>Courses</small></span>
                                                                                    <span class="mr-1"><?php echo $nums_student; ?> <small>Students</small></span>
                                                                                    <?php

                                                                                    ?>

                                                                                </div>
                                                                                <p><i>disponibility: </i><?php echo $disponibilite; ?></p>
                                                                                <div>
                                                                                    <div class="badge badge-light-primary badge-round mr-1 mb-1" data-toggle="tooltip" data-placement="bottom" title="secured"><i class="cursor-pointer bx bx-check-shield"></i>
                                                                                    </div>
                                                                                    <div class="badge badge-light-warning badge-round mr-1 mb-1" data-toggle="tooltip" data-placement="bottom" title="Safe"><i class="cursor-pointer bx bx-badge-check"></i>
                                                                                    </div>
                                                                                    <div class="badge badge-light-success badge-round mb-1" data-toggle="tooltip" data-placement="bottom" title="got premium"><i class="cursor-pointer bx bx-award"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <button class="btn btn-sm d-none d-sm-block float-right btn-light-primary">
                                                                                    <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Edit</span>
                                                                                </button>
                                                                                <button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary">
                                                                                    <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>Edit</span></button> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Basic details</h5>
                                                        <ul class="list-unstyled">
                                                            <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i><?php echo $adresse; ?></li>
                                                            <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i><?php echo $telephone; ?> </li>
                                                            <li><i class="cursor-pointer bx bx-time mb-1 mr-50"></i><?php echo "$date_academique"; ?></li>
                                                            <li><i class="cursor-pointer bx bx-envelope mb-1 mr-50"></i><?php echo $email; ?></li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-1">Where he (she) is Working
                                                            <i class="cursor-pointer bx bx-dots-vertical-rounded align-top float-right"></i>
                                                        </h5>
                                                        <?php
                                                        $query_2 = mysqli_query($database, "SELECT* FROM discipline_classe WHERE matricule_enseignant = '$matricule_enseignant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                            try {
                                                                $code_classe_2 = addslashes($result_2['code_classe']);
                                                                $code_discipline = addslashes($result_2['code_discipline']);
                                                                $query_3 = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_classe_2' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $result_3 = mysqli_fetch_assoc($query_3);
                                                                // if (mysqli_num_rows($query_3)==0) {
                                                                //  continue;
                                                                //   // code...
                                                                // }
                                                                $classe_name = ($result_3['nom_classe'] == null) ? null : $result_3['nom_classe'];
                                                                $classe_niveau_id = ($result_3['id_niveau'] == null) ? null : $result_3['id_niveau'];
                                                                $query_3 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$classe_niveau_id' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $result_3 = mysqli_fetch_assoc($query_3);
                                                                $niveau_name = $result_3['nom_niveau'];
                                                                $query_3 = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $result_3 = mysqli_fetch_assoc($query_3);
                                                                $discipline_name = $result_3['nom_discipline'];
                                                        ?>
                                                                <div class="media d-flex align-items-center mb-1">
                                                                    <div class="media-body ml-1">
                                                                        <h6 class="media-heading mb-0"><small><?php echo $classe_name; ?></small></h6><small class="text-muted">Niveau : <?php echo $niveau_name; ?></small><br> <?php echo $discipline_name; ?>
                                                                    </div>
                                                                    <i class="cursor-pointer bx bx-plus-circle text-primary d-flex align-items-center "></i>
                                                                    <?php echo $result_2['heure']; ?> Hours
                                                                </div>
                                                        <?php

                                                            } catch (\Exception $e) {
                                                                #code

                                                            }
                                                            # code...
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- user profile nav tabs profile ends -->
                                        </div>
                                    </div>
                                </div>
                                <!-- user profile nav tabs content ends -->
                                <!-- user profile right side content start -->
                                <div class="col-lg-3">
                                    <!-- user profile right side content related groups start -->
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">Some others teachers
                                                    <i class="cursor-pointer bx bx-dots-vertical-rounded align-top float-right"></i>
                                                </h5>
                                                <?php
                                                $query = mysqli_query($database, "SELECT* FROM enseignant WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY id desc LIMIT 15 ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <div class="media d-flex align-items-center mb-1">
                                                        <img src="../../../app-assets/images/logo/logo.png" class="rounded" alt="group image" height="64" width="64" />
                                                        <div class="media-body ml-1">
                                                            <h6 class="media-heading mb-0"> <a href="teacher_profile.php?ktsp=<?php echo base64_encode($result['id']) ?>"><small><?php echo $result['nom_enseignant'] . ' ' . $result['prenom_enseignant']; ?></small> </a></h6><small class="text-muted"><?php echo $result['telephone']; ?></small>
                                                        </div>
                                                        <i class="cursor-pointer bx bx-plus-circle text-primary d-flex align-items-center "></i>
                                                    </div>
                                                <?php
                                                    # code...
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- user profile right side content related groups ends -->
                                </div>
                                <!-- user profile right side content ends -->
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
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>