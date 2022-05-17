<?php require 'index_php.php'; ?>
<?php
if (isset($_POST['print_note'])) {
  $_cent_s130 = $_POST['30_cent_s1'];
  $_cent_s170 = $_POST['70_cent_s1'];
  //get data semestre 1
  $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$_cent_s130' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
  $result = mysqli_fetch_assoc($query);
  $exam30s1 = $result['nom_examen'];
  $notev30s1 = $result['note_valid'];
  $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$_cent_s170' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
  $result = mysqli_fetch_assoc($query);
  $exam70s1 = $result['nom_examen'];
  $notev70s1 = $result['note_valid'];
  $nbrdis30s1 = 0;
  $countcrds30s1 = 0;
  $nbrdis70s1 = 0;
  $countcrds70s1 = 0;
  //end get data semestre 1

  $_cent_s230 = $_POST['30_cent_s2'];
  $_cent_s270 = $_POST['70_cent_s2'];
  //get data semestre 2
  $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$_cent_s230' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
  $result = mysqli_fetch_assoc($query);
  $exam30s2 = $result['nom_examen'];
  $notev30s2 = $result['note_valid'];
  $query = mysqli_query($database, "SELECT * FROM examen WHERE code_examen = '$_cent_s270' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
  $result = mysqli_fetch_assoc($query);
  $exam70s2 = $result['nom_examen'];
  $notev70s2 = $result['note_valid'];
  $nbrdis30s2 = 0;
  $countcrds30s2 = 0;
  $nbrdis70s2 = 0;
  $countcrds70s2 = 0;
  //end get data semestre 2
  $id_niveau = $_POST['id_niveau'];
  //get niveau date_academique
  $query = mysqli_query($database, "SELECT * FROM niveau WHERE id = '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
  $result = mysqli_fetch_assoc($query);
  $nom_niveau = $result['nom_niveau'];
  // code...
} else {
  header("Location: bulletin.php");
}

?>
<?php
$query = mysqli_query($database, "SELECT * FROM classe WHERE id_niveau =  '$id_niveau' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
while ($result = mysqli_fetch_assoc($query)) {
  $code_classe = addslashes($result['code_classe']);
  $nom_classe = $result['nom_classe'];
  $query_1 = mysqli_query($database, "SELECT * FROM apprenant WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
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
      <meta name="author" content="PIXINVENT">
      <title>Notes Reports | <?php echo $nom_etablissement . " "; ?></title>
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
                <img src="logo_data/<?php echo "$logo" ?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="user profile image" height="50" width="90">
              </div>
            </div>
            <div class="col-11">
              <center>
                <span style="font-size : 13px">
                  <h4><b><?php echo "$nom_etablissement" ?></b></h2>
                </span>
                <span style="font-size : 13px">
                  <h5> <b> <?php echo "$nom_etablissement" ?> </b></h2>
                </span>
              </center>
            </div>

          </div>
          <hr>

          <center>
            <h5><b>RELEVE DE NOTES / STUDENT ACADEMIC RECORD</b></h3>
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
                  <strong>NOMS ET PRENOMS (NAME AND FIRST NAME)</strong>
                </span>
                <div class="media-body ml-1">
                  <h6 class="media-heading mb-0" style="text-align:justify;"><?php echo $nom_apprenant . "  " . $prenom_apprenant; ?></h6>
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
                  <strong>SPECIALITE (SPECIALITY)</strong>
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
                              <th colspan="5" style="justify-content: center;">Semestre 1</th>
                            </tr>
                            <tr>
                              <th style="text-align: center;">Sujets / <br> subjects</th>
                              <th style="text-align: center;"><?php echo $exam30s1; ?> </th>
                              <th style="text-align: center;"><?php echo $exam70s1; ?></th>
                              <th style="text-align: center;">Moyenne / <br> Average </th>
                              <th style="text-align: center;">Observations</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $nombre_ds1 = 0;
                            $nombre_ds2 = 0;
                            $noval1 = 0;
                            $query0 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                            while ($result0 = mysqli_fetch_assoc($query0)) {
                              $code_discipline = addslashes($result0['code_discipline']);
                              //check if the courses is choosen for the first semestre
                              while ($index_tab = key($_POST)) {
                                if ($index_tab == str_replace(" ", "_", $code_discipline) . "s1") {
                                  //get the name
                                  $querya = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                  $resulta = mysqli_fetch_assoc($querya);
                                  $nom_discipline = $resulta['nom_discipline'];
                                  //get note controle continue
                                  $query00 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$_cent_s130' AND code_discipline = '$code_discipline' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                  $result00 = mysqli_fetch_assoc($query00);
                                  $note30 = (isset($result00['note'])) ? $result00['note'] : 0;
                                  //get note normalizer_normalize
                                  $query000 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$_cent_s170' AND code_discipline = '$code_discipline' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                  $result000 = mysqli_fetch_assoc($query000);
                                  $note70 = (isset($result000['note'])) ? $result000['note'] : 0;
                                  if ($note30 != 0 or $note70 != 0) {
                                    $nombre_ds1 += 1;
                                    //cumuler les moyennes
                                    $nbrdis30s1 += ($note30) * 30 / 100 + ($note70) * 70 / 100;
                                    if ((($note30) * 30 / 100 + ($note70) * 70 / 100) >= 10) {
                                      $noval1 += 1;
                                      // code...
                                    }
                            ?>
                                    <tr>
                                      <td style="text-transform: uppercase;"><?php echo $nom_discipline; ?></td>
                                      <td><?php echo $note30; ?></td>
                                      <td><?php echo $note70; ?></td>
                                      <td><?php echo ($note30) * 30 / 100 + ($note70) * 70 / 100; ?></td>
                                      <td><?php echo $retVal = ((($note30) * 30 / 100 + ($note70) * 70 / 100) >= 10) ? "Va" : "NV"; ?></td>
                                    </tr>

                            <?php

                                  }
                                }
                                next($_POST);
                                # code...
                              }
                              reset($_POST);
                              // code...
                            }
                            ?>
                          </tbody>

                          <tfoot>
                            <tr>
                              <th colspan="5" style="justify-content: center;">Semestre 2</th>
                            </tr>
                            <tr>
                              <th style="text-align: center;">Sujets / <br> subjects</th>
                              <th style="text-align: center;"><?php echo $exam30s2; ?> </th>
                              <th style="text-align: center;"><?php echo $exam70s2; ?></th>
                              <th style="text-align: center;">Moyenne / <br> Average </th>
                              <th style="text-align: center;">Observations</th>
                            </tr>
                            <?php
                            $query0 = mysqli_query($database, "SELECT * FROM discipline_classe WHERE code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                            while ($result0 = mysqli_fetch_assoc($query0)) {
                              $code_discipline = addslashes($result0['code_discipline']);
                              //check if the courses is choosen for the first semestre
                              while ($index_tab = key($_POST)) {
                                if ($index_tab == str_replace(" ", "_", $code_discipline) . "s2") {
                                  //get the name
                                  $querya = mysqli_query($database, "SELECT * FROM discipline WHERE code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                  $resulta = mysqli_fetch_assoc($querya);
                                  $nom_discipline = $resulta['nom_discipline'];

                                  //get note controle continue
                                  $query00 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$_cent_s230' AND code_discipline = '$code_discipline' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                  $result00 = mysqli_fetch_assoc($query00);
                                  $note30 = (isset($result00['note'])) ? $result00['note'] : 0;
                                  //get note normalizer_normalize
                                  $query000 = mysqli_query($database, "SELECT * FROM note WHERE code_examen = '$_cent_s270' AND code_discipline = '$code_discipline' AND matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
                                  $result000 = mysqli_fetch_assoc($query000);
                                  $note70 = (isset($result000['note'])) ? $result000['note'] : 0;
                                  if ($note30 != 0 or $note70 != 0) {
                                    $nombre_ds2 += 1;
                                    //cumuler les moyennes
                                    $nbrdis30s2 += ($note30) * 30 / 100 + ($note70) * 70 / 100;
                                    if ((($note30) * 30 / 100 + ($note70) * 70 / 100) >= 10) {
                                      $noval1 += 1;
                                      // code...
                                    }
                            ?>
                                    <tr>
                                      <td style="text-transform: uppercase;"><?php echo $nom_discipline; ?></td>
                                      <td><?php echo $note30; ?></td>
                                      <td><?php echo $note70; ?></td>
                                      <td><?php echo (($note30) * 30 / 100 + ($note70) * 70 / 100); ?></td>
                                      <td><?php echo $retVal = ((($note30) * 30 / 100 + ($note70) * 70 / 100) >= 10) ? "Va" : "NV"; ?></td>
                                    </tr>
                            <?php
                                  }
                                }
                                next($_POST);
                                # code...
                              }
                              reset($_POST);

                              // code...
                            }
                            ?>
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
                <b><i><u>NB: Toutes les unités de valeur non validées seront reprises en 2 ieme année <br> All non validated courses will be recitted in level 200 </u></i></b>
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
                    BAFOUSSAM, le <?php echo  date("D-d-M-Y"); ?> <br>
                    <b>Le chef d'etablissement</b><br>
                    The director <br><br><br><br>
                    <b>XXXXX</b>
                  </a>
                </div>
              </center>
            </div>

          </div>
          <hr>
          <div class="row">
            <div class="col-1">
              <div class="user-profile-images">
                <img src="logo_data/<?php echo "$logo" ?>" style="margin-left: 50px;" class="user-profile-image rounded" alt="user profile image" height="57" width="50">
              </div>
            </div>
            <div class="col-11">
              <center>
                <span style="font-size: 20px;">
                  <h6 style="color : red"><b><i>Le pôle de l'execellence Universitaire pour la formation Professionnelle</i></b></h6>
                </span>
                <span style="font-size: 20px;">
                  <!-- <h6><b><i>Campus de Bafoussam / Entrée de la ville Email: <i>tchonanguniversity@yahoo.com</i> Campus de Douala / Village, face PICASO</i></b></h6> -->
                </span>
                <span style="font : cursive 20px">
                  <h6><b><i><strong>Tel:xxxxx. web</strong>www.xxx.org <strong>Tel:xxxxx.</strong></i></b></h6>
                </span>

              </center>
            </div>

          </div>


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