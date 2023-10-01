<?php

$get = file_get_contents('txt/all.txt');
if($get == ""){

}else{
$done = explode(" ", $get);
// print_r($done);

$account_number = $done[0];
$bank_code = $done[1];
$email = $done[2];
$usdt = $done[3];
$address = $done[4];

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
                ]
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
        if($status == 1){
        echo $account_name;
        }else{
        echo $message;
        }
    
        // $_SESSION["account_name"] =  $account_name;
    
        // echo(($status == 1) ? $message : ' Please Cross-check the details input previously');
        // echo(($status == 1 ? $identity->data->account_name : ''));
        // echo(($status == 1 ? $identity->data->account_number : ''));
        // echo (($status == 1? floor( $usdt * $usdt_rate) : ""));
        // echo (($status == 1? $usdt." USDT": ""));
    } 

?>