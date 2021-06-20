<?php
    include("connect_database.php");
    session_start(); 
    if (isset($_POST['follow'])){      
        $userid_following=$_GET['user'];
        $userid_follower=$_SESSION['id_user'];
        $user=$_GET['user_timeline'];
        $sql2="INSERT INTO `follow`(`id`, `id_user_following`, `id_user_follower`) VALUES (0,'$userid_following','$userid_follower')";
        $result2=mysqli_query($link,$sql2);
        $page=$_GET['page'];
        if($page=="suggestions"){     
        	header("location: ../suggestions.php");    
        }else if($page=="acceuil"){
        	header("location: ../acceuil.php");  
        }else if($page=="addfriends"){
            header("location: ../addfriends.php");
        }else if($page=="profile"){
            header("Location: ../timeline.php?user_timeline=$user");
        }
    }
?>