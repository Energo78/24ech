<?php

setlocale(LC_ALL, "Russian_Russia.1251"); // установили локаль для русских букв

$dir = "./$di/$ech/";
if (file_exists($dir)) 
{$n=0;
	$dir = opendir ("$dir");
	while ( $file = readdir ($dir))
	{
		
		if (( $file != ".") && ($file != ".."))
		{
			// $dirsarr[] = $file;
			//echo "$file</br>";
			unset ($str_exp_pers, $allpers_arr);
			$allpers_arr =  file ("./$di/$ech/$file/pers.csv");
			$n_persall = count($allpers_arr);
			
			for($i=0; $i < $n_persall+1; $i++){
				$str_exp_pers = explode(";", $allpers_arr[$i]);
				$tabnamber = $str_exp_pers[5];
				$fio[$tabnamber]=$str_exp_pers[2];
				$n=$n+$i;
				$persmass[$n] = $fio[$tabnamber];
				// echo "$fio[$tabnamber]$option";
			};
			
			
		};
	
	};
	closedir ($dir);
};
sort($persmass, SORT_STRING);
	for($i=1; $i < count($persmass); $i++){
		echo "$persmass[$i]$option";
	};

	
	unset ($persmass);	
?>