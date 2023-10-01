<?php
include "db.php";
    $details = $db->query("SELECT * FROM check_data WHERE status = '1' ORDER BY id DESC LIMIT 7");
$details_stat = $details->fetch_array();
$ngn = "";
while ($det = $details->fetch_assoc()) {
    $ngn .= '<img src="naira.png" alt="naira" class="recex"><p class="quant" id="ngntx">'.$det['ngn'].'</p>';
}
echo $ngn;
?>
