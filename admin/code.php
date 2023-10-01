<?php

include "../db.php";

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $acct_name = $_POST['acct_name'];
    $email = $_POST['email'];

    $address = $_POST['address'];
    $tx_hash = $_POST['tx_hash'];
    $acct_no = $_POST['acct_no'];
    $ref_code = $_POST['ref_code'];    
    $usdt = $_POST['usdt'];
    $ngn = $_POST['ngn'];
    $status = $_POST['status'] == true ? '1':'0'; 

    $postupdate = $db->query("UPDATE check_data SET acct_name = '$acct_name', email = '$email', acct_no = '$acct_no', wallet_address = '$address', ref_code = '$ref_code', usdt = '$usdt', ngn = '$ngn', tx_hash = '$tx_hash', status = '$status' WHERE id = '$id'");

    if ($postupdate) 
    {
        $_SESSION['message'] = "Details Updated Successfully";
        header('Location:update?id='.$id);
        exit();
    }
    else{
        $_SESSION['message'] = "Something Went Wrong!";
        header('Location:update?id='.$id);
        exit();
    }
}

?>