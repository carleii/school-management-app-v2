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
    <title>Notes Reports | <?php echo $nom_etablissement . " "; ?></title>
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
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-content">
                <form class="form form-horizontal" method="post" action="print_bulletin.php">
                    <div class="card-body card-dashboard">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <legend>Semestre 1 courses</legend>
                                            <section id="column-selectors">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body card-dashboard">
                                                                    <div class="table-responsive">
                                                                        <section id="collapsible">
                                                                            <div class="collapsible">
                                                                                <div class="card collapse-header">
                                                                                    <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                                                        <span class="collapse-title">
                                                                                            OPEN/CLOSE HERE
                                                                                        </span>
                                                                                    </div>
                                                                                    <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
                                                                                        <div class="card-content">
                                                                                            <div class="card-body">
                                                                                                <table class="table nowrap">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Course Name</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php

                                                                                                        $queryo = mysqli_query($database, "SELECT DISTINCT(code_matiere) AS code_matiere FROM discipline WHERE  matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                        while ($resulto = mysqli_fetch_assoc($queryo)) {
                                                                                                            $code_matiere = $resulto['code_matiere'];
                                                                                                        ?>
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <h5><?php echo str_replace($matricule_etablissement . $date_academique, "", $code_matiere) ?></h5>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $query1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                            while ($result1 = mysqli_fetch_assoc($query1)) {
                                                                                                                $code_discipline = addslashes($result1['code_discipline']);
                                                                                                                $nom_discipline = $result1['nom_discipline'];
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td style="text-transform: uppercase;">
                                                                                                                        <input type="checkbox" name="<?php echo $code_discipline ?>s1" value="<?php echo $code_discipline ?>s1">
                                                                                                                        <?php echo  $nom_discipline; ?>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                        <?php
                                                                                                                // code...
                                                                                                            }
                                                                                                        }
                                                                                                        ?>

                                                                                                    </tbody>
                                                                                                    <tfoot>
                                                                                                        <tr>
                                                                                                            <th>Course Name</th>
                                                                                                        </tr>
                                                                                                    </tfoot>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </fieldset>
                                    </div>
                                    <div class="mb-3">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <h3>Semestre 2 courses</h3>
                                            <section id="column-selectors">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-content">
                                                                <div class="card-body card-dashboard">
                                                                    <div class="table-responsive">
                                                                        <section id="collapsible">
                                                                            <div class="collapsible">
                                                                                <div class="card collapse-header">
                                                                                    <div id="headingCollapse1" class="card-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                                                        <span class="collapse-title">
                                                                                            OPEN/CLOSE HERE
                                                                                        </span>
                                                                                    </div>
                                                                                    <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse">
                                                                                        <div class="card-content">
                                                                                            <div class="card-body">
                                                                                                <table class="table nowrap">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>Course Name</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <?php

                                                                                                        $queryo = mysqli_query($database, "SELECT DISTINCT(code_matiere) AS code_matiere FROM discipline WHERE  matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                        while ($resulto = mysqli_fetch_assoc($queryo)) {
                                                                                                            $code_matiere = $resulto['code_matiere'];
                                                                                                        ?>
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <h5><?php echo str_replace($matricule_etablissement . $date_academique, "", $code_matiere) ?></h5>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <?php
                                                                                                            $query1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                            while ($result1 = mysqli_fetch_assoc($query1)) {
                                                                                                                $code_discipline = addslashes($result1['code_discipline']);
                                                                                                                $nom_discipline = $result1['nom_discipline'];
                                                                                                            ?>
                                                                                                                <tr>
                                                                                                                    <td style="text-transform: uppercase;">
                                                                                                                        <input type="checkbox" name="<?php echo $code_discipline ?>s2" value="<?php echo $code_discipline ?>s2">
                                                                                                                        <?php echo  $nom_discipline; ?>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                        <?php
                                                                                                                // code...
                                                                                                            }
                                                                                                        }
                                                                                                        ?>

                                                                                                    </tbody>
                                                                                                    <tfoot>
                                                                                                        <tr>
                                                                                                            <th>Course Name</th>
                                                                                                        </tr>
                                                                                                    </tfoot>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-5 form-group">
                                    <div class="mb-3">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <legend>Semestre 1 Notes</legend>
                                            <label for="">30%</label>
                                            <select required class="form-control" name="30_cent_s1">
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <option value="<?php echo addslashes($result['code_examen']); ?>"><?php echo $result['nom_examen']; ?></option>
                                                <?php
                                                    // code...
                                                }
                                                ?>
                                            </select>
                                            <label for="">70%</label>
                                            <select required class="form-control" name="70_cent_s1">
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
                                    <div class="mb-3">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <legend>Semestre 2 Notes</legend>
                                            <label for="">30%</label>
                                            <select class="form-control" name="30_cent_s2">
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <option value="<?php echo addslashes($result['code_examen']); ?>"><?php echo $result['nom_examen']; ?></option>
                                                <?php
                                                    // code...
                                                }
                                                ?>
                                            </select>
                                            <label for="">70%</label>
                                            <select class="form-control" name="70_cent_s2">
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <option value="<?php echo addslashes($result['code_examen']); ?>"><?php echo $result['nom_examen']; ?></option>
                                                <?php
                                                    // code...
                                                }
                                                ?>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="mb-3">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <legend>NIVEAU/LEVEL</legend>
                                            <label for=""></label>
                                            <select required class="form-control" name="id_niveau">
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM niveau WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <option value="<?php echo $result['id']; ?>"><?php echo $result['nom_niveau']; ?></option>
                                                <?php
                                                    // code...
                                                }
                                                ?>
                                            </select>

                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="print_note" class="btn btn-danger">Print</button>
                        </div>
                    </div>
                </form>
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