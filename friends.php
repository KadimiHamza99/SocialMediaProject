<?php
    session_start();
    include_once("includes/connect_database.php");
    $id_user=$_SESSION["id_user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/friendsstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>My Friends</title>
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
            <a href="addfriends.php" style='color:white;text-decoration:none'>Find New Friends</a>
            <a href="includes/deconnexion.php" style='color:white;text-decoration:none'>Sign Out</a>
        </div><!-- /.container -->
    </nav>
</header>
    
    <?php
    $sql="SELECT * from follow where id_user_follower='$id_user'";
    $res=mysqli_query($link,$sql);
    while($data=mysqli_fetch_assoc($res)){
        $friend=$data['id_user_following'];
        $sql1="SELECT * from user where id_user='$friend'";
        $res1=mysqli_query($link,$sql1);
        while($data1=mysqli_fetch_assoc($res1)){
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="people-nearby">      
                            <div class="nearby-user">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2">
                                        <img src="pictures/<?php echo $data1['picture']; ?>" class="profile-photo-lg" width="80">
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <h5><a href="timeline.php?user_timeline=<?php echo $data1['id_user']; ?>" class="profile-link"><?php echo $data1['username']." ";?></a></h5><?php 
                                        $status=$data1['is_active'];
                                        if($status==1){?>
                                            <span class='badge rounded-pill bg-success'>Online</span><?php
                                        }else{
                                            ?><span class='badge rounded-pill bg-danger'>Offline</span><?php
                                        }
                                        ?>
                                        <p><?php echo $data1['description']; ?></p>
                                        <p class="text-muted"><?php 
                                        $city=$data1['city'];
                                        $sql2="SELECT * from city where id_city='$city'";
                                        $res2=mysqli_query($link,$sql2);
                                        $data2=mysqli_fetch_assoc($res2);
                                        echo $data2['city_name'];
                                    ?>  </p>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <?php 
                                            $userid=$data1['id_user'];
                                            echo"
                                                <form action='includes/unfollow.php?user=$userid&page=friends' method='post'>  
                                                <input type='submit' class='btn btn-danger btn-sm' name='unfollow' value='Unfollow' style='margin:1px;font-weight:bolder'>
                                                </form>";
                                        ?>
                                        <button class="btn btn-primary btn-sm"><a href='messages.php?id_user=<?php echo $userid; ?>#spot' style="text-decoration:none; color:white;"><b>Send Message</b></a></button>
                                        <button class="btn btn-success"><a href="timeline.php?user_timeline=<?php echo $userid; ?>" style="text-decoration:none; color:white;"><b>Visit Timeline</b></a></button>
                                    </div>
                                </div>                               
                            </div>                           
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
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