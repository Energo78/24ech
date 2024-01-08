<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "бейрнп-32";
include "head.html";
include "config.php";
$file = file_get_contents ("http://10.43.161.235/index.php");
echo "$file"
?>