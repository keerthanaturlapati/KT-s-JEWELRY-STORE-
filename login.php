<?php

    session_start();

     include "./utils/_database.php";
     $showalert=false;

    if(isset($_SESSION["isloggedin"])){
        header("location:index.php");

        exit;
        
    }
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST["Email"];
        $password=$_POST["Password"];
        $sql="SELECT * FROM user WHERE user_email='$email' AND user_password='$password'";
        $result=mysqli_query($connection,$sql);
        $no_of_rows=mysqli_num_rows($result);
        if($no_of_rows==1){
            session_start();
            $db_user=mysqli_fetch_assoc($result);
            $_SESSION["user_id"]=$db_user["user_id"];
            $_SESSION["isloggedin"]=true;
            $_SESSION["email"]=$email;
            header("location:index.php");
        }
        else{
                $showalert=true;
                echo $email;
                
                
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/auth.css">

    <title>Login</title>
</head>
<body>

  <?php require "./snippets/_navbar.php"; ?> 
    <?php 
        if($showalert){
            echo '<div class="onetimealert">
            <h4>Username or password is incorrect</h4>
        </div>';
            
        }    
    ?>

    


    <div class="container">
        
        <div class="form-container">
            <form action="" method="post" class="form-element">
                <div class="input-element">
                    <label for="email">Email</label>
                    <input type="text" name="Email" class="input-box">
                </div>
                <div class="input-element">
                    <label for="password">Password</label>
                    <input type="password" name="Password" class="input-box">
                </div>
                <button type="submit" class="btn form-btn">Login</button>
                
                
            </form>
        </div>

    </div>
    <footer>

    </footer>
<script src="https://kit.fontawesome.com/cc211e9abe.js" crossorigin="anonymous"></script>  
</body>
</html>