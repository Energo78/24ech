<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Отчёт";
if($menuis!=1){
	include "head.html";
}
include "config.php";
$pr = $_POST["Dateold"];
// echo "pr = $pr <br>";
if ($pr != ""){
	$date1=$_POST["Dateold"];
};

        //получаем дату
        // if ($date1=="")
        // {
            
			// $date=$_POST["Date"];
			// $year = substr ("$date", 6, 4);
			// $mes = substr ("$date", 3, 2);
			// $day = substr ("$date", 0, 2);
			// $mesday = "$mes$day";
        // };
        if ($date1==""){
                echo "ВЫ НЕ ВЫБРАЛИ ДАТУ!";
                exit;
        };
        //--------------------
        // $dir = "./data/$date1";

		include "otchet_inc.php";
echo "</table></body></HTML>";
 ?>