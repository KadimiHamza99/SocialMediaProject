<?php 
	include("connect_database.php");
	$user_timeline=$_GET['user_timeline'];
	session_start(); 
    if (isset($_POST['unlike'])) {
		$id_user=$_SESSION['id_user'];
    	$page=$_GET['page'];
		$id_pub=$_GET['id'];
		$sql="UPDATE publication SET likes=likes-1 WHERE id_publication='$id_pub'";
        mysqli_query($link, $sql);
        
		$sql1="DELETE FROM `publications_likes` WHERE id_user='$id_user' AND id_publication='$id_pub'";
        mysqli_query($link,$sql1);
        
        if ($page=='acceuil') {
			header("Location: ../acceuil.php#$id_pub");
		}
        if($page=='profile') {
			$user=$_GET['user'];
			header("Location: ../timeline.php?user_timeline=$user_timeline#$id_pub");
		}
	}
?>