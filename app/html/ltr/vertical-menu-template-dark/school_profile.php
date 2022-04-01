<?php require 'index_php.php'; ?>
<?php
if (isset($_GET['ktsp'])) {
    $manage_year = base64_decode($_GET['ktsp']);
    # code...
} else {
    header("Location: management.php");
    exit();
}

//MIGRATE STUDENT TO NEXT YEAR
if (isset($_POST['migrate'])) {
    if ($role = 'admin') {
        $bool = 1;
        $go_classe = $_POST['go_classe'];
        $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
        while ($result = mysqli_fetch_assoc($query)) {
            $matricule_apprenant = $result['matricule_apprenant'];
            while ($index_tab = key($_POST)) {
                if ($index_tab == $matricule_apprenant) {
                    $nom_apprenant = $result['nom_apprenant'];
                    $prenom_apprenant = $result['prenom_apprenant'];
                    $telephone_apprenant = $result['telephone'];
                    $adresse_apprenant = $result['adresse'];
                    $other_info_apprenant = $result['information_tierce'];
                    $tutor_apprenant = $result['contact_parentale'];
                    $code_classe = addslashes($go_classe);
                    $ini = $result['matricule_apprenant'];
                    $pass = $result['pssw'];
                    $bool = $user->add_student_m($nom_apprenant, $prenom_apprenant, $telephone_apprenant, $adresse_apprenant, $other_info_apprenant, $tutor_apprenant, $matricule_etablissement, $code_classe, $manage_year, $ini, $pass);
                    # code...
                }
                if ($bool == 0) {
                    //   break;
                    # code...
                }
                next($_POST);
                # code...
            }
            reset($_POST);
            # code...
        }
        switch ($bool) {
            case 1: ?>
                <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-content">
                            <div id="swal2-content" style="display: block;"><?php echo 'Student have been promoted'; ?></div>
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
                </div>

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
                            <div id="swal2-content" style="display: block;"><?php echo 'There are Student already Promoted.. The other one have been promoted'; ?></div>
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
        # code...
    } else {
        include 'access_denieted.php';
        # code...
    }
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
    <title><?php echo $manage_year . " | " . $nom_etablissement; ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/animate/animate.css">
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
                                        <!-- user timeline image -->
                                        <img src="../../../app-assets/images/profile/post-media/profile-banner-co.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                        <!-- user profile image -->
                                        <img src="logo_data/<?php echo $logo ?>" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color"><?php echo $nom_etablissement ?></h4>
                                        <small><?php echo $date_academique ?></small>
                                    </div>
                                    <!-- user profile nav tabs start -->
                                    <div class="card-body px-0">
                                        <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                            <!-- <li class="nav-item pb-0">
                                                <a class=" nav-link d-flex px-1 active" id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Feed</span></a>
                                            </li> -->
                                            <li class="nav-item pb-0">
                                                <a class="nav-link d-flex px-1 active" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-user"></i><span class="d-none d-md-block">Activity</span></a>
                                            </li>
                                            <!-- <li class="nav-item pb-0">
                                                <a class="nav-link d-flex px-1" id="friends-tab" data-toggle="tab" href="#friends" aria-controls="friends" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Friends</span></a>
                                            </li>
                                            <li class="nav-item pb-0 mr-0">
                                                <a class="nav-link d-flex px-1" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false"><i class="bx bx-copy-alt"></i><span class="d-none d-md-block">Profile</span></a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <!-- user profile nav tabs ends -->
                                </div>
                            </div>
                            <!-- user profile heading section ends -->
                            <!-- <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">please select the exam</h4><br>
                                </div>
                                <div class="card-content">
                                    <form class="form form-horizontal" method="post" action="">
                                        <div class="card-body card-dashboard">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <button type="submit" name="report" class="btn btn-danger">View</button>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <div class="mb-3">
                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                <legend></legend>
                                                                <label for="">Exam</label>
                                                                <select required class="form-control" name="exam">
                                                                    <<?php
                                                                        $query = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                                        while ($result = mysqli_fetch_assoc($query)) { ?> <option value="<?php echo addslashes($result['code_examen']); ?>"><?php echo $result['nom_examen']; ?></option>
                                                                    <?php
                                                                            // code...
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> -->
                            <!-- user profile content section start -->
                            <div class="row">
                                <!-- user profile nav tabs content start -->
                                <div class="col-lg-12">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                            <!-- Accordion with hover start -->
                                            <section id="accordion-hover-wrapper">
                                                <div id="accordionExample3" data-toggle-hover="true">
                                                    <div class="accordion card collapse-icon accordion-icon-rotate">
                                                        <?php
                                                        $i = 0;
                                                        $query = mysqli_query($database, "SELECT * FROM classe WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                            $i += 1;
                                                            $code_classe = $result['code_classe'];
                                                            $nom_classe = $result['nom_classe'];
                                                            $id_niveau = $result['id_niveau'];
                                                            $query_1 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' ");
                                                            $result_1 = mysqli_fetch_assoc($query_1);
                                                            $nom_niveau = $result_1['nom_niveau'];
                                                        ?>
                                                            <form class="form" action="" method="post">
                                                                <div class="card collapse-header">
                                                                    <div class="card-header" id="heading300<?php echo $i ?>" data-toggle="collapse" role="button" data-target="#collapse300<?php echo $i ?>" aria-expanded="true" aria-controls="collapse300<?php echo $i ?>">
                                                                        <span class="collapse-title"><?php echo $nom_classe . " | " . $nom_niveau ?></span><br>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <span><big>Select the class where checked student will be promuted</big></span>
                                                                        <select class="form-control col-5" required name="go_classe" id="">
                                                                            <?php
                                                                            $quer0 = mysqli_query($database, "SELECT * FROM classe WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$manage_year' ");
                                                                            while ($result0 = mysqli_fetch_assoc($quer0)) {
                                                                                $nom_classe_p = $result0['nom_classe'];
                                                                                $code_classe_p = $result0['code_classe'];
                                                                                $id_niveau = $result0['id_niveau'];
                                                                                $quer00 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$manage_year' ");
                                                                                $result00 = mysqli_fetch_assoc($quer00);
                                                                                $nom_niveau = $result00['nom_niveau'];
                                                                            ?>
                                                                                <option value="<?php echo $code_classe_p ?>"><?php echo $nom_classe_p . '  ' . $nom_niveau; ?></option>
                                                                            <?php

                                                                                # code...
                                                                            }
                                                                            ?>
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="collapse300<?php echo $i ?>" class="collapse" aria-labelledby="heading300<?php echo $i ?>" data-parent="#accordionExample3">
                                                                        <section id="column-selectors">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <div class="card-body card-dashboard">
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-striped ">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>First Name</th>
                                                                                                                <th>Last Name</th>
                                                                                                                <th>Classroom</th>
                                                                                                                <th>Level</th>
                                                                                                                <!-- <th>Exams</th>
                                                                                                                <th>Moyenne</th>
                                                                                                                <th>Resultat</th> -->
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php
                                                                                                            $queryp = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id asc ");
                                                                                                            while ($resultp = mysqli_fetch_assoc($queryp)) {
                                                                                                                $matricule_apprenant = addslashes($resultp['matricule_apprenant']);
                                                                                                                $nom_apprenant = $resultp['nom_apprenant'];
                                                                                                                $prenom_apprenant = $resultp['prenom_apprenant'];
                                                                                                                // if (isset($_POST['report'])) {
                                                                                                                //     $code_examen = $_POST['exam'];
                                                                                                                //     $querypppp = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$code_examen' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                //     // code...
                                                                                                                // } else {
                                                                                                                //     $querypppp = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                //     // code...
                                                                                                                // }
                                                                                                                // while ($resultpppp = mysqli_fetch_assoc($querypppp)) {
                                                                                                                //     $note_valid = $resultpppp['note_valid'];
                                                                                                                //     $code_examen = addslashes($resultpppp['code_examen']);
                                                                                                                //     $nom_examen = $resultpppp['nom_examen'];
                                                                                                                //     $count_note = 0;
                                                                                                                //     $note = 0;
                                                                                                                //     $queryo = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$code_examen' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                // while ($resulto = mysqli_fetch_assoc($queryo)) {
                                                                                                                //     $code_discipline = addslashes($resulto['code_discipline']);
                                                                                                                //     if ($resulto['note'] != 0) {
                                                                                                                //         $note = $note + 1;
                                                                                                                //         $count_note  = $count_note + $resulto['note'];
                                                                                                                //         // code...
                                                                                                                //     }
                                                                                                                //     # code...
                                                                                                                // }
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <input type="checkbox" name="<?php echo $matricule_apprenant ?>" value="<?php echo $matricule_apprenant ?>">
                                                                                                                        <?php echo  $nom_apprenant; ?>
                                                                                                                    </td>
                                                                                                                    <td><?php echo $prenom_apprenant; ?></td>
                                                                                                                    <td><?php echo $nom_classe; ?></td>
                                                                                                                    <td><?php echo $nom_niveau; ?></td>
                                                                                                                </tr>
                                                                                                            <?php
                                                                                                                # code...
                                                                                                                // }

                                                                                                                # code...
                                                                                                            }
                                                                                                            ?>

                                                                                                        </tbody>
                                                                                                        <tfoot>
                                                                                                            <tr>
                                                                                                                <<th>First Name</th>
                                                                                                                    <th>Last Name</th>
                                                                                                                    <th>Classroom</th>
                                                                                                                    <th>Level</th>
                                                                                                                    <!-- <th>Exams</th>
                                                                                                                    <th>Moyenne</th>
                                                                                                                    <th>Resultat</th> -->
                                                                                                            </tr>
                                                                                                        </tfoot>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                        <!-- Column selectors with Export Options and print table -->
                                                                        <div class="form-group">
                                                                            <button class="btn btn-danger float-right" type="submit" name="migrate">Promote</button>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                        </div>
                </section>
                <!-- Accordion with hover end -->
            </div>
        </div>
    </div>
    <!-- user profile nav tabs content ends -->
    <!-- user profile right side content start -->
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

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php include 'footer.php' ?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <script src="../../../app-assets/js/scripts/pages/page-user-profile.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/sweet-alerts.js"></script>
    <script src="../../../app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>