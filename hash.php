<?php
include "db.php";
$API_KEY = '9CMIRVTCY3A3VCVNFDH76KG46MENXIKVQ3';

$contractaddress = '0xe9e7cea3dedca5984780bafc599bd69add087d56';

$address = '0xfbC74D86fc320383D1Af240129aa762341AB00AC';

$BASE_CONVERT_RATE= 10**18;

$BASE_URL = 'https://api.bscscan.com/api';

// function get_balance($contractaddress, $address, $BASE_URL, $API_KEY, $BASE_CONVERT_RATE){

$url = $BASE_URL."?module=account&action=tokentx&contractaddress=".$contractaddress."&address=".$address."&apikey=".$API_KEY;

$val = 1.3;
$val = intval($val * 10**18);
$ad = '0x1df1c2388dd1445a6cd06304daf90d6ff58eebe3';
$response = file_get_contents($url);
$data = json_decode($response, true);
// echo $response;
$tx_hash = '0x5c6607352482512635203f9d66fbb26ca44f68073313fae0a90b387575b4935f';
$last_transaction = null;
foreach (array_slice($data['result'], -5) as $key) {
    if (in_array($ad, $key) && in_array($val, $key)) {
        if ($ad == $key['from']) {
          echo $key['tokenSymbol'];
            $last_transaction = $key;
        }
    }
}

if ($last_transaction !== null) {
    // print the last transaction data
    // var_dump($last_transaction);
    print_r($last_transaction['hash']);
} else {
    // print a message indicating that no transactions were found
    echo "No transactions found with the specified address and value.";
}
$details = $db->query("SELECT * FROM check_data WHERE id = '2' LIMIT 1");
$details_stat = $details->fetch_array();

$address = $details_stat['wallet_address'];
$contractaddress =  $details_stat['tx_hash'];


?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
            if(navigator.online){
swal({
  title: "Offline!",
  text: "Your network is lost!",
  icon: "warning",
});
}
    window.addEventListener('online', (e) => {
swal({
  title: "Back Online!",
  text: "Your network is restored!",
  icon: "success",
});
    
});
    
    window.addEventListener('offline', (e) => {
swal({
  title: "Offline!",
  text: "Your network is lost!",
  icon: "warning",
});
    vibratePattern();
});

        </script>