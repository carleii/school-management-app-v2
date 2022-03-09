<?php
require_once 'class_package.php';
require_once 'root.php';
$message = "";
//enregistrement d'un nouveau cloud
if (isset($_POST['save_cloud'])) {
   $name = addslashes(htmlentities($_POST['name']));
   $pssw = addslashes(htmlentities($_POST['pssw']));
   $type = addslashes(htmlentities($_POST['type']));
   $c_c = $user_->get_u_code() . "cld" . $pssw . $name . random_int(0, 999999999);
   $code_allow = $c_c . "allow";
   if ($type == 0) {
      //enregistrement du cloud
      $query = mysqli_query($db, "INSERT INTO cldcloud VALUES(
         '$code_user',
         null,
         '$c_c',
         '$name',
         '$pssw',
         '$last_view',
         0
      )");
      //appartenance
      $query = mysqli_query($db, "INSERT INTO clduser_part_of_cloud VALUES(
         '$code_user',
         '$c_c',
         1,
         0,
         '$last_view'
      ) ");

      //creation du repertoire root et des premiers dossier
      $code_folder_home = $c_c . "home_fold";
      $code_folder_doc = $c_c . "allow#";
      $code_folder_down = $c_c . "down_fold";
      $code_folder_img = $c_c . "img_fold";
      $code_folder_wks = $c_c . "wks_fold";
      $code_folder_mus = $c_c . "mus_fold";
      $code_folder_fav = $c_c . "fav_fold";
      $root = "root" . $c_c;
      $user_code = $user_->get_u_code();
      $query = mysqli_query($db, "
         INSERT INTO cldfolder VALUES
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$root',
            'root',
            '$last_view',
            'root Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_fav',
            'Favorite',
            '$last_view',
            'Favorite Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_mus',
            'Music',
            '$last_view',
            'Music Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_wks',
            'Workspace',
            '$last_view',
            'Workspace Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_home',
            'office',
            '$last_view',
            'Home Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_doc',
            'Documents',
            '$last_view',
            'Docs Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_down',
            'Downloads',
            '$last_view',
            'Downloads Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_img',
            'Images',
            '$last_view',
            'Images Folder',
            1
         )
      ");
      // code...
   } else {
      //enregistrement du cloud
      $query = mysqli_query($db, "INSERT INTO cldcloud VALUES(
         '$code_user',
         null,
         '$c_c',
         '$name',
         '$pssw',
         '$last_view',
         1
      )");

      //appartenance
      $query = mysqli_query($db, "INSERT INTO clduser_part_of_cloud VALUES(
         '$code_user',
         '$c_c',
         1,
         0,
         '$last_view'
      ) ");

      //creation du repertoire root et des premiers dossier
      $code_folder_home = $c_c . "home_fold";
      $code_folder_doc = $c_c . "allow#";
      $code_folder_down = $c_c . "down_fold";
      $code_folder_img = $c_c . "img_fold";
      $code_folder_wks = $c_c . "wks_fold";
      $code_folder_mus = $c_c . "mus_fold";
      $code_folder_fav = $c_c . "fav_fold";
      $root = "root" . $c_c;
      $user_code = $user_->get_u_code();
      $query = mysqli_query($db, "
         INSERT INTO cldfolder VALUES
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$root',
            'root',
            '$last_view',
            'root Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_fav',
            'Favorite',
            '$last_view',
            'Favorite Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_mus',
            'Music',
            '$last_view',
            'Music Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_wks',
            'Workspace',
            '$last_view',
            'Workspace Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_home',
            'office',
            '$last_view',
            'Home Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_doc',
            'Documents',
            '$last_view',
            'Docs Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_down',
            'Downloads',
            '$last_view',
            'Downloads Folder',
            1
         ),
         (
            null,
            '$c_c',
            '$user_code',
            '$root',
            null,
            '$code_folder_img',
            'Images',
            '$last_view',
            'Images Folder',
            1
         )
      ");
      //enregistrement des niveaux d'acces
      $privc = 0;
      $privd = 0;
      $privr = 0;
      $privs = 0;
      $privw = 0;
      if (isset($_POST['privc'])) {
         $privc = 1;
         // code...
      };
      if (isset($_POST['privd'])) {
         $privd = 1;
         // code...
      };
      if (isset($_POST['privr'])) {
         $privr = 1;
         // code...
      };
      if (isset($_POST['privs'])) {
         $privs = 1;
         // code...
      };
      if (isset($_POST['privw'])) {
         $privw = 1;
         // code...
      };

      $query = mysqli_query($db, "INSERT INTO cldallow VALUES (
         null,
         null,
         '$c_c',
         null,
         '$code_allow',
         '$privr',
         '$privw',
         '$privc',
         0,
         '$privs',
         1
      )");

      // code...
   }
   //creation du cookie du cloud
   setcookie('c_cloud', base64_encode($c_c), time() + 60 * 15);
   header("location: ./");
   exit();
   // code...
}

//connection à un cloud
if (isset($_POST['connect_cloud'])) {
   $code_cloud = addslashes(htmlentities($_POST['cloud_name']));
   $pssw = addslashes(htmlentities($_POST['cloud_pssw']));
   $query = mysqli_query($db, "SELECT * FROM cldcloud WHERE CODE_CLOUD = '$code_cloud' AND PSSW = '$pssw'");
   if (mysqli_num_rows($query) == 1) {
      $result = mysqli_fetch_assoc($query);
      $type = $result['TYPE'];
      if ($type == 1) {
         $query = mysqli_query($db, "
            SELECT * FROM clduser_part_of_cloud WHERE CODE_USER = '$code_user' AND CODE_CLOUD = '$code_cloud'
         ");
         if (mysqli_num_rows($query) == 0) {
            $message .= "
            <div class=\"message\">
              <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", Your connection is okay</p>
              <p class=\"bg-light-cyan\">But administrator has'nt validated your account yet. Please contact him or wait a bit</p>
            </div>
            ";
            // code...
         } else {
            $result = mysqli_fetch_assoc($query);
            if ($result['BANNED'] == 0) {
               $query = mysqli_query($db, "UPDATE clduser_part_of_cloud SET LAST_VIEW = '$last_view' WHERE CODE_USER = '$code_user' AND CODE_CLOUD = '$cl_code' ");
               setcookie('c_cloud', base64_encode($code_cloud), time() + 60 * 15);
               header("location: ./");
               // code...
            } else {
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", Your account have been suspended for this Cloud. contact the administrator</p>
                 <p class=\"bg-light-cyan\"></p>
               </div>
               ";
               // code...
            }

            // code...
         }
         // code...
      } else {
         setcookie('c_cloud', base64_encode($code_cloud), time() + 60 * 15);
         header("location: ./");
      }
      // code...
   } else {
      $message .= "
      <div class=\"message\">
        <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", the Password is wrong</p>
        <p class=\"bg-light-cyan\">Try again if you remember else contact the administrator</p>
      </div>
      ";
   }
   // code...
}

//creation d'un dossier
if (isset($_POST['create_folder'])) {
   $folder_name = str_replace("root", "_", addslashes(mb_strtolower(htmlentities($_POST['folder_name']))));
   $folder_des = addslashes(htmlentities($_POST['folder_des']));
   $code_folder = $user_->get_u_code() . $folder_name . $code_lib . random_int(0, 999999999);
   if ($folder_name == "root") {
      $message .= "
      <div class=\"message\">
        <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", You cannot use root has folder name</p>
        <p class=\"bg-light-cyan\">Please try with a different name. </p>
      </div>
      ";
      // code...
   } else {
      if (isset($cloud) == false) {
         if (isset($folder) == false or (isset($folder) == true and $folder->get_name() == "root")) {
            $query = mysqli_query($db, "SELECT CODE_FOLDER FROM cldfolder WHERE NAME = 'root' AND CODE_USER = '$code_user' AND CODE_LIB = '$code_lib' ");
            $result = mysqli_fetch_assoc($query);
            $code_folder_in = $result['CODE_FOLDER'];
            //verification qu'un nom indentique existe deja
            $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE NAME = '$folder_name' AND CODE_USER = '$code_user' AND CODE_LIB = '$code_lib' AND CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder_in' ");

            if (mysqli_num_rows($query) == 0) {
               $query = mysqli_query($db, "INSERT INTO cldfolder VALUES (
                  '$code_lib',
                  null,
                  '$code_user',
                  '$code_folder_in',
                  null,
                  '$code_folder',
                  '$folder_name',
                  '$last_view',
                  '$folder_des',
                  1
               )");
               $code_folder_e = base64_encode($code_folder);
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\">Done!</p>
                 <p class=\"bg-light-cyan\"> Open folder direclty here: <a href ='./?f_ktsp=$code_folder_e'>$folder_name</a></p>
               </div>
               ";
               // code...
            } else {
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", This folder already exist at this place</p>
                 <p class=\"bg-light-cyan\">Please try with a different name. </p>
               </div>
               ";
               // code...
            }


            // code...
         } elseif (isset($folder) == true and $folder->get_name() !== "root") {
            $code_folder_in = $folder->get_code_folder();
            //verification qu'un nom indentique existe deja
            $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE NAME = '$folder_name' AND CODE_USER = '$code_user' AND CODE_LIB = '$code_lib' AND CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder_in' ");

            if (mysqli_num_rows($query) == 0) {
               $query = mysqli_query($db, "INSERT INTO cldfolder VALUES (
                  '$code_lib',
                  null,
                  '$code_user',
                  '$code_folder_in',
                  null,
                  '$code_folder',
                  '$folder_name',
                  '$last_view',
                  '$folder_des',
                  1
               )");
               $code_folder_e = base64_encode($code_folder);
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\">Done!</p>
                 <p class=\"bg-light-cyan\"> Open folder direclty here: <a href ='./?f_ktsp=$code_folder_e'>$folder_name</a></p>
               </div>
               ";
               // code...
            } else {
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", This folder already exist at this place</p>
                 <p class=\"bg-light-cyan\">Please try with a different name. </p>
               </div>
               ";
               // code...
            }
            // code...
         }
         // code...
      } else {
         if (($cloud->get_type() == 0 or ($cloud->get_type() == 1 and $user_->get_u_role() == 1) or ($cloud->get_type() == 1 and $user_->get_u_role() == 0 and $cloud->get_create() == 1))) {
            if (isset($folder) == false or (isset($folder) == true and $folder->get_name() == "root")) {
               $query = mysqli_query($db, "SELECT CODE_FOLDER FROM cldfolder WHERE NAME = 'root' AND CODE_CLOUD = '$cl_code' ");
               $result = mysqli_fetch_assoc($query);
               $code_folder_in = $result['CODE_FOLDER'];
               //verification qu'un nom indentique existe deja
               $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE NAME = '$folder_name'  AND CODE_CLOUD = '$cl_code' AND CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder_in' ");

               if (mysqli_num_rows($query) == 0) {
                  $query = mysqli_query($db, "INSERT INTO cldfolder VALUES (
                     null,
                     '$cl_code',
                     '$code_user',
                     '$code_folder_in',
                     null,
                     '$code_folder',
                     '$folder_name',
                     '$last_view',
                     '$folder_des',
                     1
                  )");
                  $code_folder_e = base64_encode($code_folder);
                  $message .= "
                  <div class=\"message\">
                    <p class=\"bg-light-cyan\">Done!</p>
                    <p class=\"bg-light-cyan\"> Open folder direclty here: <a href ='./?f_ktsp=$code_folder_e'>$folder_name</a></p>
                  </div>
                  ";
                  // code...
               } else {
                  $message .= "
                  <div class=\"message\">
                    <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", This folder already exist at this place</p>
                    <p class=\"bg-light-cyan\">Please try with a different name. </p>
                  </div>
                  ";
                  // code...
               }
               // code...
            } elseif (isset($folder) == true and $folder->get_name() !== "root") {

               $code_folder_in = $folder->get_code_folder();
               //verification qu'un nom indentique existe deja
               $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE NAME = '$folder_name'  AND CODE_CLOUD = '$cl_code' AND CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder_in' ");

               if (mysqli_num_rows($query) == 0) {
                  $query = mysqli_query($db, "INSERT INTO cldfolder VALUES (
                     null,
                     '$cl_code',
                     '$code_user',
                     '$code_folder_in',
                     null,
                     '$code_folder',
                     '$folder_name',
                     '$last_view',
                     '$folder_des',
                     1
                  )");
                  $code_folder_e = base64_encode($code_folder);
                  $message .= "
                  <div class=\"message\">
                    <p class=\"bg-light-cyan\">Done!</p>
                    <p class=\"bg-light-cyan\"> Open folder direclty here: <a href ='./?f_ktsp=$code_folder_e'>$folder_name</a></p>
                  </div>
                  ";
                  // code...
               } else {
                  $message .= "
                  <div class=\"message\">
                    <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", This folder already exist at this place</p>
                    <p class=\"bg-light-cyan\">Please try with a different name. </p>
                  </div>
                  ";
                  // code...
               }
               // code...
            }
            // code...
         } else {
            $message .= "
            <div class=\"message\">
              <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ",</p>
              <p class=\"bg-light-cyan\">Members of this Cloud can't create file or folder inside. Contact the administrator. </p>
            </div>
            ";
            // code...
         }
         // code...
      }

      // code...
   }
   // code...
}

//creation d'un fichier
if (isset($_POST['new_file'])) {
   $file_name = addslashes(str_replace(" ", '_', $_FILES['file_name']['name']));
   $file_name_mv = str_replace(" ", '_', $_FILES['file_name']['name']);
   $file = explode(".",  $file_name);
   $name = str_replace(" ", '_', $file[0]);
   $icon = null;
   switch ($file[1]) {
      case 'exe':
         $icon = "<i class=\"fa fa-5x fa-file-exe-o text-primary\"></i>";
      case 'pdf':
         $icon = "<i class=\"fa fa-5x fa-file-pdf-o text-primary\"></i>";
         // code...
         break;
      case 'docx':
         $icon = "<i class=\"fa fa-5x fa-file-word-o text-primary\"></i>";
         // code...
         break;
      case 'mp4':
         $icon = "<i class=\"fa fa-5x fa-file-video-o text-primary\"></i>";
         // code...
         break;
      case 'mp3':
         $icon = "<i class=\"fa fa-5x fa-file-audio-o text-primary\"></i>";
         // code...
         break;
      case 'png':
         $icon = "<i class=\"fa fa-5x fa-file-image-o text-primary\"></i>";
         // code...
         break;
      case 'JPG':
         $icon = "<i class=\"fa fa-5x fa-file-image-o text-primary\"></i>";
         // code...
         break;
      case 'JPEG':
         $icon = "<i class=\"fa fa-5x fa-file-image-o text-primary\"></i>";
         // code...
         break;
      case 'csv':
         $icon = "<i class=\"fa fa-5x fa-file-excel-o text-primary\"></i>";
         // code...
         break;
      case 'xlsx':
         $icon = "<i class=\"fa fa-5x fa-file-excel-o text-primary\"></i>";
         // code...
         break;
      default:
         $icon = "<i class=\"fa fa-5x fa-file-text-o text-primary\"></i>";
         // code...
         break;
   }
   $path = $_FILES['file_name']['tmp_name'];
   $size = $_FILES['file_name']['size'] / (1024 * 1024);
   $query1 = false;
   $code_file = str_replace(" ", "_", $user_->get_l_name() . $name . "#file" . random_int(0, 999999999));
   $code_file_e = base64_encode($code_file);

   if (isset($cloud) == false) {
      if (isset($folder) == false or (isset($folder) == true and $folder->get_name() == "root")) {
         //verification de l'existence d'un fichier au meme nom
         $query = mysqli_query($db, "SELECT * FROM cldfile WHERE PATH_ = '$file_name' AND CODE_USER = '$code_user' ");
         if (mysqli_num_rows($query) == 0) {
            $query = mysqli_query($db, "SELECT CODE_FOLDER FROM cldfolder WHERE NAME = 'root' AND CODE_USER = '$code_user' AND CODE_LIB = '$code_lib' ");
            $result = mysqli_fetch_assoc($query);
            $code_folder_in = $result['CODE_FOLDER'];
            $query1 = mysqli_query($db, "INSERT INTO cldfile VALUES(
               '$code_user',
               '$code_folder_in',
               null,
               null,
               '$code_file',
               '$name',
               '$size',
               1,
               '$icon',
               '$file_name',
               1,
               '$last_view',
               '$code_user',
               '$last_view',
               null

            )");
            // code...
         } else {
            $message .= "
            <div class=\"message\">
              <p class=\"bg-light-cyan\">Hi " . $user_->get_f_name() . ",</p>
              <p class=\"bg-light-cyan\">A file with the same name already existe at this place.please try with another name.</p>
            </div>
            ";
            // code...
         }
         // code...
      } elseif (isset($folder) == true and $folder->get_name() !== "root") {
         $code_folder_in = $folder->get_code_folder();
         //verification que le fichier n'existe pas deja dans le dossier
         $query = mysqli_query($db, "SELECT * FROM cldfile WHERE PATH_ = '$file_name' AND CODE_USER = '$code_user' AND CODE_FOLDER = '$code_folder_in' ");

         if (mysqli_num_rows($query) == 0) {
            $query1 = mysqli_query($db, "INSERT INTO cldfile VALUES(
               '$code_user',
               '$code_folder_in',
               null,
               null,
               '$code_file',
               '$name',
               '$size',
               1,
               '$icon',
               '$file_name',
               1,
               '$last_view',
               '$code_user',
               '$last_view',
               null

            )");
            // code...
         } else {
            $message .= "
            <div class=\"message\">
              <p class=\"bg-light-cyan\">Hi " . $user_->get_f_name() . ",</p>
              <p class=\"bg-light-cyan\">A file with the same name already existe at this place.please try with another name.</p>
            </div>
            ";
            // code...
         }
         // code...
      }
      // code...
   } else {
      if ($cloud->get_type() == 0 or ($cloud->get_type() == 1 and $user_->get_u_role() == 1) or ($cloud->get_type() == 1 and $user_->get_u_role() == 0 and $cloud->get_create() == 1)) {
         if (isset($folder) == false or (isset($folder) == true and $folder->get_name() == "root")) {
            $query = mysqli_query($db, "SELECT CODE_FOLDER FROM cldfolder WHERE NAME = 'root' AND CODE_CLOUD = '$cl_code' ");
            $result = mysqli_fetch_assoc($query);
            $code_folder_in = $result['CODE_FOLDER'];
            //verification qu'un nom identique existe deja
            $query = mysqli_query($db, "SELECT * FROM cldfile WHERE PATH_ = '$path'  AND CODE_CLOUD = '$cl_code' AND CODE_FOLDER = '$code_folder_in' ");
            if (mysqli_num_rows($query) == 0) {
               $query1 = mysqli_query($db, "INSERT INTO cldfile VALUES(
                  '$code_user',
                  '$code_folder_in',
                  '$cl_code',
                  null,
                  '$code_file',
                  '$name',
                  '$size',
                  1,
                  '$icon',
                  '$file_name',
                  1,
                  '$last_view',
                  '$code_user',
                  '$last_view',
                  null

               )");
               // code...
            } else {
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", This file's name exist at this place</p>
                 <p class=\"bg-light-cyan\">Please try with a different name. </p>
               </div>
               ";
               // code...
            }
            // code...
         } elseif (isset($folder) == true and $folder->get_name() !== "root") {

            $code_folder_in = $folder->get_code_folder();
            //verification qu'un nom indentique existe deja
            $query = mysqli_query($db, "SELECT * FROM cldfile WHERE PATH_ = '$path'  AND CODE_CLOUD = '$cl_code' AND CODE_FOLDER = '$code_folder_in' ");

            if (mysqli_num_rows($query) == 0) {
               $query1 = mysqli_query($db, "INSERT INTO cldfile VALUES(
                  '$code_user',
                  '$code_folder_in',
                  '$cl_code',
                  null,
                  '$code_file',
                  '$name',
                  '$size',
                  1,
                  '$icon',
                  '$file_name',
                  1,
                  '$last_view',
                  '$code_user',
                  '$last_view',
                  null

               )");
               // code...
            } else {
               $message .= "
               <div class=\"message\">
                 <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ", This file's name already exist at this place</p>
                 <p class=\"bg-light-cyan\">Please try with a different name. </p>
               </div>
               ";
               // code...
            }
            // code...
         }
         // code...
      } else {
         $message .= "
         <div class=\"message\">
           <p class=\"bg-light-cyan\"> Hi " . $user_->get_f_name() . ",</p>
           <p class=\"bg-light-cyan\">Members of this Cloud can't create file or folder inside. Contact the administrator. </p>
         </div>
         ";
         // code...
      }
      // code...
   }

   if ($query1 and move_uploaded_file($path, 'data/' . $file_name_mv)) {
      $message .= "
      <div class=\"message\">
        <p class=\"bg-light-cyan\">Done!</p>
        <p class=\"bg-light-cyan\"> The file have been added: <a href ='index.php?f_view=$code_file_e'>$file_name</a></p>
      </div>
      ";
   } else {
      $message .= "
      <div class=\"message\">
        <p class=\"bg-light-cyan\">Oops!</p>
        <p class=\"bg-light-cyan\"></p>
      </div>
      ";
      // code...
   }


   // code...
}


//supression d'un fichier
if (isset($_GET['f_ktspf'])) {
   # code...
}
?>

<!doctype html>
<html lang="en" dir="html">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="icon" href="favicon.ico" type="image/x-icon" />
   <title><?php $system->page_name('Home') ?></title>

   <!-- Bootstrap Core and vandor -->
   <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />
   <link rel="stylesheet" href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
   <link rel="stylesheet" href="../assets/plugins/dropify/css/dropify.min.css">

   <!-- Core css -->
   <link rel="stylesheet" href="../assets/css/style.min.css" />
</head>

<body class="font-muli dark-mode gradient">

   <!-- Page Loader -->
   <!-- <div class="page-loader-wrapper">
     <div class="loader">
     </div>
 </div> -->

   <div id="main_content">
      <?php
      // include 'main_nav.php';
      ?>


      <!-- Start project content area -->
      <div class="page">
         <!-- Start Page header -->
         <?php
         // include 'page_header.php';
         ?>
         <!-- Start Page title and tab -->
         <div class="section-body">
            <div class="container">
               <div class="d-flex justify-content-between align-items-center ">
                  <div class="header-action">
                     <h1 class="page-title">Dashboard</h1>
                     <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="#">THIB</a></li>
                        <li class="breadcrumb-item"><a href="./?cld_out" title="Exit the current Cloud and move to your private data">SERVER</a></li>
                        <?php
                        if (isset($cloud) == true) {
                           if (isset($folder) == true) {
                        ?>
                              <li class="breadcrumb-item"> <a href="./">
                                    <?php echo $retVal = ($cloud->get_type() == 0) ? "PUBLIC :" : "PRIVATE :"; ?>Cloud <?php echo $cloud->get_name(); ?></a></li>
                              <li class="breadcrumb-item"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder_in()); ?> ">Back</a></li>
                              <li class="breadcrumb-item active" aria-current="page"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder()); ?> "><?php echo $folder->get_name(); ?></a></li>
                           <?php
                              // code...
                           } else {
                           ?>
                              <li class="breadcrumb-item"> <a href="./">
                                    <?php echo $retVal = ($cloud->get_type() == 0) ? "PUBLIC: " : "PRIVATE: "; ?>Cloud <?php echo $cloud->get_name(); ?></a></li>
                           <?php
                              // code...
                           }
                           // code...
                        } else {
                           if (isset($folder) == true) {
                           ?>
                              <li class="breadcrumb-item"> <a href="./" title="Move to your home personnal data">My Personnal Cloud</a></li>
                              <li class="breadcrumb-item"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder_in()); ?> " title="Move to the previous folder">Back</a></li>
                              <li class="breadcrumb-item active" aria-current="page"> <a href="./?f_ktsp=<?php echo base64_encode($folder->get_code_folder()); ?> "><?php echo $folder->get_name(); ?></a></li>
                           <?php
                              // code...
                           } else {
                           ?>
                              <li class="breadcrumb-item"> <a href="./">My Personnal Cloud</a></li>
                        <?php
                              // code...
                           }
                           // code...
                        }

                        ?>
                     </ol>
                  </div>
                  <ul class="nav nav-tabs">
                     <li class="nav-item"><a class="nav-link" id="list-tab" data-toggle="tab" href="#list"><i class="fa fa-list-ul"></i> Add new folder</a></li>
                     <li class="nav-item"><a class="nav-link active" id="grid-tab" data-toggle="tab" href="#grid"><i class="fa fa-th"></i> Data</a></li>
                     <li class="nav-item"><a class="nav-link" id="addnew-tab" data-toggle="tab" href="#addnew"><i class="fa fa-plus"></i> Add New File</a></li>
                     <li class="nav-item"><a class="nav-link" id="cloud-tab" data-toggle="tab" href="#cloud"><i class="fa fa-book"></i> Cloud Connexion</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="section-body mt-4">
            <div class="">
               <?php echo $message; ?>
               <!-- //FICHIERS RECEMMENTS CONSULTéS
                <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Recently Accessed Files</h3>
                       <div class="card-options ">
                           <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                           <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                       </div>
                   </div>
                   <div class="">
                       <div class="">
                          <div class="row">
                           <div class="col-2">
                              <div class="card-body">
                                  <div class="card-header">
                                       <h3 class="card-title">Exam Toppers</h3>
                                       <div class="card-options">
                                          <div class="item-action dropdown ml-2">
                                               <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                               <div class="dropdown-menu dropdown-menu-right">
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                               </div>
                                          </div>
                                       </div>
                                  </div>
                                  <a href="javascript:void(0);">
                                    <div class="icon">
                                      <i class="fa fa-5x fa-folder text-success"></i>
                                    </div>
                                    <div class="file-name">
                                           <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>">Family</p>
                                           <small>3 File, 1.2Mb</small>
                                    </div>
                                  </a>
                              </div>
                           </div>
                           <div class="col-2">
                              <div class="card-body">
                                  <div class="card-header">
                                       <h3 class="card-title">Exam Toppers</h3>
                                       <div class="card-options">
                                          <div class="item-action dropdown ml-2">
                                               <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                               <div class="dropdown-menu dropdown-menu-right">
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                               </div>
                                          </div>
                                       </div>
                                  </div>
                                  <a href="javascript:void(0);">
                                     <div class="icon">
                                         <i class="fa fa-5x fa-file-word-o text-primary"></i>
                                     </div>
                                     <div class="file-name">
                                         <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>">Report2017.doc</p>
                                         <small>Size: 68KB</small>
                                     </div>
                                  </a>
                              </div>
                           </div>
                           <div class="col-2">
                              <div class="card-body">
                                  <div class="card-header">
                                       <h3 class="card-title">Exam Toppers</h3>
                                       <div class="card-options">
                                          <div class="item-action dropdown ml-2">
                                               <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                               <div class="dropdown-menu dropdown-menu-right">
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                   <div class="dropdown-divider"></div>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                   <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                               </div>
                                          </div>
                                       </div>
                                  </div>
                                  <a href="javascript:void(0);">
                                     <div class="icon">
                                         <i class="fa fa-5x fa-file-word-o text-primary"></i>
                                     </div>
                                     <div class="file-name">
                                         <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>">Report2017.doc</p>
                                         <small>Size: 68KB</small>
                                     </div>
                                  </a>
                              </div>
                           </div>

                          </div>

                       </div>
                   </div>
                </div> -->

               <div class="tab-content">
                  <div class="tab-pane fade" id="list" role="tabpanel">
                     <div class="card">
                        <div class="card-body">
                           <form class="form" action="" method="post">
                              <div class="row clearfix">
                                 <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                       <div class="icon">
                                          <i class="fa fa-5x fa-folder text-success"></i>
                                       </div>
                                       <input type="text" name="folder_name" required="Every doc has a name" focused class="form-control" placeholder="New folder"><br>
                                       <hr>
                                       <?php
                                       if (isset($cloud) == false) {
                                          if (isset($folder) == false or (isset($folder) == true and $folder->get_name() == "root")) {
                                       ?>
                                             <p class="text-warning">This folder will be saved in the "root" folder of your personnal Cloud**</p>
                                          <?php
                                             // code...
                                          } elseif (isset($folder) == true and $folder->get_name() !== "root") {
                                          ?>
                                             <p class="text-warning">This folder will be saved in "<?php echo $folder->get_name(); ?>" folder of your personnal Cloud**</p>
                                          <?php
                                             // code...
                                          }
                                          // code...
                                       } else {
                                          if (isset($folder) == false or (isset($folder) == true and $folder->get_name() == "root")) {
                                          ?>
                                             <p class="text-warning">This folder will be saved in the "root" folder of the "<?php echo $cloud->get_name(); ?>" Cloud**</p>
                                          <?php
                                             // code...
                                          } elseif (isset($folder) == true and $folder->get_name() !== "root") {
                                          ?>
                                             <p class="text-warning">This folder will be saved in the "<?php echo $folder->get_name(); ?>" folder of the "<?php echo $cloud->get_name(); ?>" Cloud**</p>
                                       <?php
                                             // code...
                                          }
                                          // code...
                                       }
                                       ?>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-xl-12 col-md-12">
                                    <div class="form-group">
                                       <textarea type="text" cols="3" rows="4" name="folder_des" class="form-control" placeholder="Enter Name">
                                                What this folder must content ?
                                             </textarea>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 mt-3">
                                    <button type="submit" name="create_folder" class="btn btn-warning">Add and Apply my settings</button>
                                    <!-- <span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span>
                                         <button type="submit" name="create_folder" class="btn btn-success">Add and Apply Cloud settings</button> -->
                                 </div>

                              </div>
                           </form>

                        </div>
                     </div>

                  </div>
                  <!-- //collapse des données -->
                  <div class="tab-pane fade show active" id="grid" role="tabpanel">
                     <!-- VOLET DE VISUALISATION DES FICHIERS -->
                     <?php
                     if (isset($_GET['f_ktspf'])) {
                        $code_file = base64_decode($_GET['f_ktspf']);
                        $query = mysqli_query($db, "SELECT * FROM cldfile WHERE CODE_FILE = '$code_file' ");
                        $result = mysqli_fetch_assoc($query);
                        $file = new File($user_->get_u_code(), $result['CODE_FOLDER'], $result['CODE_CLOUD'], $result['NAME'], $result['SIZE'], null, $result['ICON'], $result['PATH_'], null, $result['LAST_VIEW'], $result['LAST_WHO'], $result['C_DATE'], null);

                     ?>
                        <div class="row row-deck">
                           <div class="col-xl-4 col-lg-4 col-md-6">
                              <div class="card">
                                 <div class="card-body d-flex flex-column">
                                    <h5><a href="#"><?php echo $file->name ?></a></h5>
                                    <!-- <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div> -->
                                 </div>
                                 <div class="table-responsive">
                                    <table class="table table-striped table-vcenter mb-0">
                                       <tbody>
                                          <tr>
                                             <td class="w20"><i class="fa fa-calendar text-blue"></i></td>
                                             <td class="tx-medium">Duration</td>
                                             <td class="text-right">6 Months</td>
                                          </tr>
                                          <tr>
                                             <td><i class="fa fa-cc-visa text-danger"></i></td>
                                             <td class="tx-medium">Fees</td>
                                             <td class="text-right">$1,674</td>
                                          </tr>
                                          <tr>
                                             <td><i class="fa fa-users text-warning"></i></td>
                                             <td class="tx-medium">Students</td>
                                             <td class="text-right">125+</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="card-footer">
                                    <div class="d-flex align-items-center mt-auto">
                                       <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar4.jpg" alt="avatar">
                                       <div>
                                          <a href="#">Pro. Jane</a>
                                          <small class="d-block text-muted">Head OF Dept.</small>
                                       </div>
                                       <div class="ml-auto text-muted">
                                          <a href="javascript:void(0)" class="icon d-none d-md-inline-block ml-3"><i class="fe fe-heart mr-1"></i> 521</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-4 col-lg-4 col-md-6">
                              <div class="card">
                                 <div class="card-body d-flex flex-column">
                                    <h5><a href="#">OPTIONS</a></h5>
                                    <!-- <div class="text-muted">Look, my liege! The Knights Who Say Ni demand a sacrifice!</div> -->
                                 </div>
                                 <div class="table-responsive">
                                    <table class="table table-striped table-vcenter mb-0">
                                       <tbody>
                                          <tr>
                                             <td class="w20"><button class="btn btn-google btn-danger"> Delete</button></td>
                                             <td class="w20"><button class="btn btn-google btn-warning"> Move to</button></td>
                                             <td><button class="btn btn-light">Rename</button></td>

                                          </tr>
                                          <tr>
                                             <td><button class="btn btn-primary">Share</button></td>
                                             <td><button class="btn btn-info">Download</button></td>
                                             <td class="w20"><button class="btn btn-google btn-action"> Copy</button></td>

                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="card-footer">
                                    <div class="d-flex align-items-center mt-auto">
                                       <img class="avatar avatar-md mr-3" src="../assets/images/xs/avatar4.jpg" alt="avatar">
                                       <div>
                                          <a href="#">Pro. Jane</a>
                                          <small class="d-block text-muted">Head OF Dept.</small>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     <?php
                        # code...
                     }

                     if (1) {
                     ?>
                        <div class="row">
                           <?php
                           $query = "";
                           //si on ouvre pas un cloud on se connecte à la bibliotheque personnelle
                           if (isset($cloud) == false) {
                              //si on est pas à l'interieur d'un dossier de la bibliotheque c'est qu'on est dans la racine
                              if (isset($folder) == false) {
                                 //Affichage des dossiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE CODE_LIB = '$code_lib' AND CODE_FOLDER_MANY_FOLDER_WITHIN LIKE 'root%' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_folder = addslashes($result['CODE_FOLDER']);
                                    if ($result['NAME'] === "root") {
                                       continue;
                                       // code...
                                    }
                           ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="folder.php?view=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="folder.php?share=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="folder.php?download=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="folder.php?copy=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="folder.php?move=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                      <a href="folder.php?rename=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="folder.php?delete=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="./?f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>">
                                             <div class="icon">
                                                <i class="fa fa-5x fa-folder text-success"></i>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <?php
                                                $tab = $system->get_capacity($result['CODE_FOLDER']);
                                                ?>
                                                <small><?php echo $tab[1]; ?> File(s), <?php echo  $tab[0]; ?>Mb, <?php echo $system->get_count_folder($result['CODE_FOLDER']); ?> Folder(s)</small>
                                             </div>
                                          </a>
                                       </div>
                                    </div>

                                 <?php
                                    // code...
                                 }


                                 //Affichage des fichiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfile WHERE CODE_USER = '$code_user' AND CODE_CLOUD IS NULL AND CODE_FOLDER LIKE 'root%' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_file = addslashes($result['CODE_FILE']);
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="index.php?f_ktspf=<?php echo base64_encode($result['CODE_FILE']); ?>&f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="index.php?f_share=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="index.php?f_download=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="index.php?f_copy=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="index.php?f_move=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-file"></i> Move to</a>
                                                      <a href="index.php?f_rename=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="index.php?f_delete=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="data/<?php echo $result['PATH_'] ?>">
                                             <div class="icon">
                                                <?php echo $result['ICON']; ?>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <small><?php echo $result['SIZE'] + 0.0; ?>Mb</small>
                                             </div>
                                          </a>
                                       </div>

                                    </div>
                                 <?php
                                    // code...
                                 }
                                 // code...
                              }
                              //si on est dans un repertoire de la bibliotheque
                              else {
                                 //Affichage des dossiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE CODE_LIB = '$code_lib' AND CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_fl' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_folder = addslashes($result['CODE_FOLDER']);
                                    if ($result['NAME'] === "root") {
                                       continue;
                                       // code...
                                    }
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="folder.php?view=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="folder.php?share=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="folder.php?download=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="folder.php?copy=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="folder.php?move=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                      <a href="folder.php?rename=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="folder.php?delete=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="./?f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>">
                                             <div class="icon">
                                                <i class="fa fa-5x fa-folder text-success"></i>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <?php
                                                $tab = $system->get_capacity($result['CODE_FOLDER']);
                                                ?>
                                                <small><?php echo $tab[1]; ?> File(s), <?php echo  $tab[0]; ?>Mb, <?php echo $system->get_count_folder($result['CODE_FOLDER']); ?> Folder(s)</small>
                                             </div>
                                          </a>
                                       </div>
                                    </div>

                                 <?php
                                    // code...
                                 }


                                 //Affichage des fichiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfile WHERE CODE_USER = '$code_user' AND CODE_CLOUD IS NULL AND CODE_FOLDER = '$code_fl' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_file = addslashes($result['CODE_FILE']);
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="index.php?f_ktspf=<?php echo base64_encode($result['CODE_FILE']); ?>&f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="index.php?f_share=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="index.php?f_download=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="index.php?f_copy=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="index.php?f_move=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-file"></i> Move to</a>
                                                      <a href="index.php?f_rename=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="index.php?f_delete=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="data/<?php echo $result['PATH_'] ?>">
                                             <div class="icon">
                                                <?php echo $result['ICON']; ?>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <small><?php echo $result['SIZE'] + 0.0; ?>Mb</small>
                                             </div>
                                          </a>
                                       </div>

                                    </div>
                                 <?php
                                    // code...
                                 }
                                 // code...
                              }
                              // code...
                           }
                           //si un cloud a ete ouvert
                           else {
                              //si on est dans la racine cloud
                              if (isset($folder) == false) {
                                 //Affichage des dossiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE CODE_CLOUD = '$cl_code' AND CODE_FOLDER_MANY_FOLDER_WITHIN LIKE 'root%' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_folder = addslashes($result['CODE_FOLDER']);
                                    if ($result['NAME'] === "root") {
                                       continue;
                                       // code...
                                    }
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="folder.php?view=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="folder.php?share=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="folder.php?download=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="folder.php?copy=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="folder.php?move=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                      <a href="folder.php?rename=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="folder.php?delete=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="./?f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>">
                                             <div class="icon">
                                                <i class="fa fa-5x fa-folder text-success"></i>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <?php
                                                $tab = $system->get_capacity($result['CODE_FOLDER']);
                                                ?>
                                                <small><?php echo $tab[1]; ?> File(s), <?php echo  $tab[0]; ?>Mb, <?php echo $system->get_count_folder($result['CODE_FOLDER']); ?> Folder(s)</small>
                                             </div>
                                          </a>
                                       </div>
                                    </div>

                                 <?php
                                    // code...
                                 }


                                 //Affichage des fichiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfile WHERE  CODE_CLOUD = '$cl_code' AND CODE_FOLDER LIKE 'root%' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_file = addslashes($result['CODE_FILE']);
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="index.php?f_ktspf=<?php echo base64_encode($result['CODE_FILE']); ?>&f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="index.php?f_share=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="index.php?f_download=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="index.php?f_copy=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="index.php?f_move=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-file"></i> Move to</a>
                                                      <a href="index.php?f_rename=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="index.php?f_delete=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="data/<?php echo $result['PATH_'] ?>">
                                             <div class="icon">
                                                <?php echo $result['ICON']; ?>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <small><?php echo $result['SIZE'] + 0.0; ?>Mb</small>
                                             </div>
                                          </a>
                                       </div>

                                    </div>
                                 <?php
                                    // code...
                                 }
                                 // code...
                              }

                              //si on est dans un repertoire du cloud
                              else {
                                 //Affichage des dossiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfolder WHERE CODE_CLOUD = '$cl_code' AND CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_fl' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_folder = addslashes($result['CODE_FOLDER']);
                                    if ($result['NAME'] === "root") {
                                       continue;
                                       // code...
                                    }
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="folder.php?view=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="folder.php?share=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="folder.php?download=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="folder.php?copy=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="folder.php?move=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                      <a href="folder.php?rename=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="folder.php?delete=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="./?f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>">
                                             <div class="icon">
                                                <i class="fa fa-5x fa-folder text-success"></i>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <?php
                                                $tab = $system->get_capacity($result['CODE_FOLDER']);
                                                ?>
                                                <small><?php echo $tab[1]; ?> File(s), <?php echo  $tab[0]; ?>Mb, <?php echo $system->get_count_folder($result['CODE_FOLDER']); ?> Folder(s)</small>
                                             </div>
                                          </a>
                                       </div>
                                    </div>

                                 <?php
                                    // code...
                                 }


                                 //Affichage des fichiers
                                 $query = mysqli_query($db, "SELECT * FROM cldfile WHERE CODE_CLOUD = '$cl_code' AND CODE_FOLDER = '$code_fl' AND STATUT = 1 ORDER BY NAME ASC
                                    ");
                                 while ($result = mysqli_fetch_assoc($query)) {
                                    $code_file = addslashes($result['CODE_FILE']);
                                 ?>
                                    <div class="col-md-4 col-xl-2 col-lg-1">
                                       <div class="card-body">
                                          <div class="card-header">
                                             <!-- <h3 class="card-title">Exam Toppers</h3> -->
                                             <div class="card-options">
                                                <div class="item-action dropdown ml-2">
                                                   <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <a href="index.php?f_ktspf=<?php echo base64_encode($result['CODE_FILE']); ?>&f_ktsp=<?php echo base64_encode($result['CODE_FOLDER']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                      <a href="index.php?f_share=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                      <a href="index.php?f_download=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item" target="_blank"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                      <div class="dropdown-divider"></div>
                                                      <a href="index.php?f_copy=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                      <a href="index.php?f_move=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-file"></i> Move to</a>
                                                      <a href="index.php?f_rename=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                      <a href="index.php?f_delete=<?php echo base64_encode($result['CODE_FILE']); ?>" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <a href="data/<?php echo $result['PATH_'] ?>">
                                             <div class="icon">
                                                <?php echo $result['ICON']; ?>
                                             </div>
                                             <div class="file-name">
                                                <p class="mb-0 text-muted" style="overflow-x: hidden;" title="<?php echo $result['NAME'] ?>"><?php echo $result['NAME']; ?></p>
                                                <small><?php echo $result['SIZE'] + 0.0; ?>Mb</small>
                                             </div>
                                          </a>
                                       </div>

                                    </div>
                           <?php
                                    // code...
                                 }

                                 // code...
                              }
                              // code...
                           }
                           ?>
                        </div>
                     <?php
                        # code...
                     }
                     ?>
                     <span>No more data</span>
                  </div>
                  <!-- //collapse ajouter un fichier -->
                  <div class="tab-pane fade" id="addnew" role="tabpanel">
                     <form class="form" action="" method="post" enctype="multipart/form-data">
                        <div class="card">
                           <div class="card-body">
                              <div class="row clearfix">
                                 <div class="col-lg-12">
                                    <label for="">Limit 40Mbytes</label>
                                    <input type="file" name="file_name" required class="dropify">
                                 </div>
                                 <div class="col-lg-12 mt-3">
                                    <button type="submit" name="new_file" class="btn btn-success">Add the file</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <!-- //collapse se connectec à un cloud -->
                  <div class="tab-pane fade" id="cloud" role="tabpanel">
                     <center>
                        <h6>Connect to a Cloud</h6>
                     </center>
                     <div class="card">
                        <div class="card-body">
                           <form class="form" action="" method="post">
                              <div class="row clearfix">
                                 <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                       <select class="form-control" name="cloud_name" required>
                                          <?php
                                          $q = mysqli_query($db, "SELECT * FROM cldcloud WHERE 1 ORDER BY NAME DESC");
                                          while ($r = mysqli_fetch_assoc($q)) {
                                          ?>
                                             <option value="<?php echo $r['CODE_CLOUD']; ?>"><?php echo $r['NAME']; ?></option>
                                          <?php
                                             // code...
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                       <input type="password" required name="cloud_pssw" class="form-control" placeholder="Enter Cloud password">
                                    </div>
                                 </div>

                                 <div class="col-lg-12 mt-3">
                                    <button type="submit" name="connect_cloud" class="btn btn-success">Connexion</button>
                                 </div>
                              </div>

                           </form>

                        </div>
                     </div>
                     <hr>
                     <center>
                        <h6>Else create new one</h6>
                     </center>
                     <div class="card">
                        <div class="card-header">
                           <h3 class="card-title">Settings</h3>
                        </div>
                        <div class="card-body">
                           <form action="" method="POST">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                       <label>Cloud Name</label>
                                       <input name="name" class="form-control" required type="text">
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                       <label>Cloud Password</label>
                                       <input name="pssw" class="form-control" required type="password">
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                       <label>Public Cloud</label>
                                       <input name="type" value="0" class="form-control" required type="radio"><br><br>
                                       <ul class="list-group mb-3 tp-setting">
                                          <li class="list-group-item">
                                             Anyone can read files
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can update files
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can add new files
                                          </li>
                                          <li class="list-group-item">
                                             Anyone cannot delete files, Just admin and owner
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can share files with different cloud
                                          </li>
                                       </ul>

                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                       <label>Private Cloud</label>
                                       <input name="type" value="1" class="form-control" required type="radio"><br>
                                       <span>Set it on your own sweet will</span>
                                       <ul class="list-group mb-3 tp-setting">
                                          <li class="list-group-item">
                                             Anyone can read files
                                             <div class="float-right">
                                                <label class="custom-control custom-checkbox">
                                                   <input type="checkbox" name="privr" class="custom-control-input">
                                                   <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                             </div>
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can update files
                                             <div class="float-right">
                                                <label class="custom-control custom-checkbox">
                                                   <input type="checkbox" name="privw" class="custom-control-input">
                                                   <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                             </div>
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can add new files
                                             <div class="float-right">
                                                <label class="custom-control custom-checkbox">
                                                   <input type="checkbox" name="privc" class="custom-control-input">
                                                   <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                             </div>
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can delete files
                                             <div class="float-right">
                                                <label class="custom-control custom-checkbox">
                                                   <input type="checkbox" name="privd" disabled class="custom-control-input">
                                                   <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                             </div>
                                          </li>
                                          <li class="list-group-item">
                                             Anyone can share files with different cloud
                                             <div class="float-right">
                                                <label class="custom-control custom-checkbox">
                                                   <input type="checkbox" name="privs" class="custom-control-input">
                                                   <span class="custom-control-label">&nbsp;</span>
                                                </label>
                                             </div>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <button type="submit" name="save_cloud" class="btn btn-success">Save</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Start Main project js, jQuery, Bootstrap -->
   <script src="../assets/bundles/lib.vendor.bundle.js"></script>

   <!-- Start Plugin Js -->
   <script src="../assets/bundles/sweetalert.bundle.js"></script>
   <script src="../assets/plugins/dropify/js/dropify.min.js"></script>

   <!-- Start project main js  and page js -->
   <script src="../assets/js/core.js"></script>
   <script src="assets/js/page/dialogs.js"></script>
   <script src="assets/js/page/summernote.js"></script>
   <script>
      $(function() {
         "use strict";

         $('.dropify').dropify();

         var drEvent = $('#dropify-event').dropify();
         drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
         });

         drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
         });

         $('.dropify-fr').dropify({
            messages: {
               default: 'Glissez-déposez un fichier ici ou cliquez',
               replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
               remove: 'Supprimer',
               error: 'Désolé, le fichier trop volumineux'
            }
         });
      });
   </script>
</body>

</html>