<?php
include "head.html";
include "ip2.php";

//ini_set('display_errors',1);
//error_reporting(E_ALL);


         //получаем данные

$date1=$_POST['Date3'];
$redactf=$_POST['redactf'];

$data[0]=$_POST['echknum'];
$data[1]=$_POST['narnum'];
$data[12]=$_POST['raspnum'];
$data[2]=$_POST['proizvod'];

$data[3]=$_POST['time1'];
$data[4]=$_POST['time2'];
$data[5]=$_POST['time3'];
$data[6]=$_POST['time4'];

$data[7]=$_POST['peregon'];
$data[8]=$_POST['put1'];
$data[9]=$_POST['stanc'];
$data[10]=$_POST['put2'];
$data[13]=$_POST['uchastok'];

$data[11]=$_POST['work'];

for ($i=0; $i <= 13; $i++)
        {
                $data[i] = str_replace("\r\n","",$data[i]);
                $data[i] = str_replace("\r","",$data[i]);
                $data[i] = str_replace("\n","",$data[i]);
        };


srand((double) microtime()*1000000);
$random = rand();

//проверяем наличие каталога - если его нет - создаём
$dir = "./data/$date1";

if (file_exists($dir)) {
    echo "Каталог найден<br>";
} else {
    mkdir("./data/$date1-R");
         }

        //открываем файл
$dirf = "./data/$date1-R/$redactf";
$file = fopen("$dirf","w+");
  if(!$file)
  {
    echo("Ошибка создания файла!");
  };
  //укладываем данные
for ($i=0; $i <= 13; $i++)
{
fputs ( $file,"$data[$i]");fputs ( $file,"|");
};
        //закрываем файл
fclose ($file);
//chdir("..");
//chdir("..");

//вставляем кусок кода из otchet_2.php для отображения таблицы.

include "otchet_inc.php";
//---



echo "
</body></HTML>";
 ?>