<?php
    $display_btn=false;
    if(!isset($_SESSION["isloggedin"]) || $_SESSION["isloggedin"]!=true ){
        $display_btn=true;
    }
?>
<nav>
        <div class="logo">
            <a href="./index.php">
                 <img src="https://picsum.photos/30" alt="logo">
            </a>
           
        </div>
            
        <div class="auth">
        <a href="./cart.php" class="nav__links">Cart</a>
        <a href="./contact.php" class="nav__links">Contact US</a>
        <?php
            if($display_btn){
                echo('<a href="./register.php" class="nav__links">Register</a>
                <a href="./login.php" class="nav__links">Login</a> <a href="./contact.php" class="nav__links">Contact US</a>');
            }
            else{
            echo('<a href="./logout.php" class="nav__links logout-btn">Logout</a>');
            }
        ?>


        </div>
    </nav>