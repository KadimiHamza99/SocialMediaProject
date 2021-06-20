<?php
    include("connect_database.php");
    session_start();
    $id_user=$_SESSION['id_user'];
    $username=$_SESSION['username'];
    if (isset($_POST["chercher"])){
        $_POST["search"] = htmlspecialchars($_POST["search"]); 
        $search = $_POST["search"];
        $search = trim($search);
        $search = strip_tags($search); 
    }
    if (isset($search)){
        $search = strtolower($search);
        $sql = "SELECT * FROM user WHERE username LIKE %'$search'";
        $res=mysqli_query($link,$sql);
        while($data=mysqli_fetch_assoc($res)){
            $user=$data['username'];
		    echo "<div>
                    <img width=20px; src='pictures/".$data['picture']."'>
                        <a href='profile.php?user=$user'>Profile $user</a>
                        <img width='10px;' src=".$data['is_active'].">
                </div>
                <br>";
        }
}
?>