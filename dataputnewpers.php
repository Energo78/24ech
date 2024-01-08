<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
// unset ($zapretredact);

//include "head.html";
	

//получаем данные
$di=$_POST["di"];
$ech=$_POST["ech"];
$date=$_POST["date"];
$ceh=$_POST["ceh"];
$cehrus=$_POST["cehrus"];
$redactf=$_POST["redactf"];

// $filname=$_POST['redactf'];



//1. БЛОК РЕДАКТИРОВАНИЯ ПОЛУЧЕННЫХ ДАННЫХ

foreach ($_POST as $ArrKey => $ArrStr)
        {
                $mass[] = $ArrStr;
                $keymas[] = $ArrKey;
        };
        
        
$mass = str_replace("\r\n","b-b",$mass);
$mass = str_replace("\r","b-b",$mass);
$mass = str_replace("\"","",$mass);
$mass = str_replace("\\","",$mass);
$keymas = str_replace("\r\n","b-b",$keymas);
$keymas = str_replace("\r","b-b",$keymas);
$keymas = str_replace("\"","",$keymas);
$keymas = str_replace("\\","",$keymas);
		// print_r ($mass); echo"</br></br>";
		// print_r ($keymas); echo"</br></br>";
		
for ($i=0;$i < count($keymas); $i++)
        {
                $massiv[$keymas[$i]] = $mass[$i];
				
        };
// print_r ($massiv); echo"</br></br>";

$massiv = str_replace("\r\n","b-b",$massiv);
$massiv = str_replace("\r","b-b",$massiv);
$massiv = str_replace("\"","",$massiv);
$massiv = str_replace("\\","",$massiv);
$massiv[44] = str_replace("b-b",";",$massiv[44]);
//х


//2 БЛОК ЗАПИСИ НОВЫХ ДАННЫХ

// Дата
$year = substr ("$date", 6, 4);
$mes = substr ("$date", 3, 2);
$day = substr ("$date", 0, 2);
$mesday = "$mes$day";


//echo "Год $year</br></br>Месяц: $mes</br></br>День $day</br></br>";

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
                srand((double) microtime()*1000000);
                $filename = rand();
//открываем файл
	if ($redactf !=""){
		$dirf = "$redactf";
	}else{
		$dirf = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";
	};
        $file = fopen("$dirf","w+");
		
//Цикл ввода данных
fputs ($file,"$massiv[ceh]");fputs ( $file,"|"); //0-наименование цеха

for ($i=1; $i <= 30; $i++){
	fputs ($file,"$massiv[$i]");fputs ( $file,"|");
};
for ($i=20; $i <= 50; $i++){
	if ($keymas[$i] !="" and $keymas[$i] > 100000){
		fputs ($file,"$keymas[$i]");fputs ( $file,";");
	};
}; fputs ( $file,"|");
	
for ($i=32; $i <= 46; $i++){
	fputs ($file,"$massiv[$i]");fputs ( $file,"|");
};

// Закрываем файл
		fclose ($file);




// Запись в БД объектов (objects) ------------------------------------------------
$tmp="0";
if($tmp=="0"){//check on ip for developer
//echo("ok for objects");
/*}else{*/			
	//	читаем БД объектов
		$dir = "./$di/$ech/$ceh/objects_$ceh.csv";
		
		if(file_exists($dir)){
		
//			$file_ex = 1;
			$file_array =  file ("./$di/$ech/$ceh/objects_$ceh.csv");
			
		
		}else{//если нет файла БД objects то создаём и сразу вносим строки
		
			$file =  fopen ("./$di/$ech/$ceh/objects_$ceh.csv","w+");
				if($massiv[7] !=""){
					fputs ($file,"$massiv[7];");
				}
				if($massiv[9] !=""){
					fputs ($file,"$massiv[9];");
				}
			fclose ($file);
			unset($file_array);
			$file_array =  file ("./$di/$ech/$ceh/objects_$ceh.csv");
		}

		
		$string_db = $file_array[0];
		$db_objects = explode(";","$string_db");
		
		unset($sovpad_7, $sovpad_9);
		foreach($db_objects as $obj){
			if($obj==$massiv[7]){
				$sovpad_7 = $sovpad_7+1;
//				echo("sovpad_7 = $sovpad_7<br/>");
			}else if($obj==$massiv[9]){
			 	$sovpad_9 = $sovpad_9+1;
//			 	echo("sovpad_9 = $sovpad_9<br/>");
			 }
		}
		
		if($sovpad_7 > 0 and $sovpad_9 > 0){
//			echo("всё совпало добавлять в БД ничего не надо..<br/>");
		}else{
			if($sovpad_7 == ""){
				$string_db = "$string_db"."$massiv[7]".";";
			}
			if($sovpad_9 == ""){
				$string_db = "$string_db"."$massiv[9]".";";
			}
		
		//	добавляем в БД строку в соответствии с порядком её в общей БД
		$id_pc = $_SERVER["DOCUMENT_ROOT"];
		include "$id_pc/config.php";
		$kp_arr = explode("<option>", $kontr_punct);
//		print_r($kp_arr);
//		$kp_arr_flip = array_flip($kp_arr);
		
		unset($db_objects, $string_db_new);
		$db_objects = explode(";","$string_db");
		
			foreach($kp_arr as $obj){
				if(in_array("$obj", $db_objects) and $obj != ""){
					$string_db_new = "$string_db_new"."$obj;";
				}
			}
			
			/*echo("massiv[7] = $massiv[7]<br> massiv[9] = $massiv[9]<br>
		string_db = $string_db<br/>string_db_new = $string_db_new<br/>
		");*/
			
			//	записываем БД в файл
		$file =  fopen ("./$di/$ech/$ceh/objects_$ceh.csv","w+");
			if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
				fputs ($file,"$string_db_new");
			}else{
				echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
			}
		flock($file, LOCK_UN);
		fclose ($file);
			
			
		//Пишем лог (временный для проверки, потом удалить)
		$file =  fopen ("./log/objects_log.csv","a+");
			if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
				fputs ($file,"$ceh".";"."$string_db_new"."\r\n");
			}else{
				echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
			}
		flock($file, LOCK_UN);
		fclose ($file);
			
			
			
		}
		
		
		
		

	
	
	
	
	

}
//----------end "objects" --------------------------------------------------------


	unset($vvod, $redactf, $_POST['redactf']);

	include("arm_nach_ceh.php");















 ?>