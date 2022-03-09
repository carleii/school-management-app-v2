<?php require 'index_php.php'; ?>
<!-- DELETE USER TREATMENT -->
<?php
if (isset($_POST['delete_user'])) {
    if ($role == "admin") {
        $del_matri = $_POST['delete_user'];
        $query = mysqli_query($database, "DELETE FROM utilisateur WHERE matricule_utlisateur = '$del_matri' and matricule_etablissement = '$matricule_etablissement' ");
        if ($query) { ?>
            <!-- <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                            <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                                <div class="swal2-content">
                                    <div id="swal2-content" style="display: block;">User have been deleted</div>
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
        }
        # code...
        # code...
    } else {
        include 'access_denieted.php';
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
    <title>Users | <?php include 'site_title.php'; ?></title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
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
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="users-list-filter px-1">
                        <form>
                            <div class="row border rounded py-2 mb-2">
                                <!--  <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-verified">Verified</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-verified">
                                            <option value="">Any</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </fieldset>
                                </div> -->
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-role">Role</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-role">
                                            <option value="admin">admin</option>
                                            <option value="teacher">teacher</option>
                                            <option value="headmaster">headmaster</option>
                                            <option value="secretary">secretary</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <!-- <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-status">Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-list-status">
                                            <option value="">Any</option>
                                            <option value="Active">Active</option>
                                            <option value="Close">Close</option>
                                            <option value="Banned">Banned</option>
                                        </select>
                                    </fieldset>
                                </div> -->
                                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                    <button type="reset" class="btn btn-primary btn-block glow users-list-clear mb-0">Clear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <form method="post" action="">
                                            <table id="users-list-datatable" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>First name</th>
                                                        <th>Last name</th>
                                                        <th>User Name</th>
                                                        <th>verified</th>
                                                        <th>role</th>
                                                        <th>status</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- LET'S GET ALL HE USER OF THE SCHOOL -->
                                                    <?php
                                                    $query = mysqli_query($database, "SELECT * FROM utilisateur WHERE matricule_etablissement = '$matricule_etablissement' ");
                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                        if ($matricule_user != $result['matricule_utlisateur']) { ?>
                                                            <tr>
                                                                <td><?php echo $result['id']; ?></td>
                                                                <td><a href="#"><?php echo $result['nom_utilisateur']; ?></a>
                                                                </td>
                                                                <td><?php echo $result['prenom_utilisateur']; ?></td>
                                                                <td><?php echo $result['email_utilisateur'] ?></td>
                                                                <td>Yes</td>
                                                                <td><?php echo $result['role']; ?></td>
                                                                <td><span class="badge badge-light-success">Active</span></td>
                                                                <td> <button type="submit" value="<?php echo $result['matricule_utlisateur'] ?>" name="delete_user" role="submit" class="btn btn-icon action-icon">
                                                                        <span class="fonticon-wrap">
                                                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                            </i>
                                                                        </span>
                                                                    </button></td>
                                                            </tr>
                                                    <?php
                                                            # code...
                                                        }
                                                        # code...
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </form>

                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->


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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>