<?php require 'index_php.php';
include('phpqrcode/qrlib.php');
// delete previous qrcode
$dir = 'qrcode_saved';
array_map('unlink', glob("{$dir}*.png"));

// function for appreciation

function appreciation(float $value): string
{
    if ($value >= 18) {
        return "Excellent";
        # code...
    } elseif ($value < 18 and $value >= 16) {
        return "Very good";
        # code...
    } elseif ($value < 16 and $value >= 14) {
        return "Good";
        # code...
    } elseif ($value < 14 and $value > 11) {
        return "Quite well";
        # code...
    } elseif ($value == 10 or $value == 1) {
        return "Passable";
    } elseif ($value < 10 and $value >= 8) {
        return "Insufficient";
        # code...
    } elseif ($value < 8 and $value >= 5) {
        return "Poor";
        # code...
    } else {
        return "Very Poor";
    }
}
?>
<?php
if (isset($_POST['print_note'])) {
    $code_classe = base64_decode($_GET['ktsp']);
    $trnmae = $_POST['trnmae'];
    $code_exams1 = $_POST['s1'];
    $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '{$code_exams1}' ");
    $result = mysqli_fetch_assoc($query);
    $nom_exams1 = $result['nom_examen'];
    $code_exams2 = $_POST['s2'];
    $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '{$code_exams2}' ");
    $result = mysqli_fetch_assoc($query);
    $nom_exams2 = $result['nom_examen'];
    $id_niveau = $_POST['id_niveau'];
    $query = mysqli_query($database, "SELECT * FROM niveau WHERE id = '{$id_niveau}' ");
    $result = mysqli_fetch_assoc($query);
    $nom_niveau = $result['nom_niveau'];


    // code...
} else {
    header("Location: bulletin.php");
}

?>


<?php
$query = mysqli_query($database, "SELECT * FROM classe WHERE code_classe = '$code_classe' and id_niveau =  '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
while ($result = mysqli_fetch_assoc($query)) {
    $nom_classe = $result['nom_classe'];
    $query_1 = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' order by nom_apprenant ");
    while ($result_1 = mysqli_fetch_assoc($query_1)) {
        $matricule_apprenant = addslashes($result_1['matricule_apprenant']);
        $nom_apprenant = $result_1['nom_apprenant'];
        $prenom_apprenant = $result_1['prenom_apprenant'];
        $adresse = $result_1['adresse'];
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
            <meta name="author" content="carleii Dev">
            <title>Notes Reports | <?php echo $nom_classe . " " . $nom_niveau; ?></title>
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
            <div class="" style="margin-top: 100px;">
                <div class="">
                    <div class="row">
                        <div class="col-1">
                            <div class="user-profile-images">
                                <img src="logo_data/<?php echo "$logo" ?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="school logo" height="50" width="90">
                            </div>
                        </div>
                        <div class="col-11">
                            <center>
                                <span style="font-size : 21px">
                                    <h2><b><?php echo strtoupper($nom_etablissement); ?></b></h2>
                                </span>
                                <span style="font-size : 13px">
                                    <h5> <b> <?php echo strtoupper($nom_etablissement); ?> </b></h5>
                                </span>
                            </center>
                        </div>

                    </div>
                    <hr>
                    <center>
                        <h3><b>RELEVE DE NOTES / STUDENT ACADEMIC RECORD</b></h3>
                        <h4><b><?php echo $trnmae ?></b></h4>
                    </center>

                    <div class="row">
                        <div class="col-8">
                            <center>
                                <div class="media d-flex align-items-center mb-1">
                                    <span class="float-right" style="margin-left: 60px">
                                        <strong> ANNEE ACADEMIQUE / ACADEMIC YEAR</strong>
                                    </span>
                                    <div class="media-body ml-1">
                                        <h6 class="media-heading mb-0" style="text-align:justify;"><?php echo $date_academique; ?></< /h6>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <span class="float-right" style="margin-left: 60px">
                                        <strong>NOM ET PRENOM (S) (FIRST AND LAST NAME)</strong>
                                    </span>
                                    <div class="media-body ml-1">
                                        <h6 class="media-heading mb-0" style="text-align:justify;"><?php echo strtoupper($nom_apprenant . "  " . $prenom_apprenant); ?></h6>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <span class="float-right" style="margin-left: 60px">
                                        <strong>DATE ET LIEU DE NAISSANCE (DATE AND PLACE OF BIRTH)</strong>
                                    </span>
                                    <div class="media-body ml-1">
                                        <h6 class="media-heading mb-0" style="text-align:justify;"><?php echo $adresse; ?></h6>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <span class="float-right" style="margin-left: 60px">
                                        <strong><?php echo $retVal = ($statut == 1) ? "CLASSE (CLASS)" : "SPECIALITE (SPECIALITY)"; ?></strong>
                                    </span>
                                    <div class="media-body ml-1">
                                        <h6 class="media-heading mb-0" style="text-align:justify;"><?php echo $nom_classe; ?></h6>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <span class="float-right" style="margin-left: 60px">
                                        <strong>NIVEAU (LEVEL)</strong>
                                    </span>
                                    <div class="media-body ml-1">
                                        <h6 class="media-heading mb-0" style="text-align:justify; "><?php echo $nom_niveau; ?></h6>
                                    </div>
                                </div>

                                <div class="media d-flex align-items-center mb-1">
                                    <span class="float-right" style="margin-left: 60px">
                                        <strong> MATRICULE (REGISTRATION NUMBER)</strong>
                                    </span>
                                    <div class="media-body ml-1">
                                        <h6 class="media-heading mb-0" style="text-align:justify;"><?php echo $matricule_apprenant; ?></h6>
                                    </div>
                                </div>

                            </center>


                        </div>
                        <div class="col-4">
                            <?php
                            // how to save PNG codes to server

                            $tempDir = "qrcode_saved/";

                            $codeContents = $matricule_apprenant;

                            // we need to generate filename somehow,
                            // with md5 or with database ID used to obtains $codeContents...
                            $fileName = base64_encode($codeContents) . '.png';
                            // $fileName = uniqid() . base64_encode($codeContents) . '.png';
                            $pngAbsoluteFilePath = $tempDir . $fileName;
                            $urlRelativeFilePath = $tempDir . $fileName;

                            // generating
                            if (!file_exists($pngAbsoluteFilePath)) {
                                QRcode::png($codeContents, $pngAbsoluteFilePath, "Q");
                            }

                            // displaying
                            echo '<img height="200" width="200" src="' . $urlRelativeFilePath . '" />';
                            ?>
                        </div>
                    </div>
                    <section id="headers">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table-bordered" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="9" style="justify-content: center;">
                                                                <center><?php echo strtoupper($trnmae) ?></center>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th style="text-align: center;" rowspan="2">Sujets / <br> subjects</th>
                                                            <th style="text-align: center;" colspan="3"><?php echo $nom_exams1; ?> </th>
                                                            <th style="text-align: center;" colspan="3"><?php echo $nom_exams2; ?></th>
                                                            <th style="text-align: center;" rowspan="2">Moyenne / <br> Average </th>
                                                            <th style="text-align: center;" rowspan="2">Observations</th>
                                                        </tr>
                                                        <tr>
                                                            <th style="text-align: center;">NOTE</th>
                                                            <th style="text-align: center;">CREDIT/COEF</th>
                                                            <th style="text-align: center;">TOTAL</th>
                                                            <th style="text-align: center;">NOTE</th>
                                                            <th style="text-align: center;">CREDIT/COEF</th>
                                                            <th style="text-align: center;">TOTAL</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $somme_de_cours = 0;
                                                        $somme_de_credit = 0;
                                                        $somme_notes1 = 0;
                                                        $somme_notes2 = 0;
                                                        $somme_notes1Xcredit = 0;
                                                        $somme_notes2Xcredit = 0;
                                                        $note_trimestre = 0;
                                                        $query0 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                        while ($result0 = mysqli_fetch_assoc($query0)) {
                                                            $code_discipline = addslashes($result0['code_discipline']);
                                                            $credit_discipline = $result0['heure'];
                                                            $somme_de_credit = $somme_de_credit + $credit_discipline;
                                                            $somme_de_cours++;
                                                            if (1) {
                                                                //get the name
                                                                $querya = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $resulta = mysqli_fetch_assoc($querya);
                                                                $nom_discipline = $resulta['nom_discipline'];
                                                                //get note controle continue
                                                                $query00 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '{$code_exams1}' AND code_discipline = '$code_discipline' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $result00 = mysqli_fetch_assoc($query00);
                                                                $notes1 = (isset($result00['note'])) ? $result00['note'] : 0;
                                                                $somme_notes1 += $notes1;
                                                                //get note normalizer_normalize
                                                                $query000 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '{$code_exams2}' AND code_discipline = '$code_discipline' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                                                $result000 = mysqli_fetch_assoc($query000);
                                                                $notes2 = (isset($result000['note'])) ? $result000['note'] : 0;
                                                                $somme_notes2 += $notes2;
                                                                // note du trimestre de la discipline
                                                                $note_trimestre = ($notes1 + $notes2) / 2;

                                                        ?>
                                                                <tr>
                                                                    <td style="text-transform: uppercase;"><?php echo $nom_discipline; ?></td>

                                                                    <td><?php echo $notes1; ?></td>
                                                                    <td><?php echo $credit_discipline; ?></td>
                                                                    <td><?php echo $notes1 * $credit_discipline ?></td>

                                                                    <td><?php echo $notes2; ?></td>
                                                                    <td><?php echo $credit_discipline; ?></td>
                                                                    <td><?php echo $notes2 * $credit_discipline ?></td>
                                                                    <td><?php echo $note_trimestre ?></td>
                                                                    <td><?php echo appreciation($note_trimestre) ?></td>
                                                                </tr>

                                                        <?php

                                                            }
                                                            # code...
                                                            // code...
                                                        }
                                                        ?>
                                                    </tbody>

                                                    <tfoot>
                                                        <tr>
                                                            <th style="text-align: center;">Sujets / <br> subjects</th>
                                                            <th style="text-align: center;" colspan="3"><?php echo $nom_exams1; ?> </th>
                                                            <th style="text-align: center;" colspan="3"><?php echo $nom_exams2; ?></th>
                                                            <th style="text-align: center;">Moyenne / <br> Average </th>
                                                            <th style="text-align: center;">Observations</th>
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
                    <!--/ Complex headers table -->
                    <div class="row">
                        <div class="col-7">
                            <center>
                                <div class="media d-flex align-items-center mb-1">
                                    <a class="float-right" style="margin-left: 60px">
                                        Moyenne générale (general average):
                                    </a>
                                    <div class="media-body ml-1">
                                        <h5 class="media-heading mb-0">
                                            <?php echo $retVal = ($nombre_ds1 == 0) ? 0 : "Semestre 1: " . ($nbrdis30s1 / $nombre_ds1) . "<br>"; ?>
                                            <?php echo $retVal = ($nombre_ds2 == 0) ? 0 : "Semestre 2: " . ($nbrdis30s2 / $nombre_ds2) . "<br>"; ?>
                                            <?php  ?>
                                            <?php if ($nombre_ds1 == 0) {
                                                $nombre_ds1 = 1;
                                                // code...
                                            };
                                            if ($nombre_ds2 == 0) {
                                                $nombre_ds2 = 1;
                                                // code...
                                            };
                                            echo "Moyenne general/ General Average: " . ((($nbrdis30s1 / $nombre_ds1) + ($nbrdis30s2 / $nombre_ds2)) / 2); ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <a href="" class="float-right" style="margin-left: 60px">
                                        MENTION / RESULT CLASSIFICATION:
                                    </a>
                                    <div class="media-body ml-1">
                                        <h4 class="media-heading mb-0">
                                            <?php

                                            $my = (($nbrdis30s1 / $nombre_ds1) + ($nbrdis30s2 / $nombre_ds2)) / 2;
                                            if ($my <= 9) {
                                                echo "Mediocre";
                                                // code...
                                            } elseif ($my == 10) {
                                                echo "Passable/Pass";
                                                // code...
                                            } elseif ($my <= 13 and $my >= 11) {
                                                echo "Assez Bien";
                                                // code...
                                            } elseif ($my > 13 and $my <= 15) {
                                                echo "Bien/Good";
                                                // code...
                                            } elseif ($my > 15 and $my <= 18) {
                                                echo "Tres Bien/ Very Good";
                                                // code...
                                            } else {
                                                echo "Excellent";
                                            }
                                            ?></h4>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <a href="" class="float-right" style="margin-left: 60px">
                                        <?php
                                        if (($nombre_ds1 == 0) and ($nombre_ds2 == 0)) {
                                            $nombre_ds2 = 1;
                                            // code...
                                        }

                                        ?>
                                        % DE VALIDATION (percentage of validation): <?php echo (100 * $noval1) / ($nombre_ds1 + $nombre_ds2); ?>
                                    </a>
                                    <div class="media-body ml-1">
                                        <h4 class="media-heading mb-0"> <?php  ?></h4>
                                    </div>
                                </div><br>
                                <b><i><u>NB: si la descision est "Validé",toutes les unités de valeur non validées seront reprises au niveau suivant; sinon reprise du niveau en cours. <br> All non validated courses will be recitted next level if "Validated"; else restart the actual level the next year. </u></i></b>
                            </center>

                        </div>
                        <div class="col-5">
                            <center>
                                <b><small>Légende(key): Va : validé(validated)<br> Nv: Non validé (non validated) </small></b>
                                <div class="media d-flex align-items-center mb-1">
                                    <a href="" class="float-right" style="margin-left: 60px">
                                        Decision/decision:
                                    </a>
                                    <div class="media-body ml-1">
                                        <h4 class="media-heading mb-0"><?php echo $retVal = (((100 * $noval1) / ($nombre_ds1 + $nombre_ds2)) >= 60) ? "validated" : "Rejected"; ?></h4>
                                    </div>
                                </div>
                                <div class="media d-flex align-items-center mb-1">
                                    <a href="" class="float-right" style="margin-left: 60px">
                                        <?php echo  date("D-d-M-Y"); ?> <br>
                                        <b>Le chef d'etablissement</b><br>
                                        The director <br><br><br><br>
                                        <b>XXXXX</b>
                                    </a>
                                </div>
                            </center>
                        </div>

                    </div>
                    <!-- <div class="row" style="position: fixed; bottom:0; width:100%">
                        <div class="col-1">
                            <div class="user-profile-images">
                                <img src="logo_data/<?php echo "$logo "?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="user profile image" height="57" width="50">
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


                </div>
            </div>
            <!-- user profile heading section ends -->
            <?php require 'footer.php' ?>
            <!-- END: Content-->
            <p style="page-break-after: always;"></p>

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
            <?php $nbrdis30s1 = 0;
            $nbrdis30s2 = 0;
            $countcrds30s1 = 0;
            $countcrds30s2 = 0 ?>

        </body>
        <!-- END: Body-->

        </html>

    <?php
        // code...
    }
    ?>


<?php
    // code...
}
?>
<script type="text/javascript">
    window.print();
</script>