<?php
    session_start();
    include "./utils/_database.php";
    if(!isset($_SESSION["isloggedin"]) || $_SESSION["isloggedin"]!=true){
        header("location:login.php");
        echo "exiting";
        exit;
        
    }
    $current_user_id=$_SESSION["user_id"];
    $no_of_items=0;

    $get_cart="SELECT * FROM cart WHERE user_id='$current_user_id'";
    $cart_payload=mysqli_query($connection,$get_cart);

    if($cart_payload){
        $no_of_items=mysqli_num_rows($cart_payload);
    }

    if(isset($_POST["delete_cart"])){
        $cart_id=$_POST["cart_id"];
        $delete_cart="DELETE FROM cart WHERE cart_id='$cart_id'";
        $result=mysqli_query($connection,$delete_cart);

        if($result){
             $cart_payload=mysqli_query($connection,$get_cart);
             if($cart_payload){
                $no_of_items=mysqli_num_rows($cart_payload);
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
    <link rel="stylesheet" href="./css/cart.css">

    <title>KT's JEWELRY STORE</title>
</head>
<body>
    <?php require "./snippets/_navbar.php"; ?> 
    <div class="container">
        <div class="cart-container">
            <div class="cartcontainer__left">
                <div class="cartcontainer__header">
                    <h2><?= $no_of_items?> Items in your Cart<h2>
                    <i class="fa-regular fa-trash-can"></i>
                </div>
                <div class="cartcontainer__items">

                    <?php while($cart_item=mysqli_fetch_assoc($cart_payload)):?>
                    <form class="cart_item" method="POST" action="">

                        <img src="<?= $cart_item["product_image"]?>" alt="something" width="20" height="20">
                        <h4 class="cart_title"><?= $cart_item["product_title"]?></h4>
                        <h4>$<?= $cart_item["product_price"]?></h4>
                        <input type="hidden" name="cart_id" value="<?= $cart_item["cart_id"]?>">
                        <div class="delete-cart-btn">
                             <i class="fa-solid fa-trash-can"></i>
                             <input type="submit" value="" name="delete_cart">
                        </div>
                       
                    </form>
                <?php endwhile ?>           


                </div>
            </div>
            <div class="cartcontainer__right">
                <div class="ordersummary-header">
                    <h2>Order Summary</h2>
                
                </div>
                <div class="ordersummary-bottom">
                    <div class="ordersummary-items">
                        <div class="ordersummary-element">
                            <h4>Shipping Costs</h4>
                            <h4>$20</h4>
                            
                        </div>
                        <div class="ordersummary-element">
                            <h4>Shipping Costs</h4>
                            <h4>$20</h4>
                            
                        </div>
                        <div class="ordersummary-element">  
                            <h4>Shipping Costs</h4>
                            <h4>$20</h4>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn checkout-btn">Proceed to checkout</button>
                </div>
               
            </div>
        </div>

    </div>
    <footer>

    </footer>
<script src="https://kit.fontawesome.com/cc211e9abe.js" crossorigin="anonymous"></script>   
</body>
</html>