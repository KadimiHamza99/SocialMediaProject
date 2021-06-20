<?php
    include("connect_database.php");
    session_start();
    if (isset($_POST['unfollow'])){   
        $userid_following=$_GET['user'];
        $userid_follower=$_SESSION['id_user'];
        $user=$_GET['user_timeline'];
        $sql2="DELETE FROM `follow` WHERE id_user_follower=$userid_follower and id_user_following=$userid_following";
        mysqli_query($link,$sql2);
        $page=$_GET['page'];
        echo $page;
        echo $userid_following;
        echo $userid_follower;
        if($page=="suggestions"){     
        	header("location: ../suggestions.php");    
        }else if($page=="acceuil"){
        	header("location: ../acceuil.php");  
        }else if($page=="friends"){
            header("location: ../friends.php");
        }else if($page=="profile"){
            header("Location: ../timeline.php?user_timeline=$user");
        }
    }
?>