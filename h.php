
<?php
include 'db.php';
$API_KEY = '9CMIRVTCY3A3VCVNFDH76KG46MENXIKVQ3';

$contractaddress = '0xe9e7cea3dedca5984780bafc599bd69add087d56';

$address = '0xfbC74D86fc320383D1Af240129aa762341AB00AC';

$BASE_CONVERT_RATE= 10**18;

$BASE_URL = 'https://api.bscscan.com/api';

// function get_balance($contractaddress, $address, $BASE_URL, $API_KEY, $BASE_CONVERT_RATE){

   $url = $BASE_URL."?module=account&action=tokentx&contractaddress=".$contractaddress."&address=".$address."&apikey=".$API_KEY;
    $value = 1.3;
    $val = intval($value * 10**18);
    $ad = '0x1df1c2388dd1445a6cd06304daf90d6ff58eebe3';
    $hash = '0x5c6607352482512635203f9d66fbb26ca44f68073313fae0a90b387575b4935f';
   $response = file_get_contents($url);
//    echo $response;
   $data = json_decode($response, true);
//    $r = end($data);
//    print_r($r);
    // echo '<pre>';
//     $get = file_get_contents('txt/all.txt');
// $done = explode(" ", $get);
// print_r($done);
// $arr = array( "p"=>"150", "p"=>"100", "p"=>"120", "p"=>"110", "p"=>"115");
// print_r($arr);
    foreach (array_slice($data['result'], -5) as $key){
            if (in_array($ad, $key) && in_array($val, $key)) {
                $w = array($key['hash']);
                $k = 'new_key';

                foreach ($w as &$ve) {
                    $ve = array($k => $ve);
                }
                
                // print_r($w);
                // $z = strval($w[0]['new_key'].' ');
                                                // $tx_hash = $key['hash'];
                // // $w = str_split($key['hash'], 66);
                // // print_r($key['hash']);
                // // $w = end($w).' ';
                // $_SESSION['tx'] = $z;
                // // print_r($z);
                // $wa = strrpos($w[0]['new_key'], ' 0x');
                // $w = substr($_SESSION['tx'], $wa + 1);
                // print_r($w);

                // $w = explode(" ", $w);
                // $values = array_values($w); 
                // $lastValue = end($w['0']);
                // $lastValue = $w[count($w)-1];
                // echo $lastValue;
                // $lastKey = array_key_last($a);
                // $lastValue = $a[$lastKey];
                // echo $lastValue;                
                // foreach (array_slice($a, -1) as $tx_hash){
                $check_db = $db->query("SELECT * FROM check_data WHERE wallet_address = '$ad' AND usdt = '$value' ORDER BY id DESC LIMIT 1");
                // $r = end($key);
                // echo '<br>'.$r;

                foreach($check_db as $tHash){
                // $db_stat = $check_db->fetch_array();
                // print_r($tHash['tx_hash'].' ');
                // function getLastValue()
                        $check_theHash = in_array($tHash['tx_hash'],$w);
                if ($check_theHash == false) {
                    $tHashus = $tHash['status'];
     
                    if ($tHashus == '1') {
                     $tx_hash = $key['hash'];
                     if($tx_hash !== $tHash['tx_hash']){
                        echo gettype($tx_hash);
                    print_r($tx_hash);
                    echo "<br>";
                     }else{
                        echo "bluuuu";
                     }
                   }else{
                    // $tx_hash = $key['hash'];
                    // print_r($tx_hash);
                    // echo "<br>";
                    }
                }else{
                    echo "blabuu";
                }
                break;
            }
            }
        }
    // }

    
    //    echo '</pre>'.$response;

                
                
                
                
                ?>

