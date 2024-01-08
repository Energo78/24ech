<?php //сохранение данных из POST

ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//include "config.php";

//устанавливаем дату
if ($date==""){$date=$_POST["date"];}
if ($date==""){$date = date('d.m.Y');};
if ($date1 != ""){$date = $date1;};
// echo "! ---- $date --- !</br>";
include "date_functions.php";
// echo "! ---- $date --- !</br>";
$mesday = "$mes$day";
// echo "! ---- $mesday --- !</br>";

$titl = "АРМ планирование цеха";
$cehrus = ($_COOKIE[cehrus]);
$cehrus2=$_POST["cehrus"];

if($cehrus=="" or $cehrus2 !=""){
		$cehrus=$_POST["cehrus"];
		include "cehrename.php";
		setcookie("cehrus", "$cehrus", time() + 60000);
}else{
	$cehrus = ($_COOKIE[cehrus]);
	include "cehrename.php";
}
include "head.html";
// echo "cehrus = $cehrus - !";

//день недели
$dat_a = explode(".", "$date");
$dayweek = date(N, mktime(0,0,0,$dat_a[1],$dat_a[0],$dat_a[2]));
//echo "dayweek = $dayweek - !<br>";




//фдн формируем даты недели -------------------------------------
$dayw[$dayweek] = $date;
$dayj = $date;
$n=$dayweek-1;
$dayw[$n]=$dateold;
$n=$dayweek+1;
$dayw[$n]=$datenext;

for($n=0;$n<9;$n++){
	if($dayw[$n]==""){
		$y = $n - $dayweek;
		$dayw[$n]=strtotime($date)+ $y*86400;
		$dayw[$n]=date('d.m.Y',$dayw[$n]);
	}
	// echo "<br>!- $dayw[$n]";
}
//конец фдн -------------------------------------------------------




// *** - получаем данные POST ---------------------------------------

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
//		  print_r ($mass); echo"</br></br>";
//		  print_r ($keymas); echo"</br><//br>";
		 



//меняем ключи и значения
$keymas2 = array_flip($keymas);
//print_r ($keymas2); echo"</br></br>";


$a = 0;
while($endwhile = 1){
	$key1 = "redactf".$a;
	if($a>100){
//		echo("<br>a > 100");
		break 1;
	}elseif(isset($keymas2[$key1])===FALSE){
		break 1;
	}
	$key2[$a] = $keymas2[$key1];
	//$key2 - массив номеров начал отдельных работ
	
//	echo("$key1  = $key2[$a] ; ");
	$a++;
}

$key2[$a]= count($keymas2) - 6; //6-кол-во hiden в форме отправки
$a3 = $key2[$a];
$a4 = $a3+3;// ключ имени цеха
//echo"<br>Число полученных работ (от нуля): a=$a  конечный номер: a3=$a3</br>";

//print_r ($key2); echo"</br></br>";


for($a2=0; $a2 < $a+1; $a2++){// перебор файлов----------------------------------
	$x1 = (int)$key2[$a2];
	$x3 = (int)($a2+1);
	$x2 = (int)$key2[$x3];
	$x4 = $x2 - $x1 + 1;//для ввода данных
	if($x2==0){	break 1;}
	
	
	
//	echo("<br>x1 = $x1 and x2 = $x2<br>mass[x1] = $mass[$x1], mass[a4]=$mass[$a4] <br>");
	
	
	
			$pos = strpos($mass[$x1], $mass[$a4]);
			if($pos == TRUE){//файл есть, старый в архив, добавляем новый
//				echo("$mass[$x1], $mass[$a4], pos = TRUE!<br>");
				// читаем файйл ./di_01/ech01/echk02/2018/1009/*****.csv --------------
				$filename = "$mass[$x1]";
				$file = fopen("$filename","r");
				if(!file){
					echo("Ошибка открытия файла ");
				};
				$stroka = fgets ($file);
				fclose ($file);
				
				
				//пишем его в архив -----------------------------
					//есть ли дирректория, если нет - создаём
					$dir = "./$di/$ech/$ceh/archives";
					if (file_exists($dir)) {
//						echo "Каталог $dir найден<br>";
					} else {
						mkdir("./$di/$ech/$ceh/archives");
//						echo "Каталог $dir создан<br>";
					};
				
				
				$filename_archiv = "./$di/$ech/$ceh/archives/$year$mes.csv";
				
				$file =  fopen ("./$di/$ech/$ceh/archives/$year$mes.csv","a+");
				if (flock($file, LOCK_EX)) { // выполняем эксклюзивную блокировку
					$datetime = date("d.m.Y Время H:i:s");
						fputs ($file,"\r\n");
						fputs ($file,"ip=$ipv или ip=$ip fio=$fiov время=$datetime\r\n");
						fputs ($file,"отредактировал файл $filename \r\n");
						fputs ($file,"Содержание файла:\r\n $stroka \r\n");	
				}else{
					echo "Не удалось получить блокировку файла базы данных !<br>
					Вернитесь назад для повтороной отправки формы.<br>";
				}
        		fclose ($file);
        		
			}else{
				//проверяем есть ли данные в форме
				unset($checkstring);
				for($x = $x1; $x < $x2; $x++){
					$checkstring = $checkstring.$mass[$x];
				}
				if($checkstring !="okok"){
//					echo("данные в форме существуют<br>");
					//создаём новое имя для файла
					
					//------------
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
	                $filename = "$filename$a2";
	                $filename = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";
//	                echo("Новое имя файла: $filename<br>");
					//------------
				}else{
					$filename="";
				}
				
				
				
				
			};//if($pos === TRUE)

	if($filename !=""){
		//формируем строку для закладки в файл
		unset($string);
		$string = "$ceh";
		for($x = 1; $x <= 30; $x++){
			$key3 = $x."_".$a2;
			$num = $keymas2[$key3];
			//settype($mass[$num], string);
			$string =$string."|".$mass[$num];
		}
			//добавляем бригаду --------------
			//ищем ключи начала и конца
			$num = "startb_$a2";
			$key_s = $keymas2[$num]+1;
//			echo("key_s = $key_s<br>");
			$num = "endb_$a2";
			$key_e = $keymas2[$num]-1;
//			echo("key_e = $key_e<br>");
		unset($brigada);
		for($x = $key_s; $x <= $key_e; $x++){
			if($mass[$x]=="on"){//проверяем нажат ли чекбокс
				$num = "_$a2";
				$ch_b = str_replace("_$a2", "", "$keymas[$x]");
				if($brigada !=""){
					$brigada = $brigada.";".$ch_b; 
				}else{
					$brigada = $ch_b;
				}
			}
		}
//			echo("brigada=$brigada<br>");
			$string =$string."|".$brigada;
			//--------------------------------
			
			
		
		for($x = 32; $x <= 43; $x++){
			$key3 = $x."_".$a2;
			$num = $keymas2[$key3];
			//settype($mass[$num], string);
			$string =$string."|".$mass[$num];
		}
//		echo("Строка новая: $string<br>");
		
		//конец формирования строки для закладки в файл
		
		
		
		
			//пишем $filename
			$file = fopen("$filename","w+");
				if(!file){
					echo("Ошибка открытия файла ");
				};	
			fputs ($file,"$string");
			fclose ($file);
			
			
	}
	
	
};// перебор файлов ----------------- 





$no_head = "ok";
include "arm_nach_ceh_new.php";






//echo "</body></HTML>";
?>