<?php

//для присоединения БД objects 
//	читаем БД объектов
		$dir = "./$di/$ech/$ceh/objects_$ceh.csv";
		
		if(file_exists($dir)){
		
			$file_array =  file ("./$di/$ech/$ceh/objects_$ceh.csv");
			$string_db = $file_array[0];
			$objects = str_replace(";","<option>","$string_db");
			
			
		}

	
if ($redactf !=""){	
	$file = fopen("$redactf","r");
	if(!file){
		echo("Ошибка открытия файла");
	};
	$striprf = fgets ($file);
	//echo "!!! $stripr[$i]  !!!</br>";
	fclose ($file);
	
	$striprf = str_replace("b-b","\r\n", $striprf);
	
	$masworkf = explode("|", $striprf);
	$brigtabnamb = explode(";", $masworkf[31]);
	
	for ($i=0; $i < count($masworkf); $i++){// проверка checbox
		if ($masworkf[$i] =="on")
        {$masworkf[$i] = "checked";};
	};

};	
	$u=1;
		echo "<div style='clear:both;'></div><div id='contpers'>
		<table>
		<tr><td><form method='post' action='dataputnewpers.php'>
		<INPUT TYPE=hidden NAME='di' VALUE='$di'>
		<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
		<INPUT TYPE=hidden NAME='echrus' VALUE='$echrus'>
		<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
		<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
		<INPUT TYPE=hidden NAME='redactf' VALUE='$redactf'>
		<INPUT TYPE=hidden NAME='date' VALUE='$date'>
		№Нар.,№Расп.,Тек.Экспл.</td><td>Производитель</td><td>Время работы<br>(час : мин)</td><td>Место работы (перегон/станция)</td><td>Работа</td></tr>
		";
		// value='$masworkf[]'
		echo"<tr><td  valign='top'>
		  Наряд №<INPUT type=text name='1' size='3' value='$masworkf[1]'><br>
		  Распоряжение № <INPUT type=text name='12' size='3' value='$masworkf[12]'><br>
		  <INPUT TYPE=checkbox NAME='32' $masworkf[32]> Тек.Экспл.
		  <p align=left>
		  <INPUT TYPE=checkbox NAME='25' $masworkf[25]> в окно<br>
		  <INPUT TYPE=checkbox NAME='45' $masworkf[45]> отказ ДНЦ<br>
		  <INPUT TYPE=checkbox NAME='46' $masworkf[46]> отказались ЭЧК<br>
		  <INPUT TYPE=checkbox NAME='26' $masworkf[26]> Совм.окно<br>
		  Время подготовки<br> (час : мин) - (час : мин):<br><INPUT type=text name='33' size='2' value='$masworkf[33]'>
		  <b>: </b><INPUT type=text name='34' value='$masworkf[34]' size='2'> - <INPUT type=text name='35' size='2' value='$masworkf[35]'>
		  <b>: </b><INPUT type=text name='36' size='2' value='$masworkf[36]'></br>
		  Время завершающего этапа<br> (час : мин) - (час : мин):<br><INPUT type=text name='37' size='2' value='$masworkf[37]'>
		  <b>: </b><INPUT type=text name='38' size='2' value='$masworkf[38]'> - <INPUT type=text name='39' size='2' value='$masworkf[39]'>
		  <b>: </b><INPUT type=text name='40' size='2' value='$masworkf[40]'><br><br>
		  Время перерывов в работе(мин): <INPUT type=text name='43' size='2' value='$masworkf[43]'>
		  </td>
		  <td  valign='top'>
		  <SELECT NAME='2'><OPTION>$masworkf[2]<OPTION>";
		  
		  $option = "<OPTION>";
		  include "pers_arr.php";
		  echo "</select></br></br><SELECT NAME='42'><OPTION>$masworkf[42]
		  <OPTION><OPTION>";
		  include "pers_allarr.php";
		  unset ($option, $fio);
		  
		  echo "
		  </select><br>
		  <p align=left>
		  <INPUT TYPE=checkbox NAME='14' $masworkf[14]> - Под U<br>
		  <INPUT TYPE=checkbox NAME='30' $masworkf[30]> - на ВЛ АБ, ПЭ, ДПР<br>
		  <INPUT TYPE=checkbox NAME='15' $masworkf[15]> - Обеспечение ПЧ-ПМС<br>
		  <INPUT TYPE=checkbox NAME='16' $masworkf[16]> - Обеспечение ЭМП<br>
		  <INPUT TYPE=checkbox NAME='20' $masworkf[20]> - Обеспечение ШЧ<br>
		  <INPUT TYPE=checkbox NAME='21' $masworkf[21]> - Обеспечение РЦС<br>
		  <INPUT TYPE=checkbox NAME='28' $masworkf[28]> - Обеспечение СМП<br>
		  <INPUT TYPE=checkbox NAME='29' $masworkf[29]> - Обеспечение проч.<br>
		  </td>
		  <td  valign='top'>
		  с <INPUT type=text name='3' size='2' value='$masworkf[3]'>
		  <b>: </b>
		  <INPUT type=text name='4' size='2' value='$masworkf[4]'></br></br>
		  до <INPUT type=text name='5' size='2' value='$masworkf[5]'>
		  <b>: </b>
		  <INPUT type=text name='6' size='2' value='$masworkf[6]'>
		  </td>
		  <td  valign='top'><SELECT NAME='7'>
		  <OPTION>$masworkf[7]<option>$objects<option>
		  $peregons</select>
		  <INPUT type=text name='8' size='2' value='$masworkf[8]'><br>
		  <SELECT NAME='9'>
		  <OPTION>$masworkf[9]
		  $stancii</select>
		  <INPUT type=text name='10' size='2' value='$masworkf[10]'><br>
		  участок:<INPUT type=text name='13' size='23' value='$masworkf[13]'>
		  <p align=left>
		  <INPUT TYPE=checkbox NAME='22' $masworkf[22]> - Обход с осмотром<br>
		  <INPUT TYPE=checkbox NAME='23' $masworkf[23]> - Объезд с осмотром<br>
		  <INPUT TYPE=checkbox NAME='24' $masworkf[24]> - Объезд с ВИКС
		  ";
		  if ($masworkf[44]!=""){
		  	$as_apvo_arr= explode(";","$masworkf[44]");
		  	foreach($as_apvo_arr as $asap){
				if($asap !=""){
					if($as_apvo==""){
						$as_apvo = "$asap";
					}else{
						$as_apvo = "$as_apvo<br>$asap";
					}
				}				
			}
			//$as_apvo = "<p style='font-size: 80%;'><b>Информация из АС-АПВО:<br>$as_apvo</b><p>";
			$as_apvo = str_replace("<br> <br>","<br>", $as_apvo);
			$as_apvo = str_replace("<br><br>","<br>", $as_apvo);
			$as_apvo = str_replace("<br>","\r\n", $as_apvo);
			unset($asap, $as_apvo_arr);
		  		echo"</br>Из АС АПВО:</br>
				<textarea rows='6' id='one' name='44' cols='50'>$as_apvo</textarea>";
		  }
			  
		  echo"
		  </td>
		  <td  valign='top'><p align=left>
		  Запланировано:</br>
		  <textarea rows='4' id='one' name='11' cols='30'>$masworkf[11]</textarea><br>
		  Выполнено:</br>
		  <textarea rows='4' id='two' name='41' cols='30'>$masworkf[41]</textarea><br>
		 <!-- <input id='go' type = 'button' value = 'Скопировать'><br> -->
		  
		  <INPUT type=text name='17' size='2' value='$masworkf[17]'> - Проверено км.эксп.дл.<br>
		  <INPUT type=text name='18' size='2' value='$masworkf[18]'> - Выявлено Замечаний<br>
		  <INPUT type=text name='19' size='2' value='$masworkf[19]'> - Устранено Замечаний<br>
		  <INPUT type=text name='27' size='2' value='$masworkf[27]'> - Отремонтировано заземлений<br>
		  </td></tr>
		  <tr><td colspan='5'>БРИГАДА:";
		include "copyclic.html";
		
		include "pers_arr.php";
		for ($i=0; $i < count($maspers); $i++){
			$tabnamber = $maspers[$i];
			$day2 = $i + $day;
			// часы работы
			$h = $maspers[$day2]; 
			settype($h,integer);
			$brig = $masworkf[31];
			if ($tabnamber !=""){
			$sovpad = substr_count($brig, $tabnamber);
			if ($sovpad !=""){
				$check ="checked";
			}else{$check="";};
			};
			// выводим
				if($fio[$tabnamber] !=""){
					echo "<INPUT TYPE=checkbox NAME='$tabnamber' $check>$fio[$tabnamber]";
					
				};
					
			$i = $i+31;
		};
//		print_r($fio);
		echo "</td></tr>
		<tr><td colspan='5' style='text-align:center;'></br>
		
		<INPUT TYPE=submit class='green goodbutton' VALUE='СОХРАНИТЬ'>
		</form></td></tr>";
		echo "</table></div>";

		
		unset ($option, $fio);
		
		
		
?>