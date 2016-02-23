<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');
include('includes/header.inc.php');
?>

<!--formulaire-->
<form action='inscription.php' method='post'>
	<div class='clearfix'>
		<label for='texte'>Email</label>
		<div class='input'> <input type="email" name="email"></div>
	</div>
	<div class='clearfix'>
		<label for='texte'>Mot de passe</label>
		<div class='input'><input type="password" name="mdp"></div>
	</div>
	<div class='clearfix'>
		<label for='texte'>Confirmez mot de passe</label>
		<div class='input'><input type="password" name="confmdp"></div>
	</div>
	<input type='submit' value='Inscription' class ='btn btn-primary'>
</form>

<?php
/*Traitement*/

// On met les variables utilisé dans le code PHP à FALSE (C'est-à-dire les désactiver pour le moment).
$error = FALSE;
$registerOK = FALSE;

// On regarde si l'utilisateur est bien passé par le module d'inscription
if(isset($_POST['email'])){
	
	$email = mysql_real_escape_string ($_POST['email']);
	$mdp = mysql_real_escape_string (MD5($_POST['mdp']));
	$confmdp = mysql_real_escape_string (MD5($_POST['confmdp']));
	
	// On regarde si tout les champs sont remplis, sinon, on affiche un message à l'utilisateur.
    if(!isset($email) || !isset($mdp) || !isset($confmdp)){  
		// On met la variable $error à TRUE pour que par la suite le navigateur sache qu'il y'a une erreur à afficher.
		$error = TRUE;
            
		// On écrit le message à afficher :
		$errorMSG = "Tous les champs doivent être remplis !";
        }

	// Sinon, si les deux mots de passes correspondent :
	elseif($mdp == $confmdp){
		
		// On regarde si le mot de passe et le nom de compte n'est pas le même
		if($email != $mdp){
                
			// Si c'est bon on regarde dans la base de donnée si le nom de compte est déjà utilisé :
			$sql = mysql_query("SELECT email FROM utilisateurs WHERE email='$email';");
            
			// Si $sql est égal à 0 (c'est-à-dire qu'il n'y a pas de nom de compte avec la valeur tapé par l'utilisateur
			if(mysql_num_rows($sql) == 0){
               
				$mdp = "$mdp";
				// Si tout va bien on regarde si le mot de passe n'exède pas 60 caractères.
				if(strlen($mdp < 60)){
					
					$email= "$email";
					// Si tout va bien on regarde si le nom de compte n'exède pas 60 caractères.
					if(strlen($email < 60)){
                     
							// Si tout se passe correctement, on peut maintenant l'inscrire dans la base de données :
							$var = mysql_query("INSERT INTO utilisateurs (email, mdp) VALUES ('$email', '$mdp');");
                           
							// Si la requête s'est bien effectué :
							if($var){
								// On met la variable $registerOK à TRUE pour que l'inscription soit finalisé
								$registerOK = TRUE;
								// On l'affiche un message pour le dire que l'inscription c'est bien déroulé :
								$registerMSG = "Inscription reussie ! Vous etes maintenant membre du blog.";
							}
                           
							// Sinon on affiche un message d'erreur
							else{
								$error = TRUE;
								$errorMSG = "Erreur dans la requete SQL<br/>".$var."<br/>";
							}
						
					}
					// Sinon on fait savoir à l'utilisateur qu'il a mit un nom de compte trop long.
					else{
							$error = TRUE;
							$errorMSG = "Votre nom compte ne doit pas depasser <strong>60 caracteres</strong> !";
							$email = NULL;
							$mdp = $mdp;
                        }
						
                  }
                  
				// Si le mot de passe dépasse 60 caractères on le fait savoir
				else{
					$error = TRUE;
					$errorMSG = "Votre mot de passe ne doit pas depasser <strong>60 caracteres</strong> !";
					$email = $email;
					$mdp = NULL;
				}
			}
               
			// Sinon on affiche un message d'erreur lui disant que ce nom de compte est déjà utilisé.
			else{
				$error = TRUE;
				$errorMSG = "Le nom de compte <strong>".$email."</strong> est déjà utilise !";
				$email = NULL;
				$mdp = $mdp;
			}
		}
            
		// Sinon on fais savoir à l'utilisateur qu'il doit changer le mot de passe ou le nom de compte
		else{
			$error = TRUE;
			$errorMSG = "Le nom de compte et le mot de passe doivent etres differents !";
            }
	}
	
	// Sinon si les deux mots de passes sont différents :      
	elseif($mdp != $confmdp){
		$error = TRUE;
		$errorMSG = "Les deux mots de passes sont differents !";
		$login = $email;
		$pass = NULL;
	}
	
	// Sinon si le nom de compte et le mot de passe ont la même valeur :
	elseif($email == $mdp){
		$error = TRUE;
		$errorMSG = "Le nom de compte et le mot de passe doivent être differents !";
	}
}
?>

<?php // On affiche les erreurs :
   if($error == TRUE){ echo "<p align='center' style='color:red;'>".$errorMSG."</p>";}
?>

<?php // Si l'inscription s'est bien déroulée on affiche le succès :
   if($registerOK == TRUE){ echo "<p align='center' style='color:green;'><strong>".$registerMSG."</strong></p>"; }
?>

<?php
	include('includes/footer.inc.php');
?>