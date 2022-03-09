<?php

/**
 * User class
 */
class user
{
	public $id = null;
	public $matricule_user = null;
	public $nom_user = null;
	public $prenom_user = null;
	public $email = null;
	public $telephone = null;
	public $role = null;
	public $host = "localhost";
	public $user = "root";
	public $pssw = "";
	public $database = "scolaricx";
	public $query_1 = null;
	public $matricule_etablissement = null;
	public $date_academique = null;

	function __construct()
	{
		try {
			$this->database = new mysqli($this->host, $this->user, $this->pssw, $this->database) or die("unable to connect");
		} catch (Exception $e) {
			echo "someting wrong;" . $e;
			exit();
		}
		# code...
	}

	public function user_connection($Q_pssw, $Q_email, $Q_date_academique)
	//method to verify if the user is in the database
	{
		try {
			$query = mysqli_query($this->database, "SELECT * FROM utilisateur where email_utilisateur = '$Q_email'");
			if ($query and mysqli_num_rows($query) == 1) {
				$result = mysqli_fetch_assoc($query);
				if (empty($result['pssw']) or $result['pssw'] == null or $result['pssw'] == "") {
					header("Location: auth-forgot-password.php?u=$Q_email");
					exit;
					# code...
				}
				# code...
			}
			$query = mysqli_query($this->database, "SELECT * FROM utilisateur where email_utilisateur = '$Q_email' AND pssw = '$Q_pssw' ");
			// VERIFY IF THE USER EXIST
			if ($query and mysqli_num_rows($query) == 1) {
				$result = mysqli_fetch_assoc($query);
				$this->matricule_etablissement = addslashes($result['matricule_etablissement']);
				// IF THE USER EXIST TCHECK FOR THE SCHOOL
				$this->query_1 = mysqli_query($this->database, "SELECT * FROM etablissement where matricule_etablissement = '$this->matricule_etablissement' AND date_academique = '$Q_date_academique' ");
				// VERIFY IF THE SCHOOL EXIST AND THE ACADEMIC YEAR
				if ($this->query_1 and mysqli_num_rows($this->query_1) == 1) {
					// IF THE SCHOOL EXIST AND THE ACADEMIC YEAR THEN RETURN THE QUERY OF THE USER
					return $query;
					# code...
				} elseif ($result['role'] == "admin") { //IF THE SCHOOL DOESN'T EXIST RETURN NOT FOUND
					return 'school_not_found';
				}
				# code...
			} else { //IF THE USER NOT FOUND IN THE this->DATABASE
				return 'user_not_found';
			}
		} catch (Exception $e) {
			// IF SOMETHING WHEN WRONG
			return false;
		}
		# code...
	}

	public function user_regist($Q_nom, $Q_prenom, $Q_email, $Q_telephone, $Q_pssw)
	{
		try {
			//verify that the user doesn't already existe
			$query = mysqli_query($this->database, "SELECT * FROM utilisateur WHERE email_utilisateur = '$Q_email' ");
			if ($query and mysqli_num_rows($query) == 1) {
				return 0;
				# code...
			} else {
				// IF THERE IS NOT A USER AT THIS EMAIL YET
				// SETING THE USER MATRICULE
				$query_1 = mysqli_query($this->database, "SELECT * FROM utilisateur WHERE 1");
				$Q_num_user = mysqli_num_rows($query_1) + 1;
				$Q_matr_user = $Q_nom . '&' . $Q_num_user . '|' . date("d") . '-' . date("D");
				// INSERTION OF A NEW USER
				$query = mysqli_query($this->database, "INSERT INTO utilisateur values (null, '$Q_matr_user', '$Q_nom', '$Q_prenom', '$Q_email', '$Q_telephone', '$Q_pssw', 'admin',null) ");
				if ($query) {
					$this->matricule_user = $Q_matr_user;
					return $query;
					# code...
				} else {
					return 'not_inserted';
				}
			}
		} catch (Exception $e) {
			// IF SOMETHING WENT WRONG
			return false;
		}
		# code...
	}

	public function creat_school($Q_name, $Q_logo_name, $Q_logo_path) //creation of a school
	{
		$Q_name = htmlentities(addslashes($Q_name));
		$Q_date_1 = date("Y");
		$Q_date_2 = date("Y") + 1;
		$Q_date_academique = $Q_date_1 . "-" . $Q_date_2;
		$logo_name_1 = explode(".", $Q_logo_name);
		$Q_logo_name = str_replace(" ", "", $Q_name) . "." . $logo_name_1[1];

		// MAKING THE MATR_SCHOOL
		$query_matr = mysqli_query($this->database, "SELECT * FROM etablissement where 1");
		$num_etab = mysqli_num_rows($query_matr) + 1;
		$Q_matr_school = str_replace(" ", "", $Q_name) . '&' . $num_etab . date("d/M");
		//MAKING DATE_CREATION
		$Q_date_creation = date("d/D/M/Y");
		try {

			$query = mysqli_query($this->database, "INSERT INTO etablissement values(null, '$Q_matr_school', '$Q_date_academique', '$Q_name', '$Q_logo_name', '$Q_date_creation', 'free') ");
			if ($query) {
				if (!empty($Q_logo_path)) {
					// INSERT THE LOGO IN THE DATA DOC
					move_uploaded_file($Q_logo_path, 'logo_data/' . $Q_logo_name);
					# code...
				}
				return $Q_matr_school . "|" . $Q_date_academique;
				# code...
			}
		} catch (Exception $e) {
			return false;
		}
		# code...
	}
}

/**
 * Admin class
 */
class admin extends user
{

	function __construct()
	{
		try {
			$this->database = new mysqli($this->host, $this->user, $this->pssw, $this->database) or die("unable to connect");
		} catch (Exception $e) {
			echo "someting wrong;" . $e;
			exit();
		}
	}

	public function add_year($matricule_etablissement, $year, $nom_etablissement, $logo, $date_creation, $date_academique)
	{	//creation of the academic year
		if ($year == $date_academique) {
			return -1;
			# code...
		} else {
			$logo = addslashes($logo);
			$nom_etablissement = addslashes($nom_etablissement);
			$query = mysqli_query($this->database, "INSERT INTO etablissement  VALUES (null, '$matricule_etablissement', '$year', '$nom_etablissement', '$logo', '$date_creation', 'free')");
			if ($query) {
				//keep the same school structure
				//1.matter
				$query = mysqli_query($this->database, "SELECT * FROM matiere WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$code_matiere = $result['code_matiere'] . "|" . $year;
					$nom_matiere = $result['nom_matiere'];
					$query_1 = mysqli_query($this->database, "INSERT INTO matiere values (null, '$code_matiere', '$matricule_etablissement', '$year', '$nom_matiere') ");
					# code...
				}
				//2.discipline
				$query = mysqli_query($this->database, "SELECT * FROM discipline WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$code_discipline = $result['code_discipline'] . "|" . $year;
					$code_matiere = $result['code_matiere'] . "|" . $year;
					$nom_discipline = $result['nom_discipline'];
					$query_1 = mysqli_query($this->database, "INSERT INTO discipline values(null, '$code_discipline', '$code_matiere', '$matricule_etablissement', '$year', '$nom_discipline') ");
					# code...
				}

				//3.level
				$query = mysqli_query($this->database, "SELECT * FROM niveau WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$nom_niveau = $result['nom_niveau'];
					$id = $result['id'];
					$query_1 = mysqli_query($this->database, "INSERT INTO niveau values ('$id', '$matricule_etablissement', '$year', '$nom_niveau') ");
					# code...
				}
				//4.classe
				$query = mysqli_query($this->database, "SELECT * FROM classe WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$code_classe = $result['code_classe'] . "|" . $year;
					$id_niveau = $result['id_niveau'];
					$nom_classe = $result['nom_classe'];
					$scolarite = $result['scolarite'];
					$ini = $result['ini'];
					$pssw = $result['pssw'];
					$query_1 = mysqli_query($this->database, "INSERT INTO classe values (null,'$code_classe', '$id_niveau', '$matricule_etablissement', '$year', '$nom_classe', '$scolarite', '$ini', '$pssw') ");
					# code...
				}

				//5.enseignant
				$query = mysqli_query($this->database, "SELECT * FROM enseignant WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$matricule_enseignant = $result['matricule_enseignant'];
					$nom_enseignant	= $result['nom_enseignant'];
					$prenom_enseignant	= $result['prenom_enseignant'];
					$telephone = $result['telephone'];
					$email	= $result['email'];
					$adresse = $result['adresse'];
					$disponibilite = $result['disponibilite'];
					$pssw = $result['pass'];
					$query_1 = mysqli_query($this->database, "INSERT INTO enseignant values (null, '$matricule_enseignant', '$nom_enseignant', '$prenom_enseignant', '$telephone', '$email', '$adresse', '$disponibilite', '$matricule_etablissement', '$year', $pssw ) ");
					# code...
				}

				//6.discipline classe
				$query = mysqli_query($this->database, "SELECT * FROM discipline_classe WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$code_discipline = $result['code_discipline'];
					$code_classe = $result['code_classe'];
					$matricule_enseignant = $result['matricule_enseignant'];
					$heure = $result['heure'];
					$query_1 = mysqli_query($this->database, "INSERT INTO discipline_classe values (null, '$code_discipline', '$code_classe', '$matricule_enseignant', '$matricule_etablissement', '$year', '$heure') ");
					# code...
				}

				//7.Tranche de paiement des classes
				$query = mysqli_query($this->database, "SELECT * FROM tranche_paiement WHERE matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				while ($result = mysqli_fetch_assoc($query)) {
					$code_classe = $result['code_classe'];
					$montant_tranche = $result['montant'];
					$nom_tranche = $result['nom_tranche'];
					$echeance_tranche = $result['echeance'];
					$query_1 = mysqli_query($this->database, "INSERT INTO tranche_paiement values (null, '$code_classe', '$matricule_etablissement', '$year', '$montant_tranche', '$echeance_tranche', '$nom_tranche') ");
					# code...
				}
				return 1;
			}
			# code...
		}

		# code...
	}

	public function add_user($nom, $prenom, $email, $role, $password, $matricule_etablissement)
	{
		$query = mysqli_query($this->database, "SELECT * FROM utilisateur WHERE email_utilisateur = '$email' and matricule_etablissement = '$matricule_etablissement' ");
		//A PERSON CAN HAVE JUST ONE ROLE PER SCHOOL
		if ($query and mysqli_num_rows($query) == 1) {
			return 0;
			# code...
		} elseif ($query and mysqli_num_rows($query) == 0) {
			$query = mysqli_query($this->database, "SELECT * FROM utilisateur WHERE role = '$role' ");
			//MORE THAN 3 PERSONS CANNOT HAVE DE SAME ROLE IN A SCHOOL
			if ($query and mysqli_num_rows($query) >= 3) {
				return -1;
				# code...
			} elseif ($query and mysqli_num_rows($query) < 3) {
				// SETING THE USER MATRICULE
				$query_1 = mysqli_query($this->database, "SELECT * FROM utilisateur WHERE 1");
				$Q_num_user = mysqli_num_rows($query_1) + 1;
				$Q_matr_user = $nom . '&' . $Q_num_user . '|' . date("d") . '-' . date("D");
				// INSERT INTO THE DATABASE
				$query = mysqli_query($this->database, "INSERT INTO utilisateur values(null, '$Q_matr_user', '$nom', '$prenom', '$email', null, '$password', '$role', '$matricule_etablissement') ");
				if ($query) {
					//CREATION DU CLOUD PERSONNEL
					$user_ = new user_($nom, $prenom, $email, base64_decode($password), 'me');
					$result = $user_->auth_register(1, $matricule_etablissement);
					return 1;
					# code...
				} else {
					return 2;
				}
				# code...
			} else {
				return 4;
			}
			# code...
		} else {
			return 3;
		}
		# code...
	}

	public function
	add_student_m($nom_apprenant, $prenom_apprenant, $telephone_apprenant, $adresse_apprenant, $other_info_apprenant, $tutor_apprenant, $matricule_etablissement, $code_classe, $manage_year, $matricule_apprenant, $pass)
	{
		if (1 == 1) {

			$pass = base64_encode($pass);
			$query = mysqli_query($this->database, "INSERT INTO apprenant values(null, '$matricule_apprenant', '$code_classe', '$matricule_etablissement', '$manage_year', '$nom_apprenant', '$prenom_apprenant', '$telephone_apprenant', '$adresse_apprenant', '$tutor_apprenant', '$other_info_apprenant', '$pass') ");
			if ($query) {
				//CREATION DE LA LIBRAIRIE PERSONNELLE
				$user_ = new user_($nom_apprenant, $prenom_apprenant, $matricule_apprenant, base64_decode($pass), '', 0);
				$result = $user_->auth_register(0, $matricule_etablissement);

				//EMAIL DE NOTIFICATION D'AJOUT DANS LA PLATEFORME DE E-LEARNING
?>
				<!-- 	REDIRECTION VERS LA PAGE D'IMPRESSION DE LA FICHE D'INSCRIPTION -->
				<!-- <script type="text/javascript" language="javascript">
					window.open('pup_doc.php?fname=	<?php echo $nom_apprenant . "&" ?>
							lname=<?php echo $prenom_apprenant . "&" ?>mat=<?php echo $matricule_apprenant . "&" ?>cls=<?php echo $code_classe . "&" ?>tel =<?php echo $telephone_apprenant . "&" ?>tutor=<?php echo $tutor_apprenant . "&" ?>other=<?php echo $other_info_apprenant . "&" ?>pass=<?php echo $pass ?> ');
				</script> -->
			<?php
				return 1;
				# code...
			} else {
				return 0;
			}
		} else {
			return -1;
		}

		# code...
	}
}



class headmaster extends user
{
	function __construct()
	{
		try {
			$this->database = new mysqli($this->host, $this->user, $this->pssw, $this->database) or die("unable to connect");
		} catch (Exception $e) {
			echo "someting wrong;" . $e;
			exit();
		}
	}

	public function add_level($level_name, $matricule_etablissement, $date_academique)
	{
		$query = mysqli_query($this->database, "INSERT INTO niveau values(null, '$matricule_etablissement', '$date_academique', '$level_name') ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function delete_level($level_id, $matricule_etablissement, $date_academique)
	{
		$query = mysqli_query($this->database, "DELETE FROM niveau WHERE id = '$level_id' and matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function add_class($class_name, $level_id, $matricule_etablissement, $date_academique, $scolarite, $ini, $pssw)
	{
		$code_classe = $level_id . $class_name . $date_academique;
		$query = mysqli_query($this->database, "INSERT INTO classe values(null, '$code_classe', '$level_id', '$matricule_etablissement', '$date_academique', '$class_name', '$scolarite', '$ini', '$pssw') ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function delete_class($class_code, $matricule_etablissement, $date_academique)
	{
		$query = mysqli_query($this->database, "DELETE FROM `classe` WHERE `classe`.`code_classe` = '$class_code' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function add_matter($matter_name, $matricule_etablissement, $date_academique)
	{
		$code_matter = str_replace(" ", "_", $matter_name . $matricule_etablissement . $date_academique);
		$query = mysqli_query($this->database, "INSERT INTO matiere values(null, '$code_matter', '$matricule_etablissement', '$date_academique', '$matter_name') ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function delete_matter($matter_code, $matricule_etablissement, $date_academique)
	{
		$matter_code = 	addslashes($matter_code);
		$query = mysqli_query($this->database, "DELETE FROM matiere WHERE code_matiere = '$matter_code' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function add_dis($dis_name, $code_matiere, $date_academique, $matricule_etablissement)
	{
		$query = mysqli_query($this->database, "SELECT MAX(id) as mx FROM discipline WHERE 1 ");
		$result = mysqli_fetch_assoc($query);
		$code_dis = str_replace(" ", "_", addslashes($dis_name . $matricule_etablissement . $date_academique)) . $result['mx'];
		$query = mysqli_query($this->database, "INSERT INTO discipline values(null, '$code_dis', '$code_matiere', '$matricule_etablissement', '$date_academique', '$dis_name') ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function delete_dis($code_delete_dis, $code_matiere, $matricule_etablissement, $date_academique)
	{
		$code_delete_dis = $code_delete_dis;
		$code_matiere  = $code_matiere;
		$query = mysqli_query($this->database, "DELETE FROM discipline WHERE code_discipline = '$code_delete_dis' AND code_matiere = '$code_matiere' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			$query = mysqli_query($this->database, "DELETE FROM discipline_classe WHERE code_discipline = '$code_delete_dis' AND matricule_etablissement= '$matricule_etablissement' AND date_academique = '$date_academique' ");
			if ($query) {
				$query = mysqli_query($this->database, "DELETE FROM note WHERE code_discipline = '$code_delete_dis' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
				if ($query) {
					return 1;
					# code...
				} else {
					return 0;
				}
				# code...
			}
			# code...
		}
		# code...
	}

	public function add_teacher($first_name, $last_name, $telephone, $email, $adresse, $disponibilite, $matricule_etablissement, $date_academique)
	{
		$matri_teacher = $email;
		// get random password
		$bytes = openssl_random_pseudo_bytes(random_int(4, 10));
		$pass = bin2hex($bytes);
		if (strlen($pass) > 4) {
			$pass = str_replace("=", "", substr($pass, 0, 5));
			# code...
		}
		$pass = base64_encode($pass);
		$query = mysqli_query($this->database, "INSERT INTO enseignant values(null, '$matri_teacher', '$first_name', '$last_name', '$telephone', '$email', '$adresse', '$disponibilite', '$matricule_etablissement', '$date_academique', '$pass') ");
		if ($query) {
			//CREATION DE LA LIBRAIRIE PERSONNELLE
			$user_ = new user_($first_name, $last_name, $matri_teacher, base64_decode($pass), '', 2);
			$result = $user_->auth_register(2, $matricule_etablissement);
			//EMAIL DE NOTIFICATION D'AJOUT DANS LA PLATEFORME DE E-LEARNING
			?>
			<!-- 	REDIRECTION VERS LA PAGE D'IMPRESSION DE LA FICHE D'INSCRIPTION -->
			<!-- <script type="text/javascript" language="javascript">
				window.open('pup_doc.php?fname=	<?php echo $first_name . "&" ?>
						lname=<?php echo $last_name . "&" ?>mat=<?php echo $matri_teacher . "&" ?>email=<?php echo $email . "&" ?>tel=<?php echo $telephone . "&" ?>adr=<?php echo $adresse . "&" ?>dis=<?php echo $disponibilite . "&" ?>pass=<?php echo $pass ?> ');
			</script> -->
			<?php

			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function delete_teacher($teacher_matri, $matricule_etablissement, $date_academique)
	{
		$teacher_matri = addslashes($teacher_matri);
		$query = mysqli_query($this->database, "DELETE FROM enseignant WHERE matricule_enseignant  = '$teacher_matri' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function add_dis_class($code_dis, $code_classe, $code_teacher, $hour, $matricule_etablissement, $date_academique)
	{
		$code_dis = addslashes($code_dis);
		$code_classe = addslashes($code_classe);
		$code_teacher = addslashes($code_teacher);
		$query = mysqli_query($this->database, "INSERT INTO discipline_classe values(null, '$code_dis', '$code_classe', '$code_teacher', '$matricule_etablissement', '$date_academique', '$hour') ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}


	public function delete_dis_class($code_discipline, $code_classe, $matricule_etablissement, $date_academique)
	{
		$code_discipline = addslashes($code_discipline);
		$query = mysqli_query($this->database, "DELETE FROM discipline_classe WHERE code_discipline = '$code_discipline' AND code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}

		# code...
	}

	public function update_dis_class($dis_classe, $dis_teacher, $dis_credit, $matricule_etablissement, $date_academique)
	{
		$query = mysqli_query($this->database, "UPDATE discipline_classe SET matricule_enseignant = '$dis_teacher', credit = '$dis_credit' WHERE code_classe = '$dis_classe' AND matricule_etablissement = 'matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function add_student($nom_apprenant, $prenom_apprenant, $telephone_apprenant, $adresse_apprenant, $other_info_apprenant, $tutor_apprenant, $matricule_etablissement, $code_classe, $date_academique, $ini)
	{
		if (1 == 1) {
			$matricule_apprenant = date("y") . "THIB" . $ini . "0" . random_int(1, 999);
			// get random password
			$bytes = openssl_random_pseudo_bytes(random_int(4, 10));
			$pass = bin2hex($bytes);
			if (strlen($pass) > 4) {
				$pass = str_replace("=", "", substr($pass, 0, 5));
				# code...
			}
			$pass = base64_encode($pass);
			$query = mysqli_query($this->database, "INSERT INTO apprenant values(null, '$matricule_apprenant', '$code_classe', '$matricule_etablissement', '$date_academique', '$nom_apprenant', '$prenom_apprenant', '$telephone_apprenant', '$adresse_apprenant', '$tutor_apprenant', '$other_info_apprenant', '$pass') ");
			if ($query) {
				//CREATION DE LA LIBRAIRIE PERSONNELLE
				$user_ = new user_($nom_apprenant, $prenom_apprenant, $matricule_apprenant, base64_decode($pass), '', 0);
				$result = $user_->auth_register(0, $matricule_etablissement);

				//EMAIL DE NOTIFICATION D'AJOUT DANS LA PLATEFORME DE E-LEARNING
			?>
				<!-- 	REDIRECTION VERS LA PAGE D'IMPRESSION DE LA FICHE D'INSCRIPTION -->
				<!-- <script type="text/javascript" language="javascript">
					window.open('pup_doc.php?fname=	<?php echo $nom_apprenant . "&" ?>
							lname=<?php echo $prenom_apprenant . "&" ?>mat=<?php echo $matricule_apprenant . "&" ?>cls=<?php echo $code_classe . "&" ?>tel =<?php echo $telephone_apprenant . "&" ?>tutor=<?php echo $tutor_apprenant . "&" ?>other=<?php echo $other_info_apprenant . "&" ?>pass=<?php echo $pass ?> ');
				</script> -->
<?php
				return 1;
				# code...
			} else {
				return 0;
			}
		} else {
			return -1;
		}

		# code...
	}

	public function add_time_tab($jour, $code_classe, $code_discipline, $horaire, $matricule_etablissement, $date_academique, $week, $place)
	{
		$query = mysqli_query($this->database, "SELECT * FROM calendrier WHERE code_classe = '$code_classe' AND jour = '$jour' AND horaire = '$horaire' AND week = '$week' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query and mysqli_num_rows($query) > 0) {
			return 0;
			# code...
		} else {
			$query = mysqli_query($this->database, "INSERT INTO calendrier values (null, '$code_classe', '$code_discipline', '$matricule_etablissement', '$date_academique', '$jour', '$horaire', '$week', '$place') ");
			if ($query) {
				return 1;
				# code...
			} else {
				return -1;
			}
			# code...
		}
	}

	public function week_del($week, $code_classe, $matricule_etablissement, $date_academique)
	{
		$query = mysqli_query($this->database, "DELETE FROM calendrier WHERE week = '$week' AND code_classe = '$code_classe' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}

	public function change_class($matricule_apprenant, $new_class, $date_academique, $matricule_etablissement)
	{
		$query = mysqli_query($this->database, "UPDATE apprenant SET code_classe = '$new_class' WHERE matricule_apprenant = '$matricule_apprenant' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			// code...
		} else {
			return 0;
		}
		// code...
	}

	public function add_exam($exam_name, $exam_period, $date_academique, $matricule_etablissement, $note_val)
	{
		$code_examen = $exam_name . $date_academique . random_int(10, 99999) . $matricule_etablissement;
		$query = mysqli_query($this->database, "INSERT INTO examen values(null, '$code_examen', '$matricule_etablissement', '$date_academique', '$exam_name', '$exam_period', '$note_val')");
		if ($query) {
			return true;
			// code...
		} else {
			return false;
		}
		// code...
	}

	public function delete_exam($delete_exam, $matricule_etablissement, $date_academique)
	{
		$delete_exam = addslashes($delete_exam);
		$query = mysqli_query($this->database, "DELETE FROM examen WHERE code_examen = '$delete_exam' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		if ($query) {
			return 1;
			// code...
		} else {
			return 0;
		}
		// code...
	}


	public function regler_tranche($id_tranche, $montant_tranche, $jour, $matricule_apprenant, $code_classe, $matricule_etablissement, $date_academique, $name)
	{
		$qq = mysqli_query($this->database, "SELECT montant FROM tranche_paiement WHERE id='$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		$rqq = mysqli_fetch_assoc($qq);
		$mm = $rqq['montant'];
		$q = mysqli_query($this->database, "SELECT SUM(montant) as montant FROM compta WHERE id_tranche='$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND matricule_apprenant = '$matricule_apprenant' ");
		$rq = mysqli_fetch_assoc($q);
		$m = $rq['montant'];
		echo $mm . "<br>";
		echo  $m + $montant_tranche;
		exit();
		if ($mm >= $m and $mm > $m + $montant_tranche) {
			$query = mysqli_query($this->database, "INSERT INTO compta values(null, '$id_tranche', '$matricule_apprenant', '$code_classe', '$matricule_etablissement', '$date_academique', '$montant_tranche', '$jour', '$name')");
			if ($query) {
				return 1;
				# code...
			} else {
				return 0;
			}
			# code...

			# code...
		} else {
			return 2;
		}
	}
}


/**
 * Compatable class
 */
class comptable extends user
{

	function __construct()
	{
		try {
			$this->database = new mysqli($this->host, $this->user, $this->pssw, $this->database) or die("unable to connect");
		} catch (Exception $e) {
			echo "someting wrong;" . $e;
			exit();
		}
	}
	public function add_tranche($nom_tranche, $montant_tranche, $echeance_tranche, $code_classe, $matricule_etablissement, $date_academique)
	{
		$qq = mysqli_query($this->database, "SELECT scolarite FROM classe WHERE code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		$rqq = mysqli_fetch_assoc($qq);
		$cm = $rqq['scolarite'];
		$cm = floatval(str_replace(" ", "", $cm));
		$q = mysqli_query($this->database, "SELECT SUM(montant) AS montant FROM tranche_paiement WHERE code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		$rq = mysqli_fetch_assoc($q);
		$mtt = 0 + $rq['montant'];
		if ($montant_tranche + $mtt <= $cm) {
			$query = mysqli_query($this->database, "INSERT INTO tranche_paiement values(null, '$code_classe', '$matricule_etablissement', '$date_academique', '$montant_tranche', '$echeance_tranche', '$nom_tranche')");
			if ($query) {
				return 1;
				# code...
			} else {
				return 0;
			}
			# code...
		} else {
			return 2;
		}
		// code...
	}

	public function delete_tranche($id_tranche, $code_classe, $date_academique, $matricule_etablissement)
	{
		$query = mysqli_query($this->database, "DELETE FROM tranche_paiement WHERE id = '$id_tranche' AND code_classe = '$code_classe' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
			# code...
		}

		# code...
	}
	public function regler_tranche($id_tranche, $montant_tranche, $jour, $matricule_apprenant, $code_classe, $matricule_etablissement, $date_academique, $name)
	{
		$qq = mysqli_query($this->database, "SELECT montant FROM tranche_paiement WHERE id='$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		$rqq = mysqli_fetch_assoc($qq);
		$mm = $rqq['montant'];
		$q = mysqli_query($this->database, "SELECT SUM(montant) as montant FROM compta WHERE id_tranche='$id_tranche' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' AND matricule_apprenant = '$matricule_apprenant' ");
		$rq = mysqli_fetch_assoc($q);
		$m = $rq['montant'] + 0;
		if ($mm > $m and $mm + 1 > $m + $montant_tranche) {
			$query = mysqli_query($this->database, "INSERT INTO compta values(null, '$id_tranche', '$matricule_apprenant', '$code_classe', '$matricule_etablissement', '$date_academique', '$montant_tranche', '$jour', '$name')");
			if ($query) {
				return 1;
				# code...
			} else {
				return 0;
			}
			# code...

			# code...
		} else {
			return 2;
		}
	}
}





/**
 * Secretary class
 */
class secretary extends user
{

	function __construct()
	{
		# code...
	}
}

/**
 * Tcheacher class
 */
class teacher extends user
{

	function __construct()
	{
		try {
			$this->database = new mysqli($this->host, $this->user, $this->pssw, $this->database) or die("unable to connect");
		} catch (Exception $e) {
			echo "someting wrong;" . $e;
			exit();
		}
	}

	public function save_note($matricule_apprenant, $exam_code, $code_discipline, $date_academique, $matricule_etablissement, $indexval)
	{
		//VERIFIER QUE LA NOTE N'EXISTE PAS DEJA POUR LE MEME ELEVE POUR LE MEME EXAMEN
		$matricule_apprenant = addslashes($matricule_apprenant);
		$exam_code = addslashes($exam_code);
		$code_discipline = addslashes($code_discipline);
		$query = mysqli_query($this->database, "SELECT * FROM note WHERE  matricule_apprenant = '$matricule_apprenant' AND code_examen = '$exam_code' AND code_discipline = '$code_discipline' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement' ");
		if (mysqli_num_rows($query) == 1) {
			$query = mysqli_query($this->database, "UPDATE note set note = '$indexval' WHERE  matricule_apprenant = '$matricule_apprenant' AND code_examen = '$exam_code' AND code_discipline = '$code_discipline' AND date_academique = '$date_academique' AND matricule_etablissement = '$matricule_etablissement'  ");
			if ($query) {
				return 1;
				# code...
			} else {
				return 0;
			}
			# code...
		} else {
			$query = mysqli_query($this->database, "INSERT INTO note values ( null, '$code_discipline', '$indexval', '$exam_code', '$matricule_apprenant', '$matricule_etablissement', '$date_academique' ) ");
			if ($query) {
				return 1;
				# code...
			} else {
				return 0;
			}
			# code...
		}

		# code...
	}

	public function delete_note($code_examen, $code_discipline, $matricule_apprenant, $matricule_etablissement, $date_academique)
	{
		$query = mysqli_query($this->database, "DELETE FROM note WHERE matricule_apprenant = '$matricule_apprenant' AND code_examen = '$code_examen' AND code_discipline = '$code_discipline' AND matricule_etablissement = '$matricule_etablissement' AND date_academique = '$date_academique' ");
		if ($query) {
			return 1;
			# code...
		} else {
			return 0;
		}
		# code...
	}
}


/**
 * COOKIE session class
 */
class cookie_session extends user
{
	public $cookie_value = null;

	function __construct($Q_date_academique, $Q_user_email)
	{
		try {
			$this->database = new mysqli($this->host, $this->user, $this->pssw, $this->database) or die("unable to connect");
		} catch (Exception $e) {
			echo "someting wrong;" . $e;
			exit();
		}
		$Q_query = mysqli_query($this->database, "SELECT * FROM utilisateur WHERE email_utilisateur = '$Q_user_email'");
		$result = mysqli_fetch_assoc($Q_query);
		$matricule_user = $result['matricule_utlisateur'];
		$matricule_etablissement  = $result["matricule_etablissement"];
		$query = mysqli_query($this->database, "SELECT * FROM etablissement where date_academique = '$Q_date_academique' ");
		$result_1 = mysqli_fetch_assoc($query);
		$this->date_academique = $result_1["date_academique"];
		$this->cookie_value = $matricule_user . "µ" . $matricule_etablissement . "£" . $this->date_academique;
		setcookie("user_cookie", $this->cookie_value, time() + 60 * 60);
		return 1;
		# code...
	}
}
