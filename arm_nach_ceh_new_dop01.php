<?php

	echo"
		<div id='frame_in1'>
			<b>$dayw[$n]</b><br>
			
	";
	// $ceh<br>
	// $cehrus<br>
		settype($dayw[$n], string);
		unset($datedrop, $dir, $filsr, $file, $stripr);
		$datedrop = explode(".",$dayw[$n]);
		$year= $datedrop[2];
		$mes = $datedrop[1];
		$day = $datedrop[0];
		$mesday= "$mes$day";
		//echo "<br>$n - $year - $mes - $day - $mesday<br>";








		
	//читаем работы --------------------------------------------------------
		//получаем список файлов каталога
		$n_files=0;
		$dir = "./$di/$ech/$ceh/$year/$mesday/";
		//echo "</br>! dir = $dir -!</br>";
		if (file_exists($dir)) {
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir))
			{
					if (( $file != ".") && ($file != ".."))
					{
							if ($file != "eche.csv")
							{
									$filsr[] = $file;
									$n_files++;
							};
					};
			};
			closedir ($dir);
			// print_r ($filsr);
			//echo "</br>! $n_files ! dir = $dir -!</br>";// возвращаем число файлов

			echo "<div id='list'>";
			for($i=0; $i < count($filsr); $i++){
				unset($otmena);
				$otmena = substr_count("$filsr[$i]","otmena");
				if($otmena ==0){
					$file = fopen("./$di/$ech/$ceh/$year/$mesday/$filsr[$i]","r");
					if(!file)
							{
							  echo("Ошибка открытия файла");
							};
					$stripr[$i] = fgets ($file);
					$stripr[$i] = str_replace("b-b","</br>",$stripr[$i]);
					
					$str_exp = explode("|",$stripr[$i]);
					if ($str_exp[41]!=""){
						$work = $str_exp[11];//пока не время, т.к. пишут выполнено
					}else{
						$work = $str_exp[11];
					}
					echo "<p>
					$str_exp[3]:$str_exp[4]-$str_exp[5]:$str_exp[6]  $str_exp[7] $str_exp[8] $str_exp[9] $str_exp[10] $str_exp[13]: $work</p>";
					
					fclose ($file);
					unset($str_exp);
				}
			};
			echo "<p><div id=cont_min_menu>
				<!-- <a href='arm_nach_ceh_new.php?ceh=$ceh&year=$year&mesday=$mesday&action=podrobno'><img src='../img/Search.png' width=25 alt='Подробно' titl='Подробно'/></a> -->
				<a href='arm_nach_ceh_new.php?date=$dayw[$n]&ceh=$ceh&year=$year&mesday=$mesday&action=izmenenie'><img src='../img/Compose.png' width=25 alt='Изменить' titl='Изменить'/></a>
				</div>
			</p>";
			echo "</div>";

		} else {
			if ($otchet2016 != 1){ 
					echo "Работ не запланировано.
					<p><div id=cont_min_menu>
				<!--	<a href='arm_nach_ceh_new.php?ceh=$ceh&year=$year&mesday=$mesday&action=podrobno'><img src='../img/Search.png' width=25 alt='Подробно' titl='Подробно'/></a> -->
					<a href='arm_nach_ceh_new.php?date=$dayw[$n]&ceh=$ceh&year=$year&mesday=$mesday&action=izmenenie'><img src='../img/Compose.png' width=25 alt='Изменить' titl='Изменить'/></a>
					</div></p>
					";
			};
		};

	//end читаем работы -------------------------------------------------------





	echo"</div>";


?>