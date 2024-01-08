<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "Неисправности";
include "head.html";

//Читаем устранённые замечания +++

$del_array =  file ("./neispr/log.csv");
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

echo "<table align = center border = 0>
<tr><td>";


for ($i=0; $i < $n; $i++)
{
echo "$massdel[$i]<br>";
};

echo "</td></tr></table>";
include"neispr_bot.html";
echo "</table></body></HTML>";

?>