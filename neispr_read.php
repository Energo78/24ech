<?php

//проверяем наличие файла  neispr$di$ech.csv
if($menuis!=1){
	include "head.html";
}
$dirf = "./neispr/neispr$di$ech.csv";
// echo "! ---------- > $dirf";
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

$file_array =  file ("./neispr/neispr$di$ech.csv");
$n=0;

// echo "<br>-- ./neispr/neispr$di$ech.csv --";

  if(!$file_array)
  {
    echo("Ошибка открытия файла");
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