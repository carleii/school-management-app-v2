<?php require 'index_php.php';
?>

<?php
$nom_classe = null;
$code_classe = null;
$nom_niveau = null;
$scolarite = null;
$ini = null
?>
<?php
if (isset($_GET['ktsp'])) {
    $classe_id = base64_decode($_GET['ktsp']);
    $query = mysqli_query($database, "SELECT * FROM classe WHERE id = '$classe_id' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
    if (mysqli_num_rows($query) != 1) {
        header("Location: classe.php");
        # code...
    } else {
        $result = mysqli_fetch_assoc($query);
        $nom_classe = $result['nom_classe'];
        $code_classe = addslashes($result['code_classe']);
        $id_niveau = $result['id_niveau'];
        $scolarite = $result['scolarite'];
        $ini = $result['ini'];
        $code_cloud = base64_decode($result['pssw']);
        $query = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
        if (mysqli_num_rows($query) == 1) {
            $result = mysqli_fetch_assoc($query);
            $nom_niveau = $result['nom_niveau'];
            # code...
        } else {
            $nom_niveau = "The level have been deleted";
        }
        $query = mysqli_query($database, "SELECT COUNT(id) AS max_a FROM apprenant WHERE code_classe = '$code_classe' AND  matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
        $result = mysqli_fetch_assoc($query);
        $max_apprenant = $result['max_a'];
    }
    # code...
} else {
    header("Location: classe.php");
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
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title><?php echo $nom_classe . " " . $nom_niveau; ?> | <?php echo $nom_etablissement . " " . $date_academique; ?> </title>
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/animate/animate.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->
<?php
if (isset($_POST['add_dis_class'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $code_dis = $_POST['dis_name'];
        $code_teacher = $_POST['dis_teacher'];
        $hour = $_POST['dis_hour'];
        $result = $user->add_dis_class($code_dis, $code_classe, $code_teacher, $hour, $matricule_etablissement, $date_academique);
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
                            <div id="swal2-content" style="display: block;"><?php echo 'This course has already been added or there is an error in the course text'; ?></div>
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

// DELETE A DISCIPLINE FROM THE CLASS TREATMENT
if (isset($_POST['delete_dis_class'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $code_discipline = $_POST['delete_dis_class'];
        $result = $user->delete_dis_class($code_discipline, $code_classe, $matricule_etablissement, $date_academique);
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
                            <div id="swal2-content" style="display: block;"><?php echo 'The Course have not been deleted, try in a few minutes'; ?></div>
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

// UPDATE A DISCIPLINE IN THE CLASS TREATMENT
if (isset($_POST['update_dis_class'])) {
    if ($role == 'admin' or $role = "headmaster") {
        $dis_classe = $_POST['dis_classe'];
        $dis_teacher =  $_POST['dis_teacher'];
        $dis_credit = $_POST['dis_credit'];
        $result = $user->update_dis_class($dis_classe, $dis_teacher, $dis_credit, $matricule_etablissement, $date_academique);
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
                            <div id="swal2-content" style="display: block;"><?php echo 'Something when wrong, try in a few minutes'; ?></div>
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
}

//ADD A STUDENT TO THE CLASS TREATMENT
if (isset($_POST['add_student'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $nom_apprenant = $_POST['nom_apprenant'];
        $prenom_apprenant = $_POST['prenom_apprenant'];
        $telephone_apprenant = $_POST['telephone_apprenant'];
        $adresse_apprenant = $_POST['adresse_apprenant'];
        $other_info_apprenant = $_POST['other_info_apprenant'];
        $tutor_apprenant = $_POST['tutor_apprenant'];
        $result = $user->add_student($nom_apprenant, $prenom_apprenant, $telephone_apprenant, $adresse_apprenant, $other_info_apprenant, $tutor_apprenant, $matricule_etablissement, $code_classe, $date_academique, $ini);
        # code...
    } else {
        include 'access_denieted.php';
    }
}

//DELET A Student
if (isset($_POST['delete_student'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $matricule_apprenant = $_POST['delete_student'];
        $result = mysqli_query($database, "DELETE FROM apprenant WHERE matricule_apprenant = '$matricule_apprenant' AND date_academique = '$date_academique'");
        # code...
    } else {
        include 'access_denieted.php';
    }
    # code...
}

//ADD A NEW PROGRAMM TREATMENT
if (isset($_POST['add_time_tab'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $week = $_POST['week'];
        $begin = $_POST['begin'];
        $end = $_POST['end'];
        $jour = $_POST['jour'];
        $code_discipline = $_POST['discipline'];
        $place = $_POST['place'];
        $horaire = $begin . "-" . $end;
        $result = $user->add_time_tab($jour, $code_classe, $code_discipline, $horaire, $matricule_etablissement, $date_academique, $week, $place);
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
                            <div id="swal2-content" style="display: block;"><?php echo 'Already Programmed in an occupied room'; ?></div>
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
        # code..
        # code...
    } else {
        include 'access_denieted.php';
    }
}

// DELET A PROGRAMM TREATMENT
if (isset($_POST['week_del'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $week = $_POST['week_view'];
        $result = $user->week_del($week, $code_classe, $matricule_etablissement, $date_academique);
        # code...
    } else {
        include 'access_denieted.php';
    }
    # code...
}

//ADD TRANCHE DE PAIEMENT
if (isset($_POST['add_tranche'])) {
    if ($role == 'admin' or $role == 'comptable') {
        $nom_tranche = $_POST['nom_tranche'];
        $montant_tranche = $_POST['montant_tranche'];
        $echeance_tranche = $_POST['echeance_tranche'];
        $result = $user->add_tranche($nom_tranche, $montant_tranche, $echeance_tranche, $code_classe, $matricule_etablissement, $date_academique);
        // code...
        if ($result == 2) {
            ?>
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
                        <div id="swal2-content" style="display: block;">It's too much</div>
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
        }
    } else {
        include 'access_denieted.php';
    }
    // code...
}

//DELETE TRANCHE DE PAIEMENT

if (isset($_POST['delete_tranche'])) {
    if ($role == 'admin' or $role == "comptable") {
        $id_tranche = $_POST['delete_tranche'];
        $result = $user->delete_tranche($id_tranche, $code_classe, $date_academique, $matricule_etablissement);
    } else {
        include 'access_denieted.php';
    }
}


// UPLOAD STUDENT DATA FILE
// CSV UPLOAD
if (isset($_POST['csv_upload'])) {
    ?>
    <script type="text/javascript" language="javascript">
        alert("Wait while data are loading....");
    </script>
    <?php
    $file = $_FILES['csv_file']['tmp_name'];
    $ext = explode(".", $_FILES['csv_file']['name']);
    $handle = fopen($file, "r");
    $i = 0;
    if ($ext[1] == "csv") {
        while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
            if ($i == 0) {
                $i++;
                continue;
            }
            $result = $user->add_student($cont[1], $cont[2], $cont[3], $cont[4] . " " . $cont[5], $cont[7], $cont[6], $matricule_etablissement, $code_classe, $date_academique, $ini);
            $i++;
            # code...
        }

        # code...
    } else {
    ?>
        <script type="text/javascript" language="javascript">
            alert("Fatal error: incorrect file format \n Download the template and use it.");
        </script>

<?php
        # code...
    }
    # code...
}


?>


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
                                        <img src="../../../app-assets/images/profile/post-media/profile-banner-co.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                        <img src="logo_data/<?php echo $logo ?>" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color"><?php echo $nom_classe . " " . $nom_niveau; ?></h4>
                                        <h6 class="mb-0 text-bold-500 profile-text-color"> E-learning password : <?php echo $code_cloud ?></h6>
                                    </div>
                                    <!-- user profile nav tabs start -->
                                    <div class="card-body px-0">
                                        <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                            <?php
                                            if ($role == "admin" or $role == "headmaster") {
                                            ?>
                                                <li class="nav-item pb-0">
                                                    <a class=" nav-link d-flex px-1 " id="feed-tab" data-toggle="tab" href="#feed" aria-controls="feed" role="tab" aria-selected="true"><i class="bx bx-home"></i><span class="d-none d-md-block">Notes Reports</span></a>
                                                </li>

                                            <?php
                                                # code...
                                            }
                                            ?>

                                            <?php
                                            if ($role == "admin" or $role == "headmaster") {
                                            ?>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Courses</span></a>
                                                </li>

                                            <?php
                                                # code...
                                            }
                                            ?>
                                            <?php
                                            if ($role == 'admin' or $role == 'comptable') { ?>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="compta-tab" data-toggle="tab" href="#compta" aria-controls="compta" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Manage Class Tuition feeds</span></a>
                                                </li>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="compta-tab" data-toggle="tab" href="#tuition" aria-controls="tuition" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Class Stats</span></a>
                                                </li>

                                            <?php
                                                // code...
                                            }
                                            ?>
                                            <?php
                                            if ($role == "admin" or $role == "headmaster") {
                                            ?>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="friends-tab" data-toggle="tab" href="#friends" aria-controls="friends" role="tab" aria-selected="false"><i class="bx  bx-user"></i><span class="d-none d-md-block">
                                                            <?php $query = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                            echo "ADD A STUDENT: (" . mysqli_num_rows($query) . ")"; ?></span></a>
                                                </li>

                                            <?php
                                                # code...
                                            }
                                            ?>
                                            <?php
                                            if ($role == "admin" or $role == "headmaster") {
                                            ?>
                                                <li class="nav-item pb-0 mr-0">
                                                    <a class="nav-link d-flex px-1" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false"><i class="bx bx-copy-alt"></i><span class="d-none d-md-block">Time Table</span></a>
                                                </li>

                                            <?php
                                                # code...
                                            }
                                            ?>

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
                                        <div class="tab-pane" aria-labelledby="tuition" role="tabpanel" id="tuition">
                                            <section id="column-selectors">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form action="" method="post">
                                                                <!-- timeline widget start -->
                                                                <ul class="widget-timeline">
                                                                    <?php
                                                                    $id_tranche = null;
                                                                    $query = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                        $id_tranche = $result['id'];

                                                                        $query_0 = mysqli_query($database, "SELECT SUM(montant) AS montant_t FROM compta WHERE code_classe = '$code_classe' AND id_tranche = '$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                        $result_0 = mysqli_fetch_assoc($query_0);


                                                                    ?>
                                                                        <li class="timeline-items timeline-icon-success active">
                                                                            <div class="timeline-time"><span style="text-transform: uppercase;"><?php echo $result['nom_tranche']; ?></span></div>
                                                                            <h6 class="timeline-title"><?php echo $result['montant'] . " "; ?></h6>

                                                                            <p class="timeline-text" style="font-size: 20px;">
                                                                                Total Amount that would be paid <a href="JavaScript:void(0);"><?php echo $result['montant'] * $max_apprenant; ?></a>
                                                                            </p>

                                                                            <?php
                                                                            # code...
                                                                            ?>

                                                                        </li>
                                                                        <li class="timeline-items timeline-icon-danger"> <b> Total paid for <?php echo ($result['nom_tranche'] . " : " . $result_0['montant_t'] + 0) ?> </b></li>

                                                                    <?php
                                                                        echo "<br><br>";
                                                                        # code...
                                                                    }
                                                                    ?>

                                                                </ul>
                                                                <h3>TOTAL AMOUNT TO PAID IN THE SPECIALITY: <?php echo floatval(str_replace(" ", "", $scolarite)) * $max_apprenant ?></h3>
                                                                <?php
                                                                $query = mysqli_query($database, "SELECT SUM(montant) AS montant_t FROM compta WHERE code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                $result = mysqli_fetch_assoc($query);

                                                                ?>
                                                                <h4>
                                                                    <p style="color: red;"> TOTAL AMOUNT ALREADY PAID IN THIS SPECIALITY: <?php echo $result['montant_t'] + 0 ?></p>
                                                                </h4>

                                                                <!-- timeline widget ends -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">CLASS PAIEMENT DATA TABLE</h4>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body card-dashboard">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped dataex-html5-selectors">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Full Name</th>
                                                                                    <th>Paiement Tranche</th>
                                                                                    <th>Amount</th>
                                                                                    <th>Delais</th>
                                                                                    <th>Amount PAID</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $query = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$code_classe' and matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id asc ");
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

                                        </div>
                                        <div class="tab-pane" id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                            <!-- user profile nav tabs feed start -->
                                            <div class="row">
                                                <!-- user profile nav tabs feed middle section start -->
                                                <div class="col-lg-12">
                                                    <!-- user profile nav tabs feed middle section post card start -->
                                                    <div class="tab-content pl-0">
                                                        <div class="tab-pane active" id="user-status" aria-labelledby="user-status-tab" role="tabpanel">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <form action="" method="post">
                                                                        <section id="form-and-scrolling-components">
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="card">
                                                                                        <div class="card-content">
                                                                                            <div class="card-body">
                                                                                                <div class="form-group">
                                                                                                    <!-- Button trigger for login form modal -->
                                                                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#xlarge">
                                                                                                        Add a Discipline
                                                                                                    </button>

                                                                                                    <!--login form Modal -->
                                                                                                    <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h4 class="modal-title" id="myModalLabel33">ADD A DISCIPLINE TO THE CLASS FORM</h4>
                                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                        <i class="bx bx-x"></i>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="form-group row">
                                                                                                                        <div class="col-sm-1 col-2">
                                                                                                                            <div class="avatar">
                                                                                                                                <img src="logo_data/<?php echo $logo ?>" alt="user image" width="32" height="32">
                                                                                                                                <span class="avatar-status-online"></span>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="col-sm-11 col-10">
                                                                                                                            <label>Courses list</label>
                                                                                                                            <select name="dis_name" required placeholder="select the discipline" class="form-control border-1 shadow-none">
                                                                                                                                <?php
                                                                                                                                $query = mysqli_query($database, "SELECT * FROM matiere WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                                while ($result = mysqli_fetch_assoc($query)) {
                                                                                                                                    $code_matiere = $result['code_matiere'];
                                                                                                                                    $nom_matiere = $result['nom_matiere'];
                                                                                                                                ?>
                                                                                                                                    <optgroup label="<?php echo $nom_matiere; ?>">
                                                                                                                                        <?php
                                                                                                                                        $query_ = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND  matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                                        while ($result_ = mysqli_fetch_assoc($query_)) {
                                                                                                                                            $dis = $result['code_discipline'];
                                                                                                                                            $q = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_discipline = '$dis' ");
                                                                                                                                            if (mysqli_num_rows($q) == 1) {
                                                                                                                                                continue;
                                                                                                                                                # code...
                                                                                                                                            }
                                                                                                                                        ?>
                                                                                                                                            <option value="<?php echo $result_['code_discipline'] ?>">
                                                                                                                                                <?php echo $result_['nom_discipline']; ?>

                                                                                                                                            </option>

                                                                                                                                        <?php
                                                                                                                                            // code...
                                                                                                                                        }

                                                                                                                                        ?>
                                                                                                                                    </optgroup>
                                                                                                                                <?php
                                                                                                                                    # code...
                                                                                                                                }
                                                                                                                                ?>

                                                                                                                            </select><br>
                                                                                                                            <label>Teacher</label>
                                                                                                                            <select name="dis_teacher" required placeholder="select the discipline" class="form-control border-1 shadow-none">
                                                                                                                                <?php
                                                                                                                                $query = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY nom_enseignant asc ");
                                                                                                                                while ($result = mysqli_fetch_assoc($query)) { ?>
                                                                                                                                    <option value="<?php echo $result['matricule_enseignant'] ?>">
                                                                                                                                        <?php echo $result['nom_enseignant'] . ' ' . $result['prenom_enseignant']; ?>

                                                                                                                                    </option>

                                                                                                                                <?php
                                                                                                                                    # code...
                                                                                                                                }
                                                                                                                                ?>

                                                                                                                            </select><br>
                                                                                                                            <label>How many Hours for this course</label>
                                                                                                                            <input type="tel" name="dis_hour" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3" placeholder=""></input>

                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                                                                        <span class="d-none d-sm-block">Close</span>
                                                                                                                    </button>
                                                                                                                    <button type="submit" name="add_dis_class" class="btn btn-success ml-1">
                                                                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                                                                        <span class="d-none d-sm-block">Save</span>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile middle section blogpost nav tabs card ends -->
                                                    <!-- user profile nav tabs feed middle section post card ends -->
                                                    <!-- user profile nav tabs activity start -->
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form action="" method="post">
                                                                    <!-- timeline widget start -->
                                                                    <ul class="widget-timeline">
                                                                        <?php
                                                                        $query = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER by id desc ");
                                                                        while ($result = mysqli_fetch_assoc($query)) {

                                                                            $code_discipline = addslashes($result['code_discipline']);
                                                                            $hour = $result['heure'];
                                                                            $matricule_enseignant = addslashes($result['matricule_enseignant']);
                                                                            $query_1 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$matricule_enseignant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                            $result_1 = mysqli_fetch_assoc($query_1);
                                                                            $nom_enseignant = $result_1['nom_enseignant'] . ' ' . $result_1['prenom_enseignant'];
                                                                            $query_1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                            $result_1 = mysqli_fetch_assoc($query_1);

                                                                        ?>
                                                                            <li class="timeline-items timeline-icon-success active">
                                                                                <div class="timeline-time">Teacher: <span style="text-transform: uppercase;"><?php echo $nom_enseignant; ?></span></div>
                                                                                <h6 class="timeline-title"><?php echo $result_1['nom_discipline']; ?></h6>
                                                                                <p class="timeline-text">
                                                                                    <button type="submit" name="delete_dis_class" value="<?php echo $result['code_discipline']; ?>" class="btn btn-icon action-icon">
                                                                                        <span class="fonticon-wrap">
                                                                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                            </i>
                                                                                        </span>
                                                                                    </button>
                                                                                <div class="timeline-content">
                                                                                    <?php echo "Hour: " . $hour; ?>
                                                                                </div>
                                                                            </li>


                                                                        <?php
                                                                            # code...
                                                                        }
                                                                        ?>

                                                                    </ul>
                                                                    <!-- timeline widget ends -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs activity start -->
                                                </div>
                                                <!-- user profile nav tabs feed middle section ends -->
                                            </div>
                                            <!-- user profile nav tabs feed ends -->
                                        </div>
                                        <div class="tab-pane" id="compta" aria-labelledby="compta-tab" role="tabpanel">
                                            <h5> Class Feeds :<?php echo $scolarite; ?> </h5>
                                            <!-- user profile nav tabs feed start -->
                                            <div class="row">
                                                <!-- user profile nav tabs feed middle section start -->
                                                <div class="col-lg-7">
                                                    <!-- user profile nav tabs feed middle section post card start -->
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div class="tab-content pl-0">
                                                                    <div class="tab-pane active" id="user-status" aria-labelledby="user-status-tab" role="tabpanel">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <form action="" method="post">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-1 col-2">
                                                                                            <div class="avatar">
                                                                                                <img src="logo_data/<?php echo $logo ?>" alt="user image" width="32" height="32">
                                                                                                <span class="avatar-status-online"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-11 col-10">
                                                                                            <label>Payement tranche</label>
                                                                                            <input type="text" name="nom_tranche" required class="form-control border-0 shadow-none" id="user-post-textarea" rows="3" placeholder=""></input>
                                                                                            <label>Amount</label>
                                                                                            <input type="number" required name="montant_tranche" class="form-control border-0 shadow-none" id="user-post-textarea" rows="3" placeholder=""></input>
                                                                                            <label>Date</label>
                                                                                            <input type="date" required name="echeance_tranche" class="form-control border-0 shadow-none" id="user-post-textarea" rows="3" placeholder=""></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="card-footer p-0">
                                                                                        <span class=" float-sm-right d-flex flex-sm-row flex-column justify-content-end">
                                                                                            <!-- <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button> -->
                                                                                            <button type="submit" name="add_tranche" class="btn btn-primary">Add Tranche</button>
                                                                                        </span>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- user profile middle section blogpost nav tabs card ends -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- user profile nav tabs feed middle section post card ends -->
                                                    <!-- user profile nav tabs activity start -->

                                                    <!-- user profile nav tabs activity start -->
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <form action="" method="post">
                                                                    <!-- timeline widget start -->
                                                                    <ul class="widget-timeline">
                                                                        <?php
                                                                        $query = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER by id desc ");
                                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                                        ?>
                                                                            <li class="timeline-items timeline-icon-success active">
                                                                                <div class="timeline-time"> <span style="text-transform: uppercase;"><?php echo $result['nom_tranche']; ?></span></div>
                                                                                <h6 class="timeline-title"><?php echo $result['montant'] . " "; ?></h6>
                                                                                <p class="timeline-text">
                                                                                    <button type="submit" name="delete_tranche" value="<?php echo $result['id']; ?>" class="btn btn-icon action-icon">
                                                                                        <span class="fonticon-wrap">
                                                                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                            </i>
                                                                                        </span>
                                                                                    </button>
                                                                                    For <a href="JavaScript:void(0);"><?php echo "Date: " . $result['echeance']; ?></a>
                                                                                </p>
                                                                                <div class="timeline-content">
                                                                                </div>
                                                                            </li>


                                                                        <?php
                                                                            # code...
                                                                        }
                                                                        ?>

                                                                    </ul>
                                                                    <!-- timeline widget ends -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- user profile nav tabs feed middle section ends -->
                                            </div>
                                            <!-- user profile nav tabs feed ends -->
                                        </div>
                                        <div class="tab-pane" id="friends" aria-labelledby="friends-tab" role="tabpanel">
                                            <!-- user profile nav tabs friends start -->
                                            <div class="tab-content pl-0">
                                                <div class="tab-pane active" id="user-status" aria-labelledby="user-status-tab" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <form action="" method="post">
                                                                <section id="form-and-scrolling-components">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="card">
                                                                                <div class="card-content">
                                                                                    <div class="card-body">
                                                                                        <div class="form-group">
                                                                                            <!-- Button trigger for login form modal -->
                                                                                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#xlarg">
                                                                                                Add one student
                                                                                            </button>
                                                                                            <hr>
                                                                                            <h6>Or add with a data file </h6>
                                                                                            <!--login form Modal -->
                                                                                            <div class="modal fade text-left" id="xlarg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                            <h4 class="modal-title" id="myModalLabel33">ADD STUDENT FORM </h4>
                                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                <i class="bx bx-x"></i>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group row">
                                                                                                                <?php require_once 'add_student_form.php'; ?>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="modal-footer">
                                                                                                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                                                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                                                                <span class="d-none d-sm-block">Close</span>
                                                                                                            </button>
                                                                                                            <button type="submit" name="add_student" class="btn btn-success ml-1">
                                                                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                                                                <span class="d-none d-sm-block">Save</span>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </form>
                                                            <div class="form-group form-group-compose">
                                                                <!-- compose button  -->
                                                                <button type="button" class="btn btn-warning btn-block my-2">
                                                                    <a href="template/apprenant.csv" download=""> Download the template
                                                                    </a>
                                                                </button>
                                                                <small>do not modify the header</small>

                                                                <form action="#" method="post" enctype="multipart/form-data">
                                                                    <div class="form-group mt-2">
                                                                        <div class="custom-file">
                                                                            <input type="file" required="" class="custom-file-input" name="csv_file" accept="csv" id="">
                                                                            <label class="custom-file-label" for="emailAttach">Attach File</label>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" name="csv_upload" class="btn btn-success btn-block my-2">
                                                                        Upload file's data
                                                                    </button>

                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- user profile middle section blogpost nav tabs card ends -->
                                            <!-- Column selectors with Export Options and print table -->
                                            <section id="column-selectors">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">LIST OF <?php $nom_classe ?> STUDENT DATA TABLE</h4>
                                                            </div>
                                                            <form class="" action="" method="post">
                                                                <div class="card-content">
                                                                    <div class="card-body card-dashboard">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped dataex-html5-selectors">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>First Name</th>
                                                                                        <th>Last Name</th>
                                                                                        <th>Specialty</th>
                                                                                        <th>Email</th>
                                                                                        <th>Matricule</th>
                                                                                        <th>Birthday and place</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' AND code_classe = '$code_classe' ORDER BY id asc ");
                                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                                        $code_classe = $result['code_classe'];
                                                                                        $query_1 = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td> <a href="student_profile.php?ktsp=<?php echo base64_encode($result['matricule_apprenant']);  ?>">
                                                                                                    <button type="button" class="btn btn-icon action-icon">
                                                                                                        <span class="fonticon-wrap">
                                                                                                            <i class="bx bxs-left-top-arrow-circle"></i>
                                                                                                            </i>
                                                                                                        </span>
                                                                                                    </button>
                                                                                                </a> <?php echo  $result['nom_apprenant']; ?>
                                                                                            </td>
                                                                                            <td><?php echo $result['prenom_apprenant']; ?></td>
                                                                                            <td><?php echo $result_1['nom_classe']; ?></td>
                                                                                            <td><?php echo $result['telephone']; ?></td>
                                                                                            <td>
                                                                                                <?php echo $result['matricule_apprenant']; ?>
                                                                                                <button type="submit" name="delete_student" value="<?php echo $result['matricule_apprenant']; ?>" class="btn btn-icon action-icon">
                                                                                                    <span class="fonticon-wrap">
                                                                                                        <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                                        </i>
                                                                                                    </span>
                                                                                                </button>
                                                                                            </td>
                                                                                            <td><?php echo $result['adresse']; ?></td>
                                                                                        </tr>

                                                                                    <?php
                                                                                        # code...
                                                                                    }
                                                                                    ?>

                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th>First Name</th>
                                                                                        <th>Last Name</th>
                                                                                        <th>Specialty</th>
                                                                                        <th>Email</th>
                                                                                        <th>Matricule</th>
                                                                                        <th>Birthday and place</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- Column selectors with Export Options and print table -->
                                            <!-- user profile nav tabs friends ends -->
                                        </div>
                                        <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <!-- Column selectors with Export Options and print table -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">BUILD A TIME TABLE</h4><br>
                                                </div>
                                                <div class="card-content">
                                                    <form class="form form-horizontal" method="post" action="">
                                                        <div class="card-body card-dashboard">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>SELECT THE WEEK</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <input type="text" class="form-control drops" required placeholder="Select Date" name="week">
                                                                                <div class="form-control-position">
                                                                                    <i class='bx bx-calendar-check'></i>
                                                                                </div>
                                                                            </fieldset>
                                                                            <span><em>verify that it's the correct week</em></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>BEGIN</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <input type="text" required class="form-control pickatime" placeholder="Select Time" name="begin">
                                                                                <div class="form-control-position">
                                                                                    <i class='bx bx-history'></i>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>END</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <input type="text" required class="form-control pickatime" placeholder="Select Time" name="end">
                                                                                <div class="form-control-position">
                                                                                    <i class='bx bx-history'></i>
                                                                                </div>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Day of the Week</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <select class="form-control" name="jour">
                                                                                    <option value="MONDAY">MONDAY</option>
                                                                                    <option value="TUESDAY">TUESDAY</option>
                                                                                    <option value="WEDNESDAY">WEDNESDAY</option>
                                                                                    <option value="THURSDAY">THURSDAY</option>
                                                                                    <option value="FRIDAY">FRIDAY</option>
                                                                                    <option value="SATURDAY">SATURDAY</option>
                                                                                    <option value="SUNDAY">SUNDAY</option>
                                                                                </select>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Where</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <select class="form-control" name="place">
                                                                                    <?php
                                                                                    $query = mysqli_query($database, "SELECT * FROM salle WHERE 1 ORDER BY nom_salle asc");
                                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                                    ?>
                                                                                        <option value="<?php echo $result['nom_salle']; ?>"><?php echo $result['nom_salle']; ?></option>
                                                                                    <?php
                                                                                        // code...
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label>Discipline</label>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <select class="form-control" name="discipline" required>
                                                                                    <?php
                                                                                    $query = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                                        $code_discipline = addslashes($result['code_discipline']);
                                                                                        $query_1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                                                        $nom_discipline = $result_1['nom_discipline']; ?>
                                                                                        <option value="<?php echo $code_discipline ?>"><?php echo $nom_discipline; ?></option>
                                                                                    <?php
                                                                                        # code...
                                                                                    }
                                                                                    ?>

                                                                                </select>
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <span class=" float-sm-right ">
                                                                <!-- <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button> -->
                                                                <button type="submit" name="add_time_tab" class="btn btn-primary">Add a program</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">View the programm of a week</h4><br>
                                                </div>
                                                <div class="card-content">
                                                    <form class="form form-horizontal" method="post" action="">
                                                        <div class="card-body card-dashboard">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label>Choose thee week</label><br>
                                                                        <button type="submit" name="week_tab" class="btn btn-primary">Load to print</button>
                                                                        <button type="submit" name="week_del" class="btn btn-danger">delete program</button>
                                                                    </div>
                                                                    <div class="col-md-8 form-group">
                                                                        <div class="mb-3">
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <select class="form-control" name="week_view">
                                                                                    <?php
                                                                                    $query = mysqli_query($database, "SELECT DISTINCT(week) AS week FROM calendrier WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY id desc ");
                                                                                    $week = null;
                                                                                    while ($result = mysqli_fetch_assoc($query)) {

                                                                                    ?>
                                                                                        <option value="<?php echo $result['week']; ?>"><?php echo $result['week']; ?></option>
                                                                                    <?php
                                                                                        # code...
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
                                                    <?php
                                                    if (isset($_POST['week_tab']) and isset($_POST['week_view'])) {
                                                        $week_view = $_POST['week_view']; ?>
                                                        <a href="print_time_table.php?ktsp=<?php echo $week_view . "." . $code_classe; ?> " target="_blank"><button name="print_time_table" class="btn btn-warning">Print</button></a>
                                                    <?php
                                                        # code...
                                                    }
                                                    ?>


                                                </div>
                                            </div>
                                            <!-- Column selectors with Export Options and print table -->
                                            <section id="column-selectors">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body card-dashboard">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-striped ">
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
                                                                                if (isset($_POST['week_tab']) and isset($_POST['week_view'])) {
                                                                                    $week_view = $_POST['week_view'];
                                                                                    $query = mysqli_query($database, "SELECT * FROM calendrier WHERE date_academique ='$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week_view' ORDER BY id asc ");
                                                                                    # code...
                                                                                } else {
                                                                                    $query = mysqli_query($database, "SELECT * FROM calendrier WHERE date_academique ='$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' ORDER BY id desc LIMIT 1 ");
                                                                                }
                                                                                $result = mysqli_fetch_assoc($query);
                                                                                $week = $result['week'];
                                                                                echo "<tr><td colspan='5'><h6> <center> $week </center></h6></td></tr>";

                                                                                // MONDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'MONDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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




                                                                                // TUESDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'TUESDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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



                                                                                // WEDNESDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'WEDNESDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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




                                                                                // THURSDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'THURSDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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



                                                                                // FRIDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'FRIDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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


                                                                                // SATURDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'SATURDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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


                                                                                // SUNDAY
                                                                                $query_1 = mysqli_query($database, "SELECT DISTINCT(jour) AS jour  FROM calendrier WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND code_classe = '$code_classe' AND week = '$week' AND jour = 'SUNDAY' ORDER BY id asc ");
                                                                                while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                                    $day = $result_1['jour'];
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
                                                                                                if ($result_3['matricule_enseignant'] !== null) {
                                                                                                    $code_teacher = addslashes($result_3['matricule_enseignant']);
                                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM enseignant WHERE matricule_enseignant = '$code_teacher' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_4 = mysqli_fetch_assoc($query_4);
                                                                                                    echo $result_4['nom_enseignant'] . " " . $result_4['prenom_enseignant'] . "<hr>";
                                                                                                    # code...
                                                                                                } else {
                                                                                                    echo "---";
                                                                                                }
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- Column selectors with Export Options and print table -->
                                        </div>
                                        <div class="tab-pane" id="feed" aria-labelledby="feed-tab" role="tabpanel">
                                            <div class="card">
                                                <div class="card-header">
                                                </div>
                                                <div class="card-content">
                                                    <form class="form form-horizontal" method="post" action="print_b_spe.php?ktsp=<?php echo base64_encode($code_classe) ?>" target="_blank">
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
                                                                                                                                                <?php
                                                                                                                                                $query1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                                                while ($result1 = mysqli_fetch_assoc($query1)) {
                                                                                                                                                    $code_discipline = addslashes($result1['code_discipline']);
                                                                                                                                                    $q = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_discipline = '$code_discipline' and code_classe = '$code_classe'  AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                                                    if ($q and mysqli_num_rows($q) != 1) {
                                                                                                                                                        continue;
                                                                                                                                                        # code...
                                                                                                                                                    }
                                                                                                                                                    $nom_discipline = $result1['nom_discipline'];
                                                                                                                                                ?>
                                                                                                                                                    <tr>
                                                                                                                                                        <td style="text-transform: uppercase;">
                                                                                                                                                            <input type="checkbox" name="<?php echo $code_discipline ?>s1" id="<?php echo $code_discipline ?>s1" value="<?php echo $code_discipline ?>s1">
                                                                                                                                                            <label for="<?php echo $code_discipline ?>s1"><?php echo  $nom_discipline; ?></label>

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
                                                                                                                                                <?php
                                                                                                                                                $query1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                                                while ($result1 = mysqli_fetch_assoc($query1)) {
                                                                                                                                                    $code_discipline = addslashes($result1['code_discipline']);
                                                                                                                                                    $q = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_discipline = '$code_discipline' and code_classe = '$code_classe'  AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                                                                    if ($q and mysqli_num_rows($q) != 1) {
                                                                                                                                                        continue;
                                                                                                                                                        # code...
                                                                                                                                                    }

                                                                                                                                                    $nom_discipline = $result1['nom_discipline'];
                                                                                                                                                ?>
                                                                                                                                                    <tr>
                                                                                                                                                        <td style="text-transform: uppercase;">
                                                                                                                                                            <input type="checkbox" name="<?php echo $code_discipline ?>s2" id="<?php echo $code_discipline ?>s2" value="<?php echo $code_discipline ?>s2">
                                                                                                                                                            <label for="<?php echo $code_discipline ?>s2"><?php echo  $nom_discipline; ?></label>
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
                                                                                <!-- <legend>NIVEAU/LEVEL</legend> -->
                                                                                <label for=""></label>
                                                                                <input type="hidden" value="<?php echo $id_niveau; ?>" required class="form-control" name="id_niveau">
                                                                                </input>

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
                                    </div>
                                </div>
                                <!-- user profile nav tabs content ends -->
                                <!-- user profile right side content start -->
                                <div class=" col-lg-3">
                                    <!-- user profile right side content related groups start -->
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">Others Specialities
                                                    <i class="cursor-pointer bx bx-dots-vertical-rounded align-top float-right"></i>
                                                </h5>
                                                <?php
                                                $query = mysqli_query($database, "SELECT * FROM classe WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                while ($result = mysqli_fetch_assoc($query)) {
                                                    $niveau = $result['id_niveau'];
                                                    $result_1 = mysqli_fetch_assoc(mysqli_query($database, "SELECT * FROM niveau WHERE id = '$niveau' "));
                                                    $niveau = $result_1['nom_niveau'];
                                                ?>
                                                    <div class="media d-flex align-items-center mb-1">
                                                        <a href="JavaScript:void(0);">
                                                            <img src="logo_data/<?php echo $logo ?>" class="rounded" alt="group image" height="64" width="64" />
                                                        </a>
                                                        <div class="media-body ml-1">
                                                            <h4 class="media-heading mb-0"><small><a href="classe_profile.php?ktsp=<?php echo base64_encode($result['id']) ?>"><?php echo $result['nom_classe']; ?></a></small></h4>
                                                            <?php echo $niveau ?>
                                                        </div>
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
    <!-- END: Page JS-->
</body>
<!-- END: Body-->

</html>

<?php
if (isset($_POST['week_tab']) and isset($_POST['week_view'])) {
?>
    <script type="text/javascript" language="javascript">
        alert("The time table is loaded and ready to be printed. Go to the Time table view");
    </script>
<?php
    # code...
}
?>