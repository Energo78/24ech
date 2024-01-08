<?php
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
	if($no_head !="ok"){
		if($cehrus=="" or $cehrus2 !=""){
				$cehrus=$_POST["cehrus"];
				include "cehrename.php";
				setcookie("cehrus", "$cehrus", time() + 60000);
		}else{
			$cehrus = ($_COOKIE[cehrus]);
			include "cehrename.php";
		}

		include "head.html";
	}
	unset($no_head);


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




if ($ceh==""){
	echo"<h3>Выберите цех.</h3>";
}else{
	echo "<h3>ЦЕХ: $cehrus </h3><br>";
}




//РЕДАКИРУЕМ РАБОТЫ ------------------------------------------------------
$action=$_GET['action'];
if ($action =="izmenenie"){
	$date=$_GET['date'];
	$ceh=$_GET['ceh'];
	$year=$_GET['year'];
	$mesday=$_GET['mesday'];
	echo "<div style='clear:both;'></div><div id='bg1'>";
	echo "ИЗМЕНЕНИЕ</br>";
	echo "<form method='post' action='arm_nach_ceh_new_dop03_save.php'>";
	
	// Подключаем БД "ГРАФИК"
		//$date ="";
			$d2 = substr ("$date", 3);
			$filename = "./$di/$ech/$ceh/graf_$d2.csv";
			// echo "!!! $filename !!!</br>";

		if (file_exists($filename)) //ВЫВОДИМ ГРАФИК С ДАННЫМИ
			{
				 // echo "<div class='no_print'>Файл ГРАФИКА $filename существует</div>";
				unset ($maspers);
				$file = fopen("$filename","r");
				if(!file){
					echo("Ошибка открытия файла </br>");
				};
				$stroka = fgets ($file);
				fclose ($file);
				$maspers = explode("|", $stroka);
				// print_r ($maspers);
				
			}else{
				$nografic = true;
					if ($otchet2016 != 1 and $filtr=="" and $kratko==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
						echo "График по $ceh на $date не составлен, перейдите в раздел <a href='arm_grafic.php'>график</a>.</br></br>";
					};
			};
	
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

			for($dop02=0; $dop02 < count($filsr); $dop02++){
					$file = fopen("./$di/$ech/$ceh/$year/$mesday/$filsr[$dop02]","r");
					$redactf = "./$di/$ech/$ceh/$year/$mesday/$filsr[$dop02]";
					if(!file){
						echo("Ошибка открытия файла");
					};
					$work_id = "$filsr[$dop02]";
					$stripr[$dop02] = fgets ($file);
					fclose ($file);
					
					$stripr[$dop02] = str_replace("b-b","</br>",$stripr[$dop02]);
					//echo "!!! $stripr[$dop02]  !!!</br>";
					echo "</br>";
					$striprf = $stripr[$dop02];
					include("arm_nach_ceh_new_dop02.php");//форма редактирования одного рабочего задания
					echo "</br>";
					
					unset($striprf, $stripr, $file);
					
			};
			

		};
		unset($redactf);
		$dop02_tmp = count($filsr);
		//echo "</br></br>";
	for($dop02=$dop02_tmp; $dop02 < $dop02_tmp+4; $dop02++){
				include("arm_nach_ceh_new_dop02.php");//форма чистая одного рабочего задания
				echo "</br></br>";
	};
	//!!! - ВАЖНО - в инпутах ниже не менять последовательность (связано с arm_nach_ceh_new_dop03_save.php) -----------
	echo "<table><tr><td colspan='5' style='text-align:center;'></br>
		<INPUT TYPE=hidden NAME='di' VALUE='$di'>
		<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
		<INPUT TYPE=hidden NAME='echrus' VALUE='$echrus'>
		<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
		<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
		<INPUT TYPE=hidden NAME='date' VALUE='$date'>
		<INPUT TYPE=submit class='green goodbutton' VALUE='СОХРАНИТЬ'>
		</form></td></tr></table>";
	
	echo "</div>";


	echo "</body></HTML>";
	exit();	
}



//РЕДАКИРУЕМ РАБОТЫ end --------------------------------------------------






//НЕДЕЛЯ -------------------------------------------------------
echo "<div style='clear:both;'></div><div id='bg1'>";
for($n=1;$n<5;$n++){
	include ("arm_nach_ceh_new_dop01.php");
}
echo"</div>";

echo "<div style='clear:both;'></div><div id='bg1'>";
for($n=5;$n<8;$n++){
	include ("arm_nach_ceh_new_dop01.php");
}

//прощёлкивание дней
echo"<div id='frame_in1'>
		<div id='list'><table><tr><td>
		<form method='post' action='arm_nach_ceh_new.php'>
			<INPUT TYPE=hidden NAME='date' VALUE='$dayw[0]'>
			<INPUT TYPE=submit NAME=button1 VALUE='<< $dayw[0]'>
		</form>
		</td><td>
		<form method='post' action='arm_nach_ceh_new.php'>
			<INPUT TYPE=hidden NAME='date' VALUE='$dayw[8]'>
			<INPUT TYPE=submit NAME=button2 VALUE='$dayw[8] >>'>
		</form></td></tr>
		</table>
		</div>
		
		<div id='list'><table>
		<tr><td>
			<script src='js/calendar_ru.js' type='text/javascript'></script>
			<form method='post' action='arm_nach_ceh_new.php'>
			<big>Выберите дату и цех:</big><br>
			<input autocomplete='off' name='date' type='text' value='$date' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
			<SELECT name='cehrus'><option>$cehrus<option>$ceha</select>
			<INPUT TYPE=submit NAME=button1 VALUE='далее'>
			</form>
		</td></tr>
		</table>
		</div>
</div>";

echo "</div><div style='clear:both;'></div>";
//НЕДЕЛЯ end -------------------------------------------------


//ВИКС ------------------------------------------------------
/*$check_echk = substr_count("$ceh","echk");
if($check_echk >0){
	$viks_no =$_POST['viks_no'];
	if($viks_no == "ok"){
		 $n1=$_POST['n1'];
		 $n2=$_POST['n2'];
		 $n3=$_POST['n3'];
		 $n4=$_POST['n4'];
	}else{
		$n4 = "on";
		$n3 = "on";
		$n2 = "";
		$n1 = "";
	}

		if($n1=="on"){
			$check_on1 = "checked";
		}
		if($n2=="on"){
			$check_on2 = "checked";
		}

	echo "<div style='clear:both;'></div><div id='frame'>
		<div id='frame_in0'>
			<!-- MENU -->
			<div id='frame_in01'>
			<form method='post' action='arm_nach_ceh_new.php'>
				<big>&nbsp;<font color=red>ВИКС НЕ УСТРАНЁННЫЕ</font>, ЦЕХ:&nbsp;</big>
				<SELECT name='cehrus'><option>$cehrus<option>$ceha</select>
				&nbsp;СТЕПЕНЬ:&nbsp;
				<INPUT TYPE=checkbox NAME='n4' checked>&nbsp;4&nbsp;
				<INPUT TYPE=checkbox NAME='n3' checked>&nbsp;3&nbsp;
				<INPUT TYPE=checkbox NAME='n2' $check_on2>&nbsp;2&nbsp;
				<INPUT TYPE=checkbox NAME='n1' $check_on1>&nbsp;1&nbsp;
				<INPUT TYPE=hidden NAME='viks_no' VALUE='ok'>
				<INPUT TYPE=submit NAME=button2 VALUE='Смотреть>'>
			</form>
		</div></div>
	";
		include("arm_nach_ceh_viks.php");
	echo "</div>";
}*/
//ВИКС end --------------------------------------------------



//ПЕРСОНАЛ ------------------------------------------------------
echo "<div style='clear:both;'></div><div id='frame'>";
//	echo "ПЕРСОНАЛ";
echo "</div>";
//ПЕРСОНАЛ end --------------------------------------------------



//ОБЪЕКТЫ -------------------------------------------------------
echo "<div style='clear:both;'></div><div id='frame'>";
//	echo "ОБЪЕКТЫ";
echo "</div>";
//ОБЪЕКТЫ end --------------------------------------------------




echo "</body></HTML>";

 ?>