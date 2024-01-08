<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
	//1. запрос и проверка куки - если есть сохраняем эч и цех

	include "ipv.php";

	if ($ech=="" or $di==""){
		include "ip.php";
	}
	if ($ech=="" or $di==""){
		include "login.html";
		exit;
	}
//проверяем наличие файла  tuduech3.csv

$dirf = "./tudu/tudu$di$ech.csv";
        if (file_exists($dirf)) {
  //  echo "Файл найден<br>";
} else {
    echo "Файл потерян!<br>";
        exit;
         };
// время создания файла

$stat=stat("$dirf");
$data_mod=date("H:i d F 20y ", $stat[9]);

//разбиваем файл в массив по строкам
$file_array =  file ("./tudu/tudu$di$ech.csv");
$n=0;
  if(!$file_array)
  {
    echo("Ошибка открытия файла readtudu!");
  }
  else
  {
    for($i=0; $i < count($file_array); $i++)
    {
          $massiv[$n] = $file_array[$i];
//        echo "$massiv[$n]<br>";
        $n++;
        }
        };


?>