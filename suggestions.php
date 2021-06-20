<?php 
	include("includes/connect_database.php");
	session_start();
	if (!isset($_SESSION['id_user']) && !isset($_SESSION['username'])) {
		header("Location :index.php");
	}else{
		$username=$_SESSION['username'];
		$userid=$_SESSION['id_user'];
	//selectionner des donnees sur l utilisateur qu on va les metter dans un tableau
	$sql1="SELECT * from hobbies inner join user on user.id_user=hobbies.id_user where hobbies.id_user='$userid' LIMIT 1";
	$res1=mysqli_query($link,$sql1);
	$data_user=array();
	while ($data1=mysqli_fetch_assoc($res1)) {
		$data_user[]=$data1;
	}
	//selectionner des donnees sur les autres utilisateurs qu on va les metter dans un tableau egalement
	$sql2="SELECT * from hobbies inner join user on user.id_user=hobbies.id_user where hobbies.id_user != '$userid'";
	$res2=mysqli_query($link,$sql2);
	$all_data_user=array();
	while ($data2=mysqli_fetch_assoc($res2)) {
		$all_data_user[]=$data2;
	}
	if (count($all_data_user) !== 0) {
		for ($i=0; $i < count($all_data_user) ; $i++) {
			$trouve = 0;
            foreach ($all_data_user[$i] as $key => $value) {
            	if (($key == 'sports') || ($key == 'music') || ($key == 'politics') || ($key == 'gaming') || ($key == 'science')) {
            		if (($data_user[0][$key] == 1) && ($value == 1)) {
                        $trouve =1;
                        $hobbies_friends=array();
                        $hobbies_friends[]=$all_data_user[$i];
     					break;
                    }
            	}
            }
		}
	}
	//generer 9 valeurs aleatoires distinctes
	$max = count($all_data_user)-1;
	if (count($all_data_user) < 9) {
		$a=0;
		$b=0;
		$c=0;
		$d=0;
		$e=0;
		$f=0;
		$g=0;
		$h=0;
		$i=0;
	}else{
		$a=rand(0,$max);
		$b=rand(0,$max);
		$c=rand(0,$max);
		$d=rand(0,$max);
		$e=rand(0,$max);
		$f=rand(0,$max);
		$g=rand(0,$max);
		$h=rand(0,$max);
		$i=rand(0,$max);
		while ($a==$b) {
			$b=rand(0,$max);	
		}
		while ($b==$c || $a==$c) {
			$c=rand(0,$max);
		}
		while ($b==$d || $a==$d || $c==$d){
			$d=rand(0,$max);
		}
		while ($b==$e || $a==$e || $c==$e || $d==$e) {
			$e=rand(0,$max);
		}
		while ($b==$f || $a==$f || $c==$f || $d==$f || $e==$f) {
			$f=rand(0,$max);
		}
		while ($b==$g || $a==$g || $c==$g || $d==$g || $e==$g || $f==$g) {
			$g=rand(0,$max);
		}
		while ($b==$h || $a==$h || $c==$h || $d==$h || $e==$h || $f==$h || $g==$h) {
			$h=rand(0,$max);
		}
		while ($b==$i || $a==$i || $c==$i || $d==$i || $e==$i || $f==$i || $g==$i || $h==$i) {
			$i=rand(0,$max);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Add Friends</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/suggestionsstyle.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Zilla+Slab+Highlight&display=swap" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="shortcut icon" type="image/png" href="images/fav.png"/>
</head>
<body>
	<h1 style="text-align: center; color: #0C67ED;margin:50px;font-family: 'Permanent Marker', cursive;"><b>KadimiMessagerie</b></h1>
<div class="container">
	<div class="row">
		<div class="col-md-9 col-center">
			<h2><span>Add New<b> Friends</b></span></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
				<!-- Carousel indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>   
				<!-- Wrapper for carousel items -->
				<div class="carousel-inner">
					
					<div class="item active">
						<div class="row">
							<div class="col-sm-4">	
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$a]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$a]['username']; ?></b><br>
										<?php echo $all_data_user[$a]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid1=$all_data_user[$a]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid1' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid1&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid1&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>		
							</div>
							<div class="col-sm-4">								
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$b]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$b]['username']; ?></b><br>
										<?php echo $all_data_user[$b]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid2=$all_data_user[$b]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid2' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid2&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid2&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>
							</div>
							<div class="col-sm-4">	
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$c]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$c]['username']; ?></b><br>
										<?php echo $all_data_user[$c]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid3=$all_data_user[$c]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid3' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid3&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid3&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>								
							</div>
						</div>
					</div>
					<div class="item">
						<div class="row">
							<div class="col-sm-4">						
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$d]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$d]['username']; ?></b><br>
										<?php echo $all_data_user[$d]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid4=$all_data_user[$d]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid4' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid4&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid4&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>								
								</div>
							</div>
							<div class="col-sm-4">								
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$e]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$e]['username']; ?></b><br>
										<?php echo $all_data_user[$e]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid5=$all_data_user[$e]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid5' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid5&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid5&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>
							</div>
							<div class="col-sm-4">				
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$f]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$f]['username']; ?></b><br>
										<?php echo $all_data_user[$f]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid6=$all_data_user[$f]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid6' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid6&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid6&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>							
							</div>
						</div>
					</div>
					<div class="item">
						<div class="row">
							<div class="col-sm-4">
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$g]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$g]['username']; ?></b><br>
										<?php echo $all_data_user[$g]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid7=$all_data_user[$g]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid7' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid7&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid7&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>
							</div>
							<div class="col-sm-4">								
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$h]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$h]['username']; ?></b><br>
										<?php echo $all_data_user[$h]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid8=$all_data_user[$h]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid8' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid8&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid8&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>					
							</div>
							<div class="col-sm-4">
								<div class="img-box">
									<img src="pictures/<?php echo $all_data_user[$i]['picture'] ; ?>" class="img-responsive">
									<div class="description">
										<b><?php echo $all_data_user[$i]['username']; ?></b><br>
										<?php echo $all_data_user[$i]['description']; ?>
									</div>
									<div class="followunfollow">
										<?php 
										$userid9=$all_data_user[$i]['id_user']; 
										$sql="SELECT * from follow where id_user_follower='$userid' and id_user_following='$userid9' LIMIT 1";
										$res=mysqli_query($link,$sql);
										$data=mysqli_fetch_assoc($res);
										if (!$data) {
											echo"
											<form action='includes/follow.php?user=$userid9&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-primary' name='follow' value='Follow'>
    										</form>";
										}else{
											echo"
											<form action='includes/unfollow.php?user=$userid9&page=suggestions' method='post'>
    											<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    										</form>";
										}
										?>
                                	</div>
								</div>		
							</div>
						</div>
					</div>
				</div>
				<!-- Carousel controls -->
				<a class="carousel-control left" href="#myCarousel" data-slide="prev">
					<i class="fa fa-chevron-left"></i>
				</a>
				<a class="carousel-control right" href="#myCarousel" data-slide="next">
					<i class="fa fa-chevron-right"></i>
				</a>
			</div>
		</div>
	</div>
</div>
<div style="text-align: center; margin-top: 25px;">
	<button class="btn btn-info">
		<a href="whatdoyoulike.php" style="text-decoration: none;color: white;">
			Back
		</a>
	</button>
	<button class="btn btn-danger">
		<a href="includes/deconnexion.php" style="text-decoration: none;color: white;">
			SignOut
		</a>
	</button>
	<button class="btn btn-success">
		<a href="acceuil.php" style="text-decoration: none;color: white;">
			Next
		</a>
	</button>
</div>

</body>
</html> 

<?php
 	}
 ?>