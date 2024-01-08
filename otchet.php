<?php
echo "<html><head><title>-=ЭЧЦ=-</title>
  </head>
    <TABLE ALIGN=CENTER>";
//ini_set('display_errors',1);
//error_reporting(E_ALL);
         //получаем дату
         $date1=$_POST["Date"];
         $date2=$_POST["Date2"];
        // echo "$date1+$date2<br>";


         //получаем данные номера ЭЧК и типов работ
         $n=1;
         while (++$n<=33)
         {
//         echo "$n<br>";
         $box[$n]=$_POST["box$n"];
//         echo "$box[$n]<br>";
         };

         //--------------------


//получаем список папок каталога (data)
$n=0;
$csv = ".csv";
$n2=0;
$dir = opendir ("./data/");
  while ( $file = readdir ($dir))
  {
    if (( $file != ".") && ($file != ".."))
    {

         $dirs[] = $file;
                echo "$dirs[$n]<br>";
                $dir2 = opendir ("./data/$file");

                while ( $file2 = readdir ($dir2))
  {
    if (( $file2 != ".") && ($file2 != ".."))
    {
      $files[$n2] = $file2;
          echo "$file2<br>file2<br>";
          $n2 = $n2 + 1;
          echo "$n2<br>";
    }
  }
  closedir ($dir2);


          $n=$n+1;
    }
  }
  closedir ($dir);
  echo "$n<br>";
  echo "$n2<br> Перечислим файлы:<br>";
  $n3=$n2;
  $n2=0;
 while ($n2<=$n3)
  {
                echo "$files[$n2]<br>";
                $n2 = $n2 + 1;
 };







echo "</body></HTML>";
 ?>