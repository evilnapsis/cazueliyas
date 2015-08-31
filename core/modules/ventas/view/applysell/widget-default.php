<?php

$sell = Selldata::getById($_GET["id"]);
$sell->cajero_id = Session::getUID();
$sell->apply();
// print_r($sell);

header("Location: index.php?view=onesell&id=$_GET[id]");

?>