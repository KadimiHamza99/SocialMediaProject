<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/addfriendsstyle.css" rel="stylesheet">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
   <title>Add Friends</title>
   <link rel="stylesheet" href="css/style.css" />
   <link rel="stylesheet" href="css/ionicons.min.css" />
   <link rel="stylesheet" href="css/font-awesome.min.css" />
   <link href="css/emoji.css" rel="stylesheet">
   <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
   <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Zilla+Slab+Highlight&display=swap" rel="stylesheet">
   <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
</head>
<body>
<header id="header">
   <nav class="navbar navbar-default navbar-fixed-top menu">
      <div class="container">

      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <a class="navbar-brand" href="acceuil.php"><span style="text-align: center; color: #0C67ED;margin:10px;font-family: 'Permanent Marker', cursive;"><b>KadimiMessagerie</b></span></a>
      </div>
         <a href="timeline.php?user_timeline=<?php echo $id_user; ?>" style='color:white;text-decoration:none'>My Timeline</a>
         <a href="friends.php" style='color:white;text-decoration:none'>Chatroom</a>
         <a href="includes/deconnexion.php" style='color:white;text-decoration:none'>Sign Out</a>
      </div><!-- /.container -->
   </nav>
</header>
   <?php
      include("includes/connect_database.php");
      session_start();
      $username=$_SESSION['username'];
		$id_user=$_SESSION['id_user'];
      $sql="SELECT * from user where id_user='$id_user' limit 1";
		$res=mysqli_query($link,$sql);
		$data=mysqli_fetch_assoc($res);
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
   ?>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <div id="content" class="content content-full-width">
            <!-- begin profile-content -->
            <div class="profile-content">
               <!-- begin tab-content -->
               <div class="tab-content p-0">
                  <!-- begin #profile-friends tab -->
                  <div class="tab-pane fade in active show" id="profile-friends">
                     <h4 class="m-t-0 m-b-20" style="text-align:center;"><?php echo count($data_user_not_following)-1;?> Friends To Add </h4>
                     <!-- begin row -->
                     <div class="row row-space-2">
                        <?php 
                        $i=0;
                        while($i<count($data_user_not_following)-1){
                           $i++;
                        ?>

                           <!-- begin col-6 -->
                        <div class="col-md-6 m-b-2">
                           <div class="p-10 bg-white">
                              <div class="media media-xs overflow-visible">
                                 <a class="media-left" href="javascript:;">
                                 <img src="pictures/<?php echo $data_user_not_following[$i]['picture'];?>" class="media-object img-circle" width="75">
                                 </a>
                                 <div class="media-body valign-middle">
                                    <b class="text-inverse" style="color:#159BCA;"><?php echo $data_user_not_following[$i]['username'];?></b>
                                    <p><?php echo $data_user_not_following[$i]['description'];?></p>
                                 </div>
                              </div>
                              <div class="media-body valign-middle text-right overflow-visible">
                                 <div class="btn-group dropdown">
                                    <?php 
					                     $userid=$data_user_not_following[$i]['id_user']; 
						                     echo"
							                     <form action='includes/follow.php?user=$userid&page=addfriends' method='post'>
								                     <input type='submit' class='btn btn-primary' name='follow' value='Follow'>
                                          </form>";
					                        
				                        ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end col-6 -->

                        <?php
                        }


            ?>
         </div>
      </div>
   </div>
</div>
<footer>
      	<div class="copyright">
       	 	<p>KadimiHamza © 2021. All rights reserved</p>
          <p>Email: hamza.kadimi@uit.ac.ma</p>
          <p>Phone: 0641496524</p>
      	</div>
	 </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
</body>
</html>