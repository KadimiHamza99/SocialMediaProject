<?php 
	include("connect_database.php");
	session_start();
	$user_timeline=$_GET['user_timeline'];
	if (isset($_POST['like'])) {
		$id_user=$_SESSION['id_user'];
		$page=$_GET['page'];
		$id_pub=$_GET['id'];

		$sql="UPDATE publication SET likes=likes+1 WHERE id_publication='$id_pub'";
		mysqli_query($link, $sql);

		$sql1="INSERT INTO `publications_likes`(`id`, `id_publication`, `id_user`) VALUES (0,'$id_pub','$id_user')";
		mysqli_query($link,$sql1);

		if ($page=='acceuil') {
			header("Location: ../acceuil.php#$id_pub");
		}
		if($page=='profile') {
			
			header("Location: ../timeline.php?user_timeline=$user_timeline#$id_pub");
		}
	}
?>