<?php
//fichier requis
//1.base de données
require_once 'db_connection.php';

/**
 * class system
 */
class system
{
   private $host = 'localhost';
   //2. l'utilisateur
   private $user = 'root';
   //3. mot de passe
   private $pssw = '';
   //4. base de données
   private $dbb = 'scolaricx';
   protected $database;

   function __construct()
   {
      try {
         $this->database = new mysqli($this->host, $this->user, $this->pssw, $this->dbb) or die("unable to connect");
      } catch (Exception $e) {
         echo "someting wrong;" . $e;
         exit();
      }
   }

   //methodes
   public function goto_cloud($cl_code, $u_code, $cl_pssw): int
   {
      //Aquisition du role de l'utilisateur dans le cloud
      $query = mysqli_query($this->database, "
         SELECT * FROM cldcloud WHERE PSSW = '$cl_pssw' AND CODE_CLOUD = '$cl_code'
      ");
      if (mysqli_num_rows($query) == 0) {
         return 0;
         // code...
      }
      $result = mysqli_fetch_assoc($query);
      $query = mysqli_query($this->database, "
         SELECT ROLE AS role, BANNED AS ban FROM clduser_part_of_cloud WHERE CODE_USER = '$u_code' AND CODE_CLOUD = '$cl_code'
      ");
      //si l'utilisateur ne s'est jamais connecté à ce cloud public, on l'enregistre et il devient membre autorisé
      $last_view = date("Y-d-m H:m:s");
      if ((mysqli_num_rows($query) == 0 and $result['TYPE'] == 0)) {
         $role = 0;
         $query = mysqli_query($this->database, "
            INSERT INTO clduser_part_of_cloud VALUES (
               '$u_code',
               '$cl_code',
               '$role',
               0,
               '$last_view'
               )
         ");
         return 1;
         // code...
      }
      //si l'utilisateur s'est deja connecté une fois à ce cloud
      else {
         $result = mysqli_fetch_assoc($query);
         //si l'utilisateur n'est pas bani
         if ($result['ban'] == 0) {
            $user_->role = $result['role'];
            //mise à jour de la derniere connexion
            $this->update_last_view($u_code, $cl_code, $last_view);
            return 1;
            // code...
         }
         //si il a été bani
         else {
            return 2;
         }
         // code...
      }
      // code...
   }
   public function auth(string $u_code, string $pssw): int
   {
      //encodage du mot de passe
      $pssw = base64_encode($pssw);
      //requete de verification de l'existence de l'utilisateur
      $query = mysqli_query($this->database, "
         SELECT * FROM clduser_ WHERE CODE_USER = '$u_code'
      ");
      //si la requete fonctionne
      if ($query) {
         if (mysqli_num_rows($query) == 1) {
            $result = mysqli_fetch_assoc($query);
            //Si le mot de passe est le bon
            if ($result['PSSW'] === $pssw) {
               //Instantiation de l'utilisateur
               $user_ = new user_($result['F_NAME'], $result['L_NAME'], $u_code);
               //creation du cookie se session et redirection
               $this->create_session($user_);
               // code...
            }
            //si le mot de passe est faux
            else {
               return 2;
            }
            // code...
         }
         //si aucun utilisateur n'est trouvé
         else {
            return 3;
         }
         // code...
      }
      //si la requete ne fonctionne pas
      else {
         return 4;
      }
      // code...
   }

   private function update_last_view(string $code_user, string $code_cl, string $date): void
   {
      $query = mysqli_query($this->database, "
         UPDATE clduser_part_of_cloud SET LAST_VIEW = '$date' WHERE CODE_USER = '$code_user' AND CODE_CLOUD = '$code_cl'
      ") or die('Update failed');
      // code...
   }

   private function create_session(object $data): void
   {
      //creation du cookie
      $cookie_value = base64_encode($data->get_u_code());
      setcookie('user', $cookie_value, time() + 60 * 15);
      header("location: ./");
      exit();
      // code...
   }

   public function page_name($value): void
   {
      echo $value;
      // code...
   }



   public function get_capacity($code_folder, $sum = 0, $count = 0): array
   {
      $q = mysqli_query($this->database, " SELECT SUM(SIZE) AS size, COUNT(ID) AS nbr FROM cldfile WHERE CODE_FOLDER = '$code_folder'
      ");
      $r = mysqli_fetch_assoc($q);
      $sum += $r['size'];
      $count += $r['nbr'];
      $tab[0] = $sum;
      $tab[1] = $count;

      $query = mysqli_query($this->database, "SELECT * FROM cldfolder WHERE CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder'");
      while ($result = mysqli_fetch_assoc($query)) {
         $code_folder = $result['CODE_FOLDER'];
         $q = mysqli_query($this->database, " SELECT SUM(SIZE) AS size, COUNT(ID) AS nbr FROM cldfile WHERE CODE_FOLDER = '$code_folder'
         ");
         $r = mysqli_fetch_assoc($q);
         $sum += $r['size'];
         $count += $r['nbr'];
         $tab[0] = $sum;
         $tab[1] = $count;
         // code...
      }
      $tab[0] = round($tab[0]);
      return $tab;
      // code...
   }

   public function get_count_folder($code_folder, $sum = 0): int
   {
      $q = mysqli_query($this->database, "SELECT COUNT(ID) As nbr FROM cldfolder WHERE CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder' ");
      $r = mysqli_fetch_assoc($q);
      $sum += $r['nbr'];

      $query = mysqli_query($this->database, "SELECT * FROM cldfolder WHERE CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder' ");
      while ($result = mysqli_fetch_assoc($query)) {
         $code_folder = $result['CODE_FOLDER'];
         $q = mysqli_query($this->database, "SELECT COUNT(ID) As nbr FROM cldfolder WHERE CODE_FOLDER_MANY_FOLDER_WITHIN = '$code_folder' ");
         $r = mysqli_fetch_assoc($q);
         $sum += $r['nbr'];         // code...
      }

      return $sum;
      // code...
   }
}



/**
 * class des utilisateurs
 */
class user_ extends system
{
   //proprietés
   private  $u_code;
   public  $f_name;
   public  $l_name;
   public  $role;
   private  $pssw;
   private  $phrase_r;


   function __construct(string $f_name, string $l_name, string $u_code = "", string $pssw = "", string $phrase_r = "", int $role = 0)
   {
      $this->set_f_name($f_name);
      $this->set_l_name($l_name);
      $this->set_u_code($u_code);
      $this->set_phrase_r($phrase_r);
      $this->set_pssw($pssw);
      $this->set_role($role);
      // code...
   }

   //Methodes

   public function auth_login(): int
   {
      $system = new system;
      return $system->auth($this->u_code, $this->pssw);
      // code...
   }

   public function auth_register(): int
   {
      $pssw_encoded = base64_encode($this->pssw);
      $system = new system;
      $query = mysqli_query($system->database, "
         SELECT * FROM clduser_ WHERE CODE_USER = '$this->u_code';
      ");
      if (mysqli_num_rows($query) == 1) {
         return 3;
         // code...
      }
      //creation de l'utilisateur
      $query = mysqli_query($system->database, "
         INSERT INTO clduser_ VALUES(
            null,
            '$this->u_code',
            '$this->f_name',
            '$this->l_name',
            '$pssw_encoded',
            '$this->phrase_r'
         )
      ");
      if ($query) {
         //creation de la bibliotheque personnelle
         $code_lib = $this->u_code . "lib";
         $lib_name = $this->f_name . " Library";
         $query = mysqli_query($system->database, "
            INSERT INTO cldlib VALUES(
               '$this->u_code',
               null,
               '$code_lib',
               '$lib_name'
               )
         ");
         if ($query) {
            $date = date("Y-d-m H:m:s");
            $code_folder_home = $code_lib . "home_fold";
            $code_folder_doc = $code_lib . "allow#";
            $code_folder_down = $code_lib . "down_fold";
            $code_folder_img = $code_lib . "img_fold";
            $code_folder_wks = $code_lib . "wks_fold";
            $code_folder_mus = $code_lib . "mus_fold";
            $code_folder_fav = $code_lib . "fav_fold";
            $root = "root" . $code_lib;
            $user_code = $this->get_u_code();
            $query = mysqli_query($system->database, "
               INSERT INTO cldfolder VALUES
               (
                  '$code_lib',
                  null,
                  '$user_code',
                  '$root',
                  null,
                  '$root',
                  'root',
                  '$date',
                  'root Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_fav',
                  'MyFavorite',
                  '$date',
                  'Favorite Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_mus',
                  'MyMusic',
                  '$date',
                  'Music Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_wks',
                  'MyWorkspace',
                  '$date',
                  'Workspace Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_home',
                  'Myoffice',
                  '$date',
                  'Home Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_doc',
                  'MyDocuments',
                  '$date',
                  'Docs Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_down',
                  'MyDownloads',
                  '$date',
                  'Downloads Folder',
                  1
               ),
               (
                  '$code_lib',
                  null,
                  '$this->u_code',
                  '$root',
                  null,
                  '$code_folder_img',
                  'MyImages',
                  '$date',
                  'Images Folder',
                  1
               )
            ");
            $code_allow_root = $root . "allow#";
            $code_allow_folder_home = $code_folder_home . "allow#";
            $code_allow_folder_doc = $code_folder_doc . "allow#";
            $code_allow_folder_down = $code_folder_down . "allow#";
            $code_allow_folder_img = $code_folder_img . "allow#";
            $code_allow_folder_wks = $code_folder_wks . "allow#";
            $code_allow_folder_mus = $code_folder_mus . "allow#";
            $code_allow_folder_fav = $code_folder_fav . "allow#";
            $query = mysqli_query($system->database, "
               INSERT INTO cldallow VALUES
               (
                  '$code_folder_home',
                  null,
                  null,
                  null,
                  '$code_allow_folder_home',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$code_folder_doc',
                  null,
                  null,
                  null,
                  '$code_allow_folder_doc',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$code_folder_down',
                  null,
                  null,
                  null,
                  '$code_allow_folder_down',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$code_folder_img',
                  null,
                  null,
                  null,
                  '$code_allow_folder_img',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$code_folder_wks',
                  null,
                  null,
                  null,
                  '$code_allow_folder_wks',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$code_folder_mus',
                  null,
                  null,
                  null,
                  '$code_allow_folder_mus',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$code_folder_fav',
                  null,
                  null,
                  null,
                  '$code_allow_folder_fav',
                  1,
                  1,
                  1,
                  1,
                  1,
                  1
               ),
               (
                  '$root',
                  null,
                  null,
                  null,
                  '$code_allow_root',
                  1,
                  1,
                  1,
                  0,
                  1,
                  1
               )
            ");

            if ($query) {
               return 1;
               // code...
            } else {
               return 3;
            }
            // code...
         }
      } else {
         return 2;
      }
      // code...
   }


   //Setters
   public function set_pssw($pssw)
   {
      $this->pssw = $pssw;
      // code...
   }
   public function set_phrase_r($phrase_r)
   {
      $this->phrase_r = $phrase_r;
      // code...
   }
   public function set_u_code($u_code)
   {
      $this->u_code = $u_code;
      // code...
   }
   public function set_f_name($f_name)
   {
      $this->f_name = $f_name;
      // code...
   }
   public function set_l_name($l_name)
   {
      $this->l_name = $l_name;
      // code...
   }
   public function set_role($role)
   {
      $this->role = $role;
      // code...
   }


   //Getters
   public function get_u_role(): string
   {
      return $this->role;
      // code...
   }
   public function get_f_name(): string
   {
      return $this->f_name;
      // code...
   }

   public function get_l_name(): string
   {
      return $this->l_name;
      // code...
   }

   public function get_u_code(): string
   {
      return $this->u_code;
      // code...
   }
}


/**
 * Cloud class
 */
class Cloud extends system
{
   private $code_cloud;
   public $name;
   private $pssw;
   public $c_date;
   public int $type;
   public int $read;
   public int $write;
   public int $create;
   public int $delete;
   public int $share;
   public int $download;

   function __construct($code_cloud, $name, $pssw, $c_date, $type)
   {
      $this->set_code_cloud($code_cloud);
      $this->set_name($name);
      $this->set_pssw($pssw);
      $this->set_c_date($c_date);
      $this->set_type($type);

      // code...
   }

   //Setters

   public function set_read(int $value): void
   {
      $this->read = $value;
      // code...
   }
   public function set_write(int $value): void
   {
      $this->write = $value;
      // code...
   }
   public function set_create(int $value): void
   {
      $this->create = $value;
      // code...
   }
   public function set_delete(int $value): void
   {
      $this->delete = $value;
      // code...
   }
   public function set_share(int $value): void
   {
      $this->share = $value;
      // code...
   }
   public function set_download(int $value): void
   {
      $this->download = $value;
      // code...
   }

   public function set_code_cloud($code_cloud)
   {
      $this->code_cloud = $code_cloud;
      // code...
   }

   public function set_name($name)
   {
      $this->name = $name;
      // code...
   }

   public function set_pssw($pssw)
   {
      $this->pssw = $pssw;
      // code...
   }

   public function set_c_date($c_date)
   {
      $this->c_date = $c_date;
      // code...
   }

   public function set_type($type)
   {
      $this->type = $type;
      // code...
   }



   //Getters

   public function get_read(): int
   {
      return $this->read;
      // code...
   }
   public function get_write(): int
   {
      return $this->write;
      // code...
   }
   public function get_create(): int
   {
      return $this->create;
      // code...
   }
   public function get_delete(): int
   {
      return $this->delete;
      // code...
   }
   public function get_share(): int
   {
      return $this->share;
      // code...
   }
   public function get_download(): int
   {
      return $this->download;
      // code...
   }

   public function get_code_cloud()
   {
      return $this->code_cloud;
      // code...
   }

   public function get_name()
   {
      return $this->name;
      // code...
   }

   public function get_pssw()
   {
      return $this->pssw;
      // code...
   }

   public function get_c_date()
   {
      return $this->c_date;
      // code...
   }

   public function get_type()
   {
      return $this->type;
      // code...
   }
}


/**
 * Folder class
 */
class Folder extends system
{
   private $code_lib;
   private $code_cloud;
   private $code_user;
   private $code_folder_in;
   private $code_folder;
   public $name;
   public $c_date;
   public $description;
   public $statut;

   function __construct($code_lib = null, $code_cloud = null, $code_user, $code_folder_in, $code_folder, $name, $c_date, $description, $statut)
   {
      $this->set_code_lib($code_lib);
      $this->set_f_code_cloud($code_cloud);
      $this->set_code_user($code_user);
      $this->set_code_folder_in($code_folder_in);
      $this->set_code_folder($code_folder);
      $this->set_name($name);
      $this->set_c_date($c_date);
      $this->set_description($description);
      $this->set_statut($statut);
      // code...
   }


   //Setters

   private function set_code_lib($code_lib)
   {
      $this->code_lib = $code_lib;
      // code...
   }

   //Setters

   public function set_f_code_cloud($code_cloud)
   {
      $this->code_cloud = $code_cloud;
      // code...
   }

   //Setters

   private function set_code_user($code_user)
   {
      $this->code_user = $code_user;
      // code...
   }

   //Setters

   private function set_code_folder_in($code_folder_in)
   {
      $this->code_folder_in = $code_folder_in;
      // code...
   }

   //Setters

   private function set_code_folder($code_folder)
   {
      $this->code_folder = $code_folder;
      // code...
   }

   //Setters

   public function set_name($name)
   {
      $this->name = $name;
      // code...
   }

   //Setters

   public function set_c_date($c_date)
   {
      $this->c_date = $c_date;
      // code...
   }

   //Setters

   public function set_description($description)
   {
      $this->description = $description;
      // code...
   }

   //Setters

   public function set_statut($statut)
   {
      $this->statut = $statut;
      // code...
   }


   //Getters

   public function get_code_lib()
   {
      return $this->code_lib;
      // code...
   }

   //Getters

   public function get_code_cloud()
   {
      return $this->code_cloud;
      // code...
   }

   //Getters

   public function get_code_user()
   {
      return $this->code_user;
      // code...
   }

   //Getters

   public function get_code_folder_in()
   {
      return $this->code_folder_in;
      // code...
   }

   //Getters

   public function get_code_folder()
   {
      return $this->code_folder;
      // code...
   }

   //Getters

   public function get_name()
   {
      return $this->name;
      // code...
   }

   //Getters

   public function get_c_date()
   {
      return $this->c_date;
      // code...
   }

   //Getters

   public function get_description()
   {
      return $this->description;
      // code...
   }

   //Getters

   public function get_statut()
   {
      return $this->statut;
      // code...
   }
}



/**
 * Lib class
 */
class Lib extends system
{
   private $code_user;
   private $code_lib;
   public $name;

   function __construct($code_user, $code_lib, $name)
   {
      $this->set_code_user($code_user);
      $this->set_code_lib($code_lib);
      $this->set_name($name);
      // code...
   }

   //Setters

   public function set_code_user($code_user)
   {
      $this->code_user = $code_user;
      // code...
   }

   public function set_code_lib($code_lib)
   {
      $this->code_lib = $code_lib;
      // code...
   }

   public function set_name($name)
   {
      $this->name = $name;
      // code...
   }

   //Getters

   public function get_code_user()
   {
      return $this->code_user;
      // code...
   }

   public function get_code_lib()
   {
      return $this->code_lib;
      // code...
   }

   public function get_name()
   {
      return $this->name;
      // code...
   }
}




/**
 * File class
 */
class File extends system
{
   public $auth;
   public $folder;
   public $cloud;
   public $code_fl;
   public $name;
   public $size;
   public $statut;
   public $icon;
   public $path;
   public $view;
   public $last_view;
   public $last_who;
   public $c_date;
   public $description;
   function __construct($auth, $folder, $cloud = null, $name, $size = null, $statut, $icon, $path = null, $view = null, $last_view, $last_who = null, $c_date, $description = null)
   {
      $this->auth = $auth;
      $this->folder = $folder;
      $this->cloud = $cloud;
      $this->name = $name;
      $this->size = $size;
      $this->statut = $statut;
      $this->icon = $icon;
      $this->path = $path;
      $this->view = $view;
      $this->last_view = $last_view;
      $this->last_who = $last_who;
      $this->c_date = $c_date;
      $this->description = $description;
      // code...
   }
}


?>




<?php
//fonctions usuelles

?>
