<?php
// ini_set('display_errors',1);
// Error_Reporting(E_ALL & ~E_NOTICE);
//функция чтения каталога
function getfolder ($dir){
	unset ($dirs);
	if (file_exists($dir)){
		$dir = opendir ("$dir");
		while ( $file = readdir ($dir)){
				if (( $file != ".") && ($file != "..")){
					$dirs[] = $file;
				};
		};
		closedir ($dir);
//		echo "</br>Всего $n_cehov предприятий подключены к программе !</br>";
//		print_r ($dirs);
		return($dirs);
	};
};



//читаем папку дирекции
	$dir = "./di_01/";
//	$dir = "./technics/di_01/";//ЕСЛИ ПОНАДОБИТСЯ
	
	$dirs = getfolder ($dir);
		
		echo "<html><head></head><body>
		</br>подключены к программе !</br>";
		print_r ($dirs);echo("<br/>");
	foreach($dirs as $ech_t){
		$dir = "./di_01/$ech_t/";
		$dirs_0 = getfolder ($dir);
		echo("in folder $ech_t:<br/>");
		print_r ($dirs_0);echo("<br/>");
		
		foreach($dirs_0 as $ceh_t){//пробегаем по цехам
			$dir_1 = "./di_01/$ech_t/$ceh_t/";
			//выдаём кнопки цехов:
			echo("<form  method='post' action='change_charset.php'>
				<input type='hidden' name = 'ceh_f_change' VALUE='$dir_1' />
				<INPUT TYPE=submit NAME=button1 VALUE='$ceh_t'>
			</form>");
			
		}
		
	}
	
	
$ceh_f_change = $_POST[ceh_f_change];
//если кнопка цеха нажата!
if($ceh_f_change!=""){
	//	здесь по папке цеха пробегаем
	$dirs_1 = getfolder ($ceh_f_change);
			echo("in folder $ceh_t:<br/>");
			print_r ($dirs_1);echo("<br/>");
			
			foreach($dirs_1 as $year){//пробегаем годы в папке цеха
				$dir_2 = $ceh_f_change."$year";
				if(is_dir("$dir_2")){
					echo("<br/><br/>$dir_2 - this is DIR<br/>");
					$dirs_3 = getfolder ($dir_2);
					foreach($dirs_3 as $day_t){
						$dir_end = $dir_2."/$day_t";
						if(is_dir("$dir_end")){
							$dirs_end = getfolder ($dir_end);
//							echo("<br/>in folder DAY $day_t :<br/>");
//							print_r($dirs_end);echo("<br/>");
							//здесь вставляем функцию изменения кодировки
							foreach($dirs_end as $filename_end){
					$filename_end = "$dir_end"."/$filename_end";
					
//					echo"$filename_end - is FILE<br/>";
					
					unset($file_array);
					$file_array =  file ("$filename_end");
// Блокировка файла и запись ------------------
	$file =  fopen ("$filename_end","w+");
		if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
		foreach($file_array as $string){
			$string_utf = iconv("windows-1251//IGNORE", "utf-8//IGNORE", $string);
			fputs ($file,"$string_utf");
		}
		}else{
			echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
				}
	flock($file, LOCK_UN);
	fclose ($file);
// --------------------------------------			
							}
						}
					}
				}else{
//					echo("$dir_2 - this is FILE<br/>");
unset($file_array);
$file_array =  file ("$dir_2");
// Блокировка файла и запись 2222 ------------------
	$file =  fopen ("$dir_2","w+");
		if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
		foreach($file_array as $string){
			$string_utf = iconv("windows-1251//IGNORE", "utf-8//IGNORE", $string);
			fputs ($file,"$string_utf");
		}
		}else{
			echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
				}
	flock($file, LOCK_UN);
	fclose ($file);
// --------------------------------------
					
				}
				
			}
}
	

		
/* НЕ РАСКОМЕНТИРОВАТЬ!!! ТОЛЬКО ПРИ ДЕКОДИРОВАНИИ ОТДЕЛЬНОЙ ПАПКИ ВРУЧНУ
//for decoding folders conc ------------------------
	
	$dir = "./eu83/";//folder for chenge!!!!!!!
	//$dir = "./telefons/";//folder for chenge!!!!!!!

$dirs_0 = getfolder ($dir);
foreach($dirs_0 as $fil){
	$filename = "$dir"."$fil";
unset($file_array);
$file_array =  file ("$filename");
// Блокировка файла и запись 2222 ------------------
	$file =  fopen ("$filename","w+");
		if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
		foreach($file_array as $string){
			$string_utf = iconv("windows-1251//IGNORE", "utf-8//IGNORE", $string);
			fputs ($file,"$string_utf");
		}
		}else{
			echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
				}
	flock($file, LOCK_UN);
	fclose ($file);
// --------------------------------------
}


//print_r($dirs_0);echo("<br/>");
//--------------------------------------------------

*/









echo "</body></html>";

?>