<?php 
	if (isset($_POST['description'])) {
		include "connect_database.php";
		session_start();
		$userid=$_SESSION['id_user'];
		$username=$_SESSION['username'];
		$description=$_POST['yourDescription'];
		$picture=$_FILES['picture']['name'];
		if(isset($_FILES['picture']) and $_FILES['picture']['error']==0){
			$dossier= '../pictures/';
			$temp_name=$_FILES['picture']['tmp_name'];
			if(!is_uploaded_file($temp_name)){
				exit("le fichier est untrouvable");
			}
			if ($_FILES['picture']['size'] >= 1000000){
				exit("Erreur, le fichier est volumineux");
			}
			$infosfichier = pathinfo($_FILES['picture']['name']);
			$extension_upload = $infosfichier['extension'];
			
			$extension_upload = strtolower($extension_upload);
			$extensions_autorisees = array('png','jpeg','jpg');
			if (!in_array($extension_upload, $extensions_autorisees)){
				exit("Erreur, Veuillez inserer une image svp (extensions autorisées: png)");
			}
			$nom_photo=$picture;
			if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
				exit("Problem dans le telechargement de l'image, Ressayez");
			}
			$ph_name=$nom_photo;
			$requete1="UPDATE `user` SET`picture`='$ph_name' WHERE `id_user`= $userid"; 
        	mysqli_query($link,$requete1);
		}
		if ($description !== "Hey, i'm using KadimiMessagerie") {
			$requete2="UPDATE `user` SET `description`='$description' WHERE `id_user`= $userid"; 
        	mysqli_query($link,$requete2);
		}
		header("Location: ../whatdoyoulike.php");
	} 
?>