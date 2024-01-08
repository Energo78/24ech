<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "СПРАВОЧНИК-2021";
$server = $_SERVER["HTTP_HOST"];
$style_css_now = "<link rel='stylesheet' href='http://$server/style3.css'>";


$podrazdel_get = $_GET[podrazdel];
$otdel_get = $_GET[otdel];

if($podrazdel_get==""){//смотрим куки
	$podrazdel_get = ($_COOKIE[podrazdel_get]);
}else{
 	//	save in coocies -----
	setcookie("podrazdel_get", "$podrazdel_get", time() + 60000);
 }

include $_SERVER['DOCUMENT_ROOT'].('/head.html');

// читаем БД телефонов персонала
// Схема БД: 0-дистанция или НТЭ, 1-отдел, 2-пусто, 3-таб.№, 4-ФИО, 5-должность, 6-Номер Jabber, 7-Номер РОРС, 8-Фед.Сотовый, 9-ЖД телефон.


//1. обработка БД1 $telef_db_arr
//2. --------
//3. --------
//4. --------
//5. --------
//6. --------
//7. Раздел редактирования телефонов подразделения
//8. Раздел сохранения телефонов подразделения
//. выдаём ссылки на подразделения
//8. если уже есть запрос то выводим телефоны






function process ($str_proc){
	// обрабатываем ---------------
	$str_proc = str_replace("\r\n","",$str_proc);
	$str_proc = str_replace('\" ',"",$str_proc);
	$str_proc = str_replace('\"',"",$str_proc);
	$str_proc = str_replace('&quot;',"",$str_proc);
	$str_proc = str_replace('&apos;',"",$str_proc);
	$str_proc = str_replace('&acute;',"",$str_proc);
	$str_proc = str_replace('&Prime;',"",$str_proc);
	$str_proc = str_replace('&lsquo;',"",$str_proc);
	$str_proc = str_replace('&ldquo;',"",$str_proc);
	$str_proc = str_replace('&rdquo;',"",$str_proc);
	$str_proc = str_replace('&prime;',"",$str_proc);
	$str_proc = str_replace('&tilde;',"",$str_proc);
	$str_proc = str_replace('&rsquo;',"",$str_proc);
	$str_proc = str_replace('"','',$str_proc);
	$str_proc = str_replace('\""',"",$str_proc);
	$str_proc = str_replace('\"""',"",$str_proc);
	$str_proc = str_replace("\r","",$str_proc);
	$str_proc = str_replace("\n","",$str_proc);
	$str_proc = str_replace("\ \"","",$str_proc);
	$str_proc = str_replace("  "," ",$str_proc);
	$str_proc = str_replace("   "," ",$str_proc);
	$str_proc = htmlspecialchars($str_proc);
}



$telef_db_arr =  file ($_SERVER['DOCUMENT_ROOT']."/telefons/telefons_db.csv");








//1. обработка БД1 $telef_db_arr

unset($main_db_telef, $podrazdel_arr);
foreach ($telef_db_arr as $str) {
	unset($str_arr);
	$str_arr = explode(";","$str");

	$podrazdel = $str_arr[0];
	$otdel_tel = $str_arr[1];

	if ($otdel_tel !="" and $podrazdel !="") {
		$main_db_telef[$podrazdel][$otdel_tel][] = $str;
		$podrazdel_arr[$podrazdel]=$podrazdel;
	}
}
sort($podrazdel_arr);
//print_r($podrazdel_arr);



$shapka = "<form action='telefons.php' method='POST'><tr><td>Ф.И.О.</td><td>Должность</td><td>Телефон Jabber</td><td>РОРС</td><td>Сотовый</td><td>ЖД телефон</td></tr>";







//7. Раздел редактирования телефонов подразделения --------------------------------------

$podrazdel_post = $_POST[podrazdel_post];
$otdel_post = $_POST[otdel_post];
//$passw = $_POST[passw]; отменим пока что
	$passw = "777";
if($_POST[tlfredact] =="ok" and $passw=="777"){
	echo("<div id='tab'>
	<table $tab><tr><td colspan='7' style='text-align:center;'>
	$podrazdel_post  $otdel_post<br>
	<a href='./telefons.php'>вернуться в начало</a><br></td><tr>");
	echo("$shapka");
	$nstr = 0;
	foreach ($main_db_telef[$podrazdel_post][$otdel_post] as $db_telef) {
		$db_telef_arr = explode(";","$db_telef");
		
		
		
		echo("<tr>
				<td $td><INPUT type=text name='4_$nstr' size='30' value='$db_telef_arr[4]'></td>
				<td $td><INPUT type=text name='5_$nstr' size='30' value='$db_telef_arr[5]'></td>
				<td $td><INPUT type=text name='6_$nstr' size='18' value='$db_telef_arr[6]'></td>
				<td $td><INPUT type=text name='7_$nstr' size='18' value='$db_telef_arr[7]'></td>
				<td $td><INPUT type=text name='8_$nstr' size='36' value='$db_telef_arr[8]'></td>
				<td $td><INPUT type=text name='9_$nstr' size='18' value='$db_telef_arr[9]'></td></tr>"); 
		$nstr++;
	}
	echo("<tr>
				<td $td><INPUT type=text name='4_$nstr' size='30' value=''></td>
				<td $td><INPUT type=text name='5_$nstr' size='30' value=''></td>
				<td $td><INPUT type=text name='6_$nstr' size='18' value=''></td>
				<td $td><INPUT type=text name='7_$nstr' size='18' value=''></td>
				<td $td><INPUT type=text name='8_$nstr' size='36' value=''></td>
				<td $td><INPUT type=text name='9_$nstr' size='18' value=''></td></tr>");
	
	
	echo("
	<tr><td colspan='7' style='text-align:raith;'>
	Изменить название отдела:<INPUT  type=text size='38' NAME='otdel_post_newname' VALUE='$otdel_post'>
	</td></tr>
	
	
	<tr><td colspan='7' style='text-align:center;'>
	<INPUT TYPE=hidden NAME='end' VALUE='end'>
	<INPUT TYPE=hidden NAME='nstr' VALUE='$nstr'>
	<INPUT TYPE=hidden NAME='tlf_save' VALUE='ok'>
	<INPUT TYPE=hidden NAME='podrazdel_post' VALUE='$podrazdel_post'>
	<INPUT TYPE=hidden NAME='otdel_post' VALUE='$otdel_post'>
	
	<INPUT TYPE=submit class='red goodbutton' VALUE='Сохранить'>
	</form>
	</td></tr></table></div>");
	
	echo("<div id='cont33' style='background-color:#afb632; text-align: left;'>
		<p style='margin-left: 10px; margin-top: 10px;'>
		Для добавления сотрудника заполните пустую строку в нижней части таблицы.<br>
		Для удаления - сотрите строку.
		</p>
	</div>
	");
	
	
	exit();
}
//-------------------------------------   








//8. Раздел сохранения телефонов подразделения --------------------------------------
if($_POST[tlf_save] =="ok"){
	
//	echo("tlf_save=ok");
	//	ДАННЫЕ ИЗ POST
	unset($mass, $keymas);
	foreach ($_POST as $ArrKey => $ArrStr){
                $mass[] = "$ArrStr"; //здесь по строкам данные из POST
                $keymas[] = "$ArrKey";
        };
        
        
        
    foreach ($_POST as $ArrKey => $ArrStr){
                $mass_k[$ArrKey] = $ArrStr;
        };
        
//    echo("<br>1...........");
//    print_r($mass);
//    echo("<br>2...........");
//    print_r($keymas);
    
    //подготовка строк для замены из post
    
    $n_count = count($main_db_telef[$podrazdel_post][$otdel_post]);
    
//    echo("n_count ==== $n_count");
	
	$n9 = 0;
	
	$nstr = $_POST[nstr];
	$otdel_post_newname = $_POST[otdel_post_newname];
	if($otdel_post_newname!=$otdel_post){
				$o_p=$otdel_post_newname;
				$count_podrazdel = count($podrazdel_arr);
				for($x = 0; $x < $count_podrazdel; $x++){
					if($podrazdel_arr[$x]=="$otdel_post"){
						$podrazdel_arr[$x]="$otdel_post_newname";
						echo("$otdel_post заменён на $otdel_post_newname<br>");
					}
				}
			}else{
				$o_p=$otdel_post;
			}
	for($i = 0; $i < $nstr+1; $i++){
		$i3 ="3_$i";$i4 ="4_$i";$i5 ="5_$i";$i6 ="6_$i";$i7 ="7_$i";$i8 ="8_$i";$i9 ="9_$i";
		if($mass_k[$i4]!="" OR $mass_k[$i5]!="" OR $mass_k[$i6] !="" OR $mass_k[$i7]!="" OR $mass_k[$i8]!="" OR $mass_k[$i9]!=""){
			
			$str_proc = "$podrazdel_post;$o_p;;;$mass_k[$i4];$mass_k[$i5];$mass_k[$i6];$mass_k[$i7];$mass_k[$i8];$mass_k[$i9];\r\n";
			process($str_proc);
			$main_db_telef[$podrazdel_post][$otdel_post][$i] = $str_proc;
	//		echo("<br/>i = $i,  tmp1=$tmp1<br/>str_proc=$str_proc<br/>");
			unset($str_proc);
		}
	}
	
	
 

		foreach($main_db_telef as $str_tmp){
				if(is_array($str_tmp)){
					foreach($str_tmp as $str_tmp2){
						if(is_array($str_tmp2)){
							foreach($str_tmp2 as $str_tmp3){
								$str_end[] = $str_tmp3;
							}
						}else{
							$str_end[] = $str_tmp2;
						}
					}
				}else{
					$str_end[] = $str_tmp;
				}
		}
				
//		print_r($str_end);

	
	// Блокировка файла и запись ----------------------------------------------------
		
	$file =  fopen ($_SERVER['DOCUMENT_ROOT']."/telefons/telefons_db.csv","w");
		if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
			unset($str_tmp);
			foreach($str_end as $str_tmp){
				
				$str_proc = "$str_tmp";
				process($str_proc);
				
				fputs ($file,"$str_proc");
//				echo("$str_proc"."<br>");
				
				unset($str_proc);
			
			}
			
		}else{
			echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
		}
	flock($file, LOCK_UN);
	fclose ($file);
	
	echo("Изменения в БД внесены<br>");
	
	
	
    //_end saved -------------
	$podrazdel_get = $podrazdel_post; $otdel_get = $otdel_post;

        

}
// ----------------------------------------------------------------------------------







//end. выдаём ссылки на подразделения

natsort($podrazdel_arr);

echo("<div id='cont_telefons_left'>");
foreach ($podrazdel_arr as $podrazdel) {
	echo("<a href='/telefons/telefons.php?podrazdel=$podrazdel' class='btn first'>$podrazdel</a>
	");

}
echo("</div>");

echo("<div id='cont_telefons_left2'>");
if($podrazdel_get!=""){
	
	//вставим кнопку ссылок по фидерам
	if($ech =="ech01"){
		echo("<a href='/telefons/sheet001.html' class='btn first'>Телефоны по Фид.</a><br>
		");
	}
	
	
	$otdel_arr = array_keys($main_db_telef[$podrazdel_get]); 
	natsort($otdel_arr);
	foreach ($otdel_arr as $otdel) {
		
		if($otdel == $otdel_get){
			if($otdel_get != $otdel_post_newname AND $otdel_post_newname!=""){
				$otdel = $otdel_post_newname;
			}
		}
		
		
		echo("<a href='/telefons/telefons.php?otdel=$otdel&podrazdel=$podrazdel_get'>$otdel</a><br>");
	}
	echo("<br>");
}
echo("</div>");







//9. если уже есть запрос то выводим телефоны: -----------------------------------
echo("<div id='cont_telefons_left3'>");
if($otdel!=""){
	

	if ($podrazdel_get !="" and $otdel_get !="") {
		
		if($otdel_get != $otdel_post_newname AND $otdel_post_newname!=""){
				$otdel_get_new = $otdel_post_newname;
			}else{
				$otdel_get_new = $otdel_get;
			}
		
		// - for clear columns whith no one phone number
			unset($srt6, $srt7, $srt8, $srt9);
			foreach ($main_db_telef[$podrazdel_get][$otdel_get] as $db_telef) {
				$tlf_arr = explode(";","$db_telef");
				
				$srt6 = $srt6.$tlf_arr[6];
				$srt7 = $srt7.$tlf_arr[7];
				$srt8 = $srt8.$tlf_arr[8];
				$srt9 = $srt9.$tlf_arr[9];
			}
			
			$srt6 = str_replace(" ", "", $srt6);
			$srt7 = str_replace(" ", "", $srt7);
			$srt8 = str_replace(" ", "", $srt8);
			$srt9 = str_replace(" ", "", $srt9);
			
			
			unset($s6, $s7, $s8, $s9);
			
			if($srt6 !=""){
				$s6 = "Телефон Jabber";
			}
			if($srt7 !=""){
			 	$s7 = "РОРС";
			 }
			if($srt8 !=""){
			  	$s8 = "Сотовый";
			  }
			if($srt9 !=""){
			   	$s9 = "ЖД телефон";
			   }
			   
			$shapka = "<form action='telefons.php' method='POST'><tr><td>Ф.И.О.</td><td>Должность</td><td>$s6</td><td>$s7</td><td>$s8</td><td>$s9</td></tr>";   
			
		/*	echo("<br/>
				srt6 = $srt6 <br/>
				srt7 = $srt7 <br/>
				srt8 = $srt8 <br/>
				srt9 = $srt9 <br/>
				<br/>");*/
				
		// - end
		
		
		echo("<div id='tab'>");
		echo("<table><tr><td colspan='7' style='text-align:center;'>
		$podrazdel_get  $otdel_get_new<br></td><tr>");
		
		echo("$shapka");
			
		foreach ($main_db_telef[$podrazdel_get][$otdel_get] as $db_telef) {
			$db_telef_arr = explode(";","$db_telef");
			
			echo("<tr><td>$db_telef_arr[4]</td><td>$db_telef_arr[5]</td><td>$db_telef_arr[6]</td><td>$db_telef_arr[7]</td><td>$db_telef_arr[8]$str_num_db3</td><td>$db_telef_arr[9]</td></tr>");
			
		}
		
		
		echo("<tr><td colspan='7' style='text-align:center;'>
		<INPUT TYPE=hidden NAME='tlfredact' VALUE='ok'>
		<INPUT TYPE=hidden NAME='podrazdel_post' VALUE='$podrazdel_get'>
		<INPUT TYPE=hidden NAME='otdel_post' VALUE='$otdel_get_new'>
		<!-- пароль для редактирования:<INPUT type='password' name='passw' size='8' value=''> -->
		<INPUT TYPE=submit class='red goodbutton' VALUE='Редактировать'></form>
		</td><tr></table></div>");
		
	}
}
echo("</div>");










?>