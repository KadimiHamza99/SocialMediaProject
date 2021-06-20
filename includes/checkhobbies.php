<?php 
	if (isset($_POST['hobbies'])) {
		include "connect_database.php";
		session_start();
		$userid=$_SESSION['id_user'];
		$username=$_SESSION['username'];
		$check_empty=0;
		// SPORTS
    	if (isset($_POST['sports'])) {
    	    $sports=1;
    	    $check_empty++;
    	}
    	else {
    	    $sports=0;
    	}
		//MUSIC
    	if (isset($_POST['music'])) {
    	    $music=1;
    	    $check_empty++;
    	}
    	else {
    	    $music=0;
    	}
		//GAMING
    	if (isset($_POST['gaming'])) {
    	    $gaming=1;
    	    $check_empty++;
    	}
    	else {
    	    $gaming=0;
    	}
		//POLITICS
    	if (isset($_POST['politics'])) {
    	    $politics=1;
    	    $check_empty++;
    	}
    	else {
    	    $politics=0;
    	}
		//SCIENCE
    	if (isset($_POST['science'])) {
    	    $science=1;
    	    $check_empty++;
    	}
    	else {
    	    $science=0;
    	}
    	$sql="INSERT INTO `hobbies`(`id`, `id_user`, `sports`, `politics`, `music`, `gaming`, `science`) VALUES (0,'$userid','$sports','$politics','$music','$gaming','$science')";
    	mysqli_query($link,$sql);
    	if ($check_empty==0) {
     	  header('Location: ../acceuil.php');
    	}
    	else{
       		header('Location: ../suggestions.php');
    	}
	}else{
		header('Location: ../index.php');
	}
?>