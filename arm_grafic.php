<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "ГРАФИК";
include "head.html";

// Сохранить график
//подключаем цеха
//выводим кнопки выбора цеха
//выбор ДИ, ЭЧ и цеха
//подключаем БД персонала
// И график если есть
//ВЫВОДИМ ГРАФИК С ДАННЫМИ

$cehrus=$_POST["cehrus"];
$ceh=$_POST["ceh"];
	/*	if($ceh ==""){
			$ceh = $cehv;
		}*/
include "cehrename.php";
//echo "!  $ceh  !";

// Сохранить график -----------------------------------------------
	$save=$_POST["save"];
	if ($save =="on"){
		$di=$_POST["di"];
		$ech=$_POST["ech"];
		
			

		$mesy = $_POST["mes"];
		
		$save_d = explode(".", $mesy);
		$mes = $save_d[0];
		$year = $save_d[1];
		
		$file = fopen("./$di/$ech/$ceh/graf_$mesy.csv","w");
		if(!file){
			echo("Ошибка открытия файла ");
		};
		foreach ($_POST as $ArrKey => $ArrStr){
                $mass[] = $ArrStr;
                $keymas[] = $ArrKey;
        };
		
		$mass = str_replace(",",".",$mass);
		$mass = str_replace("\r","",$mass);
		$mass = str_replace("\n","",$mass);
		for ($i=0;$i < count($keymas); $i++)
        {
                $massiv[$keymas[$i]] = $mass[$i];
				if ($i > 4){
					fputs ($file,"$mass[$i]|");
				};
				
        };
		// print_r ($massiv);
		
		// fputs ($file,"\r\n");
		
		fclose ($file);
		echo "<div class='no_print'>График сохранён!</div>";
	};
//график сохранён ---------------------------------------------------


// $d1 = date('m.Y', (time()+3600*24*30));

//$date = $_POST["d2"];
	unset($shapka);
	$shapka = $_POST["shapka"];	
if($shapka =="ok"){
	$mes = $_POST["mes_shapka"];
	$year = $_POST["year_shapka"];
}


if($mes =="" or $year ==""){
	$mes = date('m');
	$year = date('Y');
}
$date = "$mes.$year";
$date = str_pad($date, 7, "0", STR_PAD_LEFT);




//подключаем цеха
	$ceh2 = $ceh;
	$dir = "./$di/$ech/";
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
		
		//выводим кнопки выбора цеха
//		for ($i=0;$i < count($dirs); $i++){
//			unset ($cehrus, $ceh);
//			$ceh = "$dirs[$i]";
//			include "cehrename.php";
//			$ceha = "$ceha";
//		};
	$ceh = $ceh2;

$cehz=$_POST["cehz"];
// echo "!! $cehz !!"; 

if($cehz ==""){
	$cehz = $cehrus;
}

//echo "!  $cehrus  !";

echo "
<div id='contdat'>
<form action='arm_grafic.php' method='POST'>
<big>Выберите месяц:</big>
<SELECT name='mes_shapka'><option>$mes<option>$mesyachs</select> и год:<SELECT name='year_shapka'>$years</select>
<SELECT name='cehrus'><option>$cehrus<option>$ceha</select>
<INPUT TYPE=hidden NAME='shapka' VALUE='ok'>
<INPUT TYPE=submit NAME=button1 VALUE='далее'>
</form>
</div>

<div id='contdat'>
<form action='arm_grafic_excel.php' method='POST'>
<INPUT TYPE=hidden NAME='mes_excel' VALUE='$date'>
<INPUT TYPE=hidden NAME='ceh_excel' VALUE='$ceh'>
<INPUT TYPE=hidden NAME='di_excel' VALUE='$di'>
<INPUT TYPE=hidden NAME='ech_excel' VALUE='$ech'>
<INPUT TYPE=hidden NAME='cehrus_excel' VALUE='$cehrus'>
<INPUT TYPE=submit NAME=button1 VALUE='Скачать Excel'>
</form>
</div>

";


//выбор ДИ, ЭЧ и цеха

	$ip = $_SERVER["REMOTE_ADDR"];
	settype($ip,string);
	$cehrus=$_POST["cehrus"];
	include "cehrename.php";

//выбор цеха end

//подключаем БД персонала
	
	include "pers_arr.php";
	// print_r ($personal_array);
	

// И график если есть
	if ($mesy!=""){
		$date = $mesy;
	};
	
	$filename = "./$di/$ech/$ceh/graf_$date.csv";
	// echo"!-filename = $filename -!<br>";
	
	
//ВЫВОДИМ ГРАФИК С ДАННЫМИ -----------------------------------------------------------

	if (file_exists($filename)){ 
		$file = fopen("$filename","r");
		if(!file){
			echo("Ошибка открытия файла графика");
		};
		$stroka = fgets ($file);
		$maspers = explode("|", $stroka);
		// print_r ($maspers);
		fclose ($file);
		include "persgrafic.php";

	}else{ //если графика нет.. то...
		echo "<div class='no_print'>Файл ГРАФИКА не существует, но Вы можете его заполнить и сохранить!</div>";
		$newgraf = 1;
		include "persgrafic.php";
		unset ($newgraf);
	};
// конец вывода персонала 


echo "</body></HTML>";
 ?>