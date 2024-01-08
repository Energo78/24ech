<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Журнал ЭУ-83 r";
if($menuis!=1){
	include "head.html";
}


$mes=$_POST["mes"];
$year=$_POST["year"];
$id=$_POST["id"];
$del=$_POST["delete"];
$filetime=$_POST["filetime"];

//Содержание
// 1. удаляем строку (with log-saving)
// 2. Форма ввода-редактирования





//1.удаляем строку-------------------------------------------------------------

if ($del != ""){
//разбиваем файл в массив по строкам
	$file_array =  file ("./eu83/eu83db$di$ech$mes.$year.csv");

	if(!$file_array){
    	echo("Ошибка чтения файла");
	}else{
		for($i = 0; $i < count($file_array); $i++){
			$file_array[$i] = str_replace("\n","",$file_array[$i]);
			$file_array[$i] = str_replace("\r\n","",$file_array[$i]);
		}
		
	}
    
    $n = count($file_array);

	
		
//	echo("$file_array[$del]");
	$mas = explode("|", $file_array[$del]);

	$file_array[$del] = "$mas[0]|$mas[1]|$mas[2]|$mas[3]|$mas[4]|$mas[5]|$mas[6]|$mas[7]|$mas[8]|$del|hidden|$mas[11]|$ipv|$ech|$mas[14]";
	
//	echo("<br> $file_array[$del] n = $n  del = $del ");
	unset($mas);
	
	//сохраняемся
        $file =  fopen ("./eu83/eu83db$di$ech$mes.$year.csv","w+");
			if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
				for ($x=0; $x <=$n-1 ; $x++)
				{
					fputs ($file,"$file_array[$x]\n");
				};

			}else{
				echo "Не удалось получить блокировку !";
			}
		flock($file, LOCK_UN);
        fclose ($file);
        
    //пишем лог-файл ----------------------------
	$forlog1 = "Удаляем строку, Is hidden(delete) the string incident.";
	$forlog2 = "$file_array[$del]";
	include("eu83_log.php");
	unset($forlog1, $forlog2);
	//---------------------------------------------
        
	$inc_83 = 1; //для отображения корректной даты
	include "eu83.php";
exit;
};//----------------------------------------------------------------------------------------





// 2.Форма ввода-редактирования ----------------------------------------------------------

if ($mes != ""){
// Данные для редактирования
//разбиваем файл в массив по строкам
	$file_array =  file ("./eu83/eu83db$di$ech$mes.$year.csv");
  	if(!$file_array){
    	echo("Ошибка открытия файла");
  	}else{
    	$str_exp = explode("|", $file_array[$id]);
        $str_expa = explode(" ", $str_exp[0]);
        for ($x=0; $x <= 10; $x++){
			$str_exp[$x] = str_replace("b--b","\n",$str_exp[$x]);
		};
    };
}else{
	if($ech =="ech01"){
		$str_exp[11] = "checked";
	}
};


if ($str_exp[6]=="on"){
	$str_exp[6] = "checked";
};


if($str_exp[11]=="on"){
 	$str_exp[11] = "checked";
 };

if ($str_exp[14]=="on") {
			$eu83svet = "<img width='96' src='../img/svet.jpg'/>";
		}else{
			$eu83svet = "";
		}


//блок для ЭЧЦ-3:права редактирования только у них
if ($sovp_echc != 1 and $ech =="ech03") {
	$readonly = "readonly";
}else{
	$readonly = "";
}

//echo("<br>sovp = $sovp_echc, readonly = $readonly<br>");




// Форма ввода-редактирования:
// шапка таблицы:
 echo "<table $tab>
 <tr><td $td>Дата и Место</td><td $td>Хронология</td><td $td>Отметка об устранении</td><td $td>Кому сообщено</td><td $td>Причина</td></tr>";
echo "
	<tr><td $td valign='top'>
	<form method=post action=eu83_save.php>

			  <font size=3>Дата
			  <input autocomplete='off' name='Date3' type='text' value='$str_expa[0]' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)' >			
		<br><br> Время начала <INPUT type=text name='eu83_time' size='5' value='$str_expa[1]'>
		<br><br>
		<SELECT NAME=mesto>
		<OPTION>$str_exp[1] $kontr_punct</select>
		<br><br>
		Ответственный ЦЕХ: 
		<SELECT name='otvetstvenny_ceh'><option>$str_exp[8]<option>$ceha</select>
		<br/><br/><br/>";
		
		include("$id_pc/js/eu83_button.html");
		echo("<input type='hidden' name='eu83svet' value='$str_exp[14]' id='eu83svet_value'/>
		<p id='eu83svet_img'>$eu83svet</p>
		");
		echo "
		</td>
		<td $td valign='top'>
		<textarea rows=35 name=hrono cols=68 $readonly>$str_exp[2]</textarea>
		</td>
		<td $td valign='top'>
		<textarea rows=8 name=ustr cols=18 $readonly>$str_exp[3]</textarea>
		</td>
		<td $td valign='top'>
		<textarea rows=10 name=soob cols=20 $readonly>$str_exp[4]</textarea><br>
		<INPUT TYPE=checkbox NAME='nte' $str_exp[6]> сообщено в НТЭ<br>
		<INPUT TYPE=checkbox NAME='top_secret' $str_exp[11]> огранич.видимость<br>
		(видимость только для ЭЧЦ)<br>
		</td>
		<td $td valign='top'>
		<textarea rows=20 name=prich cols=30 $readonly>$str_exp[5]</textarea><br>
		Мероприятия:<br>
		<textarea rows=8 name=meropr cols=20>$str_exp[7]</textarea>
		</td>
		</tr>
		<tr><td colspan=5>
		<INPUT TYPE=hidden NAME='id' VALUE='$id'>
		<INPUT TYPE=hidden NAME='mes' VALUE='$mes'>
		<INPUT TYPE=hidden NAME='year' VALUE='$year'>
		<INPUT TYPE=hidden NAME='filetime' VALUE='$filetime'>
		<INPUT TYPE=submit VALUE='СОХРАНИТЬ'>
	</form>
	</td></tr>
	</table>
	";

//---------------------------------------------------------------------------------
?>