<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";

//получаем дату
         $date1=$_POST["Date2"];
         if ($date1=="")
        {
        echo "ВЫ НЕ ВЫБРАЛИ ДАТУ!";
        exit;
        };
        //--------------------

        $dir = "./data/$date1";
//++++++++++++++++++++++++++++++++ получаем данные:
$n=0;
$dir = opendir ("./data/$date1");
  while ( $file = readdir ($dir))
  {
    if (( $file != ".") && ($file != ".."))
    {

        $fils[] = $file;
        $n=$n+1;
  }
  };
        closedir ($dir);
        $n2=$n-1;
        //$n=0;
// +++++++++++++++++++++ массив $fils[]  - названия файлов с окнами
        sort ($fils);

        // разбиваем
        for($i=0; $i < count($fils); $i++)
        {
$file = fopen("./data/$date1/$fils[$i]","r");
  if(!file)
    {
      echo("Ошибка открытия файла");
    }
                $strip[$i] = fgets ($file);

 fclose ($file);
 };


 //СОРТИРОВКА ПО ЭЧК  $tok - ЗДЕСЬ НОМЕР ЭЧК

for ($i=0; $i < $n; $i++)
{
        $tok = strtok ($strip[$i],"|");
        $tok2 = $strip[$i];
        $strip2[$i][$tok] = $strip[$i];
//        echo ($strip2[$i][$tok]);
        //echo "<br>";
};
 //++++++++++++++++++++++!!!!!!!!!!!!!!!

 echo "<table align=center border=1>
<tr align=left><td></td>
        <td>$date1 предоставить ЭЧ-3 запланированные  «окна» со снятием напряжения с контактной сети:<br><br>";

 //++++++++++++++++++++++ВЫВОДИМ ДАННЫЕ:

 for ($p=8; $p <= 31; $p++)
{
if ($p==8){$dsp = "Любим";};
if ($p==9){$dsp = "Буй";};
if ($p==10){$dsp = "Галич";};
if ($p==11){$dsp = "Антропово";};
if ($p==12){$dsp = "Нея";};
if ($p==13){$dsp = "Мантурово";};
if ($p==14){$dsp = "Шарья";};
if ($p==15){$dsp = "Поназырево";};
if ($p==16){$dsp = "Шабалино";};
if ($p==30){$dsp = "Свеча";};
if ($p==31){$dsp = "Вохтога";};


 for($i=0; $i < count($strip); $i++)
 {
 if ($strip2[$i][$p]=="")
 {}
 else
 {
        //$otmena = substr_count($strip2[$i][$p],"ОТМЕНА");

        $str_exp = explode("|", $strip2[$i][$p]);
                if($str_exp[2]!="")//otseivaem otmeny
                {
                        echo "ЭЧК-$str_exp[0] с $str_exp[2] до $str_exp[3]<br>";
                        echo "на перегоне: $str_exp[1]<br>";
                        echo "$str_exp[5]<br>";
                        echo "ДСП $dsp отправить $str_exp[6] на окно.<br>";
                        echo "Ответственный за безопасность движения и $str_exp[7]<br><br>";
                        //для адресов:
                        $echk[] = $str_exp[0];
                        $dsp_m[] = $dsp;
                };

 };};};

echo "<br>ЭЧК №_";
        for($i=0; $i < count($echk); $i++)
        {
                echo "$echk[$i], ";
        };
echo "<br>ДСП: ";
        for($i=0; $i < count($dsp_m); $i++)
        {
                echo "$dsp_m[$i], ";
        };
echo "</td></tr></table>";
echo "</body></HTML>";







 ?>