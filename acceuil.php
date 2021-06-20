<?php 
	include("includes/connect_database.php");
	session_start();
	if (!isset($_SESSION['id_user']) && !isset($_SESSION['username'])) {
		header("Location :index.php");
	}else{
		$username=$_SESSION['username'];
		$id_user=$_SESSION['id_user'];
		$req2="UPDATE user SET is_active= 1 WHERE id_user='$id_user'";
		mysqli_query($link,$req2);
		$sql="SELECT * from user where id_user='$id_user' limit 1";
		$res=mysqli_query($link,$sql);
		$data=mysqli_fetch_assoc($res);
		$compteur_followers=0;
		$sql1="SELECT * from follow where id_user_following='$id_user'";
		$res1=mysqli_query($link,$sql1);
		while ($data1=mysqli_fetch_assoc($res1)) {
			$compteur_followers++;
		}
		$sql2="SELECT * FROM follow WHERE id_user_follower='$id_user'";
		$res2=mysqli_query($link,$sql2);
		$friends=array();
		while($row=mysqli_fetch_assoc($res2)){
			$friends[]=$row['id_user_following'];
		}
		if (empty($friends)) {
			header("location: suggestions.php");
		}
    $friends=array_unique($friends); 
    $friends[]=$id_user;
		$friends=implode(",",$friends);
		$sql4="SELECT * FROM user where id_user not IN ($friends,$id_user)";
		$res4=mysqli_query($link,$sql4);
		$data_user_not_following= array();
		while ($data4=mysqli_fetch_assoc($res4)) {
			$data_user_not_following[]=$data4;
		}

		$max = count($data_user_not_following)-1;
		if (count($data_user_not_following) < 6) {
			$a=0;
			$b=0;
			$c=0;
			$d=0;
			$e=0;
		}else{
			$a=rand(0,$max);
			$b=rand(0,$max);
			$c=rand(0,$max);
			$d=rand(0,$max);
			$e=rand(0,$max);
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
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>News Feed</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link href="css/emoji.css" rel="stylesheet">
    <!--Google Webfont-->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Zilla+Slab+Highlight&display=swap" rel="stylesheet">
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
	</head>
  <body>

    <!-- Header
    ================================================= -->
		<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="acceuil.php"><span style="text-align: center; color: #0C67ED;margin:10px;font-family: 'Permanent Marker', cursive;"><b>KadimiMessagerie</b></span></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle pages" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">All Pages <span><img src="images/down-arrow.png" alt="" /></span></a>
                <ul class="dropdown-menu page-list">      
                  	<li><a href="acceuil.php">Newsfeed</a></li>
                    <li><a href="friends.php">Chatroom</a></li>                 	
                  	<li><a href="timeline.php?user_timeline=<?php echo $id_user; ?>">My Timeline</a></li>
                    <li><a href="addfriends.php">Find New Friends</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="includes/deconnexion.php">Sign Out</a></li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm" method="post" action="">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" id="search" name="search" class="form-control" autocomplete="off" placeholder="Search friends ">
                <input type="submit" name="chercher" value="Search" class="btn btn-light">
              </div>
            </form>        
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <div id="result" style="float:right;margin-right:2%;">
        <?php
        if(isset($_POST['chercher'])){
          echo "<h1>  Search Result  </h1>";
          $username_searching=$_POST['search'];
          $searching_sql="SELECT * from user where username like '%$username_searching%'";
          $searching_result=mysqli_query($link,$searching_sql);
          while($searching_data=mysqli_fetch_assoc($searching_result)){
            $id_user_searching=$searching_data['id_user'];
            $username_searched=$searching_data['username'];
            echo "<p>";
              echo "<a href='timeline.php?user_timeline=".$id_user_searching."'>";
                ?>
                <img src="pictures/<?php echo $searching_data['picture']; ?>" alt="user" class="profile-photo" />
                <?php
                echo $username_searched;
              echo "</a>";
            echo "</p>";
          }
        }
        ?>
    </div>
    <!--Header End-->

    <div id="page-contents">
    	<div class="container">
    		<div class="row">

          <!-- Newsfeed Common Side Bar Left
          ================================================= -->
    			<div class="col-md-3 static">
            <div class="profile-card">
            	<img src="pictures/<?php echo $data['picture']; ?>" alt="user" class="profile-photo" />
            	<h5><a href="timeline.php?user_timeline=<?php echo $id_user; ?>" class="text-white"><?php echo $data['username']; ?></a></h5>
            	<div class="text-white"><i class="ion ion-android-person-add"></i> <?php echo $compteur_followers; ?> Followers</div>
            </div><!--profile card ends-->
            <ul class="nav-news-feed">
              <li><i class=""></i><div><a href="acceuil.php">My Newsfeed</a></div></li>  
              <li><i class=""></i><div><a href="timeline.php?user_timeline=<?php echo $id_user; ?>">My Timeline</a></div></li> 
              <li><i class=""></i><div><a href="friends.php">Chatroom</a></div></li>
              <li><i class=""></i><div><a href="addfriends.php">Add Friends</a></div></li>
              <li><div><a href="includes/deconnexion.php">SignOut</a></div></li>
            </ul><!--news-feed links ends-->
            <div id="chat-block">
              	<div class="title">Chat online</div>
              <?php
            	if(empty($friends)){
					echo"pas d'amis";
				}else{
					$sql3="SELECT * FROM user where id_user IN ($friends)";
					$res3=mysqli_query($link,$sql3);
					echo   "<ul class='online-users list-inline'>";
					while($data3=mysqli_fetch_assoc($res3)){
              			$id_user=$data3['id_user'];
						$user=$data3['username'];
						$pic=$data3['picture'];
						$status=$data3['is_active'];
              			echo "<li>
              				<a href='#'>
              					<img src='pictures/$pic' alt='user' class='img-responsive profile-photo' />";
              				if ($status==1) { ?>
              					<span class='badge badge-success' style="background-color: #198754">Online</span><?php
              				}else{
              					?><span class='badge badge-danger' style="background-color: #DC3545;">Offline</span><?php
              				}
              			echo	"</a>
              			</li>";
              					
              		}
              		echo '</ul>';
              	}
              ?>
            	</div><!--chat block ends-->
          	</div>
    			<div class="col-md-7">

            <!-- Post Create Box
            ================================================= -->

            <div class="create-post">
              <div class="row"> 
                <div class="col-md-7 col-sm-7">
                  <div class="form-group">
                    <img src="pictures/<?php echo $data['picture']; ?>" alt="" class=" profile-photo-md" />
                    <form method="post" action="includes/checkpublication.php?page=acceuil">
                    <div class="input-group mb-3">
                      <textarea name="publication" COLS="159" ROWS="4" onKeyUp="limite(this,255);" onKeyDown="limite(this,255);" placeholder="Publier quelque chose ..." class="form-control"></textarea>
                      <div class="input-group-append">                 
                        <input type="submit" name="publier" class="btn btn-primary" value="publish">
                      </div> 
                    </div>          
                    </form>  
                  </div>
                </div>
                
              </div>
            </div><!-- Post Create Box End-->

            <!-- Post Content
            ================================================= -->
            <?php 
              $sql0="SELECT * from publication where id_user in ($friends) order by date desc";
              $result0=mysqli_query($link,$sql0);
              while($data0=mysqli_fetch_assoc($result0)){
                $id_publication = $data0['id_publication'];
                $id_user_pub=$data0['id_user'];
                $sql01="SELECT * from user where id_user='$id_user_pub'";
                $result01=mysqli_query($link,$sql01);
                $data01=mysqli_fetch_assoc($result01);
              ?>
                <div class="post-content" id="<?php echo $id_publication;?>">
                  <!--<img src="images/post-images/1.jpg" alt="post-image" class="img-responsive post-image" />-->
                  <div class="post-container" style="background-color:azure">
                    <a href="timeline.php?user_timeline=<?php echo $id_user_pub; ?>"><img src="pictures/<?php echo $data01['picture']; ?>" alt="user" class="profile-photo-md pull-left" />
                    <div class="post-detail">
                      <div class="user-info">
                        <h5><?php echo $data01['username']; ?></h5>                   
                      </div>
                    </a>
                    <div class="user-info">
                      <p class="text-muted"><?php echo $data0['date']; ?></p>
                    </div>
                    <div class="reaction">
                      <?php 
                      $idu=$_SESSION['id_user'];
                      $sqlE="SELECT * FROM `publications_likes` WHERE id_publication='$id_publication' and id_user='$idu'";
                      $R1=mysqli_query($link,$sqlE);
                      $ro1=mysqli_fetch_assoc($R1);
                      if (!$ro1) { 
                        ?>
                        <form action='includes/like.php?id=<?php echo $id_publication;?>&page=acceuil' method='post'>                          
                          <input type="submit" class="btn text-green" name="like" value="Like">
                          <?php echo $data0['likes'].' '; ?><i class="fa fa-thumbs-down" aria-hidden="true"></i>                          
                        </form>

                <?php }else{ ?>
                        <form action='includes/unlike.php?id=<?php echo $id_publication;?>&page=acceuil' method='post'>                          
                            <input type="submit" class="btn text-red" name="unlike" value="Dislike">
                            <?php echo $data0['likes'].' '; ?><i class="fa fa-thumbs-up"  aria-hidden="true"></i>                                                            
                        </form>
                        
                    <?php } ?>
                    </div>

                    <div class="post-text">
                      <p><?php echo $data0['contenue']; ?></p>
                    </div>
                    <div class="line-divider"></div>
                    <?php
                    $sql_commentaire="SELECT * from comments where id_publication='$id_publication' order by date asc";
                    $result_commentaire=mysqli_query($link,$sql_commentaire);
                    
                    while ($data_commentaire=mysqli_fetch_assoc($result_commentaire)) {
                      $id_user_comment=$data_commentaire['id_user'];
                      $id_comment=$data_commentaire['id_comment'];
                      $sql_user="SELECT * from user where id_user='$id_user_comment'"; 
                      $result_user=mysqli_query($link,$sql_user);
                      $row_user=mysqli_fetch_assoc($result_user);
                    ?>
                    <div class="post-comment">
                      <img src="pictures/<?php echo $row_user['picture']; ?>" class="profile-photo-sm" />
                      <p><a href="#" class="profile-link"><?php echo $row_user['username']; ?></a><?php echo ' '.$data_commentaire['date']; ?><br><?php echo $data_commentaire['contenue']; ?></p>
                        <?php 
                        /*if($row_user['id_user']==$idu){
                          ?>
                          <form action="includes/delete_comment.php?id=$id_comment&page=acceuil">
                            <input type="submit" name="delete_comment" class="btn btn-danger" value="Delete" style="margin-left: 200%;">
                          </form>

                        <?php 
                        }*/
                        ?>
                    </div>
                    <?php } ?>
                    <div class="post-comment">
                      <img src="pictures/<?php echo $data['picture']; ?>" class="profile-photo-sm" />
                      <form method='post' action='includes/comment.php?id=<?php echo $id_publication; ?>&page=acceuil'>                      
                        <input type="text" name='comment' class="form-control" size='50' placeholder='add a comment ...'>
                        <input type="submit" class="btn btn-success" name="commenter" value="Post">       
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>



          <!-- Newsfeed Common Side Bar Right
          ================================================= -->
    			<?php /* ?>
          <div class="col-md-0 static">
            <div class="suggestions" id="sticky-sidebar">
              <h4 class="grey">Meet New Friends <?php echo $data['username']; ?></h4>
              <div class="follow-user">
                <img src="pictures/<?php echo $data_user_not_following[$a]['picture']; ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.html"><?php echo $data_user_not_following[$a]['username']; ?></a></h5>
                <?php 
					$userid1=$data_user_not_following[$a]['id_user']; 
					$sqlA="SELECT * from follow where id_user_follower='$id_user' and id_user_following='$userid1' LIMIT 1";
					$resA=mysqli_query($link,$sqlA);
					$dataA=mysqli_fetch_assoc($resA);
					if (!$dataA) {
						echo"
							<form action='includes/follow.php?user=$userid1&page=acceuil' method='post'>
								<input type='submit' class='btn btn-success' name='follow' value='Follow'>
    						</form>";
					}else{
						echo"
							<form action='includes/unfollow.php?user=$userid1&page=acceuil' method='post'>
    							<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    						</form>";
					}
				?>
                </div>
              </div>
              <div class="follow-user">
                <img src="pictures/<?php echo $data_user_not_following[$b]['picture']; ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.html"><?php echo $data_user_not_following[$b]['username']; ?></a></h5>
                  <?php 
					$userid2=$data_user_not_following[$b]['id_user']; 
					$sqlB="SELECT * from follow where id_user_follower='$id_user' and id_user_following='$userid2' LIMIT 1";
					$resB=mysqli_query($link,$sqlB);
					$dataB=mysqli_fetch_assoc($resB);
					if (!$dataB) {
						echo"
							<form action='includes/follow.php?user=$userid2&page=acceuil' method='post'>
								<input type='submit' class='btn btn-success' name='follow' value='Follow'>
    						</form>";
					}else{
						echo"
							<form action='includes/unfollow.php?user=$userid2&page=acceuil' method='post'>
    							<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    						</form>";
					}
				?>
                </div>
              </div>
              <div class="follow-user">
                <img src="pictures/<?php echo $data_user_not_following[$c]['picture']; ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.html"><?php echo $data_user_not_following[$c]['username']; ?></a></h5>
                  <?php 
					$userid3=$data_user_not_following[$c]['id_user']; 
					$sqlC="SELECT * from follow where id_user_follower='$id_user' and id_user_following='$userid3' LIMIT 1";
					$resC=mysqli_query($link,$sqlC);
					$dataC=mysqli_fetch_assoc($resC);
					if (!$dataC) {
						echo"
							<form action='includes/follow.php?user=$userid3&page=acceuil' method='post'>
								<input type='submit' class='btn btn-success' name='follow' value='Follow'>
    						</form>";
					}else{
						echo"
							<form action='includes/unfollow.php?user=$userid3&page=acceuil' method='post'>
    							<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    						</form>";
					}
				?>
                </div>
              </div>
              <div class="follow-user">
                <img src="pictures/<?php echo $data_user_not_following[$d]['picture']; ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.html"><?php echo $data_user_not_following[$d]['username']; ?></a></h5>
                  <?php 
					$userid4=$data_user_not_following[$d]['id_user']; 
					$sqlD="SELECT * from follow where id_user_follower='$id_user' and id_user_following='$userid4' LIMIT 1";
					$resD=mysqli_query($link,$sqlD);
					$dataD=mysqli_fetch_assoc($resD);
					if (!$dataD) {
						echo"
							<form action='includes/follow.php?user=$userid4&page=acceuil' method='post'>
								<input type='submit' class='btn btn-success' name='follow' value='Follow'>
    						</form>";
					}else{
						echo"
							<form action='includes/unfollow.php?user=$userid4&page=acceuil' method='post'>
    							<input type='submit' class='btn btn-dark' name='unfollow' value='Unfollow'>
    						</form>";
					}
				?>
                </div>
              </div>
              <div class="follow-user">
                <img src="pictures/<?php echo $data_user_not_following[$e]['picture']; ?>" alt="" class="profile-photo-sm pull-left" />
                <div>
                  <h5><a href="timeline.html"><?php echo $data_user_not_following[$e]['username']; ?></a></h5>
                 <?php 
					$userid5=$data_user_not_following[$e]['id_user']; 
					$sqlE="SELECT * from follow where id_user_follower='$id_user' and id_user_following='$userid5' LIMIT 1";
					$resE=mysqli_query($link,$sqlE);
					$dataE=mysqli_fetch_assoc($resE);
					if (!$dataE) {
						echo"
							<form action='includes/follow.php?user=$userid5&page=acceuil' method='post'>
								<input type='submit' class='btn btn-success' name='follow' value='Follow'>
    						</form>";
					}else{
						echo"
							<form action='includes/unfollow.php?user=$userid5&page=acceuil' method='post'>
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
    </div>
    */ ?>
    
    <!-- Footer
    ================================================= -->
    <footer>
      	<div class="copyright">
       	 	<p>KadimiHamza © 2021. All rights reserved</p>
          <p>Email: hamza.kadimi@uit.ac.ma</p>
          <p>Phone: 0641496524</p>
      	</div>
	 </footer>
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    
    <!-- Scripts
    ================================================= -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&callback=initMap"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>
    <script src="js/jquery.scrollbar.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>