<?php
//code existe ?
//utilisateur existe avec sid ?
//$connecte = true
include('connexion.inc.php');

if(isset($_COOKIE['sid'])&& $_COOKIE['sid'] != null){
	
	$sid = $_COOKIE['sid'];
	$req = mysql_query("SELECT * FROM utilisateurs WHERE sid='$sid'");
	$data = mysql_fetch_array($req);
	
		if($data){
		
			$email= mysql_query("SELECT email FROM utilisateurs WHERE sid='$sid'");
			$connect = true;
			$email_uti = mysql_fetch_array($email);
			$email_util = $email_uti['email'];
			echo "<div class='alert alert-success'>vous êtes connecté</div>";
		
		}else{
		
			$connect = false;
		}
	}else{
		$connect = false;
	}
?>