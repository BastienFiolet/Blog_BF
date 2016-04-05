<?php

/*
inc connexion bdd
recup email
req SQL
retour 'OK'
		'déjà abonné'
		'ko'

1. Créer table newsletter
	id
	email (varchar(255))
2. Créer script newsletter.php?email=foo@bar.com
3. Créer form dans menu
	champ + bouton 
4. Requête ajax sur click()
5. Message selon retour
*/

include('includes/connexion.inc.php');

$resultat = array('OK', 'Deja abonne', 'KO');
$email = mysql_real_escape_string($_GET['email']);

$data = "Veuillez rentrer une adresse valide";
$verif = false;

if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

	$res = mysql_query("SELECT email FROM newsletter WHERE email='$email'");

	if(mysql_num_rows($res) > 0){
		$data = $resultat[1];
	}elseif(mysql_num_rows($res) == 0){
		$data = $resultat[0];
		mysql_query("INSERT INTO newsletter (email) VALUES ('$email')");
		$verif = true;
	}else{
		$data = $resultat[2];
	}

}

if($verif == false){
	echo "<div class='alert alert-danger'>
	<button onclick='removeParent()' type='button' class='close' data-dismiss='alert'>&times;</button>
		$data
	</div>";
}else{
	echo "<div class='alert alert-success'>
	<button  onclick='removeParent()' type='button' class='close' data-dismiss='alert'>&times;</button>
		$data
	</div>";
}