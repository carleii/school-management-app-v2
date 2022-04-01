<?php require 'index_php.php'; ?>
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
    <title>Time table | <?php
                        if (isset($_GET['ktsp'])) {
                            $ktsp = $_GET['ktsp'];
                            $ktsp = explode('.', $ktsp);
                            $week_view = $ktsp[0];
                            $code_classe = $ktsp[1];
                            $query = mysqli_query($database, "SELECT * FROM classe WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' AND code_classe = '$code_classe' ");
                            $result = mysqli_fetch_assoc($query);
                            $id_niveau = $result['id_niveau'];
                            $query_1 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'");
                            $result_1 = mysqli_fetch_assoc($query_1);
                            # code...
                            echo $result['nom_classe'] . " " . $result_1['nom_niveau'] . " " . $week_view;
                        } else {
                            header("Location: ./");
                            exit();
                        }
                        ?></title>
    <style type="text/css">
        @media print {
            footer {
                page-break-after: always;
            }
        }
    </style>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-layout="dark-layout">


    <!-- BEGIN: Content-->
    <!-- user profile heading section start -->
    <div class="">
        <div class="">
            <div class="row">
                <div class="col-1">
                    <div class="user-profile-images">
                        <img src="logo_data/<?php echo $logo ?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="school logo" height="107" width="90">
                    </div>
                </div>
                <div class="col-11">
                    <center>
                        <span style="font-size : 20px">
                            <h2><b><?php echo $nom_etablissement ?></b></h2>
                        </span>
                        <span style="font-size : 20px">
                            <h2> <b> <?php echo $nom_etablissement ?> </b></h2>
                            <h3>TIME TABLE/ EMPLOI DE TEMPS</h3>
                            <?php
                            if (isset($_GET['ktsp'])) {
                                $ktsp = $_GET['ktsp'];
                                $ktsp = explode('.', $ktsp);
                                $week_view = $ktsp[0];
                                $code_classe = $ktsp[1];
                                $query = mysqli_query($database, "SELECT * FROM classe WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' AND code_classe = '$code_classe' ");
                                $result = mysqli_fetch_assoc($query);
                                $id_niveau = $result['id_niveau'];
                                $query_1 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'");
                                $result_1 = mysqli_fetch_assoc($query_1);
                                # code...
                            ?>
                                <h4>Semaine/Week : <?php echo $week_view; ?></h4>
                                <h5><?php echo $result['nom_classe'] . "  " . $result_1['nom_niveau']; ?></h5><br><?php echo $date_academique; ?>
                            <?php


                            }
                            ?>

                        </span>
                    </center>
                </div>

            </div>
            <hr>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Hour</th>
                                    <th>Discipline</th>
                                    <th>Teacher</th>
                                    <th>Place</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['ktsp'])) {
                                    $ktsp = $_GET['ktsp'];
                                    $ktsp = explode('.', $ktsp);
                                    $week_view = $ktsp[0];
                                    $code_classe = $ktsp[1];
                                    $query = mysqli_query($database, "SELECT * FROM calendrier WHERE date_academique ='$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week_view' ");
                                    # code...
                                } else {
                                    $query = mysqli_query($database, "SELECT * FROM calendrier WHERE date_academique ='$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' ORDER BY id desc LIMIT 1 ");
                                }
                                $result = mysqli_fetch_assoc($query);
                                $week = $result['week'];
                                $day = null;
                                $query_1 = mysqli_query($database, "SELECT *  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' ORDER BY id asc ");
                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                    if ($day == $result_1['jour']) {
                                        continue;
                                    } else {
                                        $day = $result_1['jour'];
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $day; ?></td>
                                        <td>
                                            <?php
                                            $query_2 = mysqli_query($database, "SELECT *  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = '$day' ORDER BY id asc ");
                                            while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                echo $result_2['horaire'] . "<hr>";
                                                # code...
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $query_2 = mysqli_query($database, "SELECT *  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = '$day' ORDER BY id asc ");
                                            while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                $code_discipline = addslashes($result_2['code_discipline']);
                                                $query_3 = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' ");
                                                $result_3 = mysqli_fetch_assoc($query_3);
                                                echo $result_3['nom_discipline'] . "<hr>";
                                                # code...
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $query_2 = mysqli_query($database, "SELECT *  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = '$day' ORDER BY id asc ");
                                            while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                $code_discipline = addslashes($result_2['code_discipline']);
                                                $query_3 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' AND code_classe = '$code_classe' ");
                                                $result_3 = mysqli_fetch_assoc($query_3);
                                                $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                $result_4 = mysqli_fetch_assoc($query_4);
                                                echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                # code...
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $query_2 = mysqli_query($database, "SELECT *  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = '$day' ORDER BY id asc ");
                                            while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                echo $result_2['lieu'] . "<hr>";
                                                # code...
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                <?php
                                    # code...
                                }

                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Day</th>
                                    <th>Hour</th>
                                    <th>Discipline</th>
                                    <th>Teacher</th>
                                    <th>Place</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


            <div class="sidenav-overlay"></div>
            <div class="drag-target"></div>
            <!-- <div class="row" style="position: fixed; bottom:0; width:100%">
                <div class="col-1">
                    <div class="user-profile-images">
                        <img src="logo_data/<?php echo $logo ?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="user profile image" height="57" width="50">
                    </div>
                </div>
                <div class="col-11">
                    <center>
                        <span style="font-size: 20px;">
                            <h6 style="color : red"><b><i>Le pôle de l'execellence Universitaire pour la formation Profssionnelle</i></b></h6>
                        </span>
                        <span style="font-size: 20px;">
                            <h6><b><i>Campus de Bafoussam / Entrée de la ville Email: <i>tchonanguniversity@yahoo.com</i> Campus de Douala / Village, face PICASO</i></b></h6>
                        </span>
                        <span style="font : cursive 20px">
                            <h6><b><i><strong>Tel: 675-246-10-08 690-98-65-95. web</strong>www.tchonanguniversity.org <strong>Tel: 675-246-10-08 690-98-65-95.</strong></i></b></h6>
                        </span>

                    </center>
                </div>

            </div> -->

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
            <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
            <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
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
            <!-- END: Page JS-->
            <script type="text/javascript">
                window.print();
            </script>

</body>
<!-- END: Body-->

</html>