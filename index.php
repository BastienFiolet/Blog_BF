<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');
include('includes/header.inc.php');

date_default_timezone_set('UTC');	//date par défaut en UTC

$res = mysql_query("SELECT * FROM articles");

//$data = mysql_fetch_array($res);

while($data = mysql_fetch_array($res)){
	$id = $data['id'];
	echo '<h3>'.htmlspecialchars($data['titre']).'</h3>';
	//echo '<p>'.$data['contenu'].'</p>';

	$chemin = "data/images/$id.jpg";				
	if(file_exists($chemin)){
		echo "<img src='vignette.jpg.php?id=$id'>";
	}
	echo "<div align='justify'>".nl2br(htmlspecialchars($data['contenu']))."</div>";
	echo "<h5>".date('Y/m/d',$data['date'])."</h5>";
	
	//var_dump($data);
		
	if($connect == true){
		echo "<a href='article.php?id=$id' class='btn btn-primary'>Modifier</a>";
		echo "<a href='supprimer_article.php?id=$id' class='btn btn-primary'>Supprimer</a>";
	}
}

//var_dump($data);
include('includes/footer.inc.php');
?>