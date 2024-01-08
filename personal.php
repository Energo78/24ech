<?php
	//разбиваем файл в массив по строкам
	//$ceh_person = "ЭЧК-05";
	$personal_array =  file ("http://localhost/personal.csv");
	$n_person = count($personal_array);
	$n = 0;
	for($i=0; $i < count($personal_array); $i++)
		{
			
			$vhod = substr_count($personal_array[$i], "$ceh_person");
			if ($vhod > 0)
			{
				$personalmassiv[$n] = $personal_array[$i];
				//echo "$personalmassiv[$n]<br>$n<br>";
				$n_ceh_person++;
				$n++;
			};
		};
//	echo "$n_person<br>";
//	echo "$n_ceh_person<br>";
	 echo "<textarea rows='30' name='personal' cols='20'>";
	//разбиваем строки
	for($i=0; $i < $n_ceh_person; $i++)
	{
		$str_exp_pers = explode(";", $personalmassiv[$i]);
		echo "$str_exp_pers[2]\r\n";
	};

	 echo "</textarea>";


?>