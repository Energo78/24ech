<?php
include "head.html";

//ini_set('display_errors',1);
//error_reporting(E_ALL);
         //получаем данные


$date=$_POST['Date3'];
$date1=$date;
$date = "$date-R";
$echknum=$_POST['echknum'];
$narnum=$_POST['narnum'];
$raspnum=$_POST['raspnum'];
$proizvod=$_POST['proizvod'];
$time1=$_POST['time1'];
$time2=$_POST['time2'];
$time3=$_POST['time3'];
$time4=$_POST['time4'];
$peregon=$_POST['peregon'];
$put1=$_POST['put1'];
$stanc=$_POST['stanc'];
$put2=$_POST['put2'];
$uchastok=$_POST['uchastok'];

$work=$_POST['work'];

$work = str_replace("\r\n","",$work);

srand((double) microtime()*1000000);
$random = rand();

$dir = "./data/$date";
$dirf = "./data/$date/$echknum-$random.csv";

if (file_exists($dir)) {
    echo "Каталог найден<br>";
} else {
    mkdir("./data/$date");
         }

if (file_exists($dirf)) {
    echo "Такой наряд уже введён в базу данных, для редактирования воспользуйтесь формой ОТЧЁТЫ";
} else {
chdir("./data/$date");
        $file = fopen("$echknum-$random.csv","a+");
    if(!file)
    {
      echo("Ошибка открытия файла");
    }
fputs ( $file,"$echknum");fputs ( $file,"|");
fputs ( $file,"$narnum");fputs ( $file,"|");
fputs ( $file,"$proizvod");fputs ( $file,"|");
fputs ( $file,"$time1");fputs ( $file,"|");
fputs ( $file,"$time2");fputs ( $file,"|");
fputs ( $file,"$time3");fputs ( $file,"|");
fputs ( $file,"$time4");fputs ( $file,"|");
fputs ( $file,"$peregon");fputs ( $file,"|");
fputs ( $file,"$put1");fputs ( $file,"|");
fputs ( $file,"$stanc");fputs ( $file,"|");
fputs ( $file,"$put2");fputs ( $file,"|");
fputs ( $file,"$work");fputs ( $file,"|");
fputs ( $file,"$raspnum");fputs ( $file,"|");
fputs ( $file,"$uchastok");fputs ( $file,"|");

  fclose ($file);
  chdir("..");
echo "<table align=center><TR>
          <TD><FONT COLOR=red>Информация успешно записана в базу данных.</FONT></TD>
                  <td><form action='otchet_2.php' method=post>
                  <INPUT TYPE=hidden NAME='Date' VALUE='$date1'>
                  <INPUT TYPE=submit NAME=button1 VALUE=OK!> </form></td>
      </TR></TABLE><br>
          <table align=center>
        <tr align=center>
  ";
}

//include "otchet_2.php?Date=$date1";


echo "
</TR>
</table>
</body></HTML>";
 ?>