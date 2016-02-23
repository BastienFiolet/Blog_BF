<?php
//1 includes
//2 recup id
//3 requete suppression DELETE FROM articles WHERE id = x
//4 redir index.php (uniquement aprés débug)
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');

//si on est connecté
if($connect == true){	
	$id=(int)$_GET['id'];
	$result = mysql_query("DELETE FROM articles WHERE id=$id;");
	mysql_query($result);
	header('Location:index.php');
}
//sinon redirection
else{	
	header('Location:index.php');
}
?>