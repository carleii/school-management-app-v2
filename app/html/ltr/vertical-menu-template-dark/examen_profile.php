<?php require 'index_php.php'; ?>
<?php
if (isset($_GET['ktsp'])) {
    $code_examen = addslashes(base64_decode($_GET['ktsp']));
    $nom_examen = null;
    $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$code_examen' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
    if (mysqli_num_rows($query) != 1) {
        header("Location: exam.php");
        # code...
    } else {
        $result = mysqli_fetch_assoc($query);
        $nom_examen = $result['nom_examen'];
        $note_valid = $result['note_valid'];
    }
    # code...
} else {
    header("Location: student.php");
    exit();
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title><?php echo $nom_examen . " | " . $nom_etablissement; ?></title>
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
                                        <img src="logo_data/<?php echo "$logo" ?>" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color"><?php echo $nom_examen ?></h4>
                                        <small>Valider à <?php echo $note_valid ?></small>
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
                                                            <div class="card collapse-header">
                                                                <div class="card-header" id="heading300<?php echo $i ?>" data-toggle="collapse" role="button" data-target="#collapse300<?php echo $i ?>" aria-expanded="true" aria-controls="collapse300<?php echo $i ?>">
                                                                    <span class="collapse-title"><?php echo $nom_classe . " | " . $nom_niveau ?></span>
                                                                </div>
                                                                <div id="collapse300<?php echo $i ?>" class="collapse" aria-labelledby="heading300<?php echo $i ?>" data-parent="#accordionExample3">
                                                                    <section id="column-selectors">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="card">
                                                                                    <div class="card-content">
                                                                                        <div class="card-body card-dashboard">
                                                                                            <div class="table-responsive">
                                                                                                <table class="table table-striped dataex-html5-selectors">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Name</th>
                                                                                                            <th>Exam</th>
                                                                                                            <th>Courses</th>
                                                                                                            <th>Note</th>
                                                                                                            <th>Definitive</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php
                                                                                                        $query_1 = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                                        while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                                            $nom_apprenant = $result_1['nom_apprenant'];
                                                                                                            $prenom_apprenant = $result_1['prenom_apprenant'];
                                                                                                            $matricule_apprenant = addslashes($result_1['matricule_apprenant']);
                                                                                                            $query_2 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$code_examen' AND matricule_apprenant = '$matricule_apprenant' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                                            while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                                                                                $code_discipline = addslashes($result_2['code_discipline']);
                                                                                                                $note = $result_2['note'];
                                                                                                                if ($note == 0) {
                                                                                                                    continue;
                                                                                                                    // code...
                                                                                                                }
                                                                                                                $query_3 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND code_discipline = '$code_discipline' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                                                $result_3 = mysqli_fetch_assoc($query_3);
                                                                                                                $query_4 = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' ");
                                                                                                                $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                                $nom_discipline = $result_4['nom_discipline'];
                                                                                                        ?>
                                                                                                                <tr>
                                                                                                                    <td><?php echo $nom_apprenant . " " . $prenom_apprenant ?></td>
                                                                                                                    <td><?php echo $nom_examen ?></td>
                                                                                                                    <td><?php echo $nom_discipline ?></td>
                                                                                                                    <td><?php echo $note ?></td>
                                                                                                                    <td><?php echo $retVal = ($note >= $note_valid) ? "VALIDED" : "REJECTED"; ?></td>
                                                                                                                </tr>

                                                                                                        <?php
                                                                                                                # code...
                                                                                                            }
                                                                                                            # code...
                                                                                                        }
                                                                                                        ?>

                                                                                                    </tbody>
                                                                                                    <tfoot>
                                                                                                        <tr>
                                                                                                            <th>Name</th>
                                                                                                            <th>Examen</th>
                                                                                                            <th>Courses</th>
                                                                                                            <th>Note</th>
                                                                                                            <th>Definitive</th>
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
                                                                </div>
                                                            <?php
                                                            # code...
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