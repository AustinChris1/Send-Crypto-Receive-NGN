<?php 
    
    session_start();
    
    $usdt_rate = $_SESSION['rate'];

    
    // if(isset($_POST['submit'])){
    //     // echo('here');
    // }else{
    //     echo('<h3>Dear Customer you need to go to the previous page<br> and fill out the form... click on the "Go back" to go to the previous page</h3>');
    //     echo('<hr>');
    //     die("<a href='./'><input type='submit' value='<<Go back' class='go_back'></a>");
        
        
    // }
    //sanitize info passed on previous page
    
    //get the info passed in the previous page
    // var_dump($_POST);
    // $account_number = $_POST['account_number'];
    // $bank_code = $_POST['bank_code'];
    // $usdt = $_POST['usdt'];
    // $wallet_address = $_POST['address'];
    // $email = $_POST['email'];

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

    //test secret key
    $PAYSTACK_API_KEY = 'sk_test_be52d644f7e6d0892965b86765a2fec2f9ad5663';
    //integrate paystack

    $curl = curl_init();//initiate curl

    //turn off mandatory ssl
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    //Make dynamic url
    $url = 'https://api.paystack.co/bank/resolve?account_number=' . $account_number ."&bank_code=" . $bank_code;

    //configure curl 
    curl_setopt_array($curl, array(
            //set above endpoint in curl
            CURLOPT_URL => $url,

            //make curl return data
            CURLOPT_RETURNTRANSFER => true,

            //set curl headers
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'authorization: Bearer sk_live_f48cba23145939849d6a32be8570b3bb39f49802',
                'cache-control: no-cache'
            ],
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('bank_code' => $bank_code, 'account_number'=>$account_number)
            )
        );

    //execute curl
    $response = curl_exec($curl);

    //control error
    $err = curl_error($curl);

    if($err){
        die('there was an error ' . $err );
    }
    //convert to object
    $identity = json_decode($response);

    $message = $identity->message;
    $status = $identity-> status;
    $account_name = $identity->data->account_name;

    $_SESSION["account_name"] =  $account_name;
echo $account_name;
    // echo(($status == 1) ? $message : ' Please Cross-check the details input previously');
    // echo(($status == 1 ? $identity->data->account_name : ''));
    // echo(($status == 1 ? $identity->data->account_number : ''));
    // echo (($status == 1? floor( $usdt * $usdt_rate) : ""));
    // echo (($status == 1? $usdt." USDT": ""));
?>
            
