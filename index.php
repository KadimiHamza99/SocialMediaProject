<!DOCTYPE html>
<html lang="en">
<head>
    <title>HamzaKadimiBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
</head>
<body>
    <div class="page">
        
        <div class="signin-section page-side">
            <div class="choice">
                <img src="Image/signin-icon-black.png">
                <p  class="title">Sign In</p> 
            </div>
            <div class="signin-form-area">
                <p class="form-title">Sign In</p>
                <div class="section-form">
                    <form class="signin-form" method="POST" action="includes/checksignin.php">
                        <label class="label" for="username">
                            <input class="input form-control" type="text" name="username&email" placeholder="UserName Or Email">
                        </label>
                        <label class="label" for="password">
                            <input class="input form-control" type="password" name="password" placeholder="Password">
                        </label>
                        <div class="signin-section-submit">
                            <div class="login-form-submit-btn">
                                <input type="submit" name="signin" value="Envoyer">
                            </div>
                        </div>
                    </form>
                     <?php
                        /* errors */
                        if(isset($_GET['error'])){
                            $signupcheck = $_GET['error'];
                            if ($signupcheck == 'emptyfields') {
                            /* error emptyfields */
                                echo '<p class ="error"> Veuillez remplir les champs vides. </p>' ;
                            }elseif($signupcheck == 'wrong_password'){
                            /* error wrong_password*/ 
                                echo '<p class = "error"> Champs inccorect. </p> ';
                            }elseif ($signupcheck == 'no_user') {
                            /* error no_user */ 
                                echo '<p class = "error"> Champs inccorect. </p>';
                            }
                        }
                    ?> 
                </div>
            </div>
        </div>
        
        <div class="signup-section page-side">
            <div class="choice">
                <img src="Image/signup-icon.png">
                <p class="title">Sign Up</p>    
            </div>
            <div class="signup-form-area">
                <p class="form-title">Sign Up</p>
                <div class="section-form">
                    <form class="signin-form" method="POST" action="includes/checksignup.php">
                        <label class="label" for="username">
                            <input class="input form-control" type="text" name="username" placeholder="UserName">
                        </label>
                        <label class="label" for="email">
                            <input class="input form-control" type="email" name="email" placeholder="E-Mail">
                        </label>                        
                        <label class="label" for="password">
                            <input class="input form-control" type="password" name="password" placeholder="Password">
                        </label>
                        <label class="label" for="confirmpassword">
                            <input class="input form-control" type="password" name="confirmpassword" placeholder="Confirm Your Password">
                        </label>
                        <label class="label" for="birthday">
                            <input type="date" name="birthday" class="input form-control">
                        </label>
                        <label class="label" for="city">
                            <select name="city" class="input form-control">
                                <?php
                                    include("includes/connect_database.php");
                                    $sql1="SELECT * FROM city";
                                    $result1=mysqli_query($link,$sql1);
                                    while($data=mysqli_fetch_assoc($result1)){
                                        echo '<option class="exception" value='.$data['id_city'].'>';
                                        echo $data['city_name'];
                                        echo '</option>';
                                    }       
                                ?>
                                <!--<span class="placeholder">Your City</span>-->
                            </select>
                        </label>
                        <div class="signup-section-submit">
                            <div class="login-form-submit-btn">
                                <input type="submit" name="signup" value="Envoyer">
                            </div>
                        </div>
                    </form>
                    <div>
                    <?php 
                        if (isset($_GET['error'])) {
                            $error=$_GET['error'];
                            if($error=='password'){
                                echo "le mot de passe est incorrecte";
                            
                            }else if($error=='email'){
                                echo "cet email est deja utilisé";
                                
                            }else if ($error=='username') {
                                echo "cet username est deja utilisé";
                                
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/indexScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>