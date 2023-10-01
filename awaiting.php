<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="awaiting.css">
    <title>Awaiting Transaction</title>
</head>

<body>
    <?php
    include "db.php";
    session_start();
    if (isset($_POST["submit"])) {


        // $base = file_get_contents("txt/base.txt");

        $account_number = $db->real_escape_string($_POST['account_number']);
        $bank_code = $db->real_escape_string($_POST['bank_code']);
        $usdt = $db->real_escape_string($_POST['usdt']);
        $address = $db->real_escape_string($_POST['address']);
        $email = $db->real_escape_string($_POST['email']);
        $account_name = $db->real_escape_string($_POST['account_name']);

        $_SESSION["usdt"] = $usdt;
        $_SESSION["address"] = $address;
        // $usdt = $_SESSION['usdt'];
        $_SESSION["bank_code"] = $bank_code;
        $_SESSION['account_number'] = $account_number;
        $_SESSION['email'] = $email;
        $_SESSION['account_name'] = $account_name;

        $address = strtolower($address);
        $base_address = "0xfbC74D86fc320383D1Af240129aa762341AB00AC";
        // $email = $_SESSION['email'];
        $base_amount = intval(file_get_contents("txt/file.txt"));
        $base_amount = $base_amount * $usdt;
    } else {
        header("location:/transact");
        exit();
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require 'vendor/autoload.php';
    function sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "server236.web-hosting.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;

        $mail->Username = "info@spectrawebx.xyz";
        $mail->Password = "Blabla789?";

        $mail->setFrom("info@spectrawebx.xyz", "Markov Exchange");
        $mail->addAddress($email);
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = "Transation Notification";
        //https://unsplash.it/801
        $email_template = "
      <div style='width:80%; height:100%; background-color:#000; padding:10%; font-family: Verdana, Geneva, Tahoma, sans-serif;'>
      <h2 style='color:white'>Hello $account_name, Thank you for transacting with Markov Exchange</h2>
      <img src='https://i.ibb.co/Q70WgX4/mk-main1-modified.png' width='160px' height='160px' style='margin-left:25%;'>
      <h5 style='color:white;'>Here are your transaction details below<br><br>
      <table style='border: 3px solid #fff; border-collapse:collapse; width: 50%; height: 90%; text-transform:uppercase; font-family: Verdana, Geneva, Tahoma, sans-serif;'>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:3%'>
      <th style='padding:3%'>
      Transaction Details
      </th>
    </tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Transaction Status</td><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>$feed</td></tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Name</td><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>$account_name</td></tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Email</td><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>$email</td></tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Wallet Address</td><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>$address</td></tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Reference code</td><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>$ref_code</td></tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Amount to be received</td><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>$base_amount</td></tr>
      <tr style='border: 3px solid #fff; border-collapse:collapse; padding:2%'><td style='border: 3px solid #fff; border-collapse:collapse; padding:2%'>Date</td><td style='border: 3px solid #fff; border-collapse:collapse;'>$paymentDate</td></tr>
      </table><br><br>
      <a style='background-color:#fff; color:white; width:80%; height:50%; padding:15px 15px 15px 15px; border-radius:15%; margin:25%;' href='https://markov.exchange'>Transact Again</a><br/><br/>
      <a style='margin:auto; margin-right:20%; border-radius:50%;' href='https://wa.link/2ptve3'><img src='https://ibb.co/VwLCNZ6'></a>
      <a style='margin:auto; margin-right:20%; border-radius:50%;' href='https://wa.link/2ptve3'><img src='https://ibb.co/zFJ0dHp'></a>
    </div>
      ";

        $mail->Body = $email_template;
        $mail->send();
    }


    $PAYSTACK_API_KEY = getenv("API_KEY");

    $url = "https://api.paystack.co/transferrecipient";

    $fields = [
        'type' => "nuban",
        'name' => $account_name,
        'account_number' => $account_number,
        'bank_code' => $bank_code,
        'currency' => "NGN"
    ];

    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();


    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer ".$PAYSTACK_API_KEY,
        "Cache-Control: no-cache",
    ));


    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $recipient_code = $response['data']['recipient_code'];
    ?>
    <?php
    $API_KEY = '9CMIRVTCY3A3VCVNFDH76KG46MENXIKVQ3';

    $details = $db->query("SELECT * FROM check_data WHERE id = '2' LIMIT 1");
    $details_stat = $details->fetch_array();
    $check_address = $details_stat['wallet_address'];
    $contractaddress =  $details_stat['tx_hash'];
    
    // $contractaddress = '0xe9e7cea3dedca5984780bafc599bd69add087d56';
    // $check_address = '0xfbC74D86fc320383D1Af240129aa762341AB00AC';

    $BASE_CONVERT_RATE = 10 ** 18;

    $BASE_URL = 'https://api.bscscan.com/api';

    // function get_balance($contractaddress, $check_address, $BASE_URL, $API_KEY, $BASE_CONVERT_RATE){

    $url = $BASE_URL . "?module=account&action=tokentx&contractaddress=" . $contractaddress . "&address=" . $check_address . "&apikey=" . $API_KEY;

    $val = $usdt;
    $val = intval($val * 10 ** 18);
    $crypto_response = file_get_contents($url);
    $crypto_data = json_decode($crypto_response, true);
    // echo '<pre>'. $response;
    ?>

    <!-- <input type="text" name="amount" id="box" class="digit" >
    <input type="text" name="array" id="address" class="digit" > -->
    <script src="ajax.js"></script>
    <script src="address.js"></script>
    <?php
    function payment($base_amount, $recipient_code, $account_name, $email, $address, $db, $account_number, $tx_hash, $usdt)
    {

        function random_strings($length_of_string)
        {

            // String of all alphanumeric character
            $str_result = '0123456789abcdefghijklmnopqrstuvwxyz';

            // Shuffle the $str_result and returns substring
            // of specified length
            return substr(
                str_shuffle($str_result),
                0,
                $length_of_string
            );
        }
        // Declare an associative array
        $arr = array("a" => "flex", "b" => "Thank you", "c" => "Nice", "d" => "We Appreciate", "e" => "My person");

        // Use shuffle function to randomly assign numeric
        // key to all elements of array.
        shuffle($arr);

        // Display the first shuffle element of array
        $reason = $arr[0];

        // This function will generate
        // Random string of length 10
        $ref_code = random_strings(10);
        $total_amount = $base_amount * 100;

        $url = "https://api.paystack.co/transfer";
        //$total_amount
        $fields = [
            'source' => "balance",
            'amount' => '500000',
            "reference" => $ref_code,
            'recipient' => $recipient_code,
            'reason' => $reason
        ];
        $PAYSTACK_API_KEY = getenv("API_KEY");

        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization:  Bearer ".$PAYSTACK_API_KEY,
            "Cache-Control: no-cache",
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $result = curl_exec($ch);
        $result = json_decode($result, true);

        $feed = $result['message'];
        $status = $result['status'];
        $paymentDate = $result['data']['createdAt'];
        $paymentDate = str_replace("T", " ", $paymentDate);
        $paymentDate = str_replace(".000Z", "", $paymentDate);
        if ($status == true) {
            $check_tx_db = $db->query("SELECT * FROM check_data WHERE wallet_address = '$address' AND usdt = '$usdt' AND tx_hash = '$tx_hash' ORDER BY id DESC LIMIT 1");
            if($check_tx_db->num_rows <= 0){
                sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed);

            sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed);
            $db->query("INSERT INTO check_data (acct_name, acct_no, email, ref_code, status, date, wallet_address, tx_hash, ngn, usdt) VALUES ('$account_name', '$account_number', '$email', '$ref_code', '1', NOW(), '$address', '$tx_hash', '$base_amount', '$usdt')");
            $_SESSION["message"] = "Transaction Successful!";
            header("location: index");
            exit();
            }else{
                sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed);
                // $db->query("UPDATE check_data set status = '1', acct_name = '$account_name', acct_no = '$account_number', email = '$email' WHERE wallet_address = '$address' AND usdt = '$usdt' AND tx_hash = '$tx_hash' ORDER BY id DESC LIMIT 1");
                $_SESSION["message"] = "Transaction Successful!";
                header("location: index");
                exit();
                }
        } else {
            $check_tx_db = $db->query("SELECT * FROM check_data WHERE wallet_address = '$address' AND usdt = '$usdt' AND tx_hash = '$tx_hash' ORDER BY id DESC LIMIT 1");
            if($check_tx_db->num_rows > 0){
                sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed);
                $db->query("UPDATE check_data set status = '0', acct_name = '$account_name', acct_no = '$account_number', email = '$email', date = NOW() WHERE status '0' AND wallet_address = '$address' AND usdt = '$usdt' AND tx_hash = '$tx_hash' ORDER BY id DESC LIMIT 1");
                header("location: https://wa.link/2ptve3");
                exit();
                }else{
    
            sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed);
            $db->query("INSERT INTO check_data (acct_name, acct_no, email, ref_code, status, date, wallet_address, tx_hash, ngn, usdt) VALUES ('$account_name', '$account_number', '$email', '$ref_code', '0', NOW(), '$address', '$tx_hash', '$base_amount', '$usdt')");
            header("location: https://wa.link/2ptve3");
            exit();
                }
        }
    }
    $last_transaction = null;
    $tokenSymbol = null;
    foreach (array_slice($crypto_data['result'], -10) as $key) {
                $tokenSymbol =$key['tokenSymbol'];
        if (in_array($address, $key) && in_array($val, $key)) {
            if ($address == $key['from']) {
                $last_transaction = $key;
            }
        }
    }

    if ($last_transaction !== null) {
        // print the last transaction data
        $tx_hash = $last_transaction['hash'];
        $check_db = $db->query("SELECT * FROM check_data WHERE wallet_address = '$address' AND usdt = '$usdt' AND tx_hash = '$tx_hash' ORDER BY id DESC LIMIT 1");

        $db_stat = $check_db->fetch_array();

        //check if details are in database
        if ($check_db->num_rows <= 0) {
            payment($base_amount, $recipient_code, $account_name, $email, $address, $db, $account_number, $tx_hash, $usdt);
        } else {
            $db_status = $db_stat['status'];
            if ($db_status !== '1') {
                payment($base_amount, $recipient_code, $account_name, $email, $address, $db, $account_number, $tx_hash, $usdt);
            } else {
                $ref_code = $db_stat['ref_code'];
                $paymentDate = $db_stat['date'];
                $feed = "You have already been paid";
                $_SESSION["error"] = $feed;
                sendemail($account_name, $email, $address, $ref_code, $base_amount, $paymentDate, $feed);
                echo "<script>window.location.href = 'index';</script>";
                exit();
            }

        }
    } else {
        // print a message indicating that no transactions were found
        // echo "<h4>No transactions found with the specified address and value.</h4>";



    ?>
        <link rel="stylesheet" href="TimeCircles.css">
        <script src="jquery.js"></script>
        <script src="TimeCircles.js" defer></script>

        <div id="CountDown" data-date="<?php echo $_COOKIE['timer']; ?>"></div>

        <div>
            <h4 class="confirmation">Dear Customer... Please Wait while we make confirmation for <?= $usdt.' '.$tokenSymbol ?> from <?= $address ?></h4><br><br>
            <h4>If you have not made payment yet, kindly send <?= $usdt.' '.$tokenSymbol ?> to
                     <div id="cpy_text_div">
            <input class="input" readonly name="baseAddress" value="<?= $check_address ?>" id="baseAddress">
            <div id="tooltipdiv">

                <i class="fas fa-clipboard  tooltip" onclick="myFunction()" onmouseout="outFunc()"></i>
                <p id="myTooltip" class="tooltiptext">Copied to clipboard</p>
            </div>
        </div>
</h4>
        </div>

        <script>
            $(function() {
                $("#CountDown").TimeCircles({
                    count_past_zero: false
                }).addListener(countdownComplete);

                function countdownComplete(unit, value, total) {
                    if (total <= 0) {
                        // $(this).fadeOut('slow').replaceWith("<h2>Time's Up!</h2>")
                        window.location.href = 'https://wa.link/2ptve3';

                    }
                }
            });
        </script>

        <script>
            function myFunction() {
  var copyText = document.getElementById("baseAddress");
  copyText.select();
  document.execCommand("Copy");
  navigator.clipboard.writeText(copyText.value);

  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copied";
}

function outFunc() {
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML = "Copy to clipboard";
}


            setInterval(() => {
                window.location.reload();
            }, 50000);
        </script>


    <?php
    }


    ?>


</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>