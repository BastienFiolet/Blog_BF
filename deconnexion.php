<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');

if($connect == true){
	setcookie("sid","$sid",time()-30000);
	header('Location:index.php');
}else{
	header('Location:index.php');
}

?>
