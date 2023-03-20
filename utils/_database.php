<?php
    $server="localhost";
    $username="root";
    $password="cloudcomputing";
    $db_name="jewelry_store";
    

    $connection=mysqli_connect($server,$username,$password,$db_name);
    if($connection){
        // echo "connected";
    }
    else{
        die("not connected".    mysqli_connect_error);
    }

?>

