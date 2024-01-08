<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//include "config.php";

//устанавливаем дату
if ($date==""){$date=$_POST["date"];}
if ($date==""){$date = date('d.m.Y');};
if ($date1 != ""){$date = $date1;};
// echo "! ---- $date --- !</br>";
include "date_functions.php";
// echo "! ---- $date --- !</br>";
$mesday = "$mes$day";
// echo "! ---- $mesday --- !</br>";

$titl = "АРМ планирование цеха";
$cehrus = ($_COOKIE[cehrus]);
$cehrus2=$_POST["cehrus"];

if($cehrus=="" or $cehrus2 !=""){
		$cehrus=$_POST["cehrus"];
		include "cehrename.php";
		setcookie("cehrus", "$cehrus", time() + 60000);
}else{
	$cehrus = ($_COOKIE[cehrus]);
	include "cehrename.php";
}
include "head.html";
// echo "cehrus = $cehrus - !";

//день недели
$dat_a = explode(".", "$date");
$dayweek = date(N, mktime(0,0,0,$dat_a[1],$dat_a[0],$dat_a[2]));
//echo "dayweek = $dayweek - !<br>";




//фдн формируем даты недели -------------------------------------
$dayw[$dayweek] = $date;
$dayj = $date;
$n=$dayweek-1;
$dayw[$n]=$dateold;
$n=$dayweek+1;
$dayw[$n]=$datenext;

for($n=0;$n<9;$n++){
	if($dayw[$n]==""){
		$y = $n - $dayweek;
		$dayw[$n]=strtotime($date)+ $y*86400;
		$dayw[$n]=date('d.m.Y',$dayw[$n]);
	}
	// echo "<br>!- $dayw[$n]";
}
//конец фдн -------------------------------------------------------







if ($ceh==""){
	echo"<h3>Выберите цех.</h3>";
}else{
	echo "<h3>ЦЕХ: $cehrus (РАЗДЕЛ В РАЗРАБОТКЕ)</h3><br>";
}


// *** - end получаем данные POST ---------------------------------------
















echo "</body></HTML>";

 ?>