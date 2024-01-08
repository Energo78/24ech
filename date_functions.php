<?php
//get string $date
if ($date==""){
	$date = date('d.m.Y');
};
$year = substr ("$date", 6, 4);
$mes = substr ("$date", 3, 2);
$day = substr ("$date", 0, 2);

settype ($day, integer);
$dayold = $day - 1;
if ($dayold==0){
	if($mes=="02" or $mes=="04" or $mes=="06" or $mes=="08" or $mes=="09" or $mes=="11") {
		$dayold = 31;
		if ($mes=="02"){$mesold="01";}
		if ($mes=="04"){$mesold="03";}
		if ($mes=="06"){$mesold="05";}
		if ($mes=="08"){$mesold="07";}
		if ($mes=="09"){$mesold="08";}
		if ($mes=="11"){$mesold="10";}
	}elseif($mes=="03"){
		$dayold = 29; $mesold = "02";
	}else{
		$dayold = 30;
		if ($mes=="12"){$mesold="11";}
		if ($mes=="10"){$mesold="09";}
		if ($mes=="07"){$mesold="06";}
		if ($mes=="05"){$mesold="04";}
		if ($mes=="01"){$mesold="12";}
	}
}
if ($mesold ==""){
	$mesold = $mes;
}
$dayold = str_pad($dayold, 2, "0", STR_PAD_LEFT);
$dateold = "$dayold.$mesold.$year";

$daynext = $day + 1;
if ($daynext==32){
	$daynext=1;
	if ($mes=="12"){$mesnext="01";}
	if ($mes=="10"){$mesnext="11";}
	if ($mes=="08"){$mesnext="09";}
	if ($mes=="07"){$mesnext="08";}
	if ($mes=="05"){$mesnext="06";}
	if ($mes=="03"){$mesnext="04";}
	if ($mes=="01"){$mesnext="02";}
}
if($mes=="04" or $mes=="06" or $mes=="09" or $mes=="11") {
	if ($day==31){
		$daynext=1;
		if ($mes=="04"){$mesnext="05";}
		if ($mes=="06"){$mesnext="07";}
		if ($mes=="09"){$mesnext="10";}
		if ($mes=="11"){$mesnext="12";}
	}
}
if ($day==30 and $mes=="02"){
	$daynext=01;
	$mesnext="03";
}
if ($mesnext ==""){
	$mesnext = $mes;
}
$daynext = str_pad($daynext, 2, "0", STR_PAD_LEFT);
$datenext = "$daynext.$mesnext.$year";
$day = str_pad($day, 2, "0", STR_PAD_LEFT);
$mesday = "$mes$day";






//корректировка по новому

$datenext_tmp = strtotime($date) + 86400;
$datenext = date('d.m.Y', $datenext_tmp);

$dateold_tmp = strtotime($date) - 86400;
$dateold = date('d.m.Y', $dateold_tmp);

?>