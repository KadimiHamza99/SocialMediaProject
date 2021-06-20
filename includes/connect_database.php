<?php 
	$url = 'localhost';
	$username = 'root';
	$password = '';
	$dbName = 'PremierProjet';
	$link=mysqli_connect($url, $username,$password,$dbName) or die('echec de connection');	
?>