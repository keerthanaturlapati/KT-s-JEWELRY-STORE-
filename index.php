<?php 
    session_start();

    $products_category="Products";
    include "./utils/_database.php";
    $sql="SELECT * FROM product";
    $product_payload=$connection->query($sql);
    $total_products=mysqli_num_rows($product_payload);

    

    if(isset($_POST["add_to_cart"])){

        if(!isset($_SESSION["isloggedin"]) || $_SESSION["isloggedin"]!=true){
            header("location:login.php");

            echo "exiting";
            exit;
            
        }

        $current_user_id=$_SESSION["user_id"];

        
        $product_image=$_POST["product_image"];
        $product_title=$_POST["product_title"];
        $product_price=$_POST["product_price"];

        $select_cart_item="SELECT * FROM cart WHERE product_title='$product_title' AND user_id='$current_user_id'";
        $current_cart_items=mysqli_query($connection,$select_cart_item);
        if(mysqli_num_rows($current_cart_items)>0){
            echo "product already present in cart";
        }
        else{
            $insert_cart_item="INSERT INTO cart (user_id, product_title, product_image, product_price) VALUES ('$current_user_id','$product_title','$product_image','$product_price')";
            $result=mysqli_query($connection,$insert_cart_item);
            
        }
    }


    $sql_categories="SELECT * FROM category";
    $category_payload=mysqli_query($connection,$sql_categories);


    if(isset($_POST["change_category"])){
        $category_id=$_POST["category_id"];
        $category_name=$_POST["category_name"];
        $products_category=$category_name;
        $select_category="SELECT * FROM product WHERE category='$category_id'";
        $product_payload=$connection->query($select_category);
        
    }

    if(isset($_POST["fetch_all"])){
        $products_category="Products";
        $product_payload=$connection->query($sql);
        
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
    <title>KT's JEWELRY STORE</title>
</head>
<body>
   <?php require "./snippets/_navbar.php"; ?> 

    <div class="container">
        <div class="banner">
            <img src="https://karltayloreducation.com/wp-content/uploads/2018/11/metal-necklace-WEB.jpg" alt="jewelry banner" class="banner__image">
            <div class="banner__overlay">
                <h2>KT's Jewelry Store</h2>
            </div>


        </div>
        <div class="products">
            <div class="products__leftsection">
                <div class="filterset">
                    <h2>Category</h2>
                    <div class="filterset__items">


                    <form action="" class="category-item" method="POST">
                            <input type="submit" value="All Products" class="category-item-link"  name="fetch_all">
                    </form>

                    
                    <?php while($category=mysqli_fetch_assoc($category_payload)):?>

                        <form action="" class="category-item" method="POST">
                            <input type="hidden" name="category_id" value="<?= $category["category_id"]?>">
                            <input type="hidden" name="category_name" value="<?= $category["category_title"]?>">
                            <input type="submit" value="<?= $category["category_title"]?>" class="category-item-link"  name="change_category">
                        </form>

                    <?php endwhile?>

                    </div>
                </div>
                

            </div>
            <div class="products__rightsection">
                <div class="product__header">
                    <h2><?= $products_category?></h2>
                    <h2><?= $total_products?></h2>
                </div>
                <div class="product__list">

                    <?php
                        while($product=mysqli_fetch_assoc($product_payload)):
                    ?>


                        <form class="card" method="post" action="">
                            <div class="card__top">
                                <div class="card__image">
                                    <img src="<?=$product["product_image"]?>" alt="something" class="card__innerimage">
                                </div>
                                <div class="card__text">
                                    <div class="card__textheader">
                                        <h3><?=$product["product_title"]?></h3>
                                        <h3>$<?=$product["product_price"]?></h3>
                                    </div>
                                    <p class="card__description"><?=$product["product_description"]?></p>
                                </div>

                            </div>
                            <div class="card__button">
                                <input type="hidden" name="product_image" value="<?=$product["product_image"]?>">
                                <input type="hidden" name="product_title" value="<?=$product["product_title"]?>">
                                <input type="hidden" name="product_price" value="<?=$product["product_price"]?>">
                                <input class="btn btn-card" type="submit" value="Add to cart" name="add_to_cart">
                            </div>
                        </form>

                    <?php endwhile ?>


                </div>
            </div>
        </div>
        
    </div>
    <footer>

    </footer>
<script src="https://kit.fontawesome.com/cc211e9abe.js" crossorigin="anonymous"></script>   
</body>
</html>