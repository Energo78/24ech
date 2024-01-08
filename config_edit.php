<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
include "head.html";
include "config.php";


$config[3]=$_POST['proizvoditeli'];
$config[4]=$_POST['peregons'];
$config[5]=$_POST['kontr_punct'];
$config[6]=$_POST['stancii'];
$config[7]=$_POST['ceha'];

$file =  fopen ("./config$ech.csv","w+");
for ($i=0; $i <= count($config); $i++)
        {
                fputs ($file,"$config[$i]");
                echo "$config[$i]<br>";
        };

        fclose ($file);

echo "ok!";




?>