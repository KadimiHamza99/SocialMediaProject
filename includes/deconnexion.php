<?php 
	include('connect_database.php');
    session_start();
    $id_user=$_SESSION['id_user'];
    session_destroy();  
    $req3="UPDATE user SET is_active= 0 WHERE id_user='$id_user'";
	mysqli_query($link,$req3);
	header("Location: ../index.php");
    
?>