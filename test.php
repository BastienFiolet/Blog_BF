<?php
include('includes/connexion.inc.php');

$res = mysql_query("SELECT * FROM articles");

echo mysql_fetch_array($res);
$data = mysql_fetch_array($res);

$data = mysql_fetch_array($res);
	echo $data['titre'];
	
//var_dump($data);


?>