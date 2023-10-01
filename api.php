<?php

$API_KEY = '9CMIRVTCY3A3VCVNFDH76KG46MENXIKVQ3';

$contractaddress = '0xe9e7cea3dedca5984780bafc599bd69add087d56';

$address = '0xfbC74D86fc320383D1Af240129aa762341AB00AC';

$BASE_CONVERT_RATE= 10**18;

$BASE_URL = 'https://api.bscscan.com/api';

// function get_balance($contractaddress, $address, $BASE_URL, $API_KEY, $BASE_CONVERT_RATE){

   $url = $BASE_URL."?module=account&action=tokentx&contractaddress=".$contractaddress."&address=".$address."&apikey=".$API_KEY;


   $response = file_get_contents($url);

   $data = json_decode($response, true);
   // $response = $data->fetch_array();

   $last_data = (end($data["result"])); 

   print_r(($last_data["value"]). "<br>"); 
   
    foreach ($data['result'] as $key){
   
    $int = $key['value'];
    
   
    $base = $int / $BASE_CONVERT_RATE;
    echo $base. "<br>";
    $base = $base;
      // $base = "102 USD";
    }
   
    echo $base;

// get_balance($contractaddress, $address, $BASE_URL, $API_KEY, $BASE_CONVERT_RATE);
   ?>


<script>
   const base = "<?php echo $base?>";
   const formData = new FormData()
   
   formData.append('base', base);
              fetch("totxts/main.php", {
              method: "POST",
              body: formData,
            }).then(() => {
              console.log(formData);
            });
</script>