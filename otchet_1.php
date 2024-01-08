<?php
include "head.html";

//ini_set('display_errors',1);
//error_reporting(E_ALL);
         //получаем дату
         $date1=$_POST["Date2"];
        // echo "$date1+$date2<br>";
        //--------------------
        $break = 0;
        $dir = "./data/$date1";
        if (file_exists($dir)) {
    echo "Каталог найден<br>Отчёт о произведённой работе ЭЧК за $date1:<br><br>";
} else {
    echo "В ЭТОТ ДЕНЬ РАБОТЫ НЕ ПРОИЗВОДИЛИСЬ<br><br><br>";
        include "index.html";
        exit;
         }


//получаем список папок каталога (data)
$n=0;
$dir = opendir ("./data/$date1");
  while ( $file = readdir ($dir))
  {
    if (( $file != ".") && ($file != ".."))
    {

        $dirs[] = $file;
//        echo "$dirs[$n]<br>";


        $n=$n+1;
  }
  };
        closedir ($dir);
        // возвращаем число файлов
//  echo "$n<br>";
        $n2=$n-1;
        $n=0;

        chdir("./data/$date1");
/*        while ($n<=$n2)
{

        $file2 = fopen("$dirs[$n]","r");
      $buff = fgets ($file2,5000);
      print $buff;
          echo "<br>";
    fclose ($file2);
        $n = $n + 1;
};
*/
// считываем содержимое файлов в массив
$n=0;
$y=0;
while ($n<=$n2)
{
$file_array = file("$dirs[$n]");
  if(!$file_array)
  {
    echo("Ошибка открытия файла");
  }
  else
  {
    for($i=0; $i < count($file_array); $i++)
    {
 //     printf("%s<br>", $file_array[$i]);

    }
        $n = $n + 1;
  };
  $str_imp[$y] = implode(" ", $file_array);
 //  echo($str_imp[$y]);
  // echo "<br>";
$y = $y + 1;
  };
 // echo ($y);

chdir ("..");
// имеем - $y-окон, $str_imp[$y] - строчек

//создаём таблицу с данными окон
echo "<table align=center border=1>
<tr align=center>
        <td>
            ЭЧК№
        </td>
        <td>
            Наряд№
        </td>
        <td>
            Производитель
        </td>
        <td>
            Время
        </td>
                <td>
            Место работы
        </td>
        <td>
           Произведённая Работа
        </td>
    </tr>
";
//echo "";
//цикл строк в таблице равный $y
$alltime = 0;
settype($alltime,integer);
$n=1;
        while ($n<=$y)
{

        echo "<tr>";
                $str_exp = explode("|", $str_imp[$n-1]);
//подсчитаем время окна:
        $hour1 = $str_exp[4];
        $min1 = $str_exp[5];
        $hour2 = $str_exp[6];
        $min2 = $str_exp[7];
        settype($hour1,integer);// echo "$hour1 <br>";
        settype($min1,integer);// echo "$min1 <br>";
        settype($hour2,integer); //echo "$hour2 <br>";
        settype($min2,integer); //echo "$min2 <br>";
        $time = (($hour2 + ($min2/60)) - ($hour1 + ($min1/60)));
        $time = round ($time * 100);
        $time =($time / 100);
        $alltime = $alltime + $time;

        $raspnum = "Расп.№ $str_exp[19]";
        if ($str_exp[19] == "")
        {$raspnum = "";};

        $uchastok = "участок:<br>$str_exp[20]";
        if ($str_exp[20] == "")
        {$uchastok = "";};


        //echo "$time <br>";

                         echo "<td>$str_exp[1]</td><td>$str_exp[2]$raspnum</td>
                         <td>$str_exp[3]</td><td>$time</td><td>$str_exp[8]<br>путь№ $str_exp[9]<br>$str_exp[10]<br>путь№ $str_exp[11]<br>$uchastok</td><td>$str_exp[12]</td>";



        echo "</td></tr>";
        $n=$n+1;

};




echo "</table>";
$srtime = $alltime / $y;
echo "всего $y работ на $alltime часов.<br>средняя продолжительность работы $srtime часа.";
echo "</body></HTML>";
 ?>