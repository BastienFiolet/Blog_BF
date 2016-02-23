<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');

//si on est connecté, on "détruit" le cookie en lui mettant une valeur négative
if($connect == true){
	setcookie("sid","$sid",time()-30000);
	header('Location:index.php');
}
//sinon on redirige sur l'index 
else{
	header('Location:index.php');
}

?>
