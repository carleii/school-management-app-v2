<?php require 'index_php.php'; ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <title>All Student Paiement | <?php echo $nom_etablissement . " " . $date_academique; ?></title>
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

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

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
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">DataTable</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">COMPTABILITY
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- Column selectors with Export Options and print table -->
                <section id="column-selectors">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Column selectors with Export and Print Options</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <!--  <p class="card-text">All of the data export buttons have a exportOptions option which can be
                                            used to specify information about what data should be exported and how. The options given
                                            for this parameter are passed directly to the buttons.exportData() method to obtain the
                                            required data.
                                        </p>
                                        <p>
                                            The print button will open a new window in the end user's browser and, by default,
                                            automatically trigger the print function allowing the end user to print the table. The
                                            window will be closed once the print is complete, or has been cancelled.
                                        </p> -->
                                        <div class="table-responsive">
                                            <table class="table table-striped dataex-html5-selectors">
                                                <thead>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>SPECIALITY</th>
                                                        <th>Paiement Tranche</th>
                                                        <th>Amount</th>
                                                        <th>Delais</th>
                                                        <th>Amount PAID</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id asc ");
                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                        $matricule_apprenant = $result['matricule_apprenant'];
                                                        $code_classe = addslashes($result['code_classe']);
                                                        $query_1 = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                        $id_level = $result_1['id_niveau'];
                                                        $result_2 = mysqli_fetch_assoc(mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_level' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' "));
                                                        $query0 = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                        while ($result0 = mysqli_fetch_assoc($query0)) {
                                                            $id_tranche = $result0['id'];
                                                            $amount = $result0['montant'];
                                                            $echeance_tranche = $result0['echeance'];
                                                            $nom_tranche = $result0['nom_tranche'];
                                                            $count = 0;
                                                            $queryp = mysqli_query($database, "SELECT * FROM compta WHERE id_tranche = '$id_tranche' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                            while ($resultp =  mysqli_fetch_assoc($queryp)) {
                                                                $count += $resultp['montant'];
                                                                // code...
                                                            }

                                                    ?>
                                                            <tr>
                                                                <td> <a href="student_profile.php?ktsp=<?php echo base64_encode($result['matricule_apprenant']);  ?>">
                                                                        <button type="button" class="btn btn-icon action-icon">
                                                                            <span class="fonticon-wrap">
                                                                                <i class="bx bxs-left-top-arrow-circle"></i>
                                                                                </i>
                                                                            </span>
                                                                        </button>
                                                                    </a> <?php echo  $result['nom_apprenant']; ?> <br> <?php echo $result['prenom_apprenant']; ?>
                                                                </td>
                                                                <td><?php echo $result_1['nom_classe']; ?> <br> <?php echo $result_2['nom_niveau']; ?></td>
                                                                <td><?php echo $nom_tranche; ?></td>
                                                                <td><?php echo $amount . ""; ?></td>
                                                                <td><?php echo $echeance_tranche; ?></td>
                                                                <td><?php echo $count . ""; ?></td>
                                                            </tr>
                                                    <?php
                                                            // code...
                                                        }

                                                        # code...
                                                    }
                                                    ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Full Name</th>
                                                        <th>SPECIALITY</th>
                                                        <th>Paiement Tranche</th>
                                                        <th>Amount</th>
                                                        <th>Delais</th>
                                                        <th>Amount PAID</th>
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
        </div>
    </div>
    <!-- END: Content-->

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

</body>
<!-- END: Body-->

</html>