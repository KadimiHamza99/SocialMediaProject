<?php
    include 'connect_database.php';
    session_start();
    $output='';
    $user_searched=$_POST['search'];
    $sql="SELECT * from user where username LIKE '%$user_searched'";
    $result=mysqli_query($link,$sql);
    if(mysqli_fetch_assoc($result)>0){
        $output .= '<h4 align="center">Search Result</h4>';
        while($row=mysqli_fetch_assoc($result)){
            echo $row['username'];
        }
        echo $output;
    }else{
        echo "Data Not Found";s
    }
?>