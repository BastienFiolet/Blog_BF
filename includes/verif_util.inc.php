<?php
//code existe ?
//utilisateur existe avec sid ?
//$connecte = true
include('connexion.inc.php');

//si il existe un cookie et qu'il n'est non null
if(isset($_COOKIE['sid'])&& $_COOKIE['sid'] != null){
	
	$sid = $_COOKIE['sid'];
	//on récupère les sid
	$req = mysql_query("SELECT * FROM utilisateurs WHERE sid='$sid'");
	$data = mysql_fetch_array($req);
	
		//si data existe
		if($data){
		
			//on récupère l'email et on dit que l'utilisateur est connecté
			$email= mysql_query("SELECT email FROM utilisateurs WHERE sid='$sid'");
			$connect = true;
			$email_uti = mysql_fetch_array($email);
			$email_util = $email_uti['email'];
			echo "<div class='alert alert-success'>vous êtes connecté</div>";
		
		}
		//sinon la connexion est à false
		else{
			$connect = false;
		}
}
//sinon la connexion est à false
else{
	$connect = false;
}
?>