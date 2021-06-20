<?php 
    include("connect_database.php");
    session_start();

    if (isset($_POST['commenter']) and !empty($_POST['comment'])){
        $page=$_GET['page'];
        $id_publication=$_GET['id'];
        $id_user=$_SESSION['id_user'];
        $user=$_GET['user'];
        echo $user;
        $contenue=addslashes($_POST['comment']);
        $date=date("Y-m-d H:i:s");
        
        $sql1="INSERT INTO `comments` VALUES (0,'$contenue','$id_publication','$date','$id_user')";
        $result1=mysqli_query($link,$sql1);
        
        if ($page=='acceuil') {
            header("location: ../acceuil.php");
        }if ($page=='profile') {
            header("Location: ../timeline.php?user_timeline=$user#$id_publication");
        }
    } 

    
?>