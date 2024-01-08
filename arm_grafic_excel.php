<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//$titl = "ГРАФИК";
//include "head.html";

//получаем данные POST  --------------------------------------------
$di=$_POST["di_excel"];
$ech=$_POST["ech_excel"];
$ceh=$_POST["ceh_excel"];
$cehrus=$_POST["cehrus_excel"];
$mesy = $_POST["mes_excel"];
$n_row = 0; //для вывода графика


//подключаем БД персонала ------------------------------------------
include "pers_arr.php";




$filename = "./$di/$ech/$ceh/graf_$mesy.csv";
//echo"!-filename = $filename -!<br>";

include ("cehrename.php");

//Подгружаем ГРАФИК С ДАННЫМИ -----------------------------------------------------------

	if (file_exists($filename)){ 
		$file = fopen("$filename","r");
		if(!file){
			echo("Ошибка открытия файла графика");
		};
		$stroka = fgets ($file);
		$maspers = explode("|", $stroka);
		// print_r ($maspers);
		fclose ($file);
//		include "persgrafic.php";

	}



// Подключаем класс для работы с excel
require_once('Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('Classes/PHPExcel/Writer/Excel5.php');

// Создаем объект класса PHPExcel
$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('График');


// Обработка БД графика $filename +++++++++++++  -----------------------------------------------------

		
		//выводим:
		// Вставляем текст в ячейку C1
		$cehrus = iconv("windows-1251", "utf-8", $cehrus);
	$sheet->setCellValue("C1", "ГРАФИК НА $mesy МЕСЯЦ по $cehrus.");
	$sheet->getStyle('C1')->getFill()->setFillType(
	  PHPExcel_Style_Fill::FILL_SOLID);
	$sheet->getStyle('C1')->getFill()->getStartColor()->setRGB('EEEEEE');

	// Объединяем ячейки
	$sheet->mergeCells('C1:W1');

	// Выравнивание текста
	$sheet->getStyle('C1')->getAlignment()->setHorizontal(
	    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    
	    
		/*echo "<div id='contpers'><p>ГРАФИК НА $date МЕСЯЦ по $cehrus.</p>";
		echo "<table><tr><td>ФИО</td><td>Таб.№</td>";*/
		
		
		
		
		//дни месяца в строку ------------------------------------------------------
		$save_d = explode(".", $mesy);
		$mes = $save_d[0];
		$year = $save_d[1];
		
		
				
        
		for($day = 1; $day < 32; $day++){ //перебор дня месяца
							
			$m = date( 'm', mktime(0,0,0,$mes,$day,$year) ); 
			if($m != $mes){
//				echo("<br> m != mes --");
			}else{
			
			//какой день недели?
				$dayweek = date(N, mktime(0,0,0,$mes,$day,$year));
				if($dayweek > 5){
					$style = "style='background-color: #e76663'";
				}else{
					$style = "";
				}
				
				$sheet->setCellValueByColumnAndRow(1 + $day, 3, "$day");
				
				$n_col = 1 + $day;
				$n_col_str = PHPExcel_Cell::stringFromColumnIndex($n_col);
				$sheet ->getColumnDimension($n_col_str)->setWidth(4);
				
				// Применяем выравнивание
				$sheet->getStyleByColumnAndRow(1 + $day, 3)->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
//				echo "<td $style>$day</td>";
				$day_last = $day;
			}
		}
		//--------------------------------------------------------------------------
		
		
		
		settype($day_last, integer);

/*		echo "</tr>
		<form action='arm_grafic.php' method='POST'>
		<INPUT TYPE=hidden NAME='mes' VALUE='$date'>
		<INPUT TYPE=hidden NAME='save' VALUE='on'>
		<INPUT TYPE=hidden NAME='di' VALUE='$di'>
		<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
		<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
		";*/
		$z=0;
		for($i=0; $i < count($personal_array); $i++){//персонал
			$str_exp_pers = explode(";", $personal_array[$i]);
			settype($str_exp_pers[5],integer);
			$tabnamber = $str_exp_pers[5];
			$fio[$tabnamber]=$str_exp_pers[2];
		};
		for($i=0; $i < count($pers_arr2); $i++){//персонал вместе с удалёнными
			$str_exp_pers = explode(";", $pers_arr2[$i]);
			settype($str_exp_pers[5],integer);
			$tabnamber = $str_exp_pers[5];
			$fio2[$tabnamber]=$str_exp_pers[2];
		};
		$n_for_pers = count ($pers_arr2);
		$n001=count($maspers);
		$n =  ((count($maspers))/33);
		//echo "!!!- $n - $n001 - ! $n_for_pers !";
		if ($n==0){
			$n = $n_person;
			//echo "! - - $n";
		}
		
		//массив табномеров из действ персонала
		for($i=0; $i < count($personal_array); $i++){
			$str_exp_pers = explode(";", $personal_array[$i]);
			$tabn[$i]=$str_exp_pers[5];
			$zy = $tabn[$i];
			// echo "!!! $fio[$zy]  $tabn[$i] !!!<br>";
		}
			
		//вывод графика
		
		$sheet ->getColumnDimension("A")->setWidth(20);
		$sheet ->getColumnDimension("B")->setWidth(10);
		
		
		for($i=0; $i < $n; $i++){
			//определим ФИО по табномеру
			$tn=$maspers[$z];
			for($in=0; $in < count($tabn); $in++){
				if ($tabn[$in]==$tn){
					//	echo "совпадает!";
					$tabn[$in] = "";
				}
			}
			$fioage = $fio2[$tn];
			if ($newgraf > 0){
				$str_exp_pers = explode(";", $personal_array[$i]);
				$fioage="$str_exp_pers[2]";
				$tn=$str_exp_pers[5];
			};
			//settype($fioage, string);
			if($fioage ==""){
				$fioage = "ФИО не найдены";
			}
						
			$fioage = iconv("windows-1251", "utf-8", $fioage);
			$sheet->setCellValueByColumnAndRow(0, 4+$n_row, "$fioage");
			$sheet->setCellValueByColumnAndRow(1, 4+$n_row, "$tn");
			$n_row++;
			/*echo "<tr><td>$yach01</td><td>$tn
			<INPUT TYPE=hidden NAME='tabnamber-$tn' VALUE='$tn'></td>";*/
			for ($y=1; $y < $day; $y++){// $z - значение часов из файла графика
				$z = $z+1;
				
				$cell = "$maspers[$z]"; 
				$cell = iconv("windows-1251", "utf-8", $cell);
				if($day_last > $y-1){
					$sheet->setCellValueByColumnAndRow(1 + $y, 3+$n_row, "$cell");
					$sheet->getStyleByColumnAndRow(1 + $y, 3+$n_row)->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//					echo "<td><input name='$y-$tn' type='text' value='$maspers[$z]' size='1' maxlength='3'></td>";

				}else{
//					echo "<td><input name='$y-$tn' type='hidden' value='$maspers[$z]'></td>";
				}
			};
			$z=$z+1;
//			echo "</tr>";

		};
		
		if($newgraf !=1){//добавим новых
			for($in=0; $in < count($tabn); $in++){
					if ($tabn[$in]!=""){
						$tn = $tabn[$in];
						$yach01 = $fio[$tn];
						
				
						/*echo "<tr><td>$yach01</td><td>$tn
						<INPUT TYPE=hidden NAME='tabnamber-$tn' VALUE='$tn'></td>";*/
						for ($y=1; $y < $day; $y++){// $z - значение часов из файла графика
							$z = $z+1;
							if($day_last > $y-1){
//								echo "<td><input name='$y-$tn' type='text' value='' size='1' maxlength='3'></td>";
							}else{
//								echo "<td><input name='$y-$tn' type='hidden' value=''></td>";
							}
						};
//						echo "</tr>";
					}
			}
		}
		



// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=grafic.xls" );

// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
 $objWriter->save('php://output');

 ?>