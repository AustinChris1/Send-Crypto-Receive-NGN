<?php 
    $var_price = $_POST['price'];
    file_put_contents("../txt/file.txt", $var_price);
?>