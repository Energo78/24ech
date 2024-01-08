<?php
	
	if ($ceh==""){
		exit;
	;}
	unset ($personal_array, $str_exp_pers, $tabnamber, $fio, $fio2, $personal_array2, $pers_arr2);
	
	$filename = "./$di/$ech/$ceh/pers.csv";
	if (file_exists($filename)) {
		$personal_array =  file ("./$di/$ech/$ceh/pers.csv");
	};
	$pers_arr2 = $personal_array;
	$filename = "./$di/$ech/$ceh/persudal.csv";
	if (file_exists($filename)) {
		$personal_array2 =  file ("./$di/$ech/$ceh/persudal.csv");
		$pers_arr2 = array_merge($personal_array2, $personal_array);
	};
	
	// print_r ($pers_arr2);
	// echo "!!! --- ./$di/$ech/$ceh/pers.csv --- !!!<br>";
	 // print_r ($personal_array);
	$n_person = count($personal_array);
	$n_person2 = count($pers_arr2);
	$n_pers_deistv = $n_person;
	
	for($i=0; $i < count($pers_arr2); $i++){//персонал вместе с удалёнными
		$str_exp_pers = explode(";", $pers_arr2[$i]);
		settype($str_exp_pers[5],integer);
		$tabnamber = $str_exp_pers[5];
		$fio2[$tabnamber]=$str_exp_pers[2];
	};
	
	
	for($i=0; $i < count($personal_array); $i++){
		$str_exp_pers = explode(";", $personal_array[$i]);
		// print_r ($str_exp_pers);
		settype($str_exp_pers[5],integer);
		$tabnamber = $str_exp_pers[5];
		$fio[$tabnamber]=$str_exp_pers[2];
		// echo "!!! $str_exp_pers[2] !!!";
		if ($option!=""){
			echo "$fio[$tabnamber]$option";
		};
		if ($optab == 1){
			if ($otchet2016 != 1 and $filtr==""){ //из otchet_04.php (отсекаем echo для месячного отчёта)
				if ($fio[$tabnamber]!=""){
					if ($kratko == ""){
						echo "<tr><td>$fio[$tabnamber]</td><td></td></tr>";
					}
				}else{
					echo "<tr><td>$fio2[$tabnamber]</td><td></td></tr>";
				};
			};
		}
	};
	
	

	
	
	
	
	
	
	
	
	
?>