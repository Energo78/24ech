<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
//инклюдим заголовок, блокировку по ай-пи
$titl = "ЭЧЦ-ОКНА";
include "head.html";
include "config.php";

$d1 = date("d.m.Y");
$date=$_POST["date3"];
include "date_functions.php";
$mesday = "$mes$day";
include "ceha.php";


echo "<br>";
//получаем данные
	$spisok = $_POST["spisok"];
//	$dir = "./data/$date1";

//Чистим блок текста ========= =- ------------------------=== ==========
	$spisok = str_replace("\r\n","",$spisok);
	$spisok = str_replace('\" ',"",$spisok);
	$spisok = str_replace('\"',"",$spisok);
	$spisok = str_replace('&quot;',"",$spisok);
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
	//$spisok = str_replace(";","|",$spisok);
	$spisok = str_replace("\"ЭЧ-1","ЭЧ-1",$spisok);
	$spisok = str_replace("По согл. ДНЦ ","",$spisok);
	$spisok = str_replace("\r","",$spisok);
	$spisok = str_replace("\n","",$spisok);
	$spisok = str_replace("\ \"","",$spisok);
	$spisok = str_replace("  "," ",$spisok);
	$spisok = str_replace("   "," ",$spisok);
	//$spisok = str_replace("ОТМЕНАФакт:","|",$spisok);
	//$spisok = str_replace("Факт:","",$spisok);
	//$spisok = str_replace("План: 0","",$spisok);
//------------------------------------------------------------------------


//Разбиваем по дате на стоки с отдельными окнами
	$str_exp = explode(";$date;", $spisok);
	
//	echo("$ceha");
	$ceha_mas = explode("<option>", $ceha);
//	print_r($ceha_mas);
	$n_str = 0;
	foreach($str_exp as $str_e){
//		echo("$str_e<br><br>");
		echo("<br>ОКНО начало: -------------------------------------<br>");
		unset($str_e2);
		$str_e2 = explode(";", $str_e);
		$strochka = "$str_e2[0]";
		//ищем какой цех
		foreach($ceha_mas as $name_c){
			$name_c = "$name_c";
			//echo("  name_c = $name_c  ");
			$a="-0";  $b = "-";
			if($name_c !=""){
				$sovpad1 = substr_count("$strochka","$name_c");
				$name_c2 = str_replace($a,$b, $name_c);
				//echo(" after replace: name_c = $name_c2");
				
				
				
				$sovpad2 = substr_count("$strochka", "$name_c2");
				$sovpad3 = substr_count("$strochka", "24,25");
				if($sovpad3 !=""){//фиксим ЭЧК-24,25
					$name_c = "ЭЧК-2425";
				}
				if($sovpad1 !="" or $sovpad2 !=""){
					unset($cehrus, $ceh);
					$cehrus = $name_c;
					include"cehrename.php";
					echo("<br>ЦЕХ = $name_c  и ceh= $ceh<br>");
				}else{
					//echo("<br>ЦЕХнепрошел = $name_c<br>");
				}
				unset($sovpad1, $sovpad2, $sovpad3);
			}
				
		}
		
		
		
		
		//выводим на экран
		$n_e = 0;
		foreach($str_e2 as $str_e21){
			if($str_e21 !="" and $n_str > 0){
				echo("N = $n_e  => $str_e21<br>");
			}
			
			$n_e++;
		}
		
//		формируем строку для укладки в файл
		
		if($ceh ==""){
			$ceh = "echa";
		}
		$stroka_for = "$ceh|N||||||||||$str_e2[1]||$str_e2[2]||||||||||||on|||||||||||||||||||$str_e2[3];$str_e2[4];$str_e2[5];$str_e2[6];$str_e2[7];$str_e2[8];$str_e2[9];$str_e2[10];$str_e2[11];$str_e2[12];$str_e2[13];$str_e2[14];$str_e2[15];$str_e2[16];$str_e2[17];$str_e2[18];$str_e2[19];$str_e2[20];$str_e2[21];$str_e2[22]|";
//		адрес укладки
		echo "Год $year  Месяц: $mes День $day</br></br>";
		
		echo("stroka_for = $stroka_for<br>");

//БЛОК ЗАПИСИ ФАЙЛА ОКНА В БД -------------->>>>
	if($n_str > 0){
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
		//присваиваем имя новому файлу
			$sovpad1 = substr_count("$str_e2[3];$str_e2[4];$str_e2[5]","ОТОЗВАНО");
			$sovpad2 = substr_count("$str_e2[3];$str_e2[4];$str_e2[5]", "ОТМЕНА");
			$sovpad3 = substr_count("$str_e2[3];$str_e2[4];$str_e2[5]", "ОТКАЗ");
			if($sovpad1 !=0 or $sovpad2 !=0 or $sovpad3 !=0){
					$otmena="otmena";
			}else{$otmena="";}
							
			
		                srand((double) microtime()*1000000);
		                $filename = rand();
		                $filename = "okno$otmena$filename";
		//открываем файл
				$dirf = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";
		        $file = fopen("$dirf","w+");
				
		//запись данных
		fputs ($file,"$stroka_for");
		// Закрываем файл
		fclose ($file);
	};
//БЛОК ЗАПИСИ ФАЙЛА ОКНА В БД -------------->>>>





		echo("<br>КОНЕЦ ОКНА n_str = $n_str ---------------------------------------<br>");
		unset($name_c, $stroka_for);
	$n_str++;
	}
//-----------------













echo "<br></body></html>";
?>