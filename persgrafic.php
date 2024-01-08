<?php
// Обработка БД графика $filename

		
		//выводим:
		echo "<div id='contpers'><p>ГРАФИК НА $date МЕСЯЦ по $cehrus.</p>";
		echo "<table><tr><td>ФИО</td><td>Таб.№</td>";
		
		
		for($day = 1; $day < 32; $day++){ //перебор дня месяца
			$m = date( 'm', mktime(0,0,0,$mes,$day,$year) ); 
			if($m != $mes){
//				echo("<br> m != mes --");
			}else{
			
			//какой день недели?
				$dayweek = date(N, mktime(0,0,0,$mes,$day,$year));
				if($dayweek > 5){
					$style = "style='background-color: #e76663'";
				}else{
					$style = "";
				}

				echo "<td $style>$day</td>";
				$day_last = $day;
			}
		}
		settype($day_last, integer);

		echo "</tr>
		<form action='arm_grafic.php' method='POST'>
		<INPUT TYPE=hidden NAME='mes' VALUE='$date'>
		<INPUT TYPE=hidden NAME='save' VALUE='on'>
		<INPUT TYPE=hidden NAME='di' VALUE='$di'>
		<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
		<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
		";
		$z=0;
		for($i=0; $i < count($personal_array); $i++){//персонал
			$str_exp_pers = explode(";", $personal_array[$i]);
			settype($str_exp_pers[5],integer);
			$tabnamber = $str_exp_pers[5];
			$fio[$tabnamber]=$str_exp_pers[2];
		};
		for($i=0; $i < count($pers_arr2); $i++){//персонал вместе с удалёнными
			$str_exp_pers = explode(";", $pers_arr2[$i]);
			settype($str_exp_pers[5],integer);
			$tabnamber = $str_exp_pers[5];
			$fio2[$tabnamber]=$str_exp_pers[2];
		};
		$n_for_pers = count ($pers_arr2);
		$n001=count($maspers);
		$n =  ((count($maspers))/33);
		//echo "!!!- $n - $n001 - ! $n_for_pers !";
		if ($n==0){
			$n = $n_person;
			//echo "! - - $n";
		}
		
		//массив табномеров из действ персонала
		for($i=0; $i < count($personal_array); $i++){
			$str_exp_pers = explode(";", $personal_array[$i]);
			$tabn[$i]=$str_exp_pers[5];
			$zy = $tabn[$i];
			// echo "!!! $fio[$zy]  $tabn[$i] !!!<br>";
		}
			
		//вывод графика
		for($i=0; $i < $n; $i++){
			//определим ФИО по табномеру
			$tn=$maspers[$z];
			for($in=0; $in < count($tabn); $in++){
				if ($tabn[$in]==$tn){
					//	echo "совпадает!";
					$tabn[$in] = "";
				}
			}
			$yach01 = $fio2[$tn];
			if ($newgraf > 0){
				$str_exp_pers = explode(";", $personal_array[$i]);
				$yach01="$str_exp_pers[2]";
				$tn=$str_exp_pers[5];
			};
			echo "<tr><td>$yach01</td><td>$tn
			<INPUT TYPE=hidden NAME='tabnamber-$tn' VALUE='$tn'></td>";
			for ($y=1; $y < $day; $y++){// $z - значение часов из файла графика
				$z = $z+1;
				if($day_last > $y-1){
					echo "<td><input name='$y-$tn' type='text' value='$maspers[$z]' size='1' maxlength='3'></td>";
				}else{
					echo "<td><input name='$y-$tn' type='hidden' value='$maspers[$z]'></td>";
				}
			};
			$z=$z+1;
			echo "</tr>";

		};
		
		if($newgraf !=1){//добавим новых
			for($in=0; $in < count($tabn); $in++){
					if ($tabn[$in]!=""){
						$tn = $tabn[$in];
						$yach01 = $fio[$tn];
						echo "<tr><td>$yach01</td><td>$tn
						<INPUT TYPE=hidden NAME='tabnamber-$tn' VALUE='$tn'></td>";
						for ($y=1; $y < $day; $y++){// $z - значение часов из файла графика
							$z = $z+1;
							if($day_last > $y-1){
								echo "<td><input name='$y-$tn' type='text' value='' size='1' maxlength='3'></td>";
							}else{
								echo "<td><input name='$y-$tn' type='hidden' value=''></td>";
							}
						};
						echo "</tr>";
					}
			}
		}
		
		
		echo "</table>
		<div class='no_print'>
		<p><INPUT TYPE=submit class='red goodbutton' VALUE='Сохранить'></form></p>
		";
		echo "Всего в цехе $cehrus: $n_person работников.<br/></div>
		
		";
		echo "</div>";
			
			
			?>