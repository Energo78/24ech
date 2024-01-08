<?php // ФОРМА ВВОДА РАБОТЫ ДЛЯ ПЛАНА НЕДЕЛИ
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);


//редактирование и добавление работ цеха
	

	$striprf = str_replace("b-b","\r\n", $striprf);
	$striprf = str_replace("</br>","\r\n", $striprf);
	unset($masworkf);
	$masworkf = explode("|", $striprf);
	$brigtabnamb = explode(";", $masworkf[31]);
	
	for ($i=0; $i < count($masworkf); $i++){// проверка checbox
		if ($masworkf[$i] =="on")
        {$masworkf[$i] = "checked";};
	};


	$u=1;
		echo "<div style='clear:both;'></div><div id='contpers'>
		<br id='all$dop02'/><table class='demotable'>
		<tr><td>
		
		<INPUT TYPE=hidden NAME='redactf$dop02' VALUE='$redactf'>
		
		№Нар.,№Расп.,Тек.Экспл.</td><td>Производитель</td><td>Время работы<br>(час : мин)</td><td>Место работы</td><td>Работа  <a href='#close'>свернуть</a><a href='#all$dop02'>развернуть</a></td></tr>
		";
		// value='$masworkf[]'
		echo"<tr><td  valign='top'>
		  Наряд №<INPUT type=text name='1_$dop02' size='3' value='$masworkf[1]'><br>
		  Распоряжение № <INPUT type=text name='12_$dop02' size='3' value='$masworkf[12]'><br>
		  <INPUT TYPE=checkbox NAME='32_$dop02' $masworkf[32]> Тек.Экспл.
		  
		  </td>
		  <td  valign='top'>
		  <SELECT NAME='2_$dop02'><OPTION>$masworkf[2]<OPTION>";
		  
		  $option = "<OPTION>";
		  include "pers_arr.php";
		  echo "</select></br></br><SELECT NAME='42_$dop02'><OPTION>$masworkf[42]
		  <OPTION><OPTION>";
		  include "pers_allarr.php";
		  unset ($option, $fio);
		  
		  echo "
		  </select><br>
		  
		  </td>
		  <td  valign='top'>
		  с <INPUT type=text name='3_$dop02' size='2' value='$masworkf[3]'>
		  <b>: </b>
		  <INPUT type=text name='4_$dop02' size='2' value='$masworkf[4]'></br></br>
		  до <INPUT type=text name='5_$dop02' size='2' value='$masworkf[5]'>
		  <b>: </b>
		  <INPUT type=text name='6_$dop02' size='2' value='$masworkf[6]'>
		  </td>
		  <td  valign='top'>пер.
		  <SELECT NAME='7_$dop02'>
		  <OPTION>$masworkf[7]
		  $peregons</select>
		  <INPUT type=text name='8_$dop02' size='2' value='$masworkf[8]'><br>
		  ст.&nbsp&nbsp&nbsp<SELECT NAME='9_$dop02'>
		  <OPTION>$masworkf[9]
		  $stancii</select>
		  <INPUT type=text name='10_$dop02' size='2' value='$masworkf[10]'><br>
		  уч-к:<INPUT type=text name='13_$dop02' size='23' value='$masworkf[13]'>
		  
		  
		  
		  
		   
		  </td>
		  <td  valign='top'><p align=left>
		  Запланировано:</br>
		  <textarea rows='4' id='one$dop02' name='11_$dop02' cols='30'>$masworkf[11]</textarea><br>
		  
		  </td></tr>
		  
		  
		  <tr><td>
		  	<p align=left>
		  <INPUT TYPE=checkbox NAME='25_$dop02' $masworkf[25]> в окно<br>
		  <INPUT TYPE=checkbox NAME='26_$dop02' $masworkf[26]> Совм.окно<br>
		  Время подготовки<br> (час : мин) - (час : мин):<br><INPUT type=text name='33_$dop02' size='2' value='$masworkf[33]'>
		  <b>: </b><INPUT type=text name='34_$dop02' value='$masworkf[34]' size='2'> - <INPUT type=text name='35_$dop02' size='2' value='$masworkf[35]'>
		  <b>: </b><INPUT type=text name='36_$dop02' size='2' value='$masworkf[36]'></br>
		  Время завершающего этапа<br> (час : мин) - (час : мин):<br><INPUT type=text name='37_$dop02' size='2' value='$masworkf[37]'>
		  <b>: </b><INPUT type=text name='38_$dop02' size='2' value='$masworkf[38]'> - <INPUT type=text name='39_$dop02' size='2' value='$masworkf[39]'>
		  <b>: </b><INPUT type=text name='40_$dop02' size='2' value='$masworkf[40]'><br><br>
		  Время перерывов в работе(мин): <INPUT type=text name='43_$dop02' size='2' value='$masworkf[43]'>
		  
		  </td><td>
		  	<p align=left>
		  <INPUT TYPE=checkbox NAME='14_$dop02' $masworkf[14]> - Под U<br>
		  <INPUT TYPE=checkbox NAME='30_$dop02' $masworkf[30]> - на ВЛ АБ, ПЭ, ДПР<br>
		  <INPUT TYPE=checkbox NAME='15_$dop02' $masworkf[15]> - Обеспечение ПЧ-ПМС<br>
		  <INPUT TYPE=checkbox NAME='16_$dop02' $masworkf[16]> - Обеспечение ЭМП<br>
		  <INPUT TYPE=checkbox NAME='20_$dop02' $masworkf[20]> - Обеспечение ШЧ<br>
		  <INPUT TYPE=checkbox NAME='21_$dop02' $masworkf[21]> - Обеспечение РЦС<br>
		  <INPUT TYPE=checkbox NAME='28_$dop02' $masworkf[28]> - Обеспечение СМП<br>
		  <INPUT TYPE=checkbox NAME='29_$dop02' $masworkf[29]> - Обеспечение проч.<br>
		  </td><td>
		  	<p align=left>
		  <INPUT TYPE=checkbox NAME='22_$dop02' $masworkf[22]> - Обход с осмотром<br>
		  <INPUT TYPE=checkbox NAME='23_$dop02' $masworkf[23]> - Объезд с осмотром<br>
		  <INPUT TYPE=checkbox NAME='24_$dop02' $masworkf[24]> - Объезд с ВИКС
		   </td><td>";
		  if ($masworkf[44]!=""){
		  	unset($as_apvo_arr, $as_apvo);
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
				<textarea rows='6' id='one' name='44_$dop02' cols='50'>$as_apvo</textarea>";
		  }
			  
		  echo"
		  </td><td>
		  	Выполнено:</br>
		  <textarea rows='4' id='two$dop02' name='41_$dop02' cols='30'>$masworkf[41]</textarea><br>
		  <input id='go$dop02' type = 'button' value = 'Скопировать'><br>
		  
		  <INPUT type=text name='17_$dop02' size='2' value='$masworkf[17]'> - Проверено км.эксп.дл.<br>
		  <INPUT type=text name='18_$dop02' size='2' value='$masworkf[18]'> - Выявлено Замечаний<br>
		  <INPUT type=text name='19_$dop02' size='2' value='$masworkf[19]'> - Устранено Замечаний<br>
		  <INPUT type=text name='27_$dop02' size='2' value='$masworkf[27]'> - Отремонтировано заземлений<br>
		  </td></tr>
		  
		  
		  
		  <tr><td colspan='5'>БРИГАДА: ";
		
		echo("<INPUT TYPE=hidden NAME='startb_$dop02' VALUE='ok'>");//маркер начала бригады
		
		//include "copyclic.html";
		
		echo("
		<!-- <input id='one$dop02' type = 'text' value = 'Значение'>
<input id='two$dop02' type = 'text' value = ''>
<input id='go$dop02' type = 'button' value = 'Скопировать'> -->
 
<script type='text/javascript'>
 
document.getElementById('go$dop02').addEventListener('click', function() {
    document.getElementById('two$dop02').value = document.getElementById('one$dop02').value;
}, false)
 
</script>
		");//это вместо copyclic.html
		
		unset ($option, $fio);
		include "pers_arr.php";
		
		
		for ($i=0; $i < count($maspers); $i++){//БРИГАДА
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
					$tn_n = $tabnamber."_".$dop02;
					echo "<INPUT TYPE=checkbox NAME='$tn_n' $check>$fio[$tabnamber]";
				};
					
			$i = $i+31;
		};
		echo("<INPUT TYPE=hidden NAME='endb_$dop02' VALUE='ok'>");//маркер бригады
		echo "</td></tr>";
		echo "</table></div>";

		
		
		
		
		




?>