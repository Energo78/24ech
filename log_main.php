<?php
//главный общий лог сайта

//получаем данные:(post,key,url, ip, fiov)

//	ДАННЫЕ ИЗ POST
	foreach ($_POST as $ArrKey => $ArrStr){
                $mass[] = "$ArrStr"; //здесь по строкам данные из POST
                $keymas[] = "$ArrKey";
        };
        
//заголовки
	$headers = GetAllHeaders();
	foreach($headers as $header=>$value){
		$header2[] = $value;
	};
	$url = $_SERVER['REQUEST_URI'];
	
	$count_m = count($mass);
	$count_k = count($keymas);
	
	
	/*echo("ip=$ip, fiov = $fiov<br>headers= ");
	echo("$header2[1]");
	echo("<br>count_k= $count_k");
	echo("<br>count_m= $count_m");
	echo("<br>key= ");
	print_r($keymas);
	echo("<br>mass= ");
	print_r($mass);
	echo("<br>");*/
		
	
	//save in file ----------------------------------------
		//пишем лог-файл добавления события
		if($count_k != 0){
			$key_str = implode(",",$keymas);
			$key_str = str_replace("\r","",$key_str);
			$key_str = str_replace("\n","",$key_str);
		}	
		if($count_m != 0){
			$mass_str = implode(",",$mass);
			$mass_str = str_replace("\r","",$mass_str);
			$mass_str = str_replace("\n","",$mass_str);
		}
			$iplog = str_replace(".","","$ip");
			$iplog = str_replace(":","","$ip");
			include "date_functions.php";
			$logtime = "$year$mes";
			$log =  fopen ("$id_pc/log/log$iplog$ech$logtime.csv","a");
			if(!$log){
				echo("Ошибка открытия файла eu83log$ech$logtime.csv при добавлении записи!");			}
			$datetime = date("d.m.Y Время H:i:s");
			fputs ($log, $datetime);
			fputs ($log, "\n ip: $ip  FIO=$fiov\n header= $header2[1] \n URL = $url \n");
			fputs ($log, "mass= $mass_str\n ");
			fputs ($log, "key_str= $key_str\n\n");
			fclose ($log); //окончание записи лог-файла...
	//-----------------------------------------------------
	
	



unset($ArrKey, $ArrStr, $mass, $keymas, $header, $headers, $header2, $value, $iplog, $logtime, $datetime, $url, $count_m, $count_k, $mass_str, $key_str);

?>