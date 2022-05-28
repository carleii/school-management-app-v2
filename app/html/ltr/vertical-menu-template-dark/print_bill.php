<?php require 'index_php.php';
if (isset($_GET['ktsp'])) {
    $matricule_apprenant = $_GET['ktsp'];
    $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'");
    $result = mysqli_fetch_assoc($query);
    $code_class = $result['code_classe'];
    $n_a = $result['nom_apprenant'];
    $p_a = $result['prenom_apprenant'];
    $query = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_class' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'");
    $result = mysqli_fetch_assoc($query);
    $nom_classe = $result['nom_classe'];
    # code...
} elseif (isset($_GET['ktspp'])) {
    $ic = $_GET['ktspp'];
    $qq = mysqli_query($database, "SELECT * FROM compta WHERE id = '$ic' ");
    $rqq = mysqli_fetch_assoc($qq);
    $matricule_apprenant = $rqq['matricule_apprenant'];
    $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'");
    $result = mysqli_fetch_assoc($query);
    $code_class = $result['code_classe'];
    $n_a = $result['nom_apprenant'];
    $p_a = $result['prenom_apprenant'];
    $query = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_class' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'");
    $result = mysqli_fetch_assoc($query);
    $nom_classe = $result['nom_classe'];

    # code...
} else {
    header("Location: ./");
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
    <title>Tution Fees Bill | <?php echo $n_a . " " . $p_a ?> </title>
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
                        <img src="logo_data/<?php echo "$logo "?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="user profile image" height="107" width="90">
                    </div>
                </div>
                <div class="col-11">
                    <center>
                        <span style="font-size : 20px">
                            <h2><b><?php echo "$nom_etablissement" ?></b></h2>
                        </span>
                        <span style="font-size : 20px">
                            <!-- <h2> <b> TCHONANG UNIVERSITY </b></h2> -->
                            <h3>Recu de paiement de scolarité/ Tuition Fees Bill</h3>
                            <h5><?php echo $n_a . " " . $p_a; ?> : <?php echo $nom_classe . " :" . $matricule_apprenant . " <br>" . $date_academique; ?></h5>
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
                                    <th>Tranche</th>
                                    <th>Amount of the tranche</th>
                                    <th>Amount Paid</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($database, "SELECT * FROM compta WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY id desc LIMIT 1 ");
                                $result = mysqli_fetch_assoc($query);
                                $id_t = $result['id_tranche'];
                                $montant = $result['montant'];
                                $dp = $result['date_paiement'];
                                $q = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE id = '$id_t' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY id desc LIMIT 1 ");
                                $r = mysqli_fetch_assoc($q);
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $r['nom_tranche']  ?>
                                    </td>
                                    <td>
                                        <?php echo $r['montant']  ?>
                                    </td>
                                    <td>
                                        <?php echo $montant  ?>
                                    </td>
                                    <td>
                                        <?php echo $result['date_paiement']  ?>
                                    </td>


                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tranche</th>
                                    <th>Amount of the tranche</th>
                                    <th>Amount Paid</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <center>
                <h4>HISTORY</h4>
            </center>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="" method="post">
                            <!-- timeline widget start -->
                            <ul class="widget-timeline">
                                <?php
                                $id_tranche = null;
                                $m = 0;
                                $mm = 0;
                                $query = mysqli_query($database, "SELECT * FROM compta WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY id_tranche desc ");
                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($id_tranche == $result['id_tranche']) {
                                        continue;
                                        # code...
                                    }
                                    $id_tranche = $result['id_tranche'];
                                    $query_0 = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE id = '$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                    if (mysqli_num_rows($query_0) == 0) {
                                        continue;
                                        # code...
                                    }
                                    $result_0 = mysqli_fetch_assoc($query_0);

                                ?>
                                    <li class="timeline-items timeline-icon-success active">
                                        <div class="timeline-time"><span style="text-transform: uppercase;"><?php echo $result_0['nom_tranche']; ?></span></div>
                                        <h6 class="timeline-title"><?php echo $result_0['montant'] . " USD"; ?></h6>
                                        <?php
                                        $query_2 = mysqli_query($database, "SELECT * FROM compta WHERE matricule_apprenant ='$matricule_apprenant' AND id_tranche = '$id_tranche' AND date_academique ='$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                        while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                            $m += $result_2['montant'];
                                            $mm += $m;
                                        ?>
                                            <p class="timeline-text">
                                                Amount Paid <a href="JavaScript:void(0);"><?php echo $result_2['montant']; ?></a>
                                            </p>
                                            <p class="timeline-text">
                                                Paid on <a href="JavaScript:void(0);"><?php echo "Date: " . $result_2['date_paiement']; ?></a>
                                                By <a href="JavaScript:void(0);"><?php echo $result_2['nom_validateur']; ?></a>
                                            </p>
                                            <div class="timeline-content">
                                            </div>

                                        <?php
                                            # code...
                                        }
                                        ?>

                                    </li>
                                    <li class="timeline-items timeline-icon-danger">Total paid for <?php echo $result_0['nom_tranche'] . " :" . $m ?></li>

                                <?php
                                    $m = 0;
                                    echo "<br><br><br>";
                                    # code...
                                }
                                ?>

                            </ul>
                            <!-- timeline widget ends -->
                        </form>
                    </div>
                </div>
            </div>

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
            <script type="text/javascript">
                window.print();
            </script>

</body>
<!-- END: Body-->

</html>
