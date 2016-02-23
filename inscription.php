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

// On met les variables utilis� dans le code PHP � FALSE (C'est-�-dire les d�sactiver pour le moment).
$error = FALSE;
$registerOK = FALSE;

// On regarde si l'utilisateur est bien pass� par le module d'inscription
if(isset($_POST['email'])){
	
	$email = mysql_real_escape_string ($_POST['email']);
	$mdp = mysql_real_escape_string (MD5($_POST['mdp']));
	$confmdp = mysql_real_escape_string (MD5($_POST['confmdp']));
	
	// On regarde si tout les champs sont remplis, sinon, on affiche un message � l'utilisateur.
    if(!isset($email) || !isset($mdp) || !isset($confmdp)){  
		// On met la variable $error � TRUE pour que par la suite le navigateur sache qu'il y'a une erreur � afficher.
		$error = TRUE;
            
		// On �crit le message � afficher :
		$errorMSG = "Tous les champs doivent �tre remplis !";
        }

	// Sinon, si les deux mots de passes correspondent :
	elseif($mdp == $confmdp){
		
		// On regarde si le mot de passe et le nom de compte n'est pas le m�me
		if($email != $mdp){
                
			// Si c'est bon on regarde dans la base de donn�e si le nom de compte est d�j� utilis� :
			$sql = mysql_query("SELECT email FROM utilisateurs WHERE email='$email';");
            
			// Si $sql est �gal � 0 (c'est-�-dire qu'il n'y a pas de nom de compte avec la valeur tap� par l'utilisateur
			if(mysql_num_rows($sql) == 0){
               
				$mdp = "$mdp";
				// Si tout va bien on regarde si le mot de passe n'ex�de pas 60 caract�res.
				if(strlen($mdp < 60)){
					
					$email= "$email";
					// Si tout va bien on regarde si le nom de compte n'ex�de pas 60 caract�res.
					if(strlen($email < 60)){
                     
							// Si tout se passe correctement, on peut maintenant l'inscrire dans la base de donn�es :
							$var = mysql_query("INSERT INTO utilisateurs (email, mdp) VALUES ('$email', '$mdp');");
                           
							// Si la requ�te s'est bien effectu� :
							if($var){
								// On met la variable $registerOK � TRUE pour que l'inscription soit finalis�
								$registerOK = TRUE;
								// On l'affiche un message pour le dire que l'inscription c'est bien d�roul� :
								$registerMSG = "Inscription reussie ! Vous etes maintenant membre du blog.";
							}
                           
							// Sinon on affiche un message d'erreur
							else{
								$error = TRUE;
								$errorMSG = "Erreur dans la requete SQL<br/>".$var."<br/>";
							}
						
					}
					// Sinon on fait savoir � l'utilisateur qu'il a mit un nom de compte trop long.
					else{
							$error = TRUE;
							$errorMSG = "Votre nom compte ne doit pas depasser <strong>60 caracteres</strong> !";
							$email = NULL;
							$mdp = $mdp;
                        }
						
                  }
                  
				// Si le mot de passe d�passe 60 caract�res on le fait savoir
				else{
					$error = TRUE;
					$errorMSG = "Votre mot de passe ne doit pas depasser <strong>60 caracteres</strong> !";
					$email = $email;
					$mdp = NULL;
				}
			}
               
			// Sinon on affiche un message d'erreur lui disant que ce nom de compte est d�j� utilis�.
			else{
				$error = TRUE;
				$errorMSG = "Le nom de compte <strong>".$email."</strong> est d�j� utilise !";
				$email = NULL;
				$mdp = $mdp;
			}
		}
            
		// Sinon on fais savoir � l'utilisateur qu'il doit changer le mot de passe ou le nom de compte
		else{
			$error = TRUE;
			$errorMSG = "Le nom de compte et le mot de passe doivent etres differents !";
            }
	}
	
	// Sinon si les deux mots de passes sont diff�rents :      
	elseif($mdp != $confmdp){
		$error = TRUE;
		$errorMSG = "Les deux mots de passes sont differents !";
		$login = $email;
		$pass = NULL;
	}
	
	// Sinon si le nom de compte et le mot de passe ont la m�me valeur :
	elseif($email == $mdp){
		$error = TRUE;
		$errorMSG = "Le nom de compte et le mot de passe doivent �tre differents !";
	}
}
?>

<?php // On affiche les erreurs :
   if($error == TRUE){ echo "<p align='center' style='color:red;'>".$errorMSG."</p>";}
?>

<?php // Si l'inscription s'est bien d�roul�e on affiche le succ�s :
   if($registerOK == TRUE){ echo "<p align='center' style='color:green;'><strong>".$registerMSG."</strong></p>"; }
?>

<?php
	include('includes/footer.inc.php');
?>