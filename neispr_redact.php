<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Неисправности оборудования";
include "head.html";
include "neispr_read.php";
include ('config.php');


// получаем индекс строки
$i=$_POST['number'];

// нужную сроку разбиваем в массив

$str_exp = explode("|", $massiv[$i]);

//echo "$i<br>";
$str_exp[6]=(string)$str_exp[6];

if ($str_exp[6]=="bgcolor=yellow")
{
$check="checked";
}


        // выводим таблицу-Форму для редактирования
  // шапка таблицы:
 echo "<table align = center border = 1>
 <tr><td>Место</td><td>Объект</td><td>Неисправность</td><td>Дата начала</td><td>Отметка об<br>устранении</td><td>Ответственные<br>(Кому передана<br>информация<br>о неисправности)</td><td>Ставим галочку,<br>если информация<br>передана<br>в службу Э</td></tr>";
 // форма:
 echo "
 <tr><td><form method=post action=neispr_save.php>
<SELECT NAME=stanc>
<OPTION>$str_exp[0] $kontr_punct
</td>
 <td>
 <textarea rows=4 name=obekt cols=10>$str_exp[1]</textarea></td>
 <td><textarea rows=6 name=neispr cols=40>$str_exp[2]</textarea></td>
 <td><textarea rows=4 cols=10 name=date1>$str_exp[3]</textarea></td>
 <td><textarea rows=4 name=date2 cols=15>$str_exp[4]</textarea></td>
 <td>
 <textarea rows=4 name=otv cols=15>$str_exp[5]</textarea>
</td>
 <td>
 <INPUT TYPE=checkbox NAME=slujba $check>
 </td>
 </tr>
 </table>
 <table align = center border = 0><tr><td>
 <INPUT TYPE=hidden NAME='i' VALUE='$i'>
<INPUT TYPE=submit VALUE='СОХРАНИТЬ'>
 </form>
</td></tr></table>
 <br>
 ";



echo "</body></HTML>";







?>