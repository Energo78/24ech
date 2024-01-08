<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
if($menuis!=1){
	$titl = "Журнал ЭУ-83 s";
	include "head.html";
}

//1 получаем данные
//2. сохраняем новое событие
//3. вносим изменение в событие




//1 получаем данные -----------------------------------------------------------------
$id=$_POST['id'];
$old_mes=$_POST['mes'];
$year=$_POST["year"];
$mas[0]=$_POST['Date3'];
$mas_a=$_POST['Date3'];
$eu83_time=$_POST['eu83_time'];
if ($eu83_time ==""){
	$eu83_time = date("H:i");
}
$mas[0]="$mas[0] $eu83_time";
$mas[1]=$_POST['mesto'];
$mas[2]=$_POST['hrono'];
$mas[3]=$_POST['ustr'];
$mas[4]=$_POST['soob'];
$mas[5]=$_POST['prich'];
$mas[6]=$_POST['nte'];
$mas[7]=$_POST['meropr'];
$mas[8]=$_POST['otvetstvenny_ceh'];
$mas[11]=$_POST['top_secret'];
$mas[14]=$_POST['eu83svet'];


$filetime=$_POST["filetime"];





//замена \r\n
for ($x=0; $x <=7 ; $x++)
{
        $mas[$x] = str_replace("\r\n","b--b",$mas[$x]);
        $mas[$x] = str_replace("\n","b--b",$mas[$x]);
        $mas[$x] = str_replace("\""," ",$mas[$x]);
        $mas[$x] = str_replace("\\"," ",$mas[$x]);
};

// определяем месяц
$dat = explode(".", $mas_a);
$mes = $dat[1];
$year = $dat[2];
//echo "$mes";
if ($mes=="")
{
        echo "Вы не указали дату события";
        exit;
};










//2. сохраняем новое событие ------------------------------------------------------------------------
if ($id==""){
//	проверяем наличие файла
	$dirf = "./eu83/eu83db$di$ech$mes.$year.csv";
	
	if (file_exists($dirf)){//  echo "Файл найден<br>";
        // сколько строк в БД ЭУ-83
		$file_array =  file ("./eu83/eu83db$di$ech$mes.$year.csv");
		
		$id = 1 + count($file_array);
		
		if($file_array[0]=="" and $id == 1){
			$nr = "";
		}else{
			$nr = "\n";
		}
		
//		unset ($file_array);
    }else{
    	$nr = "";		
	}
	
	
	
	// подготовка строки для сохранения в файл
	$str_new = "$mas[0]|$mas[1]|$mas[2]|$mas[3]|$mas[4]|$mas[5]|$mas[6]|$mas[7]|$mas[8]|$id||$mas[11]|$ipv|$ech|$mas[14]|\n";
	// открываем файл
	$file =  fopen ("./eu83/eu83db$di$ech$mes.$year.csv","a+");
	if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
	// добавляем строку нового события
		fputs ($file,"$str_new");
	}else{
		echo "Не удалось получить блокировку !";
	}
	// закрываем файл
	flock($file, LOCK_UN);
	fclose ($file);
	
	//пишем лог-файл ----------------------------
	$forlog1 = "Вводится новое событие, Is enter the new incident.";
	$forlog2 = "$str_new";
	include("eu83_log.php");
	unset($forlog1, $forlog2);
	//---------------------------------------------
	
	
//	echo("НОВАЯ ЗАПИСЬ eu83/eu83db$di$ech$mes.$year.csv");
		$inc_83 = 1; //для отображения корректной даты
		include "eu83.php";
        exit;
};//--------------------------------------------------------------------------------







//3. вносим изменение в событие  ----------------------------------------------------
if ($id != ""){
                        //логика при изменении месяца:
                        if ($mes==$old_mes){}
                        else{
                                echo "Пока что нет возможности перенести событе из одного месяца в другой, для переноса следует удалить событие в одном месяце и внести событие заново.";
                                exit;
                        };
        
        
        //3.1. разбиваем файл данных в массив по строкам
        $file_array =  file ("./eu83/eu83db$di$ech$mes.$year.csv");
        $n=0;
		
		if(!$file_array){
			echo("Ошибка чтения файла для изменения!");
		}else{
		    for($i=0; $i < count($file_array); $i++){
	        	$massiv[$n] = $file_array[$i];
	        	$n++;
        	}
		};
        
        
        $forlog1 = $massiv[$id];//для лога
        //Заменяем строку
        $massiv[$id] = "$mas[0]|$mas[1]|$mas[2]|$mas[3]|$mas[4]|$mas[5]|$mas[6]|$mas[7]|$mas[8]|$id||$mas[11]|$ipv|$ech|$mas[14]|";
        $forlog2 = $massiv[$id];//для лог-файла
        
        $massiv[$id] = str_replace("\r\n","b--b",$massiv[$id]);
        $massiv[$id] = str_replace("\n","b--b",$massiv[$id]);
        $massiv[$id] = "$massiv[$id]\n";
//        sort ($massiv);
        
        //сохраняемся
        $file =  fopen ("./eu83/eu83db$di$ech$mes.$year.csv","w+");
			if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
				for ($x=0; $x <=$n ; $x++)
				{
					fputs ($file,"$massiv[$x]");
				};
			}else{
				echo "Не удалось получить блокировку !";
			}
			flock($file, LOCK_UN);
        fclose ($file);
		
		
        //пишем лог-файл изменения события
		include("eu83_log.php");
		unset($forlog1, $forlog2);
                
};//-----------------------------------------------------------------------------------------



$inc_83 = 1; //для отображения корректной даты
include "eu83.php";





?>