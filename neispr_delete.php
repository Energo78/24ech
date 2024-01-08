<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "Неисправности оборудования";
include "head.html";
include"neispr_bot.html";
//Читаем устранённые замечания +++

$del_array =  file ("./neispr/delete$di$ech.csv");
$n=0;
  if(!$del_array)
  {
    echo("Ошибка открытия файла");
  }
  else
  {
    for($i=0; $i < count($del_array); $i++)
    {
          $massdel[$n] = $del_array[$i];
        $n++;
        }
        };

//Читаем устранённые замечания ===

//выводим таблицу УСТРАНЁННЫХ неисправностей +++

 // шапка таблицы:
 echo "<br><table align = center border = 0>
 <p align=center><i><b><font color=#0000FF size=4><span lang=ru>Устранённые Неисправности оборудования </span></font></b></i></p></table>
 <table align = center border = 1>
 <tr><td>Дата и время удаления</td><td>Кто удалил</td><td>Место</td><td>Объект</td><td>Неисправность</td><td>Дата начала</td><td>Дата устранения</td><td>Ответственные</td></tr>";

for ($i=0; $i < $n; $i++)
{

$str_exp = explode("|", $massdel[$i]);

//if ($str_exp[6]="z") {$bgc = "bgcolor=green";};

echo "<tr><td $str_exp[8]>$str_exp[0]</td><td $str_exp[8]>$str_exp[1]</td><td $str_exp[8]>$str_exp[2]</td><td $str_exp[8]>$str_exp[3]</td><td $str_exp[8]>$str_exp[4]</td><td $str_exp[8]>$str_exp[5]</td><td $str_exp[8]>$str_exp[6]</td><td $str_exp[8]>$str_exp[7]</td></tr>";

};
//выводим таблицу УСТРАНЁННЫХ неисправностей ===

include"neispr_bot.html";

?>