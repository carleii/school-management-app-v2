<?php include 'index_php.php';
?>
<!-- ADD CLASS TREATMENT -->
<?php
if (isset($_POST['add_class'])) {
    if ($role == "admin" or $role == "headmaster") {
        $class_name = addslashes($_POST['class_name']);
        $level_id = $_POST['level_id'];
        $scolarite = $_POST['scolarite'];
        $ini = $_POST['ini'];
        $pssw = base64_encode ($_POST['pssw']);
        $result = $user->add_class($class_name, $level_id, $matricule_etablissement, $date_academique, $scolarite, $ini, $pssw);
        switch ($result) {
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
                            <div id="swal2-content" style="display: block;"><?php echo $class_name . ' have not been added, verify the the encoding'; ?></div>
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
            case 1:
                //CREATION DU CLOUD DE LA SPECIALITE
                $query = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$level_id' ");
                $result = mysqli_fetch_assoc($query);
                $cloud_name = $class_name . " " . $result['nom_niveau'];
                $system = new system;
                $system->save_cloud($cloud_name, $pssw, 0, $email, $matricule_etablissement);
                break;
            default:
                # code...
                break;
        }
        # code...
    } else {
        include 'access_denieted.php';
    }
    # code...
}
?>
<!-- DELETE CLASS TREATMENT -->
<?php
if (isset($_POST['delete_class'])) {
    if ($role == "admin" or $role == "headmaster") {
        $class_code = $_POST['delete_class'];
        $result = $user->delete_class($class_code, $matricule_etablissement, $date_academique);
        switch ($result) {
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
                            <div id="swal2-content" style="display: block;"><?php echo 'The Class have not been deleted.. try after few minutes'; ?></div>
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
    <title>Speciality | <?php echo $nom_etablissement; ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-email.css">
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
    $level_csv = $_POST['level_csv'];
    $i = 0;
    if ($ext[1] == "csv") {
            while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
                if ($i == 0) {
                    $i++;
                    continue;
                }
            // get random password
			$bytes = openssl_random_pseudo_bytes(random_int(4, 100));
			$pass = bin2hex($bytes);
			if (strlen($pass) > 4) {
				$pass = str_replace("=", "", substr($pass, 0, 5));
				# code...
			}
			$pass = base64_encode($pass);
            $result = $user->add_class($cont[1], $level_csv, $matricule_etablissement, $date_academique, $cont[2], $cont[3], $pass);
            if ($result == 1) {
                //CREATION DU CLOUD DE LA SPECIALITE
                $query = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$level_csv' ");
                $result = mysqli_fetch_assoc($query);
                $cloud_name = $cont[1] . " " . $result['nom_niveau'];
                $system = new system;
                $system->save_cloud($cloud_name, $pass, 0, $email, $matricule_etablissement);
                # code...
            }
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

<body class="vertical-layout vertical-menu-modern dark-layout content-left-sidebar email-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="dark-layout">

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
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar d-flex">
                        <!-- sidebar close icon -->
                        <span class="sidebar-close-icon">
                            <i class="bx bx-x"></i>
                        </span>
                        <!-- sidebar close icon -->
                        <div class="email-app-menu">
                            <div class="form-group form-group-compose">
                                <!-- compose button  -->
                                <?php
                                if ($role == "admin" or $role == "headmaster") {
                                ?>
                                    <button type="button" class="btn btn-primary btn-block my-2 compose-btn">
                                        <i class="bx bx-plus"></i>
                                        Add New Speciality
                                    </button>

                                    <!-- compose button  -->
                                    <button type="button" class="btn btn-warning btn-block my-2">
                                        <a href="template/classe.csv" download=""> Download the template
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
                                        <div class="form-label-group">
                                            <select class="form-control" required="" name="level_csv" id="level_csv">
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM niveau WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <option value="<?php echo $result['id'] ?>"><?php echo $result['nom_niveau']; ?></option>
                                                <?php
                                                    # code...
                                                }
                                                ?>
                                            </select>
                                            <label class="custom-input-label" for="level_csv">Level</label>
                                        </div>
                                        <button type="submit" name="csv_upload" class="btn btn-success btn-block my-2">
                                            Upload file's data
                                        </button>

                                    </form>


                                <?php
                                    # code...
                                }
                                ?>
                            </div>
                            <div class="sidebar-menu-list">

                                <!-- sidebar label start -->
                                <label class="sidebar-label">Labels</label>
                                <div class="list-group list-group-labels ">
                                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                        Ready to be used
                                        <span class="bullet bullet-success bullet-sm"></span>
                                    </a>
                                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                        Work
                                        <span class="bullet bullet-primary bullet-sm"></span>
                                    </a>
                                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                        Not ready
                                        <span class="bullet bullet-warning bullet-sm"></span>
                                    </a>
                                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                        Must be deleted
                                        <span class="bullet bullet-danger bullet-sm"></span>
                                    </a>
                                    <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                        Safe
                                        <span class="bullet bullet-info bullet-sm"></span>
                                    </a>
                                </div>
                                <!-- sidebar label end -->
                            </div>
                        </div>
                    </div>
                    <!-- User new mail right area -->
                    <div class="compose-new-mail-sidebar">
                        <div class="card shadow-none quill-wrapper p-0">
                            <div class="card-header">
                                <h3 class="card-title" id="emailCompose">New Speciality</h3>
                                <button type="button" class="close close-icon">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form action="#" id="compose-form" method="post" enctype="multipart/form-data">
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <div class="form-group pb-50">
                                            <label for="emailfrom">from</label>
                                            <input type="text" id="emailfrom" class="form-control" placeholder="<?php echo $name . ' ' . $nom_etablissement; ?>" disabled>
                                        </div>
                                        <div class="form-label-group">
                                            <input type="text" name="class_name" required class="form-control" placeholder="Name of the speciality">
                                        </div>
                                        <div class="form-label-group">
                                            <select class="form-control" required="" name="level_id">
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM niveau WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <option value="<?php echo $result['id'] ?>"><?php echo $result['nom_niveau']; ?></option>
                                                <?php
                                                    # code...
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-label-group">
                                            <input type="number" name="scolarite" required class="form-control" placeholder="Tuiton fees">
                                        </div>
                                        <div class="form-label-group">
                                            <input type="text" name="ini" required class="form-control" placeholder="initial">
                                        </div>
                                        <div class="form-label-group">
                                            <input type="password" name="pssw" required class="form-control" placeholder="Specility Cloud password for e-learning">
                                        </div>


                                        <div class="form-group mt-2">
                                            <!--   <div class="custom-file">
                                                <input type="file" name="level_file" class="custom-file-input" id="emailAttach" accept="csv">
                                                <label class="custom-file-label" for="emailAttach">Add with csv file</label>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end pt-0">
                                    <!--  <button type="submit" name="add_file" class="btn btn-light-secondary cancel-btn mr-1">
                                        <i class='bx bx-x mr-25'></i>
                                        <span class="d-sm-inline d-none">Send the file</span>
                                    </button> -->
                                    <button type="submit" name="add_class" class="btn-send btn btn-primary">
                                        <i class='bx bx-send mr-25'></i> <span class="d-sm-inline d-none">Add the Speciality</span>
                                    </button>
                                </div>
                                <div class="form-label-group">
                                    <i>Example:</i><br>
                                    <ul>
                                        <li>
                                            Electrotechnique
                                        </li>
                                        <li>
                                            Science Economique
                                        </li>
                                        <li>
                                            Mecanique auto
                                        </li>
                                    </ul>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>
                    <!--/ User Chat profile right area -->
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- email app overlay -->
                        <div class="app-content-overlay"></div>
                        <div class="email-app-area">
                            <!-- Email list Area -->
                            <div class="email-app-list-wrapper">
                                <div class="email-app-list">
                                    <form action="" method="post">
                                        <div class="email-action">
                                            <!-- action left start here -->
                                            <div class="action-left d-flex align-items-center">
                                                <!-- select All checkbox -->
                                                <div class="checkbox checkbox-shadow checkbox-sm selectAll mr-50">
                                                    <input type="checkbox" name="all_check" id="checkboxsmall">
                                                    <label for="checkboxsmall"></label>
                                                </div>
                                                <!-- delete unread dropdown -->
                                                <ul class="list-inline m-0 d-flex">
                                                </ul>
                                            </div>
                                            <!-- action left end here -->

                                            <!-- action right start here -->
                                            <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                                                <!-- search bar  -->
                                                <div class="email-fixed-search flex-grow-1">
                                                    <div class="sidebar-toggle d-block d-lg-none">
                                                        <i class="bx bx-menu"></i>
                                                    </div>
                                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                                        <input type="text" class="form-control" id="email-search" placeholder="Search ">
                                                        <div class="form-control-position">
                                                            <i class="bx bx-search"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <!-- pagination and page count -->
                                                <span class="d-none d-sm-block">1-10 of 653</span>
                                                <button class="btn btn-icon email-pagination-prev d-none d-sm-block">
                                                    <i class="bx bx-chevron-left"></i>
                                                </button>
                                                <button class="btn btn-icon email-pagination-next d-none d-sm-block">
                                                    <i class="bx bx-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- / action right -->

                                        <!-- email user list start -->
                                        <div class="email-user-list list-group">
                                            <ul class="users-list-wrapper media-list">
                                                <!-- SORTING THE LEVELS -->
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM classe WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                    <li class="media mail-read">
                                                        <div class="user-action">
                                                            <div class="checkbox-con mr-25">
                                                                <div class="checkbox checkbox-shadow checkbox-sm">
                                                                    <input type="checkbox" name="<?php echo 'checkboxsmall' . $result['id']; ?>" id="checkboxsmall<?php echo $result['id']; ?>">
                                                                    <label for="checkboxsmall<?php echo $result['id']; ?>"></label>
                                                                </div>
                                                            </div>
                                                            <a href="classe_profile.php?ktsp=<?php echo base64_encode($result['id'])  ?>">
                                                                <button type="button" class="btn btn-icon action-icon">
                                                                    <span class="fonticon-wrap">
                                                                        <i class="bx bxs-left-top-arrow-circle"></i>
                                                                        </i>
                                                                    </span>
                                                                </button>
                                                            </a>
                                                            <span class="favorite warning">
                                                                <i class="bx bxs-star"></i>
                                                            </span>
                                                        </div>
                                                        <div class="pr-50">
                                                            <div class="avatar">
                                                                <img src="logo_data/<?php echo $logo; ?>" alt="avtar img holder">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="mail-items">
                                                                    <span class="list-group-item-text text-truncate"><?php echo $result['nom_classe']; ?></span>
                                                                </div>
                                                                <?php
                                                                $id_niveau = $result['id_niveau'];
                                                                $query_1 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $result_1 = mysqli_fetch_assoc($query_1);
                                                                ?>
                                                                <div class="mail-meta-item">
                                                                    <span class="float-right">
                                                                        <?php
                                                                        if ($role == "admin" or $role == "headmaster") {
                                                                        ?>
                                                                            <button type="submit" name="delete_class" value="<?php echo $result['code_classe']; ?>" class="btn btn-icon action-icon">
                                                                                <span class="fonticon-wrap">
                                                                                    <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                    </i>
                                                                                </span>
                                                                            </button>

                                                                        <?php
                                                                            # code...
                                                                        }
                                                                        ?>
                                                                        <span class="mail-date">Niveau :<?php echo $result_1['nom_niveau']; ?></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mail-message">
                                                                <p class="list-group-item-text truncate mb-0"><?php echo $nom_etablissement . ' ' . $date_academique; ?>
                                                                </p>
                                                                <div class="mail-meta-item">
                                                                    <span class="float-right">
                                                                        <span class="bullet bullet-success bullet-sm"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>



                                                <?php
                                                    # code...
                                                }
                                                ?>
                                            </ul>
                                            <!-- email user list end -->

                                            <!-- no result when nothing to show on list -->
                                            <div class="no-results">
                                                <i class="bx bx-error-circle font-large-2"></i>
                                                <h5>No Items Found</h5>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--/ Email list Area -->
                        </div>
                    </div>
                </div>
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
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-email.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/sweet-alerts.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>