<?php

include('includes/connexion.inc.php');
header("Content-type: image/jpg");

//chemin image

$id =(int) $_GET['id'];
$chemin = "data/images/$id.jpg";
//echo $chemin;

//calculer ration et taille image($largeur=200)

$temp = getimagesize($chemin);
//var_dump($temp);
$oldlarg = $temp[0];
$oldhaut = $temp[1];
$baselarg = 200;
$x = $oldlarg/$baselarg;		//ratio
$nvlarg = $oldlarg/$x;
$nvhaut = $oldhaut/$x;
//echo $x;
//echo $nvlarg;
//echo $nvhaut;

//créer img dest

$image = imagecreatetruecolor($nvlarg, $nvhaut);
$myimage = imagecreatefromjpeg($chemin);
imagecopyresampled($image, $myimage, 0, 0, 0, 0, $nvlarg, $nvhaut, $oldlarg, $oldhaut);

//affichage

imagejpeg($image, null, 100);

//imagecopyresampled	imagecreatefromjpeg	getimagesize	imagecreatetruecolor	imagejpeg
?>