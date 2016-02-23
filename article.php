<?php
include('includes/connexion.inc.php');
include('includes/verif_util.inc.php');
include('includes/header.inc.php');
//move_uploaded_fil($chemin_src,$chemin_dest)
//$chemin_src -> ['tmp_name']
//$chemin_dest -> dirname(__FILE__).'/chemin/fichier.ext'
//mysql_insert_id()

if($connect != true){
	header('Location:index.php');
}

if(isset($_POST['titre'])){
	
	/*TRAITEMENTS*/
	
	// si id existe alors on modifie
	if(isset($_POST['id'])){ 
		//pour éviter les injections de code
		$title = mysql_real_escape_string ($_POST['titre']);
		$cont = mysql_real_escape_string ($_POST['texte']);
		$id =(int) $_POST['id'];
		//on update le contenu et le titre
		$req = mysql_query("UPDATE articles SET titre='$title', contenu='$cont' WHERE id='$id';");
		mysql_query($req);
		//l'image prend le nom de l'id de l'article
		$nameimg = $id;
		header('Location:index.php');
	}
	//sinon on ajoute
	else{ 
		$titre = mysql_real_escape_string ($_POST['titre']);
		$contenu = mysql_real_escape_string ($_POST['texte']);
		$date = time();
		//création de contenu et titre
		mysql_query("INSERT INTO articles(titre, contenu, date) VALUES('$titre','$contenu', '$date');");
		$nameimg = mysql_insert_id();
		
		echo"<div class='alert alert-success'>
		<strong>Success!</strong>
		</div>";
		header('Location:index.php');
	}
	//si il contient une image
	if(isset($_FILES['image']) && isset($_FILES['image']['tmp_name'])){
		$chemin_src = $_FILES['image']['tmp_name'];
		//accède au chemin de l'image
		
		$chemin_dest = dirname(__FILE__)."/data/images/$nameimg.jpg";
		//met les nom des dossiers dans un tableau
		$verification = explode("/", $_FILES['image']['type']);
		//on regarde si l'extension est bien jpeg
		if($verification[1] == "jpeg"){
			move_uploaded_file($chemin_src,$chemin_dest);
		}
	}
	
}else{
		/*FORMULAIRE*/
	$title="";
	$cont="";

	if(isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$res = mysql_query("SELECT * FROM articles WHERE id=$id");
		$data = mysql_fetch_array($res);
		$title=mysql_real_escape_string ($data['titre']);
		$cont=mysql_real_escape_string ($data['contenu']);
	}

?>
	 <!--div = style bootstrap-->
<form action='article.php' method='post' enctype="multipart/form-data">
	<div class='clearfix'>
		<label for='titre' >Titre</label>
		<div class='input'><input type='text' name='titre' id='titre' value="<?php echo $title?>"></div>
	</div>
	<div class='clearfix'>
		<label for='texte'>Texte</label>
		<input type="file" name="image">
		<div class='input'><textarea name='texte' id='texte'><?php echo $cont?></textarea></div>
	</div>
		<input type='submit' value='Enregistrer' class ='btn btn-primary'>
		<?php if(isset($_GET['id'])){ echo"<input type='hidden' name='id' value='$id'> ";}?>
</form>

<?php
/* RAPPEL COUR */
	//var_dump($_POST);
	// form ternaire : $var = condition ? sivrai : sifaux;
	//= if(condition) $var = sivrais; else $var = sifaux;
	
	//extract($data)=> $foo = $data['foo']  $bar = $data['bar']  faire attention doublon = écrasement de variables
}
	
include('includes/footer.inc.php');
?>