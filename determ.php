<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";

//получаем дату  и данные
        $date1=$_POST["date3"];
        $spisok = $_POST["spisok"];
        $dir = "./data/$date1";

//формируем массив строк

$spisok = str_replace("\r\n","",$spisok);
$spisok = str_replace('\" ',"",$spisok);
$spisok = str_replace('\"',"",$spisok);
$spisok = str_replace('\""',"",$spisok);
$spisok = str_replace('\"""',"",$spisok);
$spisok = str_replace(";","|",$spisok);
$spisok = str_replace("\"ЭЧ-1","ЭЧ-1",$spisok);
$spisok = str_replace("По согл. ДНЦ ","",$spisok);
//$spisok = str_replace("Текущий ремонт контактной сети: ","",$spisok);
//$spisok = str_replace("Капитальный ремонт контактной сети: ","",$spisok);
$spisok = str_replace("\r","",$spisok);
$spisok = str_replace("\n","",$spisok);
$spisok = str_replace("\ \"","",$spisok);
$spisok = str_replace(" | ","|",$spisok);
$spisok = str_replace(" |","|",$spisok);
$spisok = str_replace("| ","|",$spisok);
$spisok = str_replace("  "," ",$spisok);
$spisok = str_replace("   "," ",$spisok);
//$spisok = str_replace("ОТМЕНАФакт:","|",$spisok);
//$spisok = str_replace("Факт:","",$spisok);
//$spisok = str_replace("План: 0","",$spisok);
//$spisok = str_replace("ОТМЕНА|","|ОТМЕНА|",$spisok);



// Создаём каталог
if (file_exists($dir)) {}
else {mkdir("./data/$date1");};

// разбиваем spisok по строкам

$str_exp = explode("p+", $spisok);

//print_r($str_exp);

//$str_exp[0] = stripcslashes($str_exp[0])
//echo "$str_exp[0]";

//записываем файлы окон

 for($i=0; $i < count($str_exp); $i++)
  {
                $name = explode("|", $str_exp[$i]);
                //        echo "$first<br>";
                if ($name[2] != "")
                {
                        srand((double) microtime()*1000000);
                        $random = rand();
                        echo ("$random<br>");
                        $name[2] = substr($name[2],0,15);
                        $filename = str_pad ($name[2],21,"_$random");
                        $file = fopen("./data/$date1/$filename.csv","w+");
                        if(!file)
                                {
                                  echo("Ошибка открытия файла");
                                }
                        fputs ( $file,"$str_exp[$i]");
                        //echo "$str_exp[$i]";
                        fclose ($file);
                };
        };
echo "OK!";
include "bot.html";
         ?>