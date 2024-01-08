<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";
include "neispr_read.php";
//        echo "$massiv[$n]<br>";
//echo "!---$n---!<br>";
//получаем данные

$i=$_POST['i'];
$mas[0]=$_POST['stanc'];
$mas[1]=$_POST['obekt'];
$mas[2]=$_POST['neispr'];
$mas[3]=$_POST['date1'];
$mas[4]=$_POST['date2'];
$mas[5]=$_POST['otv'];
$slujba=$_POST['slujba'];

if ($slujba=="on")
{$mas[6]="bgcolor=yellow";};

//пишем лог-файл_изменение строки 1
$log =  fopen ("./neispr/log.csv","a");
if(!$log)
  {
    echo("Ошибка открытия файла log.csv при добавлении записи!");
  }
$datetime = date("d.m.Y Время H:i:s Внесено изменение в запись неисправности");
fputs ($log, "---!---\n");
fputs ($log, $datetime);fputs ($log, "\n$ip");fputs ($log, "\n$massiv[$i]");

$massiv[$i]="$mas[0]|$mas[1]|$mas[2]|$mas[3]|$mas[4]|$mas[5]|$mas[6]|";
$massiv[$i] = str_replace("\r\n","",$massiv[$i]);
$massiv[$i] = str_replace("\n","",$massiv[$i]);


$file =  fopen ("$dirf","w+");

for ($x=0; $x <=$n ; $x++)
{
//echo "$massiv[$x]<br>";
$massiv[$x] = str_replace("\r\n","",$massiv[$x]);
$massiv[$x] = str_replace("\n","",$massiv[$x]);
fputs ($file,"$massiv[$x]");
if ($x<$n){
fputs ( $file,"\n");
}
};

fclose ($file);

//пишем лог-файл_изменение строки 2
fputs ($log, "после изменения:\n$massiv[$i]\n");
fclose ($log);
include "neispr.php";

?>