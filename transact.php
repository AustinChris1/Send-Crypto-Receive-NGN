<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
            body{
                background-color: red;
                color: wheat;
            }
            h1{
                margin-bottom: 40px;
            }
            .longer_hr{
                margin-right: auto;
            }
            .confirm_identity{
                margin-left: 30px;
            }
            .confirm{
                background-color: rgb(0,0,119);
                width: 200px;
                height: 70px;
                color: white;
                border: none;
                border-radius: 30px;
                margin-left: 35px;
                margin-top: 15px;
                transition: 0.3s;
            }
            .confirm:hover{
                cursor: pointer;
                /* background-color: rgb(51,51,146); */
                background-color: rgb(39,39 ,112);
                
            }

            .confirm:active{
                cursor: pointer;
                background-color: rgb(51,51,146);
                /* background-color: rgb(39,39 ,112); */
                
            }
            .go_back{
                background-color: rgb(0,0,119);
                width: 200px;
                height: 70px;
                color: white;
                border: none;
                border-radius: 30px;
                margin-left: 400px;
                margin-top: 30px;
                transition: 0.3s;
                
            }

            .go_back:hover{
                cursor: pointer;
                /* background-color: rgb(51,51,146); */
                background-color: rgb(39,39 ,112);
                
            }

            .go_back:active{
                cursor: pointer;
                background-color: rgb(51,51,146);
                /* background-color: rgb(39,39 ,112); */
                
            }

            h3{
                margin-top: 80px;
                margin-bottom: 20px;
                padding-left: 20px;
                line-height: 45px;
            }
            hr{
                margin-right: 40%;
            }
        </style>

<?php 
    
    session_start();
    include "db.php";

    $usdt_rate = $_SESSION['rate'];
    // echo($usdt_rate);
    $now = date("Y-m-d H:i:s");
    $count_date = date('Y-m-d H:i:s', strtotime($now . '+ 5 minutes'));

    function setTimeCookie ($count_date){
    setcookie("timer", $count_date, time()+60*20, "/");
    }
    
    if(isset($_POST['submit'])){
    //sanitize info passed on previous page
    
    //get the info passed in the previous page
    $account_number = $db->real_escape_string($_POST['account_number']);
    $bank_code = $db->real_escape_string($_POST['bank_code']);
    $usdt = $db->real_escape_string($_POST['usdt']);
    $wallet_address = $db->real_escape_string($_POST['address']);
    $email = $db->real_escape_string($_POST['email']);

    $session_usdt = $usdt;
    $_SESSION["usdt"] = $session_usdt;
    $_SESSION["address"] = $wallet_address;
    // $usdt = $_SESSION['usdt'];
    $_SESSION["bank_code"] = $bank_code;
    $_SESSION['account_number'] = $account_number;
    $_SESSION['email'] = $email;
    
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
    // echo('<pre>' . $response .'</pre>');

    $message = $identity->message;
    $status = $identity-> status;
    $account_name = $identity->data->account_name;

    $_SESSION["account_name"] =  $account_name;

    // echo $usdt;

?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Confirm details</title>
    </head>
    <body>
        
        <h1>Dear Customer Please verify Your Identity</h1>
        <hr class="longer_hr">
        <form action="<?php echo($status == 1 ? 'awaiting.php' : './') ?>" class="confirm_identity" method="POST">
            
                <h4>Response: <?php echo(($status == 1) ? $message : ' Please Cross-check the details input previously')?> </h4>
                <h4>Account Name: <?php echo(($status == 1 ? $identity->data->account_name : '')) ?></h4>
                <h4>Account Number: <?php echo(($status == 1 ? $identity->data->account_number : ''))?></h4>
                <h4>Amount To Be Recieved: <?php echo (($status == 1? floor( $usdt * $usdt_rate) : ""))   ?></h4>
                <h4>Send <?php echo (($status == 1? $usdt." USDT": ""))   ?> to this address <div id="copy" onclick="copyDivToClipboard()">0xfbC74D86fc320383D1Af240129aa762341AB00AC</div><i class="fas fa-clipboard"></i></h4>


            <input type="submit" name="confirm" id="confirm" value="<?php echo($status == 1 ? 'Confirm' : '<<Go back') ?>" class="confirm" <?php  ?>>
        </form>
    </body>
</html>
<script>
const confirmBtn = document.getElementById("confirm");
confirmBtn.addEventListener('click', () => {
    <?php setTimeCookie ($count_date);?>
})


function copyDivToClipboard() {
 var range = document.createRange();
 range.selectNode(document.getElementById("a"));
 window.getSelection().removeAllRanges(); // clear current selection
 window.getSelection().addRange(range); // to select text
 document.execCommand("copy");
 window.getSelection().removeAllRanges();// to deselect
}
</script>
<?php
    exit();
}else{
        echo('<h3>Dear Customer you need to go to the previous page<br> and fill out the form... click on the "Go back" to go to the previous page</h3>');
        echo('<hr>');
        die("<a href='./'><input type='submit' value='<<Go back' class='go_back'></a>");
        
        
    }
