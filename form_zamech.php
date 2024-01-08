<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Замечания ТУ-ДУ";
if($menuis!=1){
	include "head.html";
}
include "config.php";
include "read_tudu.php";
include"bot.html";

//        echo "$n<br>";

//выводим таблицу неисправностей +++

 // шапка таблицы:
 echo "<p align=center><i><b><font color=#0000FF size=4><span lang=ru>Замечания ТУ-ДУ на $data_mod</span></font></b></i></p>
 <table $tab>
 <tr><td $td>№</td><td $td>Место</td><td $td>Объект</td><td $td>Неисправность</td><td $td>Дата начала</td><td $td>Отметка об<br>устранении</td><td $td>Кому передано:</td><td $td></td><td $td></td $td></tr>";
settype($role, string);
for ($i=0; $i < $n; $i++)
{
$str_exp = explode("|", $massiv[$i]);

	$str_echo = "<tr><td $str_exp[6] $td>$i</td><td $str_exp[6] $td>$str_exp[0]</td><td $str_exp[6] $td>$str_exp[1]</td><td $str_exp[6] $td>$str_exp[2]</td><td $str_exp[6] $td>$str_exp[3]</td><td $str_exp[6] $td>$str_exp[4]</td><td $str_exp[6] $td>$str_exp[5]</td><td $td><form method=post action=tudu_redact.php><INPUT TYPE=hidden NAME='number' VALUE='$i'><fieldset title='Редактировать'><INPUT TYPE=submit VALUE='Re'></fieldset></form></td><td $td><form method=post action=tudu_dobav.php><fieldset title='Удалить'><INPUT TYPE=hidden NAME='delete' VALUE='$i'><INPUT TYPE=submit VALUE=' x '></fieldset></form></td></tr>";


	if ($role ==""){
		echo "$str_echo";
	}else{
		if ( $str_exp[6] !=""){
			echo "$str_echo";
		}
	}

};

echo "</table>";

?>