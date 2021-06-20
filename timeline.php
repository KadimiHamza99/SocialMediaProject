<?php
      session_start();
      include "includes/connect_database.php";
      $id_user=$_SESSION['id_user'];
      $user_timeline=$_GET['user_timeline'];
      $sql="SELECT * from user where id_user='$user_timeline' limit 1";
      $res=mysqli_query($link,$sql);
      $data=mysqli_fetch_assoc($res); 
      $compteur_followers=0;
		  $sq="SELECT * from follow where id_user_following='$user_timeline'";
	$re=mysqli_query($link,$sq);
		while ($data1=mysqli_fetch_assoc($re)) {
			$compteur_followers++;
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
		<title>Timeline</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link href="css/emoji.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Zilla+Slab+Highlight&display=swap" rel="stylesheet">
    <!--Google Webfont-->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
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
                  <li><a href="timeline.php?user_timeline=<?php echo $user_timeline; ?>">Timeline</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="includes/deconnexion.php">Sign Out</a></li>
              
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->

    <div class="container">
    
      <!-- Timeline
      ================================================= -->
      <div class="timeline">
        <div class="timeline-cover">

          <!--Timeline Menu for Large Screens-->
          <div class="timeline-nav-bar hidden-sm hidden-xs">
            <div class="row">
              <div class="col-md-3">
                <div class="profile-info">
                  <img src="pictures/<?php echo $data['picture']; ?>" alt="" class="img-responsive profile-photo" />
                  <h3><?php echo $data['username']; ?></h3>
                  <p class="text-muted"><?php echo $data['description']; ?></p>
                </div>
              </div>
              <div class="col-md-9">
                <ul class="list-inline profile-menu">
                  <li><a href="timeline.php?user_timeline=<?php echo $user_timeline; ?>" class="active">Timeline</a></li>
                  <li><a href="friends.php">Friends</a></li>
                </ul>
                <ul class="follow-me list-inline">
                  <li><?php echo $compteur_followers;  ?>  Followers</li>
                  <?php if($id_user != $user_timeline){ ?>
                  <li>
                    <?php
                      $s="SELECT * from follow where id_user_follower='$id_user' and id_user_following='$user_timeline' LIMIT 1";
                      $r=mysqli_query($link,$s);
                      $d=mysqli_fetch_assoc($r);
                      if (!$d) {
                        echo "<form action='includes/follow.php?user=$id_user&page=profile&user_timeline=$user_timeline' method='post'>";
                          echo "<input type='submit' class='btn btn-primary' name='follow' value='Follow'>";
                        echo "</form>";
                      }else{
                        echo "<form action='includes/unfollow.php?user=$id_user&page=profile&user_timeline=$user_timeline' method='post'>";
                          echo"<input type='submit' class='btn btn-danger' name='unfollow' value='Unfollow'>";
                        echo "</form>";
                      }
                    ?>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div><!--Timeline Menu for Large Screens End-->

          <!--Timeline Menu for Small Screens-->
          <div class="navbar-mobile hidden-lg hidden-md">
            <div class="profile-info">
              <img src="images/users/user-1.jpg" alt="" class="img-responsive profile-photo" />
              <h4>Sarah Cruiz</h4>
              <p class="text-muted">Creative Director</p>
            </div>
            <div class="mobile-menu">
              <ul class="list-inline">
                <li><a href="timline.php?user_timeline=<?php echo $user_timeline; ?>" class="active">Timeline</a></li>
                <li><a href="friends.php">Friends</a></li>
              </ul>
              <button class="btn-primary">Add Friend</button>
            </div>
          </div><!--Timeline Menu for Small Screens End-->

        </div>
        <div id="page-contents">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-7">

              <!-- Post Create Box
              ================================================= -->
              <?php if($id_user==$user_timeline){ ?>
              <div class="create-post">
                <div class="row">
                  <div class="col-md-7 col-sm-7">
                    <div class="form-group">
                      <form method="post" action="includes/checkpublication.php?page=timeline&user_timeline=<?php echo $user_timeline; ?>">
                      <img src="pictures/<?php echo $data['picture']; ?>" alt="" class="profile-photo-sm" />
                        <textarea name="publication" COLS="150" ROWS="4" onKeyUp="limite(this,255);" onKeyDown="limite(this,255);" placeholder="Publier quelque chose ..." class="form-control"></textarea>
                        <div class="input-group-append">                 
                          <input type="submit" name="publier" class="btn btn-primary" value="publish">
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-5 col-sm-5">
                    <div class="tools">
                      <ul class="publishing-tools list-inline">
                        <li><a href="#"><i class="ion-compose"></i></a></li>
                        <li><a href="#"><i class="ion-images"></i></a></li>
                        <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
                        <li><a href="#"><i class="ion-map"></i></a></li>
                      </ul>
                      
                    </div>
                  </div>
                </div>
              </div><!-- Post Create Box End-->
              <?php }?>

              <!-- Post Content
              ================================================= -->
              <?php 
                $sql2="SELECT * from publication where id_user='$user_timeline' order by date desc";
                $result2=mysqli_query($link,$sql2);
                if (mysqli_num_rows($result2)==0){
                  echo "<h2 style='text-align:center;'>Aucune Publication</h2>";
                }else{
                  while($data2=mysqli_fetch_assoc($result2)){
                    $id_publication=$data2['id_publication'];
                    $id_user_publication=$data2['id_user'];
              ?>
              <div class="post-content" style="margin-top:70px;background-color:azure" id="<?php echo $id_publication;?>">
                <!--Post Date-->
                <div class="post-date hidden-xs hidden-sm">
                  <h5><?php echo $data['username']; ?></h5>
                  <p class="text-grey"><?php echo substr($data2['date'],0,-8); ?></p>
                </div><!--Post Date End-->
                <div class="post-container">
                  <img src="pictures/<?php echo $data['picture']; ?>" alt="user" class="profile-photo-md pull-left" />
                  <div class="post-detail">
                    <div class="user-info">
                      <h5><a href="timeline.php?user_timeline=<?php echo $user_timeline; ?>" class="profile-link"><?php echo $data['username']; ?></a></h5>
                      <p class="text-muted">Time <?php echo substr($data2['date'],10,-3); ?></p>
                    </div>
                    <div class="reaction">
                    <?php 
                      $sqlE="SELECT * FROM `publications_likes` WHERE id_publication='$id_publication' and id_user='$id_user'";
                      $R1=mysqli_query($link,$sqlE);
                      $ro1=mysqli_fetch_assoc($R1);
                      if (!$ro1) { 
                        ?>
                        <form action='includes/like.php?id=<?php echo $id_publication;?>&page=profile&user_timeline=<?php echo $user_timeline; ?>' method='post'>                          
                          <input type="submit" class="btn text-green" name="like" value="Like">
                          <?php echo $data2['likes'].' '; ?><i class="fa fa-thumbs-down" aria-hidden="true"></i>                          
                        </form>
                <?php }else{ ?>
                        <form action='includes/unlike.php?id=<?php echo $id_publication;?>&page=profile&user_timeline=<?php echo $user_timeline; ?>' method='post'>                          
                            <input type="submit" class="btn text-red" name="unlike" value="Dislike">
                            <?php echo $data2['likes'].' '; ?><i class="fa fa-thumbs-up"  aria-hidden="true"></i>                                                            
                        </form>
                        
                    <?php } ?>
                    </div>
                    <div class="line-divider"></div>
                    <div class="post-text">
                      <p><?php echo $data2['contenue']; ?></p>
                    </div>
                    <?php 
                        $sql3="SELECT * from comments where id_publication='$id_publication' order by date asc";
                        $result3=mysqli_query($link,$sql3);
                        while($data3=mysqli_fetch_assoc($result3)){
                          $id_user_comment=$data3['id_user'];
                          $req="SELECT * from user where id_user='$id_user_comment' limit 1";
                          $r=mysqli_query($link,$req);
                          $row=mysqli_fetch_assoc($r);
                    ?>
                    <div class="line-divider"></div>
                    <div class="post-comment">
                      
                      <img src="pictures/<?php  if($id_user != $user_timeline) { echo $row['picture']; }
                                                else { echo $data['picture']; } ?>" alt="" class="profile-photo-sm" />
                      <p><a href="timeline.php?user_timeline=<?php echo $id_user; ?>" class="profile-link"><?php echo $row['username']; ?> </a><?php echo $data3['contenue']; ?></p>
                      
                    </div>
                    <?php
                        }
                    ?>
                    <div class="post-comment">
                      <img src="pictures/<?php if($id_user != $user_timeline) { echo $row['picture']; }
                                                else { echo $data['picture']; } ?>" alt="" class="profile-photo-sm" />
                      <form method='post' action='includes/comment.php?id=<?php echo $id_publication; ?>&page=profile&user=<?php echo $user_timeline; ?>'>
                        <input type="text" name='comment' class="form-control" size='50' placeholder='add a comment ...'>
                        <input type="submit" class="btn btn-success" name="commenter" value="Post">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                } }
              ?>
            </div>
            <div class="col-md-2 static">
              <div id="sticky-sidebar">
                <h4 class="grey"><b><?php echo $data['username']; ?></b>'s activity</h4>
                <div class="feed-item">
                  <div class="live-activity">
                    <p> <b><?php echo $data['username']; ?></b> Commended on a Photo</p>
                    <p class="text-muted">5 mins ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><b><?php echo $data['username']; ?></b> Has posted a photo</p>
                    <p class="text-muted">an hour ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><b><?php echo $data['username']; ?></b> Liked her friend's post</p>
                    <p class="text-muted">4 hours ago</p>
                  </div>
                </div>
                <div class="feed-item">
                  <div class="live-activity">
                    <p><b><?php echo $data['username']; ?></b> has shared an album</p>
                    <p class="text-muted">a day ago</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer
    ================================================= -->
    <footer id="footer">
      <div class="copyright">
        <p>KadimiHamza © 2021. All rights reserved</p>
      </div>
		</footer>
    
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>
    <script src="js/jquery.scrollbar.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
