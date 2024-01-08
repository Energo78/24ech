<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "ОТЧЁТ за МЕСЯЦ";
include "head.html";

//soderjanie:
//1 цикл по цехам ---> в нём цикл по дням месяца
//2 обработка данныхи вывод на экран




$mes=$_POST["mes"];
$year=$_POST["year"];



//1 цикл по цехам ---> в нём цикл по дням месяца ---------------------------------------------------------------

	// Читаем папку ЭЧ
		$dir = "./$di/$ech/";
		unset ($dirs); //обнуляем
		if (file_exists($dir)) {
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir)){
				if (( $file != ".") && ($file != "..")){
					$dirs[] = $file;
				};
			};
			closedir ($dir);
				sort ($dirs);
//				print_r ($dirs);
		};
	
		

//шапка
echo("<div id='tables'><table ><tr ><td >Дата</td><td >Всего заказано</td><td >На(часов)</td><td >Всего спланировано</td><td >На(часов)</td><td >Всего отработано</td><td >На(часов)</td><td >Средняя продолжительность окна</td><td >Отказано при планировании</td><td >Отказ ДНЦ</td><td >Отказ ЭЧК</td><td >Работ на ВЛ АБ, ПЭ, ДПР</td><td >Работ на ЭЧЭ, ПСК</td><td >Всeго работ под U</td><td >На(часов)</td><td >Работы по распоряжению и прочие работы по нарядам</td><td >обходов:</td><td >объездов:</td><td >Проверено экспл. длины (км.):</td><td >Объезд ВИКС (км.):</td><td >Выявлено замечаний:</td><td >Устранено замечаний:</td><td >Количество проверенных бригад:</td><td >Проинструктировано работников:</td><td >Проведено совещаний (собраний):</td><td >ПМС-ПЧ:</td><td >ЭМП:</td><td >ШЧ:</td><td >РЦС:</td><td >СМП:</td><td >прочих обеспечений:</td><td >совмещённых окон:</td><td>Работ в порядке тек.экспл</td></tr>");

			
			
			for($day = 1; $day < 32; $day++){ //перебор дня месяца
				$m = date( 'm', mktime(0,0,0,$mes,$day,$year) ); 
				if($m != $mes){
//					echo("<br> m != mes --");
				}else{
					$mesday = date( 'md', mktime(0,0,0,$mes,$day,$year) );
					$date_table = date( 'd.m.Y', mktime(0,0,0,$mes,$day,$year) );  
//					echo("<br>$mesday -- $ceh");
					
					for($ce=0; $ce < count($dirs); $ce++){  //ЦИКЛ ПО ПАПКАМ ЦЕХОВ ----------------
			//			$sovpad=substr_count("$dirs[$ce]", "echk");
						$ceh = "$dirs[$ce]";
						
						$dir = "./$di/$ech/$ceh/$year/$mesday";
//						echo("<br>$dir");
						
						if (file_exists($dir)) {
							$dir = opendir ("$dir");
							while ( $file = readdir ($dir)){
								if (( $file != ".") && ($file != "..")){
									
									
									$otmena = substr_count("$file","otmena");
									$okno = substr_count("$file","okno");
									
									if($otmena ==0 and $okno !=0){$n_okon = $n_okon + 1;};
									if($otmena !=0 and $okno !=0){$n_okon_otmen = $n_okon_otmen + 1;};
									
									unset($otmena, $okno);
									
									
									$string_m0 = file("./$di/$ech/$ceh/$year/$mesday/$file");//строковый массив работ на дату	
									$string_m[] = $string_m0[0];
									
								};
							};
							closedir ($dir);

						};
						
						
					};
					
					
				}
//				echo("<br>РАБОТЫ на ДАТУ $mesday<br>");
//				print_r($string_m);



//2 обработка данных -------------------------------------------------------------------------------------------
			if(is_array($string_m)){
				settype($okna_otmen_time, integer);
				foreach($string_m as $one_str){
					$one_str = "$one_str";
//					echo("$one_str<br><br>");
					unset($otkaz, $otmena);
					$otmena = substr_count("$one_str","ОТМЕНА");
					$otkaz = substr_count("$one_str","ОТКАЗ");
					unset($work);
					$work = explode("|", $one_str);
//					print_r($work);
					if($work[1]!=""){$n_nar = $n_nar + 1;};
//					echo("work[1]=$work[1] -- n_nar = $n_nar --<br><br>");
					if($work[12]!=""){$n_rasp = $n_rasp + 1;};
					if($work[14]!=""){$n_isv = $n_isv + 1;};
					if($work[15]!=""){$n_ob_pch_pms = $n_ob_pch_pms + 1;};
					if($work[16]!=""){$n_ob_emp = $n_ob_emp + 1;};
					if($work[17]!=""){$n_km_provereno = $n_km_provereno + $work[17];};
					if($work[18]!=""){$n_zamech = $n_zamech + 1;};
					if($work[19]!=""){$n_zamech_ustr = $n_zamech_ustr + 1;};
					if($work[20]!=""){$n_ob_shch = $n_ob_shch + 1;};
					if($work[21]!=""){$n_ob_rcs = $n_ob_rcs + 1;};
					if($work[22]!=""){$n_obhodov = $n_obhodov + 1;};
					if($work[23]!=""){$n_obezdov = $n_obezdov + 1;};
					if($work[24]!=""){$km_prov_viks = $km_prov_viks + $work[17];};
//					if($work[25]!=""){$n_okon = $n_okon + 1;};
					if($work[26]!=""){$n_okon_sovm = $n_okon_sovm + 1;};
					if($work[28]!=""){$n_ob_smp = $n_ob_smp + 1;};
					if($work[29]!=""){$n_ob_proch = $n_ob_proch + 1;};
					if($work[30]!=""){$nrab_ob_dpr = $nrab_ob_dpr + 1;};
					if($work[31]!=""){}; //бригада
					if($work[32]=="on"){$n_tek_ekspl = $n_tek_ekspl + 1;};
					if($work[45]!=""){$n_otkaz_dnc = $n_otkaz_dnc + 1;};
					if($work[46]!=""){$n_otkaz_echk = $n_otkaz_echk + 1;};
					
					settype($asapvo[1], integer);
					if($work[44]!=""){
						unset($asapvo);
						$asapvo = explode(";", $work[44]);
						$okna_all_time = $okna_all_time + $asapvo[1];
						if($otkaz > 0 OR $otmena > 0){
							$okna_otmen_time = $okna_otmen_time + $asapvo[1];
						}
					};
					
					
					
				}
			}
			
			if($n_okon_otmen !='' OR $n_okon !=''){
				$n_okon_all = $n_okon_otmen + $n_okon;
			}
			
			if($n_km_provereno !=""){
				$n_km_provereno = $n_km_provereno - $km_prov_viks;
			}
			
			$okna_all_plan_time = $okna_all_time - $okna_otmen_time;
			$okna_all_time = (round(($okna_all_time/60)*100))/100;
			$okna_all_plan_time = (round(($okna_all_plan_time/60)*100))/100;
			
			echo("<tr ><td >$date_table</td><td >$n_okon_all</td><td >$okna_all_time</td><td >$n_okon</td><td >$okna_all_plan_time</td><td ></td><td ></td><td ></td><td >$n_okon_otmen</td><td >$n_otkaz_dnc</td><td >$n_otkaz_echk</td><td >$nrab_ob_dpr</td><td ></td><td >$n_isv</td><td ></td><td >$n_rasp</td><td >$n_obhodov</td><td >$n_obezdov</td><td >$n_km_provereno</td><td >$km_prov_viks</td><td >$n_zamech</td><td >$n_zamech_ustr</td><td ></td><td ></td><td ></td><td >$n_ob_pch_pms</td><td >$n_ob_emp</td><td >$n_ob_shch</td><td >$n_ob_rcs</td><td >$n_ob_smp</td><td >$n_ob_proch</td><td >$n_okon_sovm</td><td>$n_tek_ekspl</td></tr>");
				
				
				
				unset($okna_all_plan_time, $okna_otmen_time, $okna_all_time, $n_okon_all, $n_okon, $n_okon_otmen, $nrab_ob_dpr, $n_isv, $n_rasp, $n_obhodov, $n_obezdov, $n_ob_pch_pms, $n_ob_emp, $n_ob_shch, $n_ob_rcs, $n_ob_smp, $n_ob_proch, $n_okon_sovm, $n_km_provereno, $km_prov_viks, $n_tek_ekspl, $n_otkaz_echk, $n_otkaz_dnc, $n_zamech_ustr, $n_zamech, $n_nar);
		
		
		



		unset($string_m);		

};
			
			
















echo("</table></div>");






			
		
			
			
			
			
			



		




















?>