<?php
include_once('connect_database.php');

if (isset($_POST['signin'])) {
    $uname = $_POST['username&email'];
    $password = $_POST['password'];

    if (empty($uname) || empty($password)) {
        header('Location: ../index.php?error=emptyfields');
        exit();
    }
    else {
        $requete="SELECT * FROM user WHERE username='$uname' OR email ='$uname' LIMIT 1";
        $result=mysqli_query($link,$requete);
        if ( mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_assoc($result) ) {
                $pwd=$row['password'];
                $password = md5($password);
                if (! ($pwd == $password)) {
                    header('Location: ../index.php?error=wrong_password');
                    exit();
                }
                else {
                    session_start();
                    $_SESSION['id_user']=$row['id_user'];
                    $_SESSION['username']=$row['username'];
                    $_SESSION['birthday']=$row['birthday'];
                    $_SESSION['email']=$row['email'];
                    header('Location: ../acceuil.php');
                }
            }
        }else {
            header('Location: ../index.php?error=no_user');
        }
    }

}
else {
    header('Location: ../index.php');
}

?>