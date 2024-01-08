<?php
// ini_set('display_errors',1);
// Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Загрузка Файла";
include "head.html";

// Содержание:
// 1. 
// 2. 
// 3. 

$vhod = $_POST[vhod];
//echo "vhod: $vhod<br>";
//1. загрузка файла и обработка в массив строк для дальнейшего присвоения цехов ------------
if($vhod =="zagruzka"){
	ini_set('upload_max_filesize', '4M'); //ограничение в 3 мб
	unset($massiv_pitch);
	 if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
	 	
		 $destiation_dir = dirname(__FILE__) .'/upload/'.$_FILES['inputfile']['name']; // Директория для размещения файла
		 $typ = $_FILES['inputfile']['type'];
		 if($typ =="application/vnd.ms-excel" OR $typ=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
		 move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию
	//	 echo 'Файл загружен!<br>';  //Оповещаем об успешной загрузке файла
		 
	//	 echo "Тип файла: $typ<br>";	
		 
		 
		// Подключаем класс для работы с excel
		require_once('Classes/PHPExcel.php');
		
		
		$excel = PHPExcel_IOFactory::load("$destiation_dir");
		//Далее формируем массив из всех листов Excel файла с помощью цикла:

		Foreach($excel ->getWorksheetIterator() as $worksheet) {
		 $lists[] = $worksheet->toArray();
		}
		//Вывод сформированного массива в виде HTML таблиц(ы) :
		foreach($lists as $list){
			
			// Перебор строк
			foreach($list as $row){
				
				// Перебор столбцов
				unset($sovpad, $string);
				
				foreach($row as $col){
					$col = iconv("utf-8", "windows-1251", $col);
					
					// обрабатываем ---------------
					$col = str_replace("\r\n","",$col);
					$col = str_replace('\" ',"",$col);
					$col = str_replace('\"',"",$col);
					$col = str_replace('&quot;'," ",$col);
					$col = str_replace('&apos;',"",$col);
					$col = str_replace('&acute;',"",$col);
					$col = str_replace('&Prime;',"",$col);
					$col = str_replace('&lsquo;',"",$col);
					$col = str_replace('&ldquo;',"",$col);
					$col = str_replace('&rdquo;',"",$col);
					$col = str_replace('&prime;',"",$col);
					$col = str_replace('&tilde;',"",$col);
					$col = str_replace('&rsquo;',"",$col);
					$col = str_replace('"','',$col);
					$col = str_replace('\""',"",$col);
					$col = str_replace('\"""',"",$col);
					$col = str_replace("\r","",$col);
					$col = str_replace("\n","",$col);
					$col = str_replace("\ \"","",$col);
					$col = str_replace("  "," ",$col);
					$col = str_replace("   "," ",$col);
					$col = htmlspecialchars($col);
									
					
					$sovpad=substr_count("$col", "Снять напряжение");
					$sovpad2=substr_count("$col", "Со снятием напряжения");
					$sovpad3=substr_count("$col", "Снятие напряжения");
					$sovpad4=substr_count("$col", "снятие напряжения");
					$sovpad5=substr_count("$col", "снять напряжение");
					
					$sovpad = $sovpad + $sovpad2 + $sovpad3 + $sovpad4 + $sovpad5;
				
					$string = "$string"."$col;";

				}
				
					$sovpad=substr_count($string, "Снять напряжение");
					$sovpad2=substr_count($string, "Со снятием напряжения");
					$sovpad3=substr_count($string, "Снятие напряжения");
					$sovpad4=substr_count($string, "снятие напряжения");
					$sovpad5=substr_count($string, "снять напряжение");
					$sovpad5=substr_count($string, "ЭЧ-");
					
					$sovpad = $sovpad + $sovpad2 + $sovpad3 + $sovpad4 + $sovpad5;
					
					
						if($sovpad > 0){
							$massiv_pitch[]="$string";
	//						echo "$string<br/><br/>";
							
						}
					
					
			}
				
		}	
		 
		 
		 }else{
		 
		 		echo 'Ошибка загрузки файла1!';
		  }
		 
	 }else{
	 	 	echo 'Ошибка загрузки файла2!';
	}

}
//end of 1 -------------------------------------------------------------------




// 2 сохранение окон в цеха и остатки в БД неопределённых по цехам окон (работа с $massiv_pitch) ----------
if($vhod =="zagruzka"){
	if($massiv_pitch !=""){
		$date=$_POST["date3"];
		$n=0;
	echo("<form method='post' action='upload.php'>");
	
	foreach($massiv_pitch as $pitch){
		
		
		echo("<br/>выберите цех:<SELECT name='cehrus_$n'><option>$ceha</select><br>$pitch
		<input type='hidden' name = 'str_$n' VALUE='$pitch' />
		<br/><br/>");
		$n++;
	}
	echo("<input type='hidden' name = 'vhod' VALUE='saving' />
		<input type='hidden' name = 'n' VALUE='$n' />
		<input type='hidden' name = 'date_apvo2' VALUE='$date' />
		<INPUT TYPE=submit NAME=button1 VALUE='Сохранить!'>
		</form>");
	
		$no_form1 = "ok";
	}
}

// end of 2 ----------------------------------------------------------------------




//3. сохраняем полученные данные по папкам цехов и в базу безхозных окон ------------------
$vhod = $_POST[vhod];
if($vhod =="saving"){
	//получаем --------
	foreach ($_POST as $ArrKey => $ArrStr){
                $mass_k[$ArrKey] = $ArrStr;
        };
    $date=$_POST["date_apvo2"];
    
    
//    include("head_check.php");
    /*echo("<br/><br/>mass_k<br/><br/>");
    print_r($mass_k);
    echo("<br/><br/>end<br/><br/>");*/


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
	
//	$date_from_upload = $date;
//	include("otchet_okn2.php");
	
}
//end of 3 -----------------------------------------------------------




//4. вывод формы загрузки файла ---------------------------------------------------
	if($no_form1 !="ok"){
		echo "
		<h3>Загрузка файла (только xls или xlsx):</h3>
		<form method='post' action='upload.php' enctype='multipart/form-data'>
		<input type='hidden' name = 'vhod' VALUE='zagruzka' />
		<label>Выберите дату: </label>
		<input autocomplete='off' name='date3' type='text' value='$datenext' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
		<label for='inputfile'>Выберите excel файл приказа на окна (до 4 мегабайт): </label>
		<input type='file' id='inputfile' name='inputfile'></br></br>
		<input type='submit' value='Загрузить'>
		</form>
		";
	}


// end of 4 -----------------------------------------------------------------------




echo "</body></HTML>";







/*if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
	if ($_FILES['inputfile']['error'] == UPLOAD_ERR_OK && $_FILES['inputfile']['type'] == 'image/pjpeg') { //проверка на наличие ошибок
		$destiation_dir = dirname(__FILE__) . '/upload/' . $_FILES['inputfile']['name']; // директория для размещения файла
		if (move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir)) { //перемещение в желаемую директорию
			echo 'Файл загружен успешно!'; //оповещаем пользователя об успешной загрузке файла
		} else {
			echo 'Ошибка загрузки файла..';
		}
	} else {
		switch ($_FILES['inputfile']['error']) {
			case UPLOAD_ERR_FORM_SIZE:
			case UPLOAD_ERR_INI_SIZE:
			echo 'Размер файла превышен';
			brake;
			case UPLOAD_ERR_NO_FILE:
			echo 'Файл не выбран';
			break;
			default:
			echo 'Возникла ошибка';
		}
	}
}
*/
 ?>