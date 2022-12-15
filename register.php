<?php

    session_start();
    if(isset($_SESSION["isloggedin"])){
        header("location:index.php");

        exit;
        
    }
     include "./utils/_database.php";
     $showalert=false;
     $user_exists=false;
     if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST["Email"];
        $password1=$_POST["Password1"];
        $password2=$_POST["Password2"];

        $user_exists="SELECT * FROM user WHERE user_email='$email'";
        $user_exists_result=mysqli_query($connection,$user_exists);
        $db_user=mysqli_fetch_assoc($user_exists_result);
        $user_email = $db_user["user_email"];
        echo $user_email;
        $num_rows=mysqli_num_rows($user_exists_result);

        if($num_rows==1){
            $user_exists=true;
            
        }
        
        else{

            if($password1!=$password2){
                $showalert=true;
            }
            else{
                $sql="INSERT INTO `user` ( `user_email`, `user_password`) VALUES ('$email', '$password1')";
                $result=mysqli_query($connection,$sql);
                if($result){
                    header("location:login.php");
                }
            }

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

    <title>Register</title>
</head>
<body>
    <?php require "./snippets/_navbar.php"; ?> 
    <?php 
        if($showalert){
            echo '<div class="onetimealert">
            <h4>Passwords do not match</h4>
        </div>';
            
        }    
    ?>

    <?php

            if($user_exists){
                echo '<div class="onetimealert">
                <h4>User Already Exists</h4>
            </div>';

        }
    ?>
 


    <div class="container">
        <div class="form-container">
            <form action="./register.php" method="post" class="form-element">
                <div class="input-element">
                    <label for="email">Email</label>
                    <input type="text" name="Email" class="input-box">
                </div>
                <div class="input-element">
                    <label for="password1">Password</label>
                    <input type="password" name="Password1" class="input-box">
                </div>
                <div class="input-element">
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="Password2" class="input-box">
                </div>
                <button type="submit" class="btn form-btn">Register</button>
                
                
            </form>
        </div>

    </div>
    <footer>

    </footer>
<script src="https://kit.fontawesome.com/cc211e9abe.js" crossorigin="anonymous"></script>   
</body>
</html>