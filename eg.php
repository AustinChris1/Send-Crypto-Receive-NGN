<?php
    var_dump($_POST);
    $account_number = $_POST['account_number'];
    $bank_code = $_POST['bank_code'];
    $usdt = $_POST['usdt'];
    $wallet_address = $_POST['address'];
    $email = $_POST['email'];

    $_SESSION["usdt"] = $usdt;
    $_SESSION["address"] = $wallet_address;
    $_SESSION["bank_code"] = $bank_code;
    $_SESSION['account_number'] = $account_number;
    $_SESSION['email'] = $email;
    
    $account_number = $_SESSION['account_number'];
    $bank_code = $_SESSION['bank_code'];
    $usdt = $_SESSION['usdt'];
    $wallet_address = $_SESSION['address'];
    $email = $_SESSION['email'];

    // $_SESSION["usdt"] = $usdt;
    // $_SESSION["address"] = $wallet_address;
    // $_SESSION["bank_code"] = $bank_code;
    // $_SESSION['account_number'] = $account_number;
    // $_SESSION['email'] = $email;
    
    $all = $account_number.' '.$bank_code.' '.$email.' '.$usdt.' '.$wallet_address;
    file_put_contents("txt/all.txt", $all);

?>



