<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//include "config.php";


if ($date ==""){
	$date=$_POST["date"];
}
	
if ($date==""){
	$date = date('d.m.Y');
};

if ($date1 != ""){
	$date = $date1;
};
// echo "! ---- $date --- !</br>";
include "date_functions.php";
// echo "! ---- $date --- !</br>";
$mesday = "$mes$day";
// echo "! ---- $mesday --- !</br>";

$vvod=$_POST["vvod"];
$kratko=$_POST["kratko"];


if ($inotchet == 1){
	
}else{
	$titl = "АРМ планирование цеха";
	include "head.html";
	$cehrus=$_POST["cehrus"];
	if($cehrus==""){
			$cehrus = ($_COOKIE[cehrus]);
			include "cehrename.php";
		}
	$ceh=$_POST["ceh"];
	
	
};

$redactf=$_POST["redactf"];
	
	
	
	
	
	
	//копируем файл	---------------------------------------------
	$copifile=$_POST["copifile"];
	$datecopy=$_POST["datecopy"];
	
	if ($copifile !=""){
		$ceh=$_POST["ceh"];
		if($datecopy!=""){
			echo "!-- $copifile -- $datecopy --!<br>";
			$date = $datecopy;
			// echo "date = $date -!<br>";
			include "date_functions.php";
			$mesday = "$mes$day";
			// echo "date = $date -!<br>mesday = $mesday -!<br>";
			//присваиваем имя новому файлу
			srand((double) microtime()*1000000);
            $filename = rand();
			$dir = "./$di/$ech/$ceh/$year";
			if (file_exists($dir)) {// echo "Каталог $dir найден<br>";
			} else {mkdir("./$di/$ech/$ceh/$year");	// echo "Каталог $dir создан<br>";
			};
			$dir = "./$di/$ech/$ceh/$year/$mesday";
			if (file_exists($dir)) {// echo "Каталог $dir найден<br>";
			} else {mkdir("./$di/$ech/$ceh/$year/$mesday");// echo "Каталог $dir создан<br>";
			};
			$newfile = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";
			$copifile2 = file("$copifile");
			// print_r ($copifile2);
			$file = fopen("$newfile","w+");
			for($i=0; $i < count($copifile2); $i++){
				fputs ($file,"$copifile2[$i]");
			};
			fclose ($file);
			echo "<br>$newfile ФАЙЛ -- записан.";
		}else{
			echo "<script src='js/calendar_ru.js' type='text/javascript'></script>
			<form method='post' action='arm_nach_ceh.php'>
			<p><big>Выберите дату:</big><br>
			<input autocomplete='off' name='datecopy' type='text' value='$date' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
			<INPUT TYPE=hidden NAME='copifile' VALUE='$copifile'>
			<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
			<INPUT TYPE=submit NAME=button1 VALUE='КОПИРОВАТЬ'>
			</form></p>
			";
		};
		exit;
	}
	//копируем файл END	------------------------------------------
	
	
	
	

if ($ceh =="" or $cehrus =="" or $echrus=="" or $inotchet == 1){
	include "cehrename.php";
};
$d1 = date('d.m.Y', (time()+3600*24*1));

//подключаем цеха
	if ($inotchet != 1){
		include "ceha.php";
	};

$cehamas = explode("<option>", $ceha);

if ($inotchet != 1){
	echo "
	<div id='contdat'>
	<script src='js/calendar_ru.js' type='text/javascript'></script>
	<form method='post' action='arm_nach_ceh.php'>
	<big>Выберите дату и цех для планирования:</big><br>
	<input autocomplete='off' name='date' type='text' value='$date' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
	<SELECT name='cehrus'><option>$cehrus<option>$ceha</select>
	<INPUT TYPE=submit NAME=button1 VALUE='далее'>
	</form>
	
	";

	echo "</div>";
};



	if ($ceh !="" and $date !=""){
			if ($inotchet != 1){
				echo "
				<div id='header_plan'>
				<b>Выбрано ($di): $echrus, ЦЕХ: $cehrus и Дата: $date</b></br>
				<div id='header_plan_2'>
				<form method='post' action='arm_nach_ceh.php'>
				<INPUT TYPE=hidden NAME='di' VALUE='$di'>
				<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
				<INPUT TYPE=hidden NAME='echrus' VALUE='$echrus'>
				<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
				<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
				<INPUT TYPE=hidden NAME='date' VALUE='$date'>
				<INPUT TYPE=hidden NAME='vvod' VALUE='on'>
				<INPUT TYPE=submit class='green goodbutton' VALUE='Добавить работу'>
				</form>
				</div>
				
				<div id='header_plan_2'>
				<form method='post' action='arm_nach_ceh_new.php'>
				<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
				<INPUT TYPE=hidden NAME='date' VALUE='$date'>
				<INPUT TYPE=submit class='green goodbutton' VALUE='НЕДЕЛЯ'>
				
				</form>
				</div>
				</div>
				";
			}else{
				if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //переменная из otchet_04.php (отсекаем echo для месячного отчёта)
					echo "<div id='header_plan'><b>Выбрано ($di): $echrus, ЦЕХ: $cehrus и Дата: $date</b></br></div>";
				};
			};
	//выбор цеха end
	
	
	
	
	
	// подключаем БД персонала

		include "pers_arr.php";
		// print_r ($personal_array);

	// Подключаем БД "ГРАФИК"
			$d2 = substr ("$date", 3);
			$filename = "./$di/$ech/$ceh/graf_$d2.csv";
			// echo "!!! $filename !!!";

		if (file_exists($filename)) //ВЫВОДИМ ГРАФИК С ДАННЫМИ
			{
			 // echo "<div class='no_print'>Файл ГРАФИКА $filename существует</div>";
			unset ($maspers);
			$file = fopen("$filename","r");
			if(!file)
			{
				echo("Ошибка открытия файла ");
			};
			$stroka = fgets ($file);
			$maspers = explode("|", $stroka);
			// print_r ($maspers);
			fclose ($file);

		}else{
			$nografic = true;
			if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
				echo "График по $ceh на $date не составлен, перейдите в раздел <a href='arm_grafic.php'>график</a>.</br></br>";
			};
		};
	};	
	//если графика нет.. то...
	if ($ceh =="" or $date ==""){
		if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
			echo "<div class='no_print'>Для начала планирования необходимо заполнить и сохранить ГРАФИК работы цеха!</div>";
		};

	};
	// #
	
// подключили БД персонала

//для НТЭЛ подключаем config нужного ЭЧ
	if($ech=="ntel"){
		$ech_tmp = $ech;
//			echo("ЭЧ=$ech<br>");
			$ech=str_replace("ntel","ech",$ceh);
//			echo("ЭЧ=$ech<br>");
			include "config.php";
		$ech = $ech_tmp;
		//echo("ЭЧ=$ech<br>");
	}
//для НТЭЛ подключили config нужного ЭЧ




// Форма ввода работы
	if ($vvod != "" or $redactf !=""){
//		echo("-- $vvod --- $redactf<br>");
		include"form.php";
	};
	
	for ($i=0; $i < count($maspers); $i++){//считаем персонал и часы
		$tabnamber = $maspers[$i];
		$day2 = $i + $day;
		// часы работы
		$h = $maspers[$day2]; 
		settype($h,float);
		// выводим
		if($h > 0){
			$pers_vrab = $pers_vrab + 1;
			$h_sum = abs($h_sum) + abs($h);
		};
		$i = $i+31;
	};
if ($inotchet != 1){
	echo //прощёлкивание дней
	"
		<div style='clear:both;'></div>
		<div id='list'><table><tr><td>
		<form method='post' action='arm_nach_ceh.php'>
			<INPUT TYPE=hidden NAME='date' VALUE='$dateold'>
			<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
			<INPUT TYPE=hidden NAME='otchet_ech' VALUE='ok'> 
			<INPUT TYPE=submit NAME=button1 VALUE='<< $dateold'>
		</form>
		</td><td>
		<form method='post' action='arm_nach_ceh.php'>
			<INPUT TYPE=hidden NAME='date' VALUE='$datenext'>
			<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
			<INPUT TYPE=hidden NAME='otchet_ech' VALUE='ok'> 
			<INPUT TYPE=submit NAME=button2 VALUE='$datenext >>'>
		</form></td></tr></table>
		</div>
	";
};
// вывод занятости персонала
if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
	echo "
	<div id='bg1'>
	<div id='contpers2'><table><tr><td>ФИО</td><td>рабочих</br>часов</td></tr>";
};


	
	if ($maspers !=""){
		unset ($fio);
		include "pers_arr.php";
		// sort($maspers, SORT_STRING);
		for ($i=0; $i < count($maspers); $i++){
			$tabnamber = $maspers[$i];
			$day2 = $i + $day;
			// часы работы
			$h = $maspers[$day2];
			settype($h,integer);
			// выводим
			if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
				if ($fio[$tabnamber]!=""){
					echo "<tr><td>$fio[$tabnamber]</td>";
				}else{
					echo "<tr><td>$fio2[$tabnamber]</td>";
				};
				echo "<td>$maspers[$day2]</td></tr>";
			};
				
			$i = $i+31;
		};
	}else{
		unset ($fio);
		$optab = 1;
		include "pers_arr.php";
		unset ($optab);
	};
	if ($otchet2016 != 1 and $filtr==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
		echo "</table></div><div id='rabots'>";
		if($filtr==""){
			echo"Работы по $cehrus на <b>$date</b></BR>";
		}
	};
unset ($maspers);

// Работы
	// читаем файлы
		//получаем список файлов каталога
		$n=0;
		$dir = "./$di/$ech/$ceh/$year/$mesday/";
		
		if (file_exists($dir)) {
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir))
			{
					if (( $file != ".") && ($file != ".."))
					{
							if ($file != "eche.csv")
							{
									$filsr[] = $file;	
									$n++;
							};
					};
			};
			closedir ($dir);
			// print_r ($filsr);
			// echo "</br>! $n !</br>";// возвращаем число файлов


			for($i=0; $i < count($filsr); $i++){
				unset($otmena);
				$otmena = substr_count("$filsr[$i]","otmena");
				if($otmena ==0){
					$file = fopen("./$di/$ech/$ceh/$year/$mesday/$filsr[$i]","r");
					if(!file){
						echo("Ошибка открытия файла");
					};
					$stripr[$i] = fgets ($file);
					$stripr[$i] = str_replace("b-b","</br>",$stripr[$i]);
					// echo "!!! $stripr[$i]  !!!</br>";
					fclose ($file);
				}	
			};

		} else {
			if ($otchet2016 != 1 and $filtr==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
				echo "На дату $date работ не запланировано.";
			};
		};
		
        
		
		
// выводим работы ----------------------------
if ($otchet2016 != 1 and $filtr==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
	echo "<table>";
};
		for ($i=0; $i < $n; $i++){//цикл - пробегаем по файлам
			if ($stripr[$i] !=""){
				$maswork = explode("|", $stripr[$i]);
				$filename = "./$di/$ech/$ceh/$year/$mesday/$filsr[$i]";
				
				unset($otmena);
				$otmena = substr_count("$filsr[$i]","otmena");
				if($otmena ==0){		
				
						// фильтр по типам работ
						if($podUf=="on" and $maswork[14]=="on"){
							include "onework.php";
						}elseif($obhodf=="on" and $maswork[22]=="on"){
							include "onework.php";
						}elseif($rasporyazheniyaf=="on" and $maswork[12]!=""){
							include "onework.php";
						}elseif($rab_VLf=="on" and $maswork[30]!=""){
							include "onework.php";
						}elseif($obezdf=="on" and $maswork[23]!=""){
							include "onework.php";
						};
						
					
					
					if ($filtr ==""){
						include "onework.php";
					}
				}
				$n_rabot_ech = $n_rabot_ech + 1;
				$chel_chas_obsh = $chel_chas_obsh + $chelovek_chas;
			}	
		};
if ($otchet2016 != 1 and $filtr==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
	echo "</table></div></div><div style='clear:both;'></div></br>";
};
// конец вывода работ
	
	if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
		echo "Всего в цехе $n_person человек, в графике $pers_vrab человек. На $h_sum чел/часов. Всего спланировано работ на $chel_chas_obsh чел/часов.</br></br>";
	};
	
	$n_person_v_ech = $n_person_v_ech + $n_person;
	$pers_vrab_ech = $pers_vrab_ech + $pers_vrab;
	
	unset ($h_sum, $chel_chas_obsh, $filsr, $pers_vrab);



//ВИКС ------------------------------------------------------
/*удалил 02.04.23*/
//ВИКС end --------------------------------------------------
	
	
if ($otchet2016 != 1 and $filtr==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
	echo "</body></HTML>";
};
 ?>