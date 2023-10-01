<?php
include "db.php";
    $details = $db->query("SELECT * FROM check_data WHERE status = '1' ORDER BY id DESC LIMIT 7");
$usdt = "";
while ($det = $details->fetch_assoc()) {
        $usdt .= '
        <div class="rebox">
        <img src="usdt.svg" alt="usdt" class="recex"><p class="quant">'.$det['usdt'].'</p>
        <i class="fa fa-long-arrow-right"></i>
        <img src="naira.png" alt="naira" class="recex"><p class="quant">'.$det['ngn'].'</p>
        </div>
        ';
}
    echo $usdt;

?>
