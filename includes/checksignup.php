<?php 
if (isset($_POST['signup'])) {
	include_once "connect_database.php";
	function check($str){
		return addslashes(htmlspecialchars(strip_tags($str)));
	}
	$username=check($_POST['username']);
	$email=check($_POST['email']);
	$password=check($_POST['password']);
	$passwordConf=check($_POST['confirmpassword']);
	$city=$_POST['city'];
	$birthday=$_POST['birthday'];
	if ($password !== $passwordConf) {
		/* check password */
		header("Location: ../index.php?error=password");
	}else{
		$requete="SELECT * FROM user WHERE email='$email' LIMIT 1";
		$resultat=mysqli_query($link,$requete);
		$check_email= mysqli_num_rows($resultat);
		if ($check_email !== 0){
			header("Location: ../index.php?error=email");
		}else{
			$requete="SELECT * FROM user WHERE username='$username' LIMIT 1";
			$resultat=mysqli_query($link,$requete);
			$check_username= mysqli_num_rows($resultat);
			if($check_username !== 0){
				header("Location: ../index.php?error=username");
			}else{
				/*insertion dans la base de donnees*/
				$password=md5($password);
				$picture="SANS_IMAGE.png";
				$description="Hey, i'm using KadimiMessagerie";
				session_start();
				$_SESSION['username']=$username;
				$sql2="INSERT INTO `user`(`id_user`, `username`, `email`, `password`, `city`, `birthday` , `picture` , `description` , `is_active`) VALUES (0,'$username','$email','$password','$city','$birthday','SANS_IMAGE.png','Hey , i m using KadimiMessagerie',0)";
				$result2=mysqli_query($link,$sql2);
				$sql3="SELECT * FROM user WHERE username='$username' LIMIT 1";
				$result3=mysqli_query($link,$sql3);
				while ($data=mysqli_fetch_assoc($result3)) {
					$_SESSION['id_user']=$data['id_user'];
				}
				header("Location: ../whatdoyoulike.php?error=NoError");
			}
		}
	}
}
?>