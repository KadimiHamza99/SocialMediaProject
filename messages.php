<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/messagesstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Conversation</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link href="css/emoji.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Zilla+Slab+Highlight&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
</head>
<body>

    <?php
        session_start();
        include "includes/connect_database.php";
        $send_from=$_SESSION['id_user'];
        $send_to=$_GET['id_user'];
        $date=date("Y-m-d H:i:s");
        $sql="SELECT * from user where id_user='$send_to' limit 1";
        $res=mysqli_query($link,$sql);
        $data=mysqli_fetch_assoc($res);
    ?>
    <?php
        if (isset($_POST['envoyer'])){
			$message=$_POST['message'];
			$sql1="INSERT INTO `messages`(`id`, `sender`, `receiver`, `contenu`,`date`) VALUES (0,'$send_from','$send_to','$message','$date')";
			$result1=mysqli_query($link,$sql1);
		}
    ?>
    <header id="header">
    <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="acceuil.php"><span style="text-align: center; color: #0C67ED;margin:10px;font-family: 'Permanent Marker', cursive;"><b>KadimiMessagerie</b></span></a>
        </div>
            <a href="timeline.php?user_timeline=<?php echo $id_user; ?>" style='color:white;text-decoration:none'>My Timeline</a>
            <a href="addfriends.php" style='color:white;text-decoration:none'>Find New Friends</a>
            <a href="friends.php" style='color:white;text-decoration:none'>Chatroom</a>
            <a href="includes/deconnexion.php" style='color:white;text-decoration:none'>Sign Out</a>
        </div><!-- /.container -->
    </nav>
</header>
    <div id="container">
    <aside style="background-color:rgb(21, 155, 202)">
        <ul>
    <?php
        $req="SELECT * from follow where id_user_follower='$send_from'";
        $resultat=mysqli_query($link,$req);
        while($row=mysqli_fetch_assoc($resultat)){
            $friend=$row['id_user_following'];
            $sqlA="SELECT * from user where id_user='$friend'";
            $resA=mysqli_query($link,$sqlA);
            while($dataA=mysqli_fetch_assoc($resA)){
                $conv=$dataA['id_user'];
                ?>
            
			<li><a href="messages.php?id_user=<?php echo $conv; ?>">
				<img src="pictures/<?php echo $dataA['picture']; ?>" width="50" alt="">
				<div>
					<h2><b><?php echo $dataA['username']; ?></b></h2>
					<h3>
                    <?php 
                        if($dataA['is_active']==0){
                    ?>
						<span class="status orange"></span>
						<b><span style="color:orange">offline</span></b>
					</h3>
                    <?php }else{ ?>
                        <span class="status green"></span>
						<b><span style="color:green">online</span></b>
                    <?php } ?>
				</div>
			</a></li>
		<?php 
            }
        }
        ?>	
		</ul>
	</aside>
	<main>
		<header>
			<img src="pictures/<?php echo $data['picture']; ?>" width="30" alt="">
			<div>
				<h2>Chat with <?php echo $data['username']; ?></h2>
			</div>
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt="">
		</header>
        <ul id="chat">
        <?php
        $sql3="SELECT * from user INNER JOIN messages on id_user=sender where (receiver='$send_from' AND sender='$send_to') OR (receiver='$send_to' AND sender='$send_from')";
        $res3=mysqli_query($link,$sql3);
        while($data3=mysqli_fetch_assoc($res3)){       
            if(($send_from == $data3['sender']) && $send_from == $_SESSION['id_user']){
        ?>

		
            <li class="me">
				<div class="entete">
					<h3><?php echo $data3['date']; ?></h3>
					<h2><?php echo $data3['username']; ?></h2>
					<span class="status blue"></span>
				</div>
				<div class="triangle"></div>
				<div class="message">
                    <?php echo $data3['contenu']; ?>
				</div>
			</li>
            <?php }else{ ?>
			<li class="you">
				<div class="entete">
					<span class="status green"></span>
					<h2><?php echo $data3['username']; ?></h2>
					<h3><?php echo $data3['date']; ?></h3>
				</div>
				<div class="triangle"></div>
				<div class="message">
                    <?php echo $data3['contenu']; ?>
				</div>
			</li>          
        <?php
                }
    
        }
        ?>
        <div id="spot"></div>
        </ul>
		<footer>
        <form action="" method='post'>
			<textarea placeholder="Type your message" name='message' style="border:1px solid black"></textarea>
			<input type="submit" name='envoyer' value="SEND" style="color:blue;background-color:rgba(0,0,0,0);border:0px solid black;">
        </form>
        
			
		</footer>
	</main>
</div>
<footer>
      	<div class="copyright">
       	 	<p>KadimiHamza © 2021. All rights reserved</p>
          <p>Email: hamza.kadimi@uit.ac.ma</p>
          <p>Phone: 0641496524</p>
      	</div>
	 </footer>
    <script>
		setInterval('load_messages()', 1500);
		function load_messages(){
			$('#messages').load('load_messages.php');
		}
	</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
</body>
</html>