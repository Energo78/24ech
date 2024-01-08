<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "ЗАЯВКА от ЭЧЦ";
include "head.html";
include "config.php";
$date=$_POST["date"];
include "date_functions.php";
$otmeny=$_POST["otmeny"];
$circle=$_POST["circle"];
$fioechc=$_POST["fio"];


//- --------------------------


	//читаем dir с датой по цехам (цикл по цехам)
	$n_okn = 0;
	echo "<div id='rabots'><table>";
	foreach($dirs as $ceh){
		unset($cehrus);
		include ("cehrename.php");
		$direct = "./$di/$ech/$ceh/$year/$mesday/";
		//echo("dir=$dir<br>");
		if (file_exists($direct)) {
			$dir_okn = opendir ("$direct");
			
			while (false !==( $file = readdir ($dir_okn))){
					if (( $file != ".") && ($file != "..")){
						unset($otmena, $okno);
						$otmena = substr_count("$file","otmena");
						$okno = substr_count("$file","okno");
						if($otmena ==0 and $okno !=0){
							//$filsr[] = $file;
//							echo("file=$file  n_okn=$n_okn<br>");
							//читаем файл и выводим данные на экран --------------
							$file_tmp = file("$direct$file");
							$striprf = "$file_tmp[0]";
							//print_r($file_tmp);
//							echo("$striprf<br>");
							
							//вывод формы окна $striprf
							$dop02 = $n_okn;
							
							$filename = "./$di/$ech/$ceh/$year/$mesday/$file";
							$striprf = str_replace("b-b","</br>", $striprf);
							$maswork = explode("|", $striprf);
							$i=$n_okn;
							
							
							$asapvo = "$maswork[44]";
							$asapvo_mas = explode(";", $asapvo);
							
							$hours = floor($asapvo_mas[1]/60);
							$minutes = $asapvo_mas[1] - ($hours*60);
							
							$asapvo_mas[5] = str_replace("выполнение работ: ЭЧ-1 ","", $asapvo_mas[5]);
							
							$mestorabot = $maswork[13];
							
							$mestorabot = str_replace("Станция ", "", $mestorabot);
							
							unset($put, $put_ok);
							$put_ok = $mestorabot;
							
							unset($put);
							$put = substr_count("$mestorabot", "п.2");
							if($put > 0){
								$put_ok = "по 2 пути перегона $mestorabot</br>
								от стрелки №  станции </br>
								до стрелки №  станции </br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "п.1");
							if($put > 0){
								$put_ok = "по 1 пути перегона $mestorabot</br>
								от стрелки №  станции </br>
								до стрелки №  станции </br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "Путь 2");
							if($put > 0){
								$put_ok = "по 2 пути, со съездами:  станции $mestorabot</br>
								от входного светофора «Ч»</br>
								до входного светофора «НД»</br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "Путь 1");
							if($put > 0){
								$put_ok = "по 1 пути, со съездами:  станции $mestorabot</br>
								от входного светофора «Н»</br>
								до входного светофора «ЧД»</br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "Пути 2");
							if($put > 0){
								$put_ok = "по 2 пути, со съездами:  станции $mestorabot</br>
								от входного светофора «Ч»</br>
								до входного светофора «НД»</br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "Пути 1");
							if($put > 0){
								$put_ok = "по 1 пути, со съездами:  станции $mestorabot</br>
								от входного светофора «Н»</br>
								до входного светофора «ЧД»</br>";
							}
							
							
							
							//echo("$asapvo<br>");
							echo "<tr COLSPAN='5'><td>
								<hr color='#006633' />
								<p style='text-align: center;'>
								<b>Заявка №</b>
								</p>
								<p style='text-align: left;'>
								Участок ЭЧ-1</br>
								$date</br>
								</br>
								ДЦУП <b>$circle</b>  круга			от ЭЧЦ-1</br>
								Для производства работ на контактной сети</br>
								Прошу снять напряжение с контактной сети:</br>
								<b>$put_ok 
								</br></b>
								Продолжительностью $hours час. $minutes мин.</br>
								Для чего закрыть для движения всех поездов</br>
								Все указанные пути и съезды для работы с <b>автомотрисы</b>.</br>
								Комментарий:  $maswork[11].</br>
								</br>
								<b>$asapvo_mas[5]</b></br>
													ЭЧЦ-1  <b>$fioechc</b></br>
								</p>
								
								<!-- ПРИКАЗ №______ с _____ до ________ДНЦ _____________ЭЧЦ _____________</br>
								Уведомление №_______ в ________Приказ ДНЦ на открытие № _________</br>
								</br>
								-->
								</td></tr>
								";
							
							
							$n_okn = $n_okn +1;
						}
					}
			}
			closedir ($dir_okn);
		}
	}	
	$n2 = $n_okn;
	echo "</table></div>";
	//end цикл по цехам












								
        //----------------------------------------


 
 
 
 
 
 
 
 
 
 ?>