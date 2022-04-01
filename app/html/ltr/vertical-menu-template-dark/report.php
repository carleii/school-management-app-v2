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
    <title>Exams Results NIVEAU: <?php if (isset($_POST['report'])) {
                                        $retVal = $_POST['niveau'];
                                        $query = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$retVal' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                        $result = mysqli_fetch_assoc($query);
                                        echo $result['nom_niveau'];
                                        // code...
                                    } else {
                                        echo "All";
                                    }

                                    ?> | <?php echo $nom_etablissement . " "; ?></title>
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
                                    <li class="breadcrumb-item active">Exam result
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">please select the Level and the exam</h4><br>
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
                                                    <label for="">Level</label>
                                                    <select required class="form-control" name="niveau">
                                                        <option value="">------</option>
                                                        <?php
                                                        $query = mysqli_query($database, "SELECT * FROM niveau WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique ='$date_academique' ");
                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                            $id_niveau = addslashes($result['id']);
                                                            $nom_niveau = $result['nom_niveau'];
                                                        ?>
                                                            <option value="<?php echo $id_niveau; ?>"><?php echo $nom_niveau ?></option>
                                                        <?php
                                                            // code...
                                                        }
                                                        ?>
                                                    </select>
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
                </div>

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
                                        <div class="table-responsive">
                                            <table class="table table-striped dataex-html5-selectors">
                                                <thead>
                                                    <tr>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Specialty</th>
                                                        <th>Level</th>
                                                        <th>Exam</th>
                                                        <th>Average</th>
                                                        <th>result</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($_POST['report'])) {
                                                        $id_niveau = $_POST['niveau'];
                                                        $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id asc ");
                                                        // code...
                                                    } else {
                                                        $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id asc ");
                                                        // code...
                                                    }
                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                        $matricule_apprenant = addslashes($result['matricule_apprenant']);
                                                        $nom_apprenant = $result['nom_apprenant'];
                                                        $prenom_apprenant = $result['prenom_apprenant'];
                                                        $code_classe = addslashes($result['code_classe']);
                                                        if (isset($_POST['report'])) {
                                                            $query_1 = mysqli_query($database, "SELECT * FROM classe WHERE id_niveau = '$id_niveau' AND code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                            if (mysqli_num_rows($query_1) == 0) {
                                                                continue;
                                                                # code...
                                                            }
                                                            # code...
                                                        } else {
                                                            $query_1 = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        }
                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                        $nom_classe = $result_1['nom_classe'];
                                                        $id_niveau = $result_1['id_niveau'];
                                                        $query_2 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        $result_2 = mysqli_fetch_assoc($query_2);
                                                        $nom_niveau = $result_2['nom_niveau'];
                                                        if (isset($_POST['report'])) {
                                                            $code_examen = $_POST['exam'];
                                                            $query_3 = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$code_examen' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                            // code...
                                                        } else {
                                                            $query_3 = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        }
                                                        while ($result_3 = mysqli_fetch_assoc($query_3)) {
                                                            $note_valid = $result_3['note_valid'];
                                                            $code_examen = addslashes($result_3['code_examen']);
                                                            $nom_examen = $result_3['nom_examen'];
                                                            $count_note = 0;
                                                            $nbrnote = 0;

                                                            $query_4 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$code_examen' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                            while ($result_4 = mysqli_fetch_assoc($query_4)) {
                                                                $code_discipline = addslashes($result_4['code_discipline']);
                                                                $nbrnote = $nbrnote + 1;
                                                                $count_note  = $count_note + $result_4['note'];
                                                                # code...
                                                            }
                                                    ?>
                                                            <tr>
                                                                <td> <a href="student_profile.php?ktsp=<?php echo base64_encode($result['matricule_apprenant']);  ?>">
                                                                        <button type="button" class="btn btn-icon action-icon">
                                                                            <span class="fonticon-wrap">
                                                                                <i class="bx bxs-left-top-arrow-circle"></i>
                                                                                </i>
                                                                                <?php echo  $nom_apprenant; ?>
                                                                            </span>
                                                                        </button>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo $prenom_apprenant; ?></td>
                                                                <td><?php echo $nom_classe; ?></td>
                                                                <td><?php echo $nom_niveau; ?></td>
                                                                <td><?php echo $nom_examen; ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($nbrnote > 0) {
                                                                        echo $count_note / $nbrnote;
                                                                        # code...
                                                                    } else {
                                                                        echo 'empty';
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($nbrnote > 0 and ($count_note / $nbrnote >= $note_valid)) {
                                                                        echo 'Validated';
                                                                        # code...
                                                                    } elseif ($nbrnote > 0 and ($count_note / $nbrnote < $note_valid)) {
                                                                        echo 'Rejected';
                                                                        # code...
                                                                    } else {
                                                                        echo 'empty';
                                                                    }
                                                                    ?>
                                                                </td>
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
                                                        <<th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Specialty</th>
                                                            <th>Level</th>
                                                            <th>Exam</th>
                                                            <th>Average</th>
                                                            <th>result</th>
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