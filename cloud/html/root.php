<?php
require_once 'class_package.php';
$system = new system;
$last_view = date("Y-d-m H:m:s");
//deconnexion du Cloud
if (isset($_GET['cld_out']) and isset($_COOKIE['c_cloud'])) {
   setcookie('c_cloud');
   unset($_COOKIE['c_cloud']);
   header("location: ./");
   // code...
}
//get cookie value and update
if (isset($_COOKIE['user'])) {
   $code_user = base64_decode($_COOKIE['user']);
   $cookie_value = base64_encode($code_user);
   setcookie('user', $cookie_value, time() + 60 * 60);
   $query = mysqli_query($db, "SELECT * FROM clduser_ WHERE CODE_USER = '$code_user'");
   $result = mysqli_fetch_assoc($query);
   $user_ = new user_($result['F_NAME'], $result['L_NAME'], $code_user, "", $result['PSSW_R']);
   //acquision de la livrairie de l'utilisateur
   $query = mysqli_query($db, "SELECT * FROM cldlib WHERE CODE_USER = '$code_user'");
   $result = mysqli_fetch_assoc($query);
   //Instantiation de la class lib
   $lib = new Lib($code_user, $result['CODE_LIB'], $result['NAME']);
   $code_lib = $lib->get_code_lib();
   //verification si on se trouve dans un cloud
   if (isset($_COOKIE['c_cloud'])) {
      $cl_code  = base64_decode($_COOKIE['c_cloud']);
      setcookie('c_cloud', $_COOKIE['c_cloud'], time() + 60 * 60);
      //Instantiation du cloud
      $query = mysqli_query($db, "
         SELECT * FROM cldcloud WHERE CODE_CLOUD = '$cl_code'
      ");
      $result = mysqli_fetch_assoc($query);
      $cloud = new Cloud($cl_code, $result['NAME'], $result['PSSW'], $result['C_DATE'], $result['TYPE']);
      if ($user_->get_u_code() == $result['CODE_USER']) {
         $user_->set_role(1);
         // code...
      } else {
         $user_->set_role(0);
      }

      //aquisition des niveaux d'acces
      if ($cloud->get_type() == 1) {
         $query = mysqli_query($db, "SELECT * FROM cldallow WHERE CODE_CLOUD = '$cl_code' ");
         $result = mysqli_fetch_assoc($query);
         $cloud->set_read($result['READ_']);
         $cloud->set_write($result['WRITE_']);
         $cloud->set_create($result['CREATE_']);
         $cloud->set_delete($result['DELETE_']);
         $cloud->set_share($result['SHARE_']);
         $cloud->set_download($result['DOWNLOAD_']);
         // code...
      }
   }
   //verification du repertoire courant
   if (isset($_GET['f_ktsp'])) {
      $code_fl = base64_decode($_GET['f_ktsp']);
      $query = mysqli_query($db, "
         SELECT * FROM cldfolder WHERE CODE_FOLDER = '$code_fl'
      ");
      if ($query and mysqli_num_rows($query) == 1) {
         $result = mysqli_fetch_assoc($query);
         //Instantiation du dossier
         $folder = new Folder($result['CODE_LIB'], $result['CODE_CLOUD'], $result['CODE_USER'], $result['CODE_FOLDER_MANY_FOLDER_WITHIN'], $result['CODE_FOLDER'], $result['NAME'], $result['C_DATE'], $result['DESCRIPTION'], $result['STATUT']);
         // code...
      }

      // code...
   }
   // code...
} else {
   header('location: login.php');
}
