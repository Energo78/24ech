<?php 
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);


if ($otchet2016 != 1){ //переменная из otchet_04.php
	$di=$_POST["di"];
	$ech=$_POST["ech"];
	$filtr = $_POST["filtr"];
	$podUf = $_POST["podUf"];
	$obhodf = $_POST["obhodf"];
	$rab_VLf = $_POST["rab_VLf"];
	$rasporyazheniyaf = $_POST["rasporyazheniyaf"];
	
	$titl = "Отчёт";

	if ($datepers ==""){
		$datepers=$_POST["date"];
	}
		
	if ($datepers==""){
		$datepers = date('d.m.Y');
	};

	if ($date1 != ""){
		$datepers = $date1;
	};
	
	include "head.html";
	
	include "config.php";
	
	$date = $datepers;

	include "date_functions.php";
	include "ceha.php";
	// Фильтр
	if($filtr=="ok"){
		/*echo"
			<div style='clear:both;'></div>
			<div id='bg1'>
			<div id='cont30'>
			<form method='post' action='otchet_pers.php'>
			<p style='text-align:left;'>
			<big>Выберите дату:</big>
			<input autocomplete='off' name='date' type='text' value='' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
			
			<INPUT TYPE=hidden NAME='filtr' VALUE='ok'>
			</br><INPUT TYPE=checkbox NAME='podUf'>Работы под напряжением
			</br><INPUT TYPE=checkbox NAME='rab_VLf'>Работы на ВЛ АБ, ПЭ, ДПР
			</br><INPUT TYPE=checkbox NAME='obhodf'>Обходы с осмотром устройств
			</br><INPUT TYPE=checkbox NAME='obezdf'>Объезды с осмотром устройств
			</br><INPUT TYPE=checkbox NAME='rasporyazheniyaf'>Работы по распоряжению
			</br><INPUT TYPE=submit NAME=buttonfiltr VALUE='Применить Фильтр'>
			</form></p>
			</div>
			<div id='cont31'>
			<p style='text-align:left;'>
			Отчёт по всем работам по цеху:<br>
			<form method='post' action='otchet_mes.php'>
			<big>Выберите цех:</big>
			<SELECT name='cehrus'><option>$cehrus<option>$ceha</select><br><br>
			<big>Выберите месяц:</big>
			<SELECT name='mes'>$mesyachs</select> и год:<SELECT name='year'>$years</select><br>
			<INPUT TYPE=hidden NAME='filtr2' VALUE='ok'>
			</br><INPUT TYPE=submit NAME=buttonfiltr VALUE='Создать Отчёт'>
			</form></p>
			
			</div>
			</div>
		";*/
	};
	
	echo //прощёлкивание дней
	"
		<div style='clear:both;'></div>
		<div id='list'><table><tr><td>
		<form method='post' action='otchet_pers.php'>
			<INPUT TYPE=hidden NAME='filtr' VALUE='$filtr'>
			<INPUT TYPE=hidden NAME='podUf' VALUE='$podUf'>
			<INPUT TYPE=hidden NAME='obhodf' VALUE='$obhodf'>
			<INPUT TYPE=hidden NAME='date' VALUE='$dateold'>
			<INPUT TYPE=hidden NAME='rab_VLf' VALUE='$rab_VLf'>
			<INPUT TYPE=hidden NAME='obezdf' VALUE='$obezdf'>
			<INPUT TYPE=hidden NAME='rasporyazheniyaf' VALUE='$rasporyazheniyaf'>
			<INPUT TYPE=hidden NAME='otchet_ech' VALUE='ok'> 
			<INPUT TYPE=submit NAME=button1 VALUE='<< $dateold'>
		</form>
		</td><td>
		<form method='post' action='otchet_pers.php'>
			<INPUT TYPE=hidden NAME='filtr' VALUE='$filtr'>
			<INPUT TYPE=hidden NAME='podUf' VALUE='$podUf'>
			<INPUT TYPE=hidden NAME='obhodf' VALUE='$obhodf'>
			<INPUT TYPE=hidden NAME='rasporyazheniyaf' VALUE='$rasporyazheniyaf'>
			<INPUT TYPE=hidden NAME='rab_VLf' VALUE='$rab_VLf'>
			<INPUT TYPE=hidden NAME='obezdf' VALUE='$obezdf'>
			<INPUT TYPE=hidden NAME='date' VALUE='$datenext'>
			<INPUT TYPE=hidden NAME='otchet_ech' VALUE='ok'> 
			<INPUT TYPE=submit NAME=button2 VALUE='$datenext >>'>
		</form></td></tr></table>
		</div>
	";
};

// Работы из нового планирования
	// Читаем папку ЭЧ
	//получаем список файлов каталога
		// $n=0;
		$dir = "./$di/$ech/";
		unset ($n_rabot_ech, $dirs, $n_cehov, $ce, $sovpad, $n_rab_na_echk, $n_rab_na_echs, $n_rab_na_tyagov, $n_rab_na_rru); //обнуляем
		if (file_exists($dir)) {
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir)){
					if (( $file != ".") && ($file != "..")){
						$dirs[] = $file;
						$n_cehov++;
					};
			};
			closedir ($dir);
			// sort ($dirs);
			// print_r ($dirs);
			// echo "</br>! $n_cehov !</br>";// возвращаем число папок
		};
		
	if($filtr !=""){
		echo"<div id='rabots'><table>";
	}
		$n_rab_na_echk = $n_rabot_ech; //считаем работы на ЭЧK
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "echk");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		$n_rab_na_echk = $n_rabot_ech - $n_rab_na_echk;
		
		$n_rab_na_echs = $n_rabot_ech; //считаем работы на ЭЧС
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "echs");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		$n_rab_na_echs = $n_rabot_ech - $n_rab_na_echs;
		
		$n_rab_na_tyagov = $n_rabot_ech; //считаем работы на ЭЧЭ
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "eche");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		$n_rab_na_tyagov = $n_rabot_ech - $n_rab_na_tyagov;
		
		$n_rab_na_rru = $n_rabot_ech; //считаем работы на РРУ
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "echr");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		
		
		$n_rab_ntel = $n_rabot_ech; //считаем работы НТЭЛ
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "ntel");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		
		$n_rab_na_rru = $n_rabot_ech - $n_rab_na_rru;
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echp");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echc");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echm");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echd");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echa");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
	if($filtr !=""){
		echo"</table></div>";
	}	

// end Работы из нового планирования


// выводим отчёт за сутки date
if ($otchet2016 != 1 and $filtr==""){ //переменная из otchet_04.php (отсекаем echo для месячного отчёта) 
	    echo "<div id='rabots'><table>
				<tr><td>Отчёт по работам в $ech за $datepers</td><td></td></tr>
				<tr><td>Работников всего:</td><td>$n_person_v_ech</td></tr>
				<tr><td>Работников за вычетом отсутствующих:</td><td>$pers_vrab_ech</td></tr>
				<tr><td>Проведено инструктажей:</td><td>$instr</td></tr>
				<tr><td>Всего спланировано работ:</td><td>$n_rabot_ech</td></tr>
				<tr><td>Работ на ЭЧК:</td><td>$n_rab_na_echk</td></tr>
                <tr><td>Работ на ЭЧC:</td><td>$n_rab_na_echs</td></tr>
                <tr><td>Работ на ЭЧЭ, ПСК:</td><td>$n_rab_na_tyagov</td></tr>
				<tr><td>Работ цеха РРУ:</td><td>$n_rab_na_rru</td></tr>
				
                <tr><td>Всeго работ под U:</td><td>$nar_U на $tameU часов.</td></tr>
                <tr><td>Работ на ВЛ АБ, ПЭ, ДПР:</td><td>$rab_VL</td></tr>
				<tr><td>Работы по распоряжению:</td><td>$rasp_sum</td></tr>
				<tr><td>Работ в порядке текущей эксплуатации:</td><td>$rabot_v_tekexpl</td></tr>
                <tr><td>обходов:</td><td>$obhodov</td></tr>
                <tr><td>объездов:</td><td>$obezdov</td></tr>
                <tr><td>Проверено экспл. длины (км.):</td><td>$prov_exp</td></tr>
                <tr><td>Объезд ВИКС (км.):</td><td>$prov_viks</td></tr>
                <tr><td>Выявлено замечаний:</td><td>$obnaruz_zam</td></tr>
                <tr><td>Устранено замечаний:</td><td>$ustr_zam</td></tr>
                
                <tr><td>Проведено совещаний (собраний):</td><td>$sobran</td></tr>

                <tr><td><b>Обеспечений:</b></td><td></td></tr>
                <tr><td>ПМС-ПЧ:</td><td>$nar_P</td></tr>
                <tr><td>ЭМП:</td><td>$nar_E</td></tr>
                <tr><td>ШЧ:</td><td>$nar_SH</td></tr>
                <tr><td>РЦС:</td><td>$nar_RCS</td></tr>
                <tr><td>СМП:</td><td>$obesp_SMP</td></tr>
                <tr><td>прочих обеспечений:</td><td>$obesp_proch</td></tr>
                <tr><td>совмещённых работ:</td><td>$sovm</td></tr>
                <tr><td>Ремонт заземлений:</td><td>$rem_zz</td></tr></table>
			</div>

        ";


	if ($filtr==""){
		if ($di=="di_01" and $ech=="ech01"){//отчет по окнам
			$date1 = $datepers;
			$from_otchet_pers = 1;
			include "otchet_okna.php";
			unset ($from_otchet_pers);
		};
		
		
	// {вставляем замечания ТУ-ДУ
			include "config.php";
			include "read_tudu.php";
			// шапка таблицы:
			echo "<p align=center><i><b><font color=#0000FF size=4><span lang=ru>Замечания ТУ-ДУ на $data_mod</span></font></b></i></p><table $tab><tr><td $td>Место</td><td $td>Объект</td><td $td>Неисправность</td><td $td>Дата начала</td><td $td>Отметка об<br>устранении</td><td $td>Ответственные</td></tr>";
			 for ($i=0; $i < $n; $i++)
			{
				$str_exp = explode("|", $massiv[$i]);

				if ($str_exp[6]!="")
				{
					echo "<tr><td $str_exp[6] $td>$str_exp[0]</td><td $str_exp[6] $td>$str_exp[1]</td><td $str_exp[6] $td>$str_exp[2]</td><td $str_exp[6] $td>$str_exp[3]</td><td $str_exp[6] $td>$str_exp[4]</td><td $str_exp[6] $td>$str_exp[5]</td></tr>";
				 };
			};
			echo "</table>";
		  //}


		 // {вставляем неисправности
			include "neispr_read.php";
			
			// шапка таблицы:
			echo "<p align=center><i><b><font color=#0000FF size=4><span lang=ru>Неисправности на $data_mod</span></font></b></i></p><table $tab><tr><td $td>Место</td><td $td>Объект</td><td $td>Неисправность</td><td $td>Дата начала</td><td $td>Отметка об<br>устранении</td><td $td>Ответственные</td></tr>";
			for ($i=0; $i < $n; $i++)
			{

				$str_exp = explode("|", $massiv[$i]);

				if ($str_exp[6]!="")
				{
					echo "<tr><td $str_exp[6] $td>$str_exp[0]</td><td $str_exp[6] $td>$str_exp[1]</td><td $str_exp[6] $td>$str_exp[2]</td><td $str_exp[6] $td>$str_exp[3]</td><td $str_exp[6] $td>$str_exp[4]</td><td $str_exp[6] $td>$str_exp[5]</td></tr>";
				 };

			
			};
			echo "</table>";
		  //}
	// end отчёт за сутки
	};
};


?>