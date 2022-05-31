<?php require 'index_php.php';
include 'function.php' ?>
<?php
if (isset($_GET['ktsp'])) {
    $matricule_apprenant = base64_decode($_GET['ktsp']);
    $code_classe = null;
    $query = mysqli_query($database, "SELECT * FROM apprenant WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
    if (mysqli_num_rows($query) != 1) {
        header("Location: student.php");
        # code...
    } else {
        $result = mysqli_fetch_assoc($query);
        $nom_apprenant = $result['nom_apprenant'];
        $prenom_apprenant = $result['prenom_apprenant'];
        $telephone = $result['telephone'];
        $adresse = $result['adresse'];
        $code_cloud = base64_decode($result['pssw']);
        $contact_parentale = $result['contact_parentale'];
        $information_tierce = $result['information_tierce'];
        $code_classe = $result['code_classe'];
        $query_1 = mysqli_query($database,  "SELECT * FROM classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
        $result_1 = mysqli_fetch_assoc($query_1);
        $scolarite = $result_1['scolarite'];
        $id_niveau = $result_1['id_niveau'];
        $query_2 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
        $result_2 = mysqli_fetch_assoc($query_2);
        $nom_niveau = $result_2['nom_niveau'];
        // exit();
        //UPDATE STUDENT INFOS
        if (isset($_POST['update_student'])) {
            if ($role == 'admin' or $role == 'headmaster') {
                $nom_apprenant = get_safe_input ($_POST['nom_apprenant']);
                $prenom_apprenant = get_safe_input ($_POST['prenom_apprenant']);
                $telephone = get_safe_input ($_POST['telephone_apprenant']);
                $adresse = get_safe_input ($_POST['adresse_apprenant']);
                $information_tierce = get_safe_input ($_POST['other_info_apprenant']);
                $tutor_apprenant = get_safe_input ($_POST['tutor_apprenant']);
                $result = mysqli_query($database, "UPDATE apprenant SET nom_apprenant = '$nom_apprenant', prenom_apprenant = '$prenom_apprenant', telephone = '$telephone', adresse = '$adresse', contact_parentale = '$contact_parentale', information_tierce = '{$information_tierce}' WHERE matricule_apprenant = '$matricule_apprenant' ");
                # code...
            } else {
                include 'access_denieted.php';
            }
        }

        //CHANGE STUDENT CLASS TREATMENT
        if (isset($_POST['change_class'])) {
            if ($role == 'admin' or $role == 'headmaster') {
                $code_classe = $_POST['new_class'];
                $query = mysqli_query($database, "SELECT * from classe WHERE code_classe = '$code_classe' ");
                $result = mysqli_fetch_assoc($query);
                $ini = $result['ini'];
                $new_matricule =date("y") . "THIB" . $ini . "0" . random_int(1, 999);
                $result = 0;
                while ($result == 0) {
                $new_matricule =date("y") . "THIB" . $ini . "0" . random_int(1, 999);
                $result = $user->change_class($matricule_apprenant, $new_matricule, $code_classe, $date_academique, $matricule_etablissement);
                }
                switch ($result) {
                    case 1:
                        $matricule_apprenant = $new_matricule;
                        $query = mysqli_query($database, "UPDATE compta SET code_classe = '$code_classe' WHERE matricule_apprenant = '$new_matricule' ");
                        # code...
                        break;
                    case 0:
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
                                    <div id="swal2-content" style="display: block;">
                                        <?php echo 'The student class have not been updated, please try in few minutes'; ?></div>
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
                // code...
                // code...
            } else {
                include 'access_denieted.php';
            }
        }
    }
    # code...
} else {
    header("Location: ./student.php");
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
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title><?php echo $nom_apprenant . " " . $prenom_apprenant . " | " . $nom_etablissement; ?></title>
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
<?php
//PAID SCHOLARYSHIPS TREATMENT
if (isset($_POST['regler_tranche'])) {
    if ($role == 'comptable' or $role == "admin") {
        $id_tranche = $_POST['id_tranche'];
        $montant_tranche = get_safe_input ($_POST['montant_tranche']);
        $jour = $_POST['jour'];
        $result = $user->regler_tranche($id_tranche, $montant_tranche, $jour, $matricule_apprenant, $code_classe, $matricule_etablissement, $date_academique, $name);
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
                            <div id="swal2-content" style="display: block;"><?php echo 'Something when Wrong'; ?></div>
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
            case 2: ?>
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
                            <div id="swal2-content" style="display: block;">It's too much!!</div>
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
                break;
            case 1:
                $body = "You have paid your tuiton fee! Amount of: " . $montant_tranche . " " . $jour;
                send_message($telephone, $body, $nom_etablissement, "Tuition paiement");
                header("Location: print_bill.php?ktsp=$matricule_apprenant");
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


    # code...
}

//DELETE TRANCHE DE PAIEMENT
if (isset($_POST['delete_tranche'])) {
    if ($role == 'admin' or $role == 'comptable') {
        $delete_tranche = $_POST['delete_tranche'];
        $query = mysqli_query($database, "DELETE FROM compta WHERE id  = '$delete_tranche'");
        if ($query) { ?>
            <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                    <div class="swal2-content">
                        <div id="swal2-content" style="display: block;"><?php echo 'Done!successfully'; ?></div>
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
        } else { ?>
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
                        <div id="swal2-content" style="display: block;"><?php echo 'Something when Wrong'; ?></div>
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
        # code...
    } else {
        include 'access_denieted.php';
    }
    # code...
}

//INSERT EXAM NOTES
if (isset($_POST['save'])) {
    if ($role == 'teacher' or $role == "admin") {
        $bool = 1;
        $exam_code = ($_POST['exam_code']);
        $query = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
        while ($result = mysqli_fetch_assoc($query)) {
            $code_discipline = $result['code_discipline'];
            while ($index_tab = key($_POST)) {
                if ($index_tab == $code_discipline) {
                    $index_tab = key($_POST);
                    $indexval = doubleval($_POST[$index_tab]);
                    if ($indexval != null or $indexval != "" or $indexval != 0) { // on ajoute pas une note de zero
                        $bool = $user->save_note($matricule_apprenant, $exam_code, $code_discipline, $date_academique, $matricule_etablissement, $indexval);
                        # code...
                    }
                    # code...
                }
                if ($bool == 0) {
                    break;
                    # code...
                }
                next($_POST);
                # code...
            }
            reset($_POST); // remet la position du tableu à zero
            if ($bool == 0) {
                break;
                # code...
            }
            # code...
        }
        switch ($bool) {
            case 1: ?>
                <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-content">
                            <div id="swal2-content" style="display: block;"><?php echo 'Notes have been saved'; ?></div>
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
                            <div id="swal2-content" style="display: block;">
                                <?php echo 'Something went wrong please try in few minutes'; ?></div>
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

// DELETE ALL EXAM'S NOTES
if (isset($_POST['delete_A_en'])) {
    if ($role == 'admin' or $role == 'teacher') {
        $query = mysqli_query($database, "DELETE * FROM note WHERE matricule_apprenant = '$matricule_apprenant' AND date_academique = '$date_academique'");
        ?>
        <script type="text/javascript" language="javascript">
            alert("DONE!");
        </script>
        <?php
        # code...
    } else {
        include 'access_denieted.php';
        # code...
    }

    # code...
}

//DELETE EXAM NOTES
if (isset($_POST['delete_note'])) {
    if ($role == 'admin' or $role == 'teacher') {
        $delete_note = explode('.', $_POST['delete_note']);
        $code_discipline = $delete_note[0];
        $code_examen = end($delete_note);
        $result = $user->delete_note($code_examen, $code_discipline, $matricule_apprenant, $matricule_etablissement, $date_academique);
        switch ($result) {
            case 1: ?>
                <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
                    <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
                        <div class="swal2-content">
                            <div id="swal2-content" style="display: block;"><?php echo 'Note have been deleted'; ?></div>
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
                            <div id="swal2-content" style="display: block;">
                                <?php echo 'Something went wrong please try in few minutes'; ?></div>
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
    # code...
}

//DELET A Student
if (isset($_POST['delete_A_s'])) {
    if ($role == 'admin' or $role == 'headmaster') {
        $result = mysqli_query($database, "DELETE FROM apprenant WHERE matricule_apprenant = '$matricule_apprenant' AND date_academique = '$date_academique'");
        header("Location: ./student.php");
        exit();
        # code...
    } else {
        include 'access_denieted.php';
    }
    # code...
}

?>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static menu-open " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

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
                                        <img src="../../../app-assets/images/profile/post-media/profile-banner-co.jpg" class="img-fluid rounded-top user-timeline-image" alt="user timeline image">
                                        <!-- user profile image -->
                                        <img src="logo_data/<?php echo "$logo" ?>" class="user-profile-image rounded" alt="user profile image" height="140" width="140">
                                    </div>
                                    <div class="user-profile-text">
                                        <h4 class="mb-0 text-bold-500 profile-text-color">
                                            <?php echo $nom_apprenant . " " . $prenom_apprenant ?></h4>
                                        <small>##############################</small>
                                        <h6 class="mb-0 text-bold-500 profile-text-color">E-learning password:
                                            <?php echo $code_cloud ?></h6>

                                    </div>
                                    <!-- user profile nav tabs start -->
                                    <div class="card-body px-0">
                                        <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-tabs border-bottom-0 mb-0" role="tablist">
                                            <?php
                                            if ($role == "admin" or $role == "comptable") {
                                            ?>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="activity-tab" data-toggle="tab" href="#activity" aria-controls="activity" role="tab" aria-selected="false"><i class="bx bx-user"></i><span class="d-none d-md-block">Tuition fees</span></a>
                                                </li>

                                            <?php
                                                # code...
                                            }
                                            if ($role == "admin" or $role == "teacher") {
                                            ?>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="friends-tab" data-toggle="tab" href="#friends" aria-controls="friends" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Exams</span></a>
                                                </li>

                                            <?php
                                            }
                                            if ($role == "admin" or $role == "headmaster") {
                                            ?>
                                                <li class="nav-item pb-0">
                                                    <a class="nav-link d-flex px-1" id="config-tab" data-toggle="tab" href="#config" aria-controls="config" role="tab" aria-selected="false"><i class="bx bx-message-alt"></i><span class="d-none d-md-block">Config</span></a>
                                                </li>

                                            <?php

                                                # code...
                                            }

                                            ?>

                                            <li class="nav-item pb-0 mr-0 active">
                                                <a class="nav-link d-flex px-1 active" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false"><i class="bx bx-copy-alt"></i><span class="d-none d-md-block">Profile</span></a>
                                            </li>
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

                                        <div class="tab-pane " id="activity" aria-labelledby="activity-tab" role="tabpanel">
                                            <h5><?php echo $scolarite; ?> USD</h5>
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
                                                                                                <img src="logo_data/<?php echo "$logo" ?>" alt="user image" width="32" height="32">
                                                                                                <span class="avatar-status-online"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-11 col-10">
                                                                                            <label>Payement
                                                                                                tranche</label>
                                                                                            <select name="id_tranche" required class="form-control border-0 shadow-none" id="user-post-textarea" rows="3">
                                                                                                <?php
                                                                                                $query = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER by id desc ");
                                                                                                while ($result = mysqli_fetch_assoc($query)) { ?>

                                                                                                    <option value="<?php echo $result['id']; ?>">
                                                                                                        <?php echo $result['nom_tranche'] . " :" . $result['montant'] . " USD /" . $result['echeance']; ?>
                                                                                                    </option>

                                                                                                <?php
                                                                                                    # code...
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                            <label>Amount</label>
                                                                                            <input type="number" required name="montant_tranche" class="form-control border-0 shadow-none" id="user-post-textarea" rows="3" placeholder=""></input>
                                                                                            <label>Date</label>
                                                                                            <input type="text" readonly value="<?php echo date("d/D/M/Y") ?>" name="jour" class="form-control border-0 shadow-none" id="user-post-textarea" rows="3" placeholder=""></input>


                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="card-footer p-0">
                                                                                        <span class=" float-sm-right d-flex flex-sm-row flex-column justify-content-end">
                                                                                            <!-- <button class="btn btn-light-primary mr-0 my-1 my-sm-0 mr-sm-1">Preview</button> -->
                                                                                            <button type="submit" name="regler_tranche" class="btn btn-success">Payement</button>
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
                                                                        $id_tranche = null;
                                                                        $m = 0;
                                                                        $mm = 0;
                                                                        $query = mysqli_query($database, "SELECT distinct(id_tranche) As disIdtranche FROM compta WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ORDER BY id_tranche desc ");
                                                                        while ($result = mysqli_fetch_assoc($query)) {
                                                                            $id_tranche = $result['disIdtranche'];
                                                                            $query_0 = mysqli_query($database, "SELECT * FROM tranche_paiement WHERE id = '$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                            if (mysqli_num_rows($query_0) == 0) {
                                                                                continue;
                                                                                # code...
                                                                            }
                                                                            $result_0 = mysqli_fetch_assoc($query_0);

                                                                        ?>
                                                                            <li class="timeline-items timeline-icon-success active">
                                                                                <div class="timeline-time"><span style="text-transform: uppercase;"><?php echo $result_0['nom_tranche']; ?></span>
                                                                                </div>
                                                                                <h6 class="timeline-title">
                                                                                    <?php echo $result_0['montant'] . " USD"; ?>
                                                                                </h6>
                                                                                <?php
                                                                                $query_2 = mysqli_query($database, "SELECT * FROM compta WHERE matricule_apprenant ='$matricule_apprenant' AND id_tranche = '$id_tranche' AND date_academique ='$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                while ($result_2 = mysqli_fetch_assoc($query_2)) {
                                                                                    $m += $result_2['montant'];
                                                                                    $mm += $m;
                                                                                    $it = $result_2['id'];
                                                                                ?>
                                                                                    <p class="timeline-text">
                                                                                        Amount Paid <a href="JavaScript:void(0);"><?php echo $result_2['montant']; ?></a>
                                                                                    </p>
                                                                                    <p class="timeline-text">
                                                                                        <button type="submit" name="delete_tranche" value="<?php echo $result_2['id']; ?>" class="btn btn-icon action-icon">
                                                                                            <span class="fonticon-wrap">
                                                                                                <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                                </i>
                                                                                            </span>
                                                                                        </button>
                                                                                        Paid on <a href="JavaScript:void(0);"><?php echo "Date: " . $result_2['date_paiement']; ?></a>
                                                                                        By <a href="JavaScript:void(0);"><?php echo $result_2['nom_validateur']; ?></a>
                                                                                    </p>
                                                                                    <div class="timeline-content">
                                                                                        <a href="print_bill.php?ktspp=<?php echo $it ?>" target="_blank">Print</a>
                                                                                    </div>

                                                                                <?php
                                                                                    # code...
                                                                                }
                                                                                ?>

                                                                            </li>
                                                                            <li class="timeline-items timeline-icon-danger">
                                                                                Total paid for
                                                                                <?php echo $result_0['nom_tranche'] . " :" . $m ?>
                                                                            </li>

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
                                                </div>
                                                <!-- user profile nav tabs feed middle section ends -->
                                            </div>
                                            <!-- user profile nav tabs feed ends -->
                                        </div>
                                        <div class=" tab-pane" id="friends" aria-labelledby="friends-tab" role="tabpanel">
                                            <!-- <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h5>Supprimer Les notes d'un Examen</h5>
                                                       <form class="form" method="post" action="">
                                                           <div class="form-goup">
                                                               <select class="form-control" name="new_class">
                                                                 <?php
                                                                    $query = mysqli_query($database, "SELECT * FROM classe WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                        if ($result['code_classe'] == $code_classe) {
                                                                            continue;
                                                                            // code...
                                                                        }
                                                                        $id_niveau = $result['id_niveau'];
                                                                        $query_1 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                                    ?>
                                                                      <option value="<?php echo $result['code_classe']; ?>"><?php echo $result['nom_classe'] . " " . $result_1['nom_niveau']; ?></option>
                                                                       <?php
                                                                        // code...
                                                                    }
                                                                        ?>

                                                               </select>
                                                           </div><br>
                                                           <div class="form-group">
                                                               <button class="btn btn-light-primary" type="submit" name="change_class">Change</button>
                                                           </div>
                                                       </form>
                                                    </div>
                                                </div>
                                            </div>                                                                             -->
                                            <!-- vertical Wizard start-->
                                            <section id="vertical-wizard">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Matters</h4>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form action="" method="post" class="wizard-vertical">
                                                                <label for="">Choose the exam</label>
                                                                <select name="exam_code" required id="" class="form-control">
                                                                    <?php
                                                                    $query = mysqli_query($database, "SELECT * FROM examen WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                    while ($result = mysqli_fetch_assoc($query)) { ?>
                                                                        <option value="<?php echo $result['code_examen'] ?>">
                                                                            <?php echo $result['nom_examen'] . "  " . $result['periode'] ?>
                                                                        </option>
                                                                    <?php
                                                                        # code...
                                                                    }

                                                                    ?>

                                                                </select>
                                                                <?php
                                                                $query = mysqli_query($database, "SELECT * FROM matiere WHERE  matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                while ($result = mysqli_fetch_assoc($query)) {
                                                                    $nom_matiere = $result['nom_matiere'];
                                                                    $code_matiere = addslashes($result['code_matiere']);
                                                                    $query_1  = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                    if (mysqli_num_rows($query_1) == 0) {
                                                                        continue;
                                                                        # code...
                                                                    }
                                                                    while ($result_1 = mysqli_fetch_assoc($query_1)) {
                                                                        $code_discipline = addslashes($result_1['code_discipline']);
                                                                        $query_2 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_discipline = '$code_discipline' AND code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                        if (mysqli_num_rows($query_2) == 0) {
                                                                            continue;
                                                                            # code...
                                                                        } else { ?>
                                                                            <h3>
                                                                                <span class="fonticon-wrap mr-1">
                                                                                    <i class="livicon-evo" data-options="name:gear.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                                                                </span>
                                                                                <span class="icon-title">
                                                                                    <span class="d-block"><?php echo $nom_matiere ?></span>
                                                                                </span>
                                                                            </h3>
                                                                            <fieldset class="pt-0">
                                                                                <!-- <legend>Enter <?php echo $nom_matiere ?> Disciplines notes</legend> -->
                                                                                <?php
                                                                                $query_3  = mysqli_query($database, "SELECT * FROM discipline WHERE code_matiere = '$code_matiere' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                while ($result_3 = mysqli_fetch_assoc($query_3)) {
                                                                                    $code_discipline = addslashes($result_3['code_discipline']);
                                                                                    $nom_discipline = $result_3['nom_discipline'];
                                                                                    $query_4 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_discipline = '$code_discipline' AND code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique'  ");
                                                                                    while ($result_4 = mysqli_fetch_assoc($query_4)) { ?>
                                                                                        <!-- step 1 content -->
                                                                                        <div class="row">
                                                                                            <div class="col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    <input type="number" min="0" max="20" name="<?php echo $result_4['code_discipline'] ?>" class="form-control" placeholder="<?php echo $nom_discipline ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- step 1 content end-->
                                                                                <?php
                                                                                        # code...
                                                                                    };
                                                                                }; ?>

                                                                            </fieldset>
                                                                            <?php
                                                                            break;
                                                                        }
                                                                        # code...
                                                                    }
                                                                            ?><?php
                                                                                # code...
                                                                            }
                                                                                ?>
                                                                            <button role="menuitem" name='save' class="btn btn-light-primary">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </section>
                                            <!-- vertical Wizard end-->
                                            <!-- Column selectors with Export Options and print table -->
                                            <section id="column-selectors">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">NOTES DATA TABLE</h4>
                                                            </div>
                                                            <div class="card-content">
                                                                <div class="card-body card-dashboard">
                                                                    <form action="" method="POST">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped dataex-html5-selectors">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Examen</th>
                                                                                        <th><?php echo $retVal = ($statut == 1) ? "COURSE" : "DISCIPLINE"; ?></th>
                                                                                        <th>Note</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $query = mysqli_query($database, "SELECT * FROM note WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id desc ");
                                                                                    while ($result = mysqli_fetch_assoc($query)) {
                                                                                        $note = $result['note'];
                                                                                        // if ($note == 0) {
                                                                                        //     continue;
                                                                                        //     // code...
                                                                                        // }
                                                                                        $code_examen = addslashes($result['code_examen']);
                                                                                        $code_discipline = addslashes($result['code_discipline']);
                                                                                        //take exam name
                                                                                        $query_1 = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$code_examen' AND matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ORDER BY id desc ");
                                                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                                                        $nom_examen = $result_1['nom_examen'];
                                                                                        //take discipline name
                                                                                        $query_1 = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
                                                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                                                        $nom_discipline = $result_1['nom_discipline'];
                                                                                        //take de credit
                                                                                        $query_1 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
                                                                                        $result_1 = mysqli_fetch_assoc($query_1);
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?php echo $nom_examen ?>
                                                                                            </td>
                                                                                            <td><?php echo $nom_discipline; ?>
                                                                                            </td>
                                                                                            <td><?php echo $note; ?>

                                                                                                <button type="submit" name="delete_note" value="<?php echo $code_discipline . "." . $code_examen ?>" class="btn btn-icon action-icon">
                                                                                                    <span class="fonticon-wrap">
                                                                                                        <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                                                        </i>
                                                                                                    </span>
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>

                                                                                    <?php
                                                                                        # code...
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th>Examen</th>
                                                                                        <th><?php echo $retVal = ($statut == 1) ? "COURSE" : "DISCIPLINE"; ?></th>
                                                                                        <th>Note</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- Column selectors with Export Options and print table -->
                                        </div>
                                        <div class=" tab-pane" id="config" aria-labelledby="config-tab" role="tabpanel">
                                            <div class="tab-content pl-0">
                                                <div class="tab-pane active" id="user-status" aria-labelledby="user-status-tab" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <section id="form-and-scrolling-components">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="card">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <h5>Update Student infos</h5>
                                                                                    <form action="" method="post">
                                                                                        <div class="form-group">
                                                                                            <div class="form-group row">
                                                                                                <label>First
                                                                                                    Name</label>
                                                                                                <input type="text" name="nom_apprenant" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3" placeholder="<?php echo $nom_apprenant ?>" value="<?php echo $nom_apprenant ?>"></input>
                                                                                                <label>Last Name</label>
                                                                                                <input type="text" name="prenom_apprenant" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3" placeholder="<?php echo $prenom_apprenant ?>" value="<?php echo $prenom_apprenant ?>"></input>
                                                                                                <label>Email</label>
                                                                                                <input type="email" name="telephone_apprenant" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3" placeholder="<?php echo $telephone ?>" value="<?php echo $telephone ?>"></input>
                                                                                                <label>Birthday and
                                                                                                    Place</label>
                                                                                                <input type="text" name="adresse_apprenant" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3" placeholder="<?php echo $adresse ?>" value="<?php echo $adresse ?>"></input>
                                                                                                <label>Others
                                                                                                    informations</label>
                                                                                                <textarea name="other_info_apprenant" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3"><?php echo $information_tierce ?> </textarea>
                                                                                                <label>Tutor
                                                                                                    Adresse</label>
                                                                                                <input type="text" name="tutor_apprenant" class="form-control border-1 shadow-none" id="user-post-textarea" rows="3" placeholder="<?php echo $contact_parentale ?>" value="<?php echo $contact_parentale ?>"></input>
                                                                                            </div>
                                                                                            <button type="reset" class="btn btn-light-secondary">
                                                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                                                <span class="d-none d-sm-block">Clean</span>
                                                                                            </button>
                                                                                            <button type="submit" name="update_student" class="btn btn-success ml-1">
                                                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                                                <span class="d-none d-sm-block">Save</span>
                                                                                            </button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="card">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <h5>Move in another Specialty
                                                                                    </h5>
                                                                                    <form class="form" method="post" action="">
                                                                                        <div class="form-goup">
                                                                                            <select class="form-control" required name="new_class">
                                                                                                <?php
                                                                                                $query = mysqli_query($database, "SELECT * FROM classe WHERE date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
                                                                                                while ($result = mysqli_fetch_assoc($query)) {
                                                                                                    if ($result['code_classe'] == $code_classe) {
                                                                                                        continue;
                                                                                                        // code...
                                                                                                    }
                                                                                                    $id_niveau = $result['id_niveau'];
                                                                                                    $query_1 = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                    $result_1 = mysqli_fetch_assoc($query_1);
                                                                                                ?>
                                                                                                    <option value="<?php echo $result['code_classe']; ?>">
                                                                                                        <?php echo $result['nom_classe'] . " " . $result_1['nom_niveau']; ?>
                                                                                                    </option>
                                                                                                <?php
                                                                                                    // code...
                                                                                                }
                                                                                                ?>

                                                                                            </select>
                                                                                        </div><br>
                                                                                        <div class="form-group">
                                                                                            <button class="btn btn-light-primary" type="submit" name="change_class">Change</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card">
                                                                            <div class="card-content">
                                                                                <div class="card-body">
                                                                                    <h5>OPERATIONS</h5>
                                                                                    <form class="form" method="post" action="">
                                                                                        <div class="form-group">
                                                                                            <button class="btn btn-light-danger" type="submit" name="delete_A_s">DELETE
                                                                                                THIS
                                                                                                STUDENT</button>
                                                                                            &AMP;
                                                                                            <button class="btn btn-light-warning" type="submit" name="delete_A_en">DELETE
                                                                                                ALL EXAM'S
                                                                                                NOTES</button>
                                                                                        </div>
                                                                                    </form>
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
                                        </div>

                                        <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                            <!-- user profile nav tabs profile start -->
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-3 text-center mb-1 mb-sm-0">
                                                                        <img src="logo_data/<?php echo "$logo "?>" class="rounded" alt="group image" height="120" width="120" />
                                                                    </div>
                                                                    <div class="col-12 col-sm-9">
                                                                        <div class="row">
                                                                            <div class="col-12 text-center text-sm-left">
                                                                                <h6 class="media-heading mb-0">
                                                                                    <?php echo $prenom_apprenant; ?><i class="cursor-pointer bx bxs-star text-warning ml-50 align-middle"></i>
                                                                                </h6>
                                                                                <small class="text-muted align-top"><?php echo $nom_apprenant; ?></small>
                                                                            </div>
                                                                            <div class="col-12 text-center text-sm-left">
                                                                                <div class="mb-1">
                                                                                    <span class="mr-1"><?php echo $matricule_apprenant ?>
                                                                                        <small></small></span>
                                                                                    <span class="mr-1"><?php $query = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                                                        $result = mysqli_fetch_assoc($query);
                                                                                                        echo $result['nom_classe']; ?>
                                                                                        <small></small></span>
                                                                                    <span class="mr-1"><?php echo $nom_niveau; ?>
                                                                                        <small></small></span>
                                                                                </div>
                                                                                <div>
                                                                                    <div class="badge badge-light-primary badge-round mr-1 mb-1" data-toggle="tooltip" data-placement="bottom" title="with 7% growth @valintini_007 is on top 5k">
                                                                                        <i class="cursor-pointer bx bx-check-shield"></i>
                                                                                    </div>
                                                                                    <div class="badge badge-light-warning badge-round mr-1 mb-1" data-toggle="tooltip" data-placement="bottom" title="last 55% growth @valintini_007 is on weedday">
                                                                                        <i class="cursor-pointer bx bx-badge-check"></i>
                                                                                    </div>
                                                                                    <div class="badge badge-light-success badge-round mb-1" data-toggle="tooltip" data-placement="bottom" title="got premium profile here">
                                                                                        <i class="cursor-pointer bx bx-award"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <!--  <button class="btn btn-sm d-none d-sm-block float-right btn-light-primary">
                                                                                    <i class="cursor-pointer bx bx-edit font-small-3 mr-50"></i><span>Edit</span>
                                                                                </button>
                                                                                <button class="btn btn-sm d-block d-sm-none btn-block text-center btn-light-primary">
                                                                                    <i class="cursor-pointer bx bx-edit font-small-3 mr-25"></i><span>Edit</span></button> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Basic details</h5>
                                                        <ul class="list-unstyled">
                                                            <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i><?php echo $adresse; ?>
                                                            </li>
                                                            <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i><?php echo $telephone; ?>
                                                            </li>
                                                            <li><i class="cursor-pointer bx bx-time mb-1 mr-50"></i><?php echo $date_academique; ?>
                                                            </li>
                                                        </ul>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6><small class="text-muted">Email adress</small></h6>
                                                                <p><?php echo $telephone; ?></p>
                                                            </div>
                                                            <div class="col-6">
                                                                <h6><small class="text-muted">Family adresse</small>
                                                                </h6>
                                                                <p><?php echo $contact_parentale; ?></p>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6><small class="text-muted">Bio</small></h6>
                                                                <p><?php echo $information_tierce; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- user profile nav tabs content ends -->
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