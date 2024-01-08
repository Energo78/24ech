<?php
//подключаем цеха
		unset ($dirs, $dirs0);
		$ceh2 = $ceh;
		$dir0 = $_SERVER['DOCUMENT_ROOT']."/$di/";
		if (file_exists($dir0)){
				$dir0 = opendir ("$dir0");
				while ( $file = readdir ($dir0)){
						if (( $file != ".") && ($file != "..")){
							$dirs0[] = $file;
						};
				};
				closedir ($dir0);
			};
		
		foreach($dirs0 as $dir_ech){
			$dir = $_SERVER['DOCUMENT_ROOT']."/$di/$dir_ech/";
			if (file_exists($dir)){
				$dir = opendir ("$dir");
				while ( $file = readdir ($dir)){
						if (( $file != ".") && ($file != "..")){
							$dirs[] = $file;
						};
				};
				closedir ($dir);
			};
		};
		
//		print_r($dirs);
		
		unset($ech_arr);
		
		foreach($dirs as $ceh){
			$cehrus="";
			include "cehrename.php";
//			$ech_arr[]=$cehrus;
			$ceha_all = "$ceha_all<option>$cehrus";
		}
		
		unset ($cehrus, $ceh);
//		print_r($ech_arr);
		
		




?>

