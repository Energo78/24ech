<?php 
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//формируе данные из пост ----------------------------------------
	$di=$_POST["di"];
	$ech=$_POST["ech"];
	$date=$_POST["date_otchet_v1"];
	if ($date==""){$date = date('d.m.Y');};
	$mes=$_POST["mes"];
	$year=$_POST["year"];
	$cehrus=$_POST["cehrus"];
	$ceh=$_POST["ceh"];
	$otchet_v1 = $_POST["otchet_v1"];
	
	unset($mass, $keymas, $mas_otch_v1);
	foreach ($_POST as $ArrKey => $ArrStr)
    {
		$mass[] = $ArrStr;
        $keymas[] = $ArrKey;
        $mas_otch_v1[$ArrKey] = $ArrStr;
	};
	
	$titl = "Отчёт";
	
	include "head.html";
	
	print_r($mass);
	echo("</br>");
	print_r($keymas);
	echo("</br>");
	print_r($mas_otch_v1);
	
	//пробегаем по заданным датам -------------------------------
//	есть: эч, дата
//	формируем даты и массив цехов
	include ('date_functions.php');
	include "ceha.php";//$dirs - массив с цехами
	
	foreach($dirs as $ceh_op2){
		$dir = "./$di/$ech/$ceh_op2/$year/$mesday/";
		//echo("dir = $dir -!</br>");
		if (file_exists($dir)) {
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir))
			{
					if (( $file != ".") && ($file != ".."))
					{
							if ($file != "eche.csv")
							{
			$fileaddr = "./$di/$ech/$ceh_op2/$year/$mesday/$file";
			$filsr1 = file("$fileaddr");
									$filname[] = "$file";
									$filname_tmp = "$file";
									$filsr[$filname_tmp] = $filsr1[0];	
									$n++;
							};
					};
			};
			closedir ($dir);
			 
	}}
//	строки из файлов:
	foreach($filname as $fi_n){
		echo("<br>$fi_n<br>$filsr[$fi_n]<br><br>");
		//обнуляем масси фильтра
		unset ($arr_filter);
		//отсекаем отмены если чекбокс не снят
		if($mas_otch_v1[otmeny_on] =="on"){
			
		}
	}
//	print_r ($filsr); echo("</br></br>");
//	print_r ($filname); echo("</br></br>");
	
	
		for($i = 0; $i < 46; $i++){//применяем фильтр -----------
			if($mas_otch_v1[$i] =="on"){
				
			}
		}


echo("</body></html>");

?>