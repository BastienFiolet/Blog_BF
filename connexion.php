<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');
include('includes/header.inc.php');
?>


<!--formulaire-->
<form action='connexion.php' method='post'>
	<div class='clearfix'>
		<label for='texte'>Email</label>
		<div class='input'> <input type="email" name="email"></div>
	</div>
	<div class='clearfix'>
		<label for='texte'>Mot de passe</label>
		<div class='input'><input type="password" name="mdp"></div>
	</div>
	<input type='submit' value='Connexion' class ='btn btn-primary'>
</form>
<?php
/*Traitement*/
if(isset($_POST['email'])){
	//pour éviter les injections de code
	$email = mysql_real_escape_string ($_POST['email']);
	$mdp = mysql_real_escape_string ($_POST['mdp']);

	$req = mysql_query("SELECT * FROM utilisateurs WHERE email='$email' AND mdp= MD5('$mdp')");
	/*dans if on peux : $data =mfa($req)
	if($data)*/
	
	//si l'utilisateur a été inscrit et qu'il se connecte, on lui crée un sid
	if( mysql_num_rows($req) == 1){   
		$sid = md5($email.time());
		$req2 = mysql_query("UPDATE utilisateurs SET sid='$sid' WHERE email='$email';");
		//le cookie se créé
		setcookie("sid","$sid",time()+30000);
		//redirection
		header('Location:index.php');
	}
}

include('includes/footer.inc.php');

?>