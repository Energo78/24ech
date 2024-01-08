<?php
//подключаем цеха
		unset ($dirs);
		$ceh2 = $ceh;
		$dir = "$id_pc/$di/$ech/";
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
			
			//выводим цеха
			unset ($ceha, $cehrus);
			for ($i=0;$i < count($dirs); $i++){
				$ceh = "$dirs[$i]";
				include "cehrename.php";
				$ceha = "$ceha<option>$cehrus";
				unset ($cehrus, $ceh);
			};
		$ceh = $ceh2;
	
		include "cehrename.php";
$mesyachs = "<option>01<option>02<option>03<option>04<option>05<option>06<option>07<option>08<option>09<option>10<option>11<option>12";
$yearsn = date(Y);

$years = "<option>";

for ($i=2015;$i < $yearsn+2 ; $i++){
	$years = "$years<option>$i";
}
$years = "<option>$yearsn<option>$years";



?>

