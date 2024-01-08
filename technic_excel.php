<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//$titl = "Техника НТЭ в EXCEL";

//получаем данные GET  --------------------------------------------
$div = ($_COOKIE[div]);
if($div==""){
	$div="di_01";
}
$date = $_GET[date];
include("date_functions.php");
$period = $_GET[period];
if($period=="08-20"){
		$periodamdm="am";	
	}else if($period=="20-08"){
	 	$periodamdm="pm";
	 }

$n_row = 0; //для вывода графика




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
//форматируем ориентацию и область печати
$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$sheet->getPageSetup()->setFitToPage(true);
$sheet->getPageSetup()->setFitToWidth(1);
$sheet->getPageSetup()->setFitToHeight(0);

// Подписываем лист
$sheet->setTitle('ТЕХНИКА НТЭ');


		//для бордюров таблицы
		$border = array(
			'borders'=>array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
		);
		
		
		//заливка 
		$bg=array(
			'fill'=>array(
				'type'=>PHPExcel_Style_Fill::FILL_SOLID,
				'color'=> array('rgb' => 'FF7979')
			)
		);
		
		

		// Вставляем текст в ячейку A1
		//$cehrus = iconv("windows-1251", "utf-8", $cehrus);
		$sheet->setCellValue("A1", "ОТЧЕТ по ССПС ПО ХОЗЯЙСТВУ ЭЛЕКТРИФИКАЦИИ И ЭЛЕКТРОСНАБЖЕНИЯ на $date за период $period.");
	$sheet->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EDED67');

	// Объединяем ячейки
	$sheet->mergeCells('A1:T1');

	// Выравнивание текста
	$sheet->getStyle('A1')->getAlignment()->setHorizontal(
	    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// Вставляем текст в ячейки Шапки таблицы
		$sheet->setCellValue("B1", "Цех");
		$sheet->setCellValue("C2", "Место дислокации");
		$sheet->setCellValue("D2", "Тип");
		$sheet->setCellValue("E2", "Номер");
		$sheet->setCellValue("F2", "Топливо");
		$sheet->setCellValue("G2", "Запас");
		$sheet->setCellValue("H2", "Кран");
		$sheet->setCellValue("I2", "Вышка");
		$sheet->setCellValue("J2", "вцелом");
		$sheet->setCellValue("K2", "до ремонта");
		$sheet->setCellValue("L2", "Машинист");
		$sheet->setCellValue("M2", "по графику");
		$sheet->setCellValue("N2", "факт");
		$sheet->setCellValue("O2", "Помощник");
		$sheet->setCellValue("P2", "по графику");
		$sheet->setCellValue("Q2", "факт");
		$sheet->setCellValue("R2", "явка");
		$sheet->setCellValue("S2", "до");
		$sheet->setCellValue("T2", "Примечание");

	
	
	
	
		//присваиваем значения:

		$sheet ->getColumnDimension("A")->setWidth(7);
		$sheet ->getColumnDimension("B")->setWidth(7);
		$sheet ->getColumnDimension("C")->setWidth(20);
		$sheet ->getColumnDimension("D")->setWidth(7);
		$sheet ->getColumnDimension("E")->setWidth(7);
		$sheet ->getColumnDimension("F")->setWidth(7);
		$sheet ->getColumnDimension("G")->setWidth(7);
		$sheet ->getColumnDimension("H")->setWidth(10);
		$sheet ->getColumnDimension("I")->setWidth(10);
		$sheet ->getColumnDimension("J")->setWidth(10);
		$sheet ->getColumnDimension("K")->setWidth(10);
		$sheet ->getColumnDimension("L")->setWidth(20);
		$sheet ->getColumnDimension("M")->setWidth(15);
		$sheet ->getColumnDimension("N")->setWidth(15);
		$sheet ->getColumnDimension("O")->setWidth(20);
		$sheet ->getColumnDimension("P")->setWidth(15);
		$sheet ->getColumnDimension("Q")->setWidth(15);
		$sheet ->getColumnDimension("R")->setWidth(7);
		$sheet ->getColumnDimension("S")->setWidth(7);
		$sheet ->getColumnDimension("T")->setWidth(20);
		$sheet ->getColumnDimension("U")->setWidth(15);
		
		

	    


//echo("role = $role<br>");

//0.0 Читаем БД (читаем все ЭЧ)-------------------------------------------------

	unset($file_array);
//читаем папку дирекции//получаем список файлов каталога
	$dir = "./technics/$div/";
	unset ($dirs, $n_cehov);
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
	
	
	$massiv = array();
	foreach($dirs as $ech_i){
		$dirf = "./technics/$div/$ech_i/$year/$mes/technics$day$periodamdm.csv";
		
		if (!file_exists($dirf)){
//			echo("<br>Файл БД ЭУ-83 $ech_i за $mes месяц $year года не найден.<br>");
		}else{
			//разбиваем файл в массив по строкам
			$file_array =  file ("$dirf");
			$massiv = array_merge($massiv, $file_array);
		}
		
	}
	
	
//	sort($massiv);
	$n = count($massiv);
//	unset($file_array);
	$file_array = $massiv;
//	unset($massiv);
	


/*echo("<br>start<br>");
print_r($file_array);
echo("<br>end<br>");
*/




// Обработка БД $file_array +++++++++  -----------------------------------------

//function
function gettr ($sheet, $n_row, $ech_naim, $n_adm){
	$n_x = 3+$n_row;
	$i1 = "A$n_x"; $i_end = "T$n_x";
	$sheet->mergeCells("$i1:$i_end");
	$sheet->getStyle("$i1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$sheet->getStyle("$i1")->getFill()->getStartColor()->setRGB('EDED67');
	$sheet->setCellValueByColumnAndRow(0, 3+$n_row, "Всего по $ech_naim техники: $n_adm единиц");
}



$n_row = 0;
$schet1 = 0;
		foreach ($file_array as $string) {
			$string = iconv("windows-1251", "utf-8", $string);
			$string = str_replace("b--b", "\n", $string);
			$str_exp = explode(";", $string);
			
			
			if($ech_naim != "$str_exp[1]"){
				
				if($ech_naim !=""){
					// Объединяем ячейки
					$n_adm = $schet1 + 1;
					gettr ($sheet, $n_row, $ech_naim, $n_adm);
					
					$n_row++;
				}
				
				$ech_naim = $str_exp[1];
				$schet1 = 0;
				
			}else{
				$schet1++;
			}
			
				
			

			
			
		
				//здесь присваиваем значения ячейкам
				for ($i = 0; $i < 20 ; $i++) {
					$str_e = $str_exp[$i+1];
					$str_e = str_replace("ech","ЭЧ-", "$str_e");
					$sheet->setCellValueByColumnAndRow($i, 3+$n_row, "$str_e");
					$sheet->getStyleByColumnAndRow($i, 3+$n_row)->getAlignment()->	setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$sheet->getStyleByColumnAndRow($i, 3+$n_row)->getAlignment()->	setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$sheet->getStyleByColumnAndRow($i, 3+$n_row)->getAlignment()->	setWrapText(true);
					
					if($str_e =="без дежурства" OR $str_e =="неисправен" OR $str_e =="неисправна"){
						$sheet->getStyleByColumnAndRow($i, 3+$n_row)->applyFromArray($bg);
					}
					
				}
				
				
				
				$n_row++;
				

			


			unset($str_exp);
		}
		
		
		//нижняя строка таблицы-------------------
		$n_adm = $schet1 + 1;
		gettr ($sheet, $n_row, $ech_naim, $n_adm);
		//----------------------------------------

		unset($file_array);

		$n_row2 = $n_row +2;
		$T="T$n_row2";
		

		$sheet->getStyle("A2:$T")->applyFromArray($border);
	
	






		
		
		


// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=NTEtechnics.xls" );

// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
 $objWriter->save('php://output');

 ?>