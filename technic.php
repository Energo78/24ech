<?php
//--------mast-be-all-sheet------------------------
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$server = $_SERVER["HTTP_HOST"];
$id_pc = $_SERVER["DOCUMENT_ROOT"];
$ip = $_SERVER["REMOTE_ADDR"];
include("$id_pc/overhead.php");
//--------mast-be-all-sheet------------------------

$titl = "ТЕХНИКА НТЭ";


//раздел записи\редактирования данных в БД 
//function tr строка для таблицы РЕДАКРОВАНИЯ
//function tr строка для таблицы ВЫВОДА(без редактирования)
//проверяем текущ время ищем файл (+сравнение с предыдущим файлом)

//выводим шапку таблицы (с менюшкой кнопок команд)---------------------
//если nte то грузим все БД всех ЭЧ
//читаем БД в папке ЭЧ, формируем для вывода на таблицу редактирования

//разбиваем БД - выводим строки таблицы----------------------
//вывод новых строк чистых для техники----------------------



//удалить потом -------------------
	$tab = "x:str border='0' cellpadding='3' align = 'center' cellspacing='0' style='border-collapse: collapse;text-align: center'";
	$td = "style='border: 1px solid #000000; vertical-align: top;'";
	$td2 = "style='border: 1px solid #000000; text-align: left; vertical-align: justify'";
//----------------------------------




//что в пост (что надо, смотреть\посланы новые данные)
	$save = $_POST[save];
	$datechenge = $_POST[datechenge];

	$date = $_POST[date];
	$period = $_POST[period];

//что в GET ---------------
	$redact = $_GET[redact];
if($redact==1){
	$date = $_GET[date];
	$period = $_GET[period];
	include ("date_functions.php");
}
	
	$new = $_GET["new"];
if($new ==""){
	$new=0;
}

if($date==""){
	$date = date(d.".".m.".".Y);
	$period = date(H);
	include ("date_functions.php");
//	echo("dateold = $dateold<br/>");
	if($period < 8){
		
		$date = $dateold;
		include ("date_functions.php");
//		echo("day = $day<br/>");
//		echo("dateold = $dateold<br/>");
	}
	if($period > 7 and $period < 20){
		$period="08-20";
	}else{
		$period="20-08";
	}	
}


if($date !=""){
	//для min и max DateTime
		$datenext_tmp = strtotime($date) + 86400;
		$datemax = date('Y-m-dT23:59', $datenext_tmp);

		$dateold_tmp = strtotime($date) - 86400;
		$datemin = date('Y-m-dT00:00', $dateold_tmp);
}


if($period ==""){
	$period = date(H);
//	echo("$period<br/>");
	if($period > 7 and $period < 19){
		$period="08-20";
	}else{
		$period="20-08";
	}
}















//раздел записи\редактирования данных в БД ------------------------------------------
	foreach ($_POST as $ArrKey => $ArrStr){
                $mass_k[$ArrKey] = $ArrStr;
        };
	
if (isset($mass_k) and $save=="ok") {
	
	$i_k =0;
	
	
		
	
	
	
	$n = $_POST[n];
	$date = $_POST[date];
	include ("date_functions.php");
	
	$period = $_POST[period];
	if($period=="08-20"){
		$periodamdm="am";	
	}else if($period=="20-08"){
	 	$periodamdm="pm";
	 }
	 
	for($y = 0; $y < $n+$new; $y++){
		$a0 = "cehrus_$y"; $a1 = "station_$y"; $a2 = "tip_$y";
		$a3 = "num_$y"; $a4 = "fuel_$y"; $a5 = "fuel_zapas_$y";
		$a6 = "kran_$y"; $a7 = "vishka_$y"; $a8 = "vcelom_$y";
		$a9 = "do_tr_$y";
		$a10 = "dezurstvo_mash_$y"; $a11 = "mashinist_graf_$y";
		$a12 = "mashinist_fact_$y"; $a13 = "dezurstvo_sopr_$y";
		$a14 = "soprov_graf_$y"; $a15 = "soprov_fact_$y";
		$a16 = "time1_$y"; $a17 = "time2_$y"; $a18 = "prim_$y";
		$a19 = "pputi_$y"; $a20 = "avz_$y"; $a21 = "bashmakall_$y";
		$a22 = "bashmakssps_$y";
		
		
		if($mass_k[$a0]!="" AND $mass_k[$a1]!="" AND $mass_k[$a2]!=""){
			
			$strings[$y]="$di;$ech;$mass_k[$a0];$mass_k[$a1];$mass_k[$a2];$mass_k[$a3];$mass_k[$a4];$mass_k[$a5];$mass_k[$a6];$mass_k[$a7];$mass_k[$a8];$mass_k[$a9];$mass_k[$a10];$mass_k[$a11];$mass_k[$a12];$mass_k[$a13];$mass_k[$a14];$mass_k[$a15];$mass_k[$a16];$mass_k[$a17];$mass_k[$a18];$mass_k[$a19];$mass_k[$a20];$mass_k[$a21];$mass_k[$a22];";
		
		}else{
			$strings[$y]="zero";
		}
		
//		echo("$strings[$y]<br/>");
		
		
		
		
		$strings[$y] = htmlspecialchars($strings[$y]);
		$strings[$y] = str_replace("\r\n","b--b",$strings[$y]);
		$strings[$y] = str_replace("\n","b--b",$strings[$y]);
        $strings[$y] = str_replace("\""," ",$strings[$y]);
        $strings[$y] = str_replace("\\"," ",$strings[$y]);
		
		
		
	}
		
	
	
//	print_r($strings);
//	echo("<br/>n=$n<br/>");
	
	
//	проверка наличия dir --------
	$dir = "./technics/$di/$ech/$year";
	if (file_exists($dir)) {
	    // echo "Каталог $dir найден<br>";
	} else {
	    mkdir("./technics/$di/$ech/$year");
		// echo "Каталог $dir создан<br>";
	};

	$dir = "./technics/$di/$ech/$year/$mes";
	if (file_exists($dir)) {
	    // echo "Каталог $dir найден<br>";
	} else {
	    mkdir("./technics/$di/$ech/$year/$mes");
		// echo "Каталог $dir создан<br>";
	};

//сохраняем новую технику-----


	$filename = "technics$day$periodamdm";
	
//	echo("$filename, $date<br/>");
	
	sort($strings);
	// Блокировка файла и запись ---------------------------------	
	$file =  fopen ("./technics/$di/$ech/$year/$mes/$filename.csv","w+");
		if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
		
			foreach($strings as $stroka){
				if($stroka!="zero"){
					fputs ($file,"$stroka\r\n");
				}
			}
	
		}else{
			echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
				}
	flock($file, LOCK_UN);
	fclose ($file);
	
	// --------------------------------
	
	//копируем свежий файл ------------
		$file = "./technics/$di/$ech/$year/$mes/$filename.csv";
		$newfile = "./technics/$di/$ech/technics$ech.csv";

		if (!copy($file, $newfile)) {
		    echo "не удалось скопировать $file...\n";
		}
	
}
//---------------------записан файл данных--------------------------------







//function tr строка для таблицы РЕДАКРОВАНИЯ
function gettr ($i, $cehrus, $ceha, $stancii, $tr, $td, $mas_fdb, $datemax, $datemin){
	echo "<tr $tr>
	<td $td>
	<p style='text-align: left;'>
	<SELECT name='cehrus_$i'><option>$mas_fdb[2]<option>$ceha</select>
	<SELECT NAME='station_$i'><option>$mas_fdb[3]$stancii</select>
	</td>
	</p>
	<td $td>
	<p style='text-align: left;'>
	<input type='text' size='8' list='tip_tech' name='tip_$i'/ value='$mas_fdb[4]'><datalist id='tip_tech'>
	<option value='АДМ'><option value='АДМскм'><option value='АРВ'><option value='Автолетучка'></datalist>
	№<input type='text' name='num_$i' size='4' placeholder='Номер'value='$mas_fdb[5]'/><br/>
	топливо в баке:<input type='text' name='fuel_$i' size='4' placeholder='Топливо' value='$mas_fdb[6]'/><br/>
	Топливо запас:<input type='text' name='fuel_zapas_$i' size='4' placeholder='Запас' value='$mas_fdb[7]'/><br/>
	</p>
	<!--Тормозные башмаки(всего):<input type='text' name='bashmakall_$i' size='4' placeholder='шт' value='$mas_fdb[23]'/><br/>
	Башмаков под ССПС:<input type='text' name='bashmakssps_$i' size='4' placeholder='шт' value='$mas_fdb[24]'/>
	-->
	
	</td>
	<td $td><p style='text-align: left;'>
	Кран:  <select name='kran_$i'><option>$mas_fdb[8]<option>исправен<option>неисправен<option></select><br/>
	Вышка:  <select name='vishka_$i'><option>$mas_fdb[9]<option>исправна<option>неисправна<option></select><br/>
	Общая исправность: <select name='vcelom_$i'><option>$mas_fdb[10]<option>исправна<option>неисправна<option></select><br/>
	Осталось до ремонта(км): <input type='text' name='do_tr_$i' size='10' placeholder='' value='$mas_fdb[11]'/>
	</p></td>
	<td $td>
	Машинист:<SELECT name='dezurstvo_mash_$i'>
	<option>$mas_fdb[12]
	<option>на рабочем месте<option>на дому<option>без дежурства<option></select>
	<input type='text' name='mashinist_graf_$i' id='mg_$i' size='14'  placeholder='ФИО маш граф' value='$mas_fdb[13]'/> / 
	<input type='text' name='mashinist_fact_$i' id='mgf_$i' size='14'  placeholder='ФИО маш факт' value='$mas_fdb[14]'/><br/>
	Помощник:<SELECT name='dezurstvo_sopr_$i'>
	<option>$mas_fdb[15]
	<option>на рабочем месте<option>на дому<option>без дежурства<option></select>
	<input type='text' name='soprov_graf_$i' id='sg_$i' size='14' placeholder='ФИО сопр граф' value='$mas_fdb[16]'/> / 
	<input type='text' name='soprov_fact_$i' id='sgf_$i' size='14' placeholder='ФИО сопр факт' value='$mas_fdb[17]'/><br/>
	Явка:<input type='datetime-local' min='$datemin' max='$datemax' name='time1_$i' id='time1_$i' value='$mas_fdb[18]'/>
	<!-- <input list='timelist' type='time' name='time1_$i' id='time1_$i' value='$mas_fdb[18]'/> -->
	<datalist id='timelist'><option value='07:00'><option value='07:30'><option value='08:00'><option value='08:30'><option value='09:00'><option value='18:00'><option value='18:30'><option value='19:00'><option value='19:30'><option value='20:00'><option value='20:30'><option value='21:00'></datalist>
	Окончание:<input type='datetime-local' name='time2_$i' id='time2_$i' value='$mas_fdb[19]'/>
	<!-- <input list='timelist2' type='time' name='time2_$i' id='time2_$i' value='$mas_fdb[19]'/> -->
	<datalist id='timelist2'><option value='07:00'><option value='07:30'><option value='08:00'><option value='08:30'><option value='09:00'><option value='18:00'><option value='18:30'><option value='19:00'><option value='19:30'><option value='20:00'><option value='20:30'><option value='21:00'></datalist>
	<br/><br/><br/><br/>
	<!--
	<br/>
	<p style='text-align: left;'>
	АВЗ: <SELECT name='avz_$i'>
	<option>$mas_fdb[22]
	<option>АВЗ техника укомплектована<option>АВЗ НЕ укомплектована</select>
	<br/>
	Подъездные пути: <SELECT name='pputi_$i'>
	<option>$mas_fdb[21]
	<option>Подъездные пути СВОБОДНЫ(очищены)<option>Подъездные пути ЗАНЯТЫ(не очищены)</select>
	</p>
	-->
	
	</td>
	<td $td>
	<textarea rows='4' name='prim_$i' cols='15'>$mas_fdb[20]</textarea><br/>
	
	</td>	
	</tr>
	";
	
}



//function tr строка для таблицы ВЫВОДА(без редактирования)
function gettrtab ($tr, $td, $mas_fdb, $mashinist, $pomoshnic, $yavka){
	
	echo "<tr $tr>
	<td $td>
	$mas_fdb[2], $mas_fdb[3]
	</td>
	<td $td>
	$mas_fdb[4]
	№ $mas_fdb[5]<br/>
	топливо в баке: $mas_fdb[6]<br/>
	Топливо запас: $mas_fdb[7]<br/>
	$mas_fdb[23]
	$mas_fdb[24]
	</td>
	<td $td>
	Кран: $mas_fdb[8]<br/>
	Вышка: $mas_fdb[9]<br/>
	Общая исправность: $mas_fdb[10]<br/>
	Осталось до ремонта(км): $mas_fdb[11]
	</td>
	<td $td>
	$mashinist
	$pomoshnic
	$yavka<br/>
	$mas_fdb[22]<br/>
	$mas_fdb[21]
	</td>
	<td $td>
	$mas_fdb[20]
	</td>	
	</tr>
	";
	
}




//chap: проверяем текущ время ищем файл (+сравнение с предыдущим файлом)-----
	if($echv != "nte"){
	
		if($period=="08-20"){
			$periodamdm="am";
			$period_tmp = "08:00";
		}else if($period=="20-08"){
		 	$periodamdm="pm";
		 	$period_tmp = "20:00";
		 }
	
	//время-дата
	if($datechenge =="ok"){
		include ("date_functions.php");
		if($period=="08-20"){
			$periodamdm="am";
			$period_tmp = "08:00";
		}else if($period=="20-08"){
		 	$periodamdm="pm";
		 	$period_tmp = "20:00";
		 }
	}
	
	if($date==""){
		$year = date(Y);
		$mes = date(m);
		$day = date(d);
		$period = date(H);

		if($period >7 and $period <19){
			$periodamdm="am";
			$period_tmp = "08:00";
		}else{
			$periodamdm="pm";
			$period_tmp = "20:00";
		}
	
	}	
		
		
		
		
		$flnm = "technics$day$periodamdm";
		$filename = "./technics/$di/$ech/$year/$mes/$flnm.csv";
//		echo("$filename<br/>");
	if (file_exists($filename)) {
		$mass_fromdb = file("$filename");
		$del_old = "";
	}else{
//		echo("Файл на текущую дату\время ещё не создан.<br/>");
		
		
		
//		подгружаем файл резерва в папке ЭЧ
		unset($mass_fromdb);
		if (file_exists("./technics/$di/$ech/technics$ech.csv")) {
			$mass_fromdb = file("./technics/$di/$ech/technics$ech.csv");
//			echo("файл резерва считан<br/>");
		//для удаления устаревших данных
		$del_old = "ok";
		}else{
			echo("Не создано ни одной записи в базе данных, создайте первую запись.");
		}
		
		
	}
	
	}
// end chaptert -----------------------------------------------------------









//view---------------------------------------------------
include("head.html");
//echo("<br/>");




//выводим шапку таблицы (с менюшкой кнопок команд)---------------------
echo("<table $tab>
	<tr>
		<td $td colspan='5'>
		<form method='post' action='technic.php' name='form'>
		ОТЧЕТ по ССПС ПО ХОЗЯЙСТВУ ЭЛЕКТРИФИКАЦИИ И ЭЛЕКТРОСНАБЖЕНИЯ НА
		<font size='5' color='#0d0198'><b>дату: </b></font><input autocomplete='off' name='date' type='text' required value='$date' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
		<font size='5' color='#0d0198'><b>период (смена):</b></font><select name='period' id='period' required ><option>$period<option>08-20<option>20-08</select>
		");
	$redact = $_GET[redact];
	if($redact==1){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;
		<a href='../technic.php/?new=1&redact=1&date=$date&period=$period' class='blue goodbutton'>Добавить технику</a>
		<input type='hidden'  name='save' value='ok' />
		<INPUT TYPE=submit class='green goodbutton' VALUE='СОХРАНИТЬ'>
		";
	}else{
		echo ("&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='hidden'  name='datechenge' value='ok' />
		<INPUT TYPE=submit class='green goodbutton' VALUE='Cмотреть>'>
		");
		if($echv != "nte"){
			echo ("
		<a href='../technic.php/?redact=1&date=$date&period=$period' class='blue goodbutton'>Редактировать</a>");
		}
		echo ("
		<a href='../technic_excel.php/?date=$date&period=$period' class='green goodbutton'>EXCEL</a>
		</form>");//здесь закрывается форма при выводе без редактирования
	}
	
		
		echo ("
		</td>
	</tr>
	<tr>
		<td $td colspan='5'>
		<b>Внимание! Удобнее использовать браузер Google Chrome или Яндекс-Браузер.</b>");
		
//		include("js.html");
		
		echo ("</td>
	</tr>
	<tr>
		<td $td>ЭЧК,ЭЧС, Место дислокации</td>
		<td $td>Тип машины, номер, топливо</td>
		<td $td>Техническое состояние  ССПС</td>
		<td $td>Дежурная бригада (по графику/факт)</td>
		<td $td>Примечания</td>
	</tr>
	");
//-----------------шапка таблицы-------------------------------------------








//если nte то грузим все БД всех ЭЧ ------------------------
if($echv == "nte"){
	include ("date_functions.php");
	$period = $_POST[period];
	if($period=="08-20"){
		$period="am";
		$period_tmp = "08:00";
	}else if($period=="20-08"){
	 	$period="pm";
	 	$period_tmp = "20:00";
	 }elseif($period==""){
	 	$period = date(H);
		if($period >7 and $period <19){
			$period="am";
			$period_tmp = "08:00";
		}else{
			$period="pm";
			$period_tmp = "20:00";
		}
	 }
	
	$interval = "$year-$mes-$day T $period_tmp";
	$interval_t = strtotime($interval);
	$interval_t12 = $interval_t - 43200;
	
	
	$dir = "./technics/$di/";
	unset ($dirs, $n_cehov);
	if (file_exists($dir)){
		$dir = opendir ("$dir");
		while ( $file = readdir ($dir)){
				if (( $file != ".") && ($file != "..")){
					$dirs[] = $file;
					$n_cehov++;
				};
		};
		closedir ($dir);
	};
	unset($str_fils);

		foreach($dirs as $folder){
			$filename = "./technics/$di/$folder/$year/$mes/technics$day$period.csv";
	if(file_exists($filename)){
			
			$str_fils = file("./technics/$di/$folder/$year/$mes/technics$day$period.csv");	
		}else{
			//подгрузка резервной БД
			$filename = "./technics/$di/$folder/technics$ech.csv";
			if(file_exists($filename)){
				$str_fils = file("./technics/$di/$folder/technics$ech.csv");
				//для удаления устаревших данных
				$del_old = "ok";
			}
			
		}
		$echrus=str_replace("ech","ЭЧ-", "$folder");
		if($folder =="ntel"){
			$echrus ="НТЭЛ";
		}
//		$echrus=str_replace("ntel","НТЭЛ", "$folder");
		echo("<tr><td $td colspan='5'><b>Техника $echrus</b></td></tr>");
			
			
			
		if(isset($str_fils)){
			
			sort($str_fils);
			
			foreach($str_fils as $str_fromdb){
				unset($count);
				$count = substr_count("$str_fromdb", "ЭЧ");
				if($count==0){
					$str_fromdb = iconv("windows-1251", "utf-8", $str_fromdb);
				}
				
				
				$mas_fdb = explode(";", "$str_fromdb");
				
			
			if($del_old == "ok"){
				$time_end_smeny = strtotime($mas_fdb[19]);
				
			//для удаления просроченных данных из резервной БД			
//			echo("time_end_smeny=$time_end_smeny<br/>interval_t12=$interval_t12<br/>interval_t=$interval_t<br/>");
			if($time_end_smeny > $interval_t12+3600 AND $time_end_smeny < $interval_t){}else{
				$mas_fdb[18]="";$mas_fdb[19]="";
				$mas_fdb[12]="";$mas_fdb[13]="";$mas_fdb[14]="";
				$mas_fdb[15]="";$mas_fdb[16]="";$mas_fdb[17]="";
				$mas_fdb[21]="";$mas_fdb[22]="";
				}
			unset($del_old);
			}
			
			
				
				
				
				
				if($mas_fdb[8]=="неисправен"){
					$mas_fdb[8]="<mark>неисправен</mark>";
				}
				if($mas_fdb[9]=="неисправна"){
					$mas_fdb[9]="<mark>неисправна</mark>";
				}
				if($mas_fdb[10]=="неисправна"){
					$mas_fdb[10]="<mark>неисправна</mark>";
				}
				if($mas_fdb[12]=="без дежурства"){
					$mas_fdb[12]="<mark>без дежурства</mark>";
				}
				if($mas_fdb[15]=="без дежурства"){
					$mas_fdb[15]="<mark>без дежурства</mark>";
				}
				$mas_fdb[20] = str_replace("b--b","<br>",$mas_fdb[20]);
		
		if($del_old =="ok"){
//			array_splice($mas_fdb, 12);
			$mas_fdb[12]="";
			$mas_fdb[13]="";$mas_fdb[14]="";$mas_fdb[15]="";$mas_fdb[16]="";
			$mas_fdb[17]="";$mas_fdb[18]="";$mas_fdb[19]="";
		}
			
			if($mas_fdb[12]!="" OR $mas_fdb[13]!="" OR $mas_fdb[14]!="")			{
				$mashinist ="Машинист: $mas_fdb[12], $mas_fdb[13] / $mas_fdb[14]<br/>";
			}
			if($mas_fdb[15]!="" OR $mas_fdb[16]!="" OR $mas_fdb[17]!="")			{
				$pomoshnic ="Помощник: $mas_fdb[15], $mas_fdb[16] / $mas_fdb[17]<br/>";
			}
	if($mas_fdb[18]!="" OR $mas_fdb[19]!=""){
		$y11=explode("T","$mas_fdb[18]");
		$y12=explode("-","$y11[0]");
		$mas_fdb[18] = "$y12[2].$y12[1].$y12[0] в $y11[1]";
		unset($y11, $y12);
		$y11=explode("T","$mas_fdb[19]");
		$y12=explode("-","$y11[0]");
		$mas_fdb[19] = "$y12[2].$y12[1].$y12[0] в $y11[1]";
		unset($y11, $y12);
		
		$yavka ="Явка: $mas_fdb[18]<br/>Окончание: $mas_fdb[19]";
	}
	
	if($mas_fdb[23]!=""){
		$mas_fdb[23]="Тормозные башмаки(всего): $mas_fdb[23]<br/>";
	}
	if($mas_fdb[24]!=""){
		$mas_fdb[24]="Башмаков под ССПС: $mas_fdb[24]<br/>";
	}
			
			gettrtab($tr, $td, $mas_fdb, $mashinist, $pomoshnic, $yavka);//просмотр без редактирования
			$i_fdb++;
			
			unset($mashinist, $pomoshnic, $yavka);
			}
		}
		unset($str_fils, $mas_fdb, $mashinist, $pomoshnic, $yavka);
			
			
		
	
	}
		
}
//----------------------вывели для НТЭ----------------------------








//читаем БД в папке ЭЧ, формируем для вывода на таблицу редактирования или БЕЗ редактирования -----
if($echv != "nte"){
	
		if($period=="08-20"){
			$periodamdm="am";
			$period_tmp = "08:00";
		}else if($period=="20-08"){
		 	$periodamdm="pm";
		 	$period_tmp = "20:00";
		 }
	
	//время-дата
	if($datechenge =="ok"){
		include ("date_functions.php");
		if($period=="08-20"){
			$periodamdm="am";
			$period_tmp = "08:00";
		}else if($period=="20-08"){
		 	$periodamdm="pm";
		 	$period_tmp = "20:00";
		 }
	}
	
	if($date==""){
		$year = date(Y);
		$mes = date(m);
		$day = date(d);
		$period = date(H);

		if($period >7 and $period <19){
			$periodamdm="am";
			$period_tmp = "08:00";
		}else{
			$periodamdm="pm";
			$period_tmp = "20:00";
		}
	
	}	
		
		
		
		
		$flnm = "technics$day$periodamdm";
		$filename = "./technics/$di/$ech/$year/$mes/$flnm.csv";
		$interval = "$year-$mes-$day T $period_tmp";
		$interval_t = strtotime($interval);
		$interval_t12 = $interval_t - 43200;
//		echo("$filename<br/>interval=$interval<br/>interval_t=$interval_t<br/>interval_t12 = $interval_t12<br/>");
	if (file_exists($filename)) {
		$mass_fromdb = file("$filename");
		$del_old = "";
	}else{
//		echo("Файл на текущую дату\время ещё не создан.");
		
		
		
//		подгружаем файл резерва в папке ЭЧ
		unset($mass_fromdb);
		if (file_exists("./technics/$di/$ech/technics$ech.csv")) {
			$mass_fromdb = file("./technics/$di/$ech/technics$ech.csv");
		//для удаления устаревших данных
		$del_old = "ok";
		}else{
			echo("Не создано ни одной записи в базе данных, создайте первую запись.");
		}
		
		
	}
	//	echo("mass_fromdb=<br/>");
	//	print_r($mass_fromdb);
	//	echo("end<br/>");
		$i_fdb = 0;
//разбиваем БД - выводим строки таблицы----------------------
		if(isset($mass_fromdb)){
			
			sort($mass_fromdb);
			
			foreach($mass_fromdb as $str_fromdb){
				unset($count);
				$count = substr_count("$str_fromdb", "ЭЧ");
				if($count==0){
					$str_fromdb = iconv("windows-1251", "utf-8", $str_fromdb);
				}
				
				$mas_fdb = explode(";", "$str_fromdb");
				
				if($mas_fdb[8]=="неисправен"){
					$mas_fdb[8]="<mark>неисправен</mark>";
				}
				if($mas_fdb[9]=="неисправна"){
					$mas_fdb[9]="<mark>неисправна</mark>";
				}
				if($mas_fdb[10]=="неисправна"){
					$mas_fdb[10]="<mark>неисправна</mark>";
				}
				
			
				
		//удаляем лишние данные с резервной бд
		if($del_old =="ok"){
			
			$time_end_smeny = strtotime($mas_fdb[19]);
//			echo("time_end_smeny=$time_end_smeny<br/>");
			if($time_end_smeny > $interval_t12+3600 AND $time_end_smeny < $interval_t){}else{
				$mas_fdb[18]="";$mas_fdb[19]="";
				$mas_fdb[12]="";$mas_fdb[13]="";$mas_fdb[14]="";
				$mas_fdb[15]="";$mas_fdb[16]="";$mas_fdb[17]="";
				$mas_fdb[21]="";$mas_fdb[22]="";
			}
			
		}
				
				
		if($redact==1){
			
			$mas_fdb[20] = str_replace("b--b","\r\n",$mas_fdb[20]);
			
			
			//строка редактирования ----------------------------
			gettr($i_fdb, $cehrus, $ceha, $stancii, $tr, $td, $mas_fdb, $datemax, $datemin);
		
			
		
		
		}else{
			if($mas_fdb[12]=="без дежурства"){
					$mas_fdb[12]="<mark>без дежурства</mark>";
				}
				if($mas_fdb[15]=="без дежурства"){
					$mas_fdb[15]="<mark>без дежурства</mark>";
				}
				$mas_fdb[20] = str_replace("b--b","<br>",$mas_fdb[20]);
			
			if($mas_fdb[12]!="" OR $mas_fdb[13]!="" OR $mas_fdb[14]!=""){
		$mashinist ="Машинист: $mas_fdb[12], $mas_fdb[13] / $mas_fdb[14]<br/>";
	}
	if($mas_fdb[15]!="" OR $mas_fdb[16]!="" OR $mas_fdb[17]!=""){
		$pomoshnic ="Помощник: $mas_fdb[15], $mas_fdb[16] / $mas_fdb[17]<br/>";
	}
	if($mas_fdb[18]!="" OR $mas_fdb[19]!=""){
		$y11=explode("T","$mas_fdb[18]");
		$y12=explode("-","$y11[0]");
		$mas_fdb[18] = "$y12[2].$y12[1].$y12[0] в $y11[1]";
		unset($y11, $y12);
		$y11=explode("T","$mas_fdb[19]");
		$y12=explode("-","$y11[0]");
		$mas_fdb[19] = "$y12[2].$y12[1].$y12[0] в $y11[1]";
		unset($y11, $y12);
		
		$yavka ="Явка: $mas_fdb[18]<br/>Окончание: $mas_fdb[19]";
	}
	
//	Тормозные башмаки(всего): $mas_fdb[23]<br/>
//	Башмаков под ССПС: $mas_fdb[24]<br/>
	if($mas_fdb[23]!=""){
		$mas_fdb[23]="Тормозные башмаки(всего): $mas_fdb[23]<br/>";
	}
	if($mas_fdb[24]!=""){
		$mas_fdb[24]="Башмаков под ССПС: $mas_fdb[24]<br/>";
	}		
			
			//строка БЕЗ редактирования ----------------------------
			gettrtab($tr, $td, $mas_fdb, $mashinist, $pomoshnic, $yavka);
		
		unset($mashinist, $pomoshnic, $yavka);
		}
			
				$i_fdb++;
			}
		}
		unset($mass_fromdb, $mas_fdb, $mashinist, $pomoshnic, $yavka);



if($redact==1){
//вывод новых строк чистых для техники----------------------
	if($new==1){
		
		$mas_fdb = array();
		gettr($i_fdb, $cehrus, $ceha, $stancii, $tr, $td, $mas_fdb, $datemax, $datemin);
		$i_fdb = $i_fdb+1;
	}
//----------------------------------------------------------


	echo("
	<input type='hidden' name='n' id='i_fdb' value='$i_fdb'/>
	</form>");
	
}
}
//-------------------------------------------------------------









echo("</table>");




echo "</body></HTML>";
?>