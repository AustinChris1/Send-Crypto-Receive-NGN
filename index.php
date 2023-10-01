<?php
session_start();
include "db.php";
include "message.php";


if (isset($_POST['account_number'])) {
    $account_number = $_POST['account_number'];
    return $account_number;
};

if (isset($_POST['bank_code'])) {
    $bank_code = $_POST['bank_code'];
    return $bank_code;
};
if (isset($_POST['usdt'])) {
    $usdt = $_POST['usdt'];
    return $usdt;
};


if (isset($_POST['submit'])) {




    //check email validation
    if (empty($_POST['account_number'])) {
        echo 'no acct number input <br/>';
    } else {
        $account_number = $_POST['account_number'];
    }
    if (empty($_POST['bank_code'])) {
        echo 'no bank code input <br/>';
    } else {
        $account_name = $_POST['account_name'];
    }

    if (empty($_POST['usdt'])) {
        echo 'no input for usdt amount <br/>';
    } else {
        $usdt = $_POST['usdt'];
    }
} //end of POST check

$echo_price = file_get_contents('txt/file.txt');




$usdt_rate = $echo_price;
$_SESSION['rate'] = $usdt_rate;

$now = date("Y-m-d H:i:s");
$count_date = date('Y-m-d H:i:s', strtotime($now . '+ 10 minutes'));

function setTimeCookie($count_date)
{
    setcookie("timer", $count_date, time() + 60 * 20, "/");
}


$details = $db->query("SELECT * FROM check_data WHERE id = '2' LIMIT 1");
$details_stat = $details->fetch_array();

$address = $details_stat['wallet_address'];

$_SESSION["warning"] = "Please do not send funds from a Centralized Exchange (Binance, Kucoin).";

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script defer>
    const confirmBtn = document.getElementById("confirm")
    confirmBtn.addEventListener('click', () => {
        <?php setTimeCookie($count_date); ?>
    })
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transact</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <h1 class="exch">Our Exchange Rate is:</h1>
    <div class="price_div">
        <h1 id="stockprice">---</h1>
    </div>
    <form action="awaiting" method="POST" id="form">
        <img src="https://i.ibb.co/Q70WgX4/mk-main1-modified.png">
        <div class="exboxbox">
            <div class="exbox">
                <img src="usdt.svg" alt="usdt" class="exchange"><img src="bnb.svg" alt="usdt" class="exsmall">
                <span class="write">YOU SEND</span>
                <span class="writeb"><strong>USDT [BEP-20]</strong></span>
            </div>
            <i class="fa fa-long-arrow-right"></i>
            <div class="exbox">
                <img src="naira.png" alt="naira" class="exchange">
                <span class="write">YOU RECEIVE</span>
                <span class="writeb"><strong>NGN</strong></span>

            </div>
        </div>
        <div class="exxbox">
            <input type="number" placeholder="YOU SEND" id="usdt" name="usdt" step="0.01" autocomplete="off" class="inputt" required>
            <i>=</i>
            <input type="number" placeholder="YOU RECEIVE" id="ngn" step="0.01" autocomplete="off" class="inputt">

        </div>
        <input type="email" placeholder="Input Email Address" name="email" id="email" required class="input">
        <select name="bank_code" id="bank_code" class="input" required>
            <option value="">Select Bank</option>
            <option value="120001">9mobile 9Payment Service Bank</option>
            <option value="801">Abbey Mortgage Bank</option>
            <option value="51204">Above Only MFB</option>
            <option value="51312">Abulesoro MFB</option>
            <option value="044">Access Bank</option>
            <option value="063">Access Bank (Diamond)</option>
            <option value="602">Accion Microfinance Bank</option>
            <option value="50036">Ahmadu Bello University Microfinance Bank</option>
            <option value="120004">Airtel Smartcash PSB</option>
            <option value="">Airtel Smartcash PSB</option>
            <option value="035A">ALAT by WEMA</option>
            <option value="50926">Amju Unique MFB</option>
            <option value="50083">Aramoko MFB</option>
            <option value="401">ASO Savings and Loans</option>
            <option value="MFB50094">Astrapolaris MFB LTD</option>
            <option value="51229">Bainescredit MFB</option>
            <option value="50931">Bowen Microfinance Bank</option>
            <option value="565">Carbon</option>
            <option value="50823">CEMCS Microfinance Bank</option>
            <option value="50171">Chanelle Microfinance Bank Limited</option>
            <option value="023">Citibank Nigeria</option>
            <option value="50204">Corestep MFB</option>
            <option value="559">Coronation Merchant Bank</option>
            <option value="51297">Crescent MFB</option>
            <option value="50162">Dot Microfinance Bank</option>
            <option value="050">Ecobank Nigeria</option>
            <option value="50263">Ekimogun MFB</option>
            <option value="098">Ekondo Microfinance Bank</option>
            <option value="50126">Eyowo</option>
            <option value="51318">Fairmoney Microfinance Bank</option>
            <option value="070">Fidelity Bank</option>
            <option value="51314">Firmus MFB</option>
            <option value="011">First Bank of Nigeria</option>
            <option value="214">First City Monument Bank</option>
            <option value="501">FSDH Merchant Bank Limited</option>
            <option value="812">Gateway Mortgage Bank LTD</option>
            <option value="00103">Globus Bank</option>
            <option value="100022">GoMoney</option>
            <option value="50739">Goodnews Microfinance Bank</option>
            <option value="562">Greenwich Merchant Bank</option>
            <option value="058">Guaranty Trust Bank</option>
            <option value="51251">Hackman Microfinance Bank</option>
            <option value="50383">Hasal Microfinance Bank</option>
            <option value="030">Heritage Bank</option>
            <option value="120002">HopePSB</option>
            <option value="51244">Ibile Microfinance Bank</option>
            <option value="50439">Ikoyi Osun MFB</option>
            <option value="50442">Ilaro Poly Microfinance Bank</option>
            <option value="50457">Infinity MFB</option>
            <option value="301">Jaiz Bank</option>
            <option value="50502">Kadpoly MFB</option>
            <option value="082">Keystone Bank</option>
            <option value="50200">Kredi Money MFB LTD</option>
            <option value="50211">Kuda Microfinance Bank</option>
            <option value="90052">Lagos Building Investment Company Plc.</option>
            <option value="50549">Links MFB</option>
            <option value="031">Living Trust Mortgage Bank</option>
            <option value="303">Lotus Bank</option>
            <option value="50563">Mayfair MFB</option>
            <option value="50304">Mint MFB</option>
            <option value="120003">MTN Momo PSB</option>
            <option value="100002">Paga</option>
            <option value="999991">PalmPay</option>
            <option value="104">Parallex Bank</option>
            <option value="311">Parkway - ReadyCash</option>
            <option value="999992">Paycom</option>
            <option value="50746">Petra Mircofinance Bank Plc</option>
            <option value="076">Polaris Bank</option>
            <option value="50864">Polyunwana MFB</option>
            <option value="105">PremiumTrust Bank</option>
            <option value="101">Providus Bank</option>
            <option value="51293">QuickFund MFB</option>
            <option value="502">Rand Merchant Bank</option>
            <option value="90067">Refuge Mortgage Bank</option>
            <option value="125">Rubies MFB</option>
            <option value="51113">Safe Haven MFB</option>
            <option value="951113">Safe Haven Microfinance Bank Limited</option>
            <option value="50582">Shield MFB</option>
            <option value="50800">Solid Rock MFB</option>
            <option value="51310">Sparkle Microfinance Bank</option>
            <option value="221">Stanbic IBTC Bank</option>
            <option value="068">Standard Chartered Bank</option>
            <option value="51253">Stellas MFB</option>
            <option value="232">Sterling Bank</option>
            <option value="100">Suntrust Bank</option>
            <option value="50968">Supreme MFB</option>
            <option value="302">TAJ Bank</option>
            <option value="090560">Tanadi Microfinance Bank</option>
            <option value="51269">Tangerine Money</option>
            <option value="51211">TCF MFB</option>
            <option value="102">Titan Bank</option>
            <option value="100039">Titan Paystack</option>
            <option value="MFB51322">Uhuru MFB</option>
            <option value="50870">Unaab Microfinance Bank Limited</option>
            <option value="50871">Unical MFB</option>
            <option value="51316">Unilag Microfinance Bank</option>
            <option value="032">Union Bank of Nigeria</option>
            <option value="033">United Bank For Africa</option>
            <option value="215">Unity Bank</option>
            <option value="566">VFD Microfinance Bank Limited</option>
            <option value="035">Wema Bank</option>
            <option value="057">Zenith Bank</option>
        </select>
        <input type="number" placeholder="Input Account Number" name="account_number" id="account_number" autocomplete="off" required minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="input">
        <input class="input" placeholder="Account Name" readonly required name="account_name" id="bank_details">
        <div id="cpy_text_div">
            <input class="input" readonly name="baseAddress" value="<?= $address ?>" id="baseAddress">
            <div id="tooltipdiv">

                <i class="fas fa-clipboard  tooltip" onclick="myFunction()" onmouseout="outFunc()"></i>
                <p id="myTooltip" class="tooltiptext">Copied to clipboard</p>
            </div>
        </div>
        <input type="text" placeholder="Input Wallet address" name="address" id="address" required class="input">
        <input type="submit" class="button" name="submit" id="confirm" value="Transact">

    </form>

        <p class="r">Recent Transactions</p>
    <div class="recent" id="usdtx">
    </div>
    <script>
        let ws = new WebSocket('wss://stream.binance.com:9443/ws/usdtngn@trade')
        let stockPrice = document.getElementById('stockprice')
        let lastPrice = null


        ws.onmessage = (event) => {
            let stockObject = JSON.parse(event.data)
            let price = parseFloat(stockObject.p).toFixed(4)
            price = (price - 10).toFixed(2)
            stockPrice.innerText = price

            stockPrice.style.color = !lastPrice || lastPrice === price ? 'black' : price > lastPrice ? 'green' : 'red'
            lastPrice = price

            var formdata = new FormData();
            formdata.append("price", price);
            fetch("toTxts/price.php", {
                method: 'POST',
                body: formdata,

            }).then(() => {})

        }
    </script>
    <script>
        var formdata = new FormData();
        formdata.append("empty", '');
        fetch("write_to_zero.php", {
            method: 'POST',
            body: formdata,

        }).then(() => {})
    </script>
    <script src="sendToCheck.js"></script>
    <script src="verify_account_number.js"></script>
    <script src="price.js"></script>
    <script src="recent.js"></script>

</body>

</html>