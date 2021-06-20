<?php 
if (isset($_POST['publier']) AND !empty($_POST['publication'])) {
	include("connect_database.php");
	session_start();
	$id_user=$_SESSION['id_user'];
	$page=$_GET['page'];
	$date=date("Y-m-d H:i:s");
	$contenue=addslashes($_POST['publication']);
	$sql1="INSERT INTO `publication` VALUES (0,'$contenue','$id_user','$date',0)";
    $result1=mysqli_query($link,$sql1);
	$user_timeline=$_GET['user_timeline'];
    if ($page=="acceuil") {
    	header("Location: ../acceuil.php");
    }else if($page=="timeline"){
		header("Location: ../timeline.php?user_timeline=$user_timeline");
	}
}
?>
