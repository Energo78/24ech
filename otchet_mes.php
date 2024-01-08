<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "ОТЧЁТ за МЕСЯЦ";
include "head.html";

//soderjanie:
//1 получаем данные post
//2 читаем папки с работами + выводим данные




//1 получаем данные post
	$cehrus=$_POST["cehrus"];
	$mes=$_POST["mes"];
	$year=$_POST["year"];
	include "cehrename.php";
	
	
	unset($mass, $keymas, $mas_otch_v1);
	foreach ($_POST as $ArrKey => $ArrStr)
    {
		$mass[] = $ArrStr;
        $keymas[] = $ArrKey;
        $mas_otch_v1[$ArrKey] = $ArrStr;
	};
	
		
//	print_r($mass); echo("</br>");
//	print_r($keymas); echo("</br>");
	$keymas2 = array_splice($keymas, count($input), 4);
	
//	print_r($keymas2); echo("</br>");
	//print_r($keymas); echo("</br>$count_arr</br>"); // - здесь номера выбранных работ в фильтре
	$count_arr = count($keymas);
//	echo("</br>$count_arr</br>");
//	print_r($mas_otch_v1); echo("</br>");
	
	
	echo "ОТЧЁТ О РАБОТЕ $cehrus ЗА $mes МЕСЯЦ $year ГОДА.<br>";

//2 читаем папки с работами + выводим данные
	$notchm=0;
	
	if($count_arr == 0){
		echo("фильтр не применён, выводим все работы<br/>");
	};
	
	
	echo "<div id='rabots'><table>";
	
	
	for ($i=1; $i < 32; $i++){
		$day = "$i";
		$day = str_pad($day, 2, "0", STR_PAD_LEFT);
		$mesday = "$mes$day";
		//проверяем наличие папки
		$dir = "./$di/$ech/$ceh/$year/$mesday";
		if (file_exists($dir)){
			//echo "$mesday -- ";
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir)){
				
				if (( $file != ".") && ($file != "..")){
						$notchm++;// возвращаем число файлов
						//echo "$file ---<br>";
						$otmena = substr_count("$file","otmena");
						if($otmena !=0){
							break;
						}
						$file = fopen("./$di/$ech/$ceh/$year/$mesday/$file","r");
						
						$strip = fgets ($file);
						
						fclose ($file);
						$dateotchmes = "$day.$mes.$year";
						$maswork = explode("|", $strip);
						
						//применяем фильтр
						if($count_arr > 1){
							foreach($keymas as $ke){
								if($maswork[$ke]=="on"){
									include "onework.php";//выводим строку таблицы
								}elseif($ke =="12"){
									if($maswork[$ke]!=""){
										include "onework.php";//выводим строку таблицы (распоряжение)
									}
								}
							}
						}else{
							/*echo("фильтр не применён, выводим все работы<br/>");*/
							include "onework.php";//выводим строку таблицы
						}
						
						
						
						// echo "$strip<br>";
				};
			};
			closedir ($dir);
		}
	}	
	
	
	
	
	echo "</table></div>";
	echo"ВСЕГО ЗАРЕГИСТРИРОВАНО РАБОТ: $notchm.";
	
//excel







?>