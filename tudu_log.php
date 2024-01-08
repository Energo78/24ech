<?php
$titl = "Замечания ТУ-ДУ";
include "head.html";

//Читаем устранённые замечания +++

$del_array =  file ("./tudu/log.csv");
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
echo "</table>
<table align = center border = 0>
<tr><td><br>
<a class='red goodbutton' href=tudu_dobav.html>Добавить замечание ТУ-ДУ</a>
</td><td><br>
<a class='red goodbutton' href=tudu_delete.php>Замечания Удалённые из списка</a>
</td><td><br>
<a class='red goodbutton' href=tudu_log.php>Смотреть историю</a>
</td></tr>";
echo "</table></body></HTML>";

?>