<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//$titl = "ЭУ-83 в EXCEL";
//include "head.html";

//получаем данные POST  --------------------------------------------
$mes=$_POST["mes"];
$year=$_POST["year"];
$ipv=$_POST["ipv"];
$di_excel=$_POST["di_excel"];
$ech_excel = $_POST["ech_excel"];
$rukovoditel = $_POST["rukovoditel"];
$role=$_POST["role"];
$echrus =str_replace("ech", "ЭЧ-",$ech_excel);

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
// Подписываем лист
$sheet->setTitle('ЭУ-83');


		
		
		

		// Вставляем текст в ячейку A1
		//$cehrus = iconv("windows-1251", "utf-8", $cehrus);
		$sheet->setCellValue("A1", "Журнал ЭУ-83 за $mes МЕСЯЦ $year года по $echrus.");
	$sheet->getStyle('A1')->getFill()->setFillType(
	  PHPExcel_Style_Fill::FILL_SOLID);
	$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

	// Объединяем ячейки
	$sheet->mergeCells('A1:H1');

	// Выравнивание текста
	$sheet->getStyle('A1')->getAlignment()->setHorizontal(
	    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	
	
	
		//присваиваем значения:

		$sheet ->getColumnDimension("A")->setWidth(1);
		$sheet ->getColumnDimension("B")->setWidth(10);
		$sheet ->getColumnDimension("C")->setWidth(15);
		$sheet ->getColumnDimension("D")->setWidth(45);
		$sheet ->getColumnDimension("E")->setWidth(15);
		$sheet ->getColumnDimension("F")->setWidth(15);
		$sheet ->getColumnDimension("G")->setWidth(15);
		$sheet ->getColumnDimension("H")->setWidth(15);
		//$sheet ->getColumnDimension("A")->setWidth(20);
		
		
		

	    


//echo("role = $role<br>");

//0.0 Читаем БД если role = rukovoditel (читаем все ЭЧ)-------------------------------------------------
if($role == "rukovoditel"){
	unset($file_array);
//читаем папку дирекции//получаем список файлов каталога
	$dir = "./$di_excel/";
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
		$dirf = "./eu83/eu83db$di_excel$ech_i$mes.$year.csv";
		
		if (!file_exists($dirf)){
//			echo("<br>Файл БД ЭУ-83 $ech_i за $mes месяц $year года не найден.<br>");
		}else{
			//разбиваем файл в массив по строкам
			$file_array =  file ("./eu83/eu83db$di_excel$ech_i$mes.$year.csv");
			$massiv = array_merge($massiv, $file_array);
		}
		
	}
	
	
	sort($massiv);
	$n = count($massiv);
//	unset($file_array);
	$file_array = $massiv;
//	unset($massiv);
	
}else{
 	//подключаем БД ЭУ-83 просто ЭЧ --------------------------------
		$dirf = "./eu83/eu83db$di_excel$ech_excel$mes.$year.csv";

		if (file_exists($dirf)) {
			//разбиваем файл в массив по строкам
			$file_array =  file ("./eu83/eu83db$di_excel$ech_excel$mes.$year.csv");
		} else {
//			echo("БД не существует");
			exit;
		};
 }

/*echo("<br>start<br>");
print_r($file_array);
echo("<br>end<br>");
*/




// Обработка БД $file_array +++++++++  -----------------------------------------
$n_row = 0;
		foreach ($file_array as $string) {
			$string = iconv("windows-1251", "utf-8", $string);
			$string = str_replace("b--b", "\n", $string);
			$str_exp = explode("|", $string);

			if ($str_exp[11]=="on") {
				if ($sovp_echc != "") {
					$dontsee = "";
				} else {
					$dontsee = "on";
				}
			} else {
				$dontsee = "";
			}
			
			if ($str_exp[10]=="hidden") {
				$dontsee = "on";
			}
			

			if ($str_exp[6]=="on" AND $dontsee=="") {
				$dostup ="ok";
			} else if ($str_exp[6]=="" AND $dontsee=="" AND $rukovoditel!=1) {
				$dostup ="ok";
			}
			
			
			if ($dostup=="ok") {
				//здесь присваиваем значения ячейкам
				for ($i = 0; $i < 9 ; $i++) {
					$str_e = $str_exp[$i];
					$sheet->setCellValueByColumnAndRow(1+$i, 2+$n_row, "$str_e");
					$sheet->getStyleByColumnAndRow(1+$i, 2+$n_row)->getAlignment()->	setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$sheet->getStyleByColumnAndRow(1+$i, 2+$n_row)->getAlignment()->	setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					$sheet->getStyleByColumnAndRow(1+$i, 2+$n_row)->getAlignment()->	setWrapText(true);
				}
				
				$n_row++;
	

			}


			unset($str_exp, $dostup, $dontsee);
		}

		unset($file_array);

		

		
	
	






		
		
		


// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=eu83.xls" );

// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
 $objWriter->save('php://output');

 ?>