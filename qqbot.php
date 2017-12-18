<?php
$get = $_GET['c'];
$a = file_get_contents('http://127.0.0.1:8188/'.($get));
var_dump($a);
?>
