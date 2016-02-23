<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');
include('includes/header.inc.php');

//date par défaut en UTC
date_default_timezone_set('UTC');	

//si le bouton recherche est appuyé
if(isset($_POST['search-bar'])){	
	$rech = mysql_real_escape_string ($_POST['search-bar']);
	//classe en tableau les mots saisis
	$expl = explode(" ", $rech);	
	//le sizeof commence à 1 et non à 0
	$var = sizeof($expl)-1;
	
	//début de la requète SQL
	$req = "SELECT * FROM articles WHERE";
	//on boucle pour avoir tous les mots
	for($i=0 ; $i<=$var ; $i++){	
		//si on arrive à la fin
		if($i == $var){
			$req .= " titre LIKE '%$expl[$i]%' OR contenu LIKE '%$expl[$i]%';";
		}else{
			$req .= " titre LIKE '%$expl[$i]%' OR contenu LIKE '%$expl[$i]%' OR";
		}
	}
	
	//affiche la requête complète
	$res = mysql_query($req);	
	
}
//sinon on choisi tout
else{	
	$res = mysql_query("SELECT * FROM articles");
}

//$data = mysql_fetch_array($res);

//tant qu'il y a quelque chose dans res
while($data = mysql_fetch_array($res)){ 

	$id = $data['id'];
	//affiche le titre
	echo '<h3>'.htmlspecialchars($data['titre']).'</h3>';	

	//chemin menant à l'image
	$chemin = "data/images/$id.jpg";				
	//si image existe, affiche la vignette
	if(file_exists($chemin)){		
		echo "<img src='vignette.jpg.php?id=$id'>";
	}
	//affiche le contenu
	echo "<div align='justify'>".nl2br(htmlspecialchars($data['contenu']))."</div>";	
	//affiche la date
	echo "<h5>".date('Y/m/d',$data['date'])."</h5>";	
		
	//si on est connecté, on affiche la modification et la suppression
	if($connect == true){
		echo "<a href='article.php?id=$id' class='btn btn-primary'>Modifier</a>";
		echo "<a href='supprimer_article.php?id=$id' class='btn btn-primary'>Supprimer</a>";
	}
}

include('includes/footer.inc.php');

?>