<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "ЭЧЦ-ОКНА из АПВО2";



//содержание 

//1. вариант * зашел без вводных > выводим окно для ввода данных
	//Стоп
//2 вариант * зашел с данными >
	// обрабатываем,
	// предлагаем определить цех
	//Стоп -----------------------------------------------------------
	
	// сохраняем
	// 
	//Стоп



// получаем данные -----------------------------------------
$vhod = $_POST[vhod];


//------------------------------------------------------------



//1. вариант * зашел без вводных > выводим окно для ввода данных ------
if($vhod ==""){
	
	include("head.html");
	
	echo("
		<div id='cont33' style='background-color:#afb632;'>
	<!-------- Форма для разбивки блоков даных из АС АПВО ---- -->
			
			<br>ВВОД ДАННЫХ из АСАПВО-2(окна):<br>
			<form method='post' action='okna_apvo2.php'>
					<p align='center'>
					<textarea rows='20' name='spisok' cols='75'></textarea>
					<p align='center'>
					<p align='center'>
					<font size='4'>  
					<p align='center'>Дата:<br>&nbsp;&nbsp;&nbsp;
					<input autocomplete='off' name='date3' type='text' value='$datenext' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
					<input type='hidden' name = 'vhod' VALUE='ok' />
					<INPUT TYPE=submit NAME=button1 VALUE='Разбить!'>
			</form>
			<!--<p>
				<a href='http://10.43.161.231/video/vvod_okon_iz_as_apvo_2й пример.wmv'>Видео как внести окна в программу смотрите здесь =>
				<img src='http://10.43.161.214/img/Video.png' width=25 alt='VIDEO' /></a>	 
			</p>-->
			
	
	</div>
	</div>

</div>

<div style='clear:both;'></div>
	");
	

	//Стоп --------------------------------------------------
}


	



//2 вариант * зашел с данными > ---------------------------------------
if($vhod =="ok"){
	//получаем данные -------------
	$spisok = $_POST["spisok"];
	$date=$_POST["date3"];
	
	
	// обрабатываем ---------------
	$spisok = str_replace("\r\n","",$spisok);
	$spisok = str_replace('\" ',"",$spisok);
	$spisok = str_replace('\"',"",$spisok);
	$spisok = str_replace('&quot;'," ",$spisok);
	$spisok = str_replace('&apos;',"",$spisok);
	$spisok = str_replace('&acute;',"",$spisok);
	$spisok = str_replace('&Prime;',"",$spisok);
	$spisok = str_replace('&lsquo;',"",$spisok);
	$spisok = str_replace('&ldquo;',"",$spisok);
	$spisok = str_replace('&rdquo;',"",$spisok);
	$spisok = str_replace('&prime;',"",$spisok);
	$spisok = str_replace('&tilde;',"",$spisok);
	$spisok = str_replace('&rsquo;',"",$spisok);
	$spisok = str_replace('"','',$spisok);
	$spisok = str_replace('\""',"",$spisok);
	$spisok = str_replace('\"""',"",$spisok);
	$spisok = str_replace("\r","",$spisok);
	$spisok = str_replace("\n","",$spisok);
	$spisok = str_replace("\ \"","",$spisok);
	$spisok = str_replace("  "," ",$spisok);
	$spisok = str_replace("   "," ",$spisok);
	$spisok = htmlspecialchars($spisok);
	
	
	
	
	//	разбиваем в массив:
	$massiv = explode("p+", "$spisok");
	
	foreach($massiv as $pitch){
		$sovpad=0;
		$sovpad=substr_count($pitch, "Снять напряжение");
		$sovpad2=substr_count($pitch, "Со снятием напряжения");
		$sovpad3=substr_count($pitch, "Снятие напряжения");
		$sovpad4=substr_count($pitch, "снятие напряжения");
		$sovpad5=substr_count($pitch, "снять напряжение");
		$sovpad6=substr_count($pitch, "ЭЧ");
		
		$sovpad = $sovpad + $sovpad2 + $sovpad3 + $sovpad4 + $sovpad5 + $sovpad6;
		
		if($sovpad > 0){
			$massiv_pitch[]="$pitch";
			
//			echo("<br/>massiv_pitch<br>$pitch<br/><br/>");

		}
	}
		$sla = ";$sl/";
		
	
	
	
	
	// предлагаем определить цех
	unset($mas_exp);
	include("head.html");
		$n=0;
	echo("<form method='post' action='okna_apvo2.php'>");
	
	foreach($massiv_pitch as $pitch){
		
		
		echo("<br/>выберите цех:<SELECT name='cehrus_$n'><option>$ceha</select><br>$pitch
		<input type='hidden' name = 'str_$n' VALUE='$pitch' />
		<br/><br/>");
		$n++;
	}
	echo("<input type='hidden' name = 'vhod' VALUE='ok2' />
		<input type='hidden' name = 'n' VALUE='$n' />
		<input type='hidden' name = 'date_apvo2' VALUE='$date' />
		<INPUT TYPE=submit NAME=button1 VALUE='Сохранить!'>
		</form>");
	
	
	//Стоп -----------------------------------------------------------
}






// сохраняем ----------------------
if($vhod =="ok2"){
	//получаем --------
	foreach ($_POST as $ArrKey => $ArrStr){
                $mass_k[$ArrKey] = $ArrStr;
        };
    $date=$_POST["date_apvo2"];
    
    
    include("head_check.php");
   /* echo("<br/><br/>mass_k<br/><br/>");
    print_r($mass_k);
    echo("<br/><br/>end<br/><br/>");*/

    
	
	// сохраняем ----------------------
	$n = $_POST[n];
	
	
	for($i = 0; $i < $n+1; $i++){
		$key = "cehrus_$i";
		$key2 = "str_$i";
	
		
			$arr_min = explode(";", $mass_k[$key2]);
//			print_r($arr_min);
			$cehrus = "$mass_k[$key]";
			$ceh="";
			include ("cehrename.php");
			include("date_functions.php");
			
			//		формируем строку для укладки в файл
			$stroka_for = "$ceh|||||||||||||$arr_min[1], $arr_min[2]||||||||||||on|||||||||||||||||||$mass_k[$key2]|";
			
//			echo("<br/>$mass_k[$key], $ceh   $date<br/>end<br/><br/><br/>");
			
		if($mass_k[$key] !=""){
			// сохраняем
			$dir = "./$di/$ech/$ceh/$year";
			if (file_exists($dir)) {
			    // echo "Каталог $dir найден<br>";
			} else {
			    mkdir("./$di/$ech/$ceh/$year");
				// echo "Каталог $dir создан<br>";
			};
			$dir = "./$di/$ech/$ceh/$year/$mesday";

			if (file_exists($dir)) {
			    // echo "Каталог $dir найден<br>";
			} else {
			    mkdir("./$di/$ech/$ceh/$year/$mesday");
				// echo "Каталог $dir создан<br>";
			};
			
				srand((double) microtime()*1000000);
		    	$filename = rand();
				$filename = "okno$otmena$filename";
			
			$dirf = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";
		    
		    if (file_exists($dirf)) {
		    	srand((double) microtime()*1000000);
	            $filename = rand();
	            $filename = "okno$otmena$filename";
				$dirf = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";			
				}
		    
		    //открываем файл
		    $file = fopen("$dirf","w+");	
			//запись данных
			fputs ($file,"$stroka_for");
			// Закрываем файл
			fclose ($file);
			
//			echo("<br/>Записан файл $stroka_for<br/><br/>");
		}else{
		 	// сохраняем в базу безхозных окон (папка okna_bezhoz)
			$dir = "./okna_bezhoz/$year";
			if (file_exists($dir)) {
			    // echo "Каталог $dir найден<br>";
			} else {
			    mkdir("./okna_bezhoz/$year");
				// echo "Каталог $dir создан<br>";
			};
			
			$dirf = "./okna_bezhoz/$year/$mesday.csv";
		    
		    
		    //открываем файл
		    $file = fopen("$dirf","a+");	
			//запись данных
			fputs ($file,"$stroka_for\r\n");
			// Закрываем файл
			fclose ($file);
		 }
			unset($stroka_for);
			
		
	}
	
	
	
	// ---------------
	
	echo("<br/><b>Данные успешно внесены.</b><br/><br/>");
	
	$date_okna_apvo2 = $date;
	include("otchet_okn2.php");
	
	//Стоп -----------------------------------------------------------
}	
	
	








echo "<br></body></html>";
?>