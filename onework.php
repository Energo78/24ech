<?php
ini_set('display_errors',0);
Error_Reporting(E_ALL & ~E_NOTICE);
// выводим работу ----------------------------

			
			            //для отчёта!
                        //pod U
                        if ($maswork[14] != ""){
                                $nar_U = $nar_U + 1;
                                $tameU = $tameU +($maswork[5] + $maswork[6]/60) - ($maswork[3] + $maswork[4]/60);
                        };
                        // obesp PC-PMS
                        if ($maswork[15] != ""){
                                $nar_P = $nar_P + 1;
                        };
                        // obesp EMP
                        if ($maswork[16] != ""){
                                $nar_E = $nar_E + 1;
                        };
                        // проверено экспл длинны
                        if ($maswork[17] != ""){
                                $prov_exp = $prov_exp + $maswork[17];
                        };
                        if ($maswork[18] != ""){
							$obnaruz_zam = $obnaruz_zam + $maswork[18];
						};
                        if ($maswork[19] != ""){
							$ustr_zam = $ustr_zam + $maswork[19];
						};
                        if ($maswork[20] != "")//obesp SHCH
                        {
                                $nar_SH = $nar_SH + 1;
                        };
                        if ($maswork[21] != "")//obesp RCS
                        {
                                $nar_RCS = $nar_RCS + 1;
                        };
                        if ($maswork[22] != "")//obhod
                        {
                                $obhodov = $obhodov + 1;
                        };
                        if ($maswork[23] != "")//obezd
                        {
                                $obezdov = $obezdov + 1;
                        };
                        if ($maswork[26] != "")//совмещённых окон
                        {
                                $sovm = $sovm + 1;
                                $sovm_arr[] = $stripr[$i];
                        };
                        if ($maswork[27] != "")//отремонтировано заземлений
                        {
                                $rem_zz = $rem_zz + $maswork[27];
                        };
                        if ($maswork[28] != "")//обесп. СМП
                        {
                                $obesp_SMP = $obesp_SMP + 1;
                        };
                        if ($maswork[29] != "")//обесп. прочих
                        {
                                $obesp_proch = $obesp_proch + 1;
                        };
                        if ($maswork[24] != "")
                        {
                                $prov_viks = $prov_viks + $maswork[17];
                        }else{
                                $prov_eksp = (int)$prov_eksp + (int)$maswork[17];
                        };
                        if ($maswork[30] != "")// на ВЛ АБ, ПЭ, ДПР
                        {
                                $rab_VL = $rab_VL + 1;
                        };

                        if ($maswork[14] == "on")
                        {$podU = "<b>Работа под напряжением </b>";};
						if ($maswork[30] == "on")
                        {$na_VL_AB_PE_DPR = "<b>Работа на ВЛ АБ, ПЭ, ДПР
</b>";};
                        if ($maswork[15] == "on")
                        {$obespPC_PMS = "<b>Обеспечение ПЧ-ПМС </b>";};
                        if ($maswork[16] == "on")
                        {$obespEMP = "<b>Обеспечение ЭМП </b>";};
                        if ($maswork[20] == "on")
                        {$obespSHCH = "<b>Обеспечение ШЧ </b>";};
                        if ($maswork[21] == "on")
                        {$obespRCS = "<b>Обеспечение РЦС </b>";};
						if ($maswork[29] == "on")
                        {$obespPROCH = "<b>Обеспечение прочих.</b>";};
                        if ($maswork[22] == "on")
                        {$obhod = "<b>Обход</b>";};
                        if ($maswork[23] == "on")
                        {$obezd = "<b>Объезд с осмотром</b>";};
                        if ($maswork[24] == "on")
                        {$obezdVIKS = "<b>Объезд с ВИКС</b>";};
                        if ($maswork[25] == "on")
                        {$v_okno = "<b>в ОКНО</b><br>";};
                        if ($maswork[26] == "on")
                        {$sovm_okno = "<b>Совмещённое окно</b><br>";};
                        if ($maswork[45] == "on")
                        {$otkaz_dnc = "<br><b><font color='red'>Отказ ДНЦ</font></b><br>"; 
                        $otk_dnc = $otk_dnc + 1;
                        }else{$otkaz_dnc="";}
                        if ($maswork[46] == "on"){
                        	$otkaz_echk = "<br><b><font color='red'>Отказ ЭЧК</font></b><br>";
                        	$otk_echk = $otk_echk + 1;
                        }else{$otkaz_echk="";};
                        if ($maswork[17] != "")
                        {$maswork[17] = "Проверено экспл. длины: $maswork[17] км.";};
                        if ($maswork[18] != "")
                        {$maswork[18] = "<br>Выявлено замечаний: $maswork[18] шт.";};
                        if ($maswork[19] != "")
                        {$maswork[19] = "<br>Устранено замечаний: $maswork[19] шт.";};
                        if ($maswork[27] != "")
                        {$maswork[27] = "<br>Отремонтировано заземлений: $maswork[27] шт.";};

                        $str_mesto = "$maswork[7] $maswork[8]<br>$maswork[9] $maswork[10]<br>$maswork[13]";
						// if ($maswork[31] !="")//бригада
                        // {
                                // $maswork[31] = "<b><font color='#040CB2'><br>Бригада:<br>$maswork[31]</b></font>";
                        // }
						$str2 = "";
                        if ($maswork[12] !="")//наряд или распоряжение
                        {
                                $str2 = "Расп.№ $maswork[12]";
                                $rasp_sum = $rasp_sum + 1;
                        }
                        elseif($maswork[1] !="")
                        {
                                $str2 = "Нар№ $maswork[1]";
                                $rabot_po_nar = $rabot_po_nar + 1;
                        }elseif($maswork[32] !=""){
							$str2 = "Тек.Экспл.";
                            $rabot_v_tekexpl = $rabot_v_tekexpl + 1;
						};
						//подсчёт времени
						$t0 = $maswork[5];
						if ($maswork[5] < $maswork[3])
						{$maswork[5] = $maswork[5] + 24;};
						$t1 = ((((int)$maswork[5]*60)+(int)$maswork[6]) - (((int)$maswork[3]*60)+(int)$maswork[4]))/60;
						$t1 = round($t1,2);
						
					if ($maswork[33] !=""){
						if ($maswork[35] < $maswork[33])
						{$maswork[35] = $maswork[35] + 24;};
						$t_p = ((((int)$maswork[35]*60)+(int)$maswork[36]) - (((int)$maswork[33]*60)+(int)$maswork[34]))/60;
						$t_p = round($t_p,2);
						$t_podgot = "Время подготовки:</br>$maswork[33]:$maswork[34]-$maswork[35]:$maswork[36] = $t_p ч.</br>";
					};
					if ($maswork[37] !=""){
						if ($maswork[39] < $maswork[37])
						{$maswork[39] = $maswork[39] + 24;};
						$t_z = ((($maswork[39]*60)+$maswork[40]) - (($maswork[37]*60)+$maswork[38]))/60;
						$t_z = round($t_z,2);
						$t_zaversh = "Время заверш.:</br>$maswork[37]:$maswork[38]-$maswork[39]:$maswork[40] = $t_z ч.";
					};
					$t_obsh = (int)$t_p + (int)$t1 + (int)$t_z - ((int)$maswork[43]/60);
					
					$maswork[41] = str_replace("b-b","</br>", $maswork[41]);
					
					unset($as_apvo);
					if($maswork[44]!=""){//информация из АС АПВО
						$as_apvo_arr= explode(";","$maswork[44]");
						unset($sovpad1,$sovpad2,$sovpad3,$otmena, $otmena1, $otmena2, $otmena3, $otmena_z);
						$sovpad1 = substr_count("$as_apvo_arr[2]","ОТОЗВАНО");
						$sovpad2 = substr_count("$as_apvo_arr[2]", "ОТМЕНА");
						$sovpad3 = substr_count("$as_apvo_arr[3]", "ОТКАЗ");
						
						if($sovpad1 !=""){
							$otmena = "ОКНО ОТОЗВАНО";
							$otmena1=5;
						}else{
							
						}
						
						if($sovpad2 !=""){
							$otmena = "ОТМЕНА ОКНА";
							$otmena2=5;
						}else{
							
						}
												
						if($sovpad3 !=""){
							$otmena = "ОКНО ОТОЗВАНО";
							$otmena3=5;
						}else{
							
						}
						if($otmena1 == 5 or $otmena2==5 or $otmena3==5){
							$as_apvo = $otmena;
							$otmena_z=0;
						}else{
							
							foreach($as_apvo_arr as $asap){
								if($asap !=""){
									if($as_apvo==""){
										$as_apvo = "$asap";
									}else{
										$as_apvo = "$as_apvo<br>$asap";
									}
								}
								
							}
							
							$as_apvo = "<p style='font-size: 80%;'><b>Информация из АС-АПВО:<br>$as_apvo</b><p>";
							$as_apvo = str_replace("<br> <br>","<br>", $as_apvo);
							$as_apvo = str_replace("<br><br>","<br>", $as_apvo);
							
							unset($asap, $as_apvo_arr);
						}
							
						
					}
					
					
				$brigada = explode(";", $maswork[31]);
				$instr = $instr + (count($brigada));
				// echo "<br>!! -- $instr --!!<br>";
				// print_r ($brigada);
			$i2 = $i+1;
			
			if ($otchet2016 != 1){ //из otchet_04.php (отсекаем echo для месячного отчёта)
				if($filtr =="ok"){$i2="$cehrus";};
				if($dateotchmes!=""){$i2=$dateotchmes;}
				echo "<tr><td>$i2<br>$cehrus</td><td>$str2</td><td>Производитель:</br><b>$maswork[2] $maswork[42]</b></br>Бригада:</br><b>";
			};
			unset ($n_chbrig);
			for($y=0; $y < count($brigada); $y++){
				$tab = $brigada[$y];
				settype($tab,integer);
				if ($otchet2016 != 1){ //из otchet_04.php (отсекаем echo для месячного отчёта)
					echo "$fio2[$tab] ";
				};
				$n_chbrig = $n_chbrig + 1;
			};
			$chelovek_chas = $t_obsh * $n_chbrig;
				$tip_rabot = "$v_okno $sovm_okno $podU $obespPC_PMS $obespEMP $obespSHCH $obespRCS $obhod $obezd $obezdVIKS $na_VL_AB_PE_DPR $obespPROCH";
				$tip_rabot = str_replace("  ","","$tip_rabot");
			
			if ($otchet2016 != 1){ //из otchet_04.php (отсекаем echo для месячного отчёта)
				
				echo "</b></br>Время перерывов: $maswork[43] мин.
				</td><td>$t_podgot Время работы:</br>$maswork[3]:$maswork[4]-$t0:$maswork[6] = $t1 ч.</br>$t_zaversh</td>
				<td>$str_mesto
				<br>$otkaz_dnc $otkaz_echk
				</td><td>$tip_rabot</br>$as_apvo
				<hr align='left' width='300' size='2' color='#ff9900' />
				Работа ПЛАН: $maswork[11]</br>
				<hr align='left' width='300' size='2' color='#ff9900' />
				Работа ФАКТ:<font color='#000099'><b> $maswork[41]</b></font>
				<hr align='left' width='300' size='2' color='#ff9900' />
				$maswork[17] $maswork[18] $maswork[19] $maswork[27]</td>
				";
				if ($dateotchmes ==""){
					echo"
					<td style='text-align:center;'>
					<form method=post action=arm_nach_ceh.php>
					<INPUT TYPE=hidden NAME='redactf' VALUE='$filename'>
					<INPUT TYPE=hidden NAME='di' VALUE='$di'>
					<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
					<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
					<INPUT TYPE=hidden NAME='echrus' VALUE='$echrus'>
					<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
					<INPUT TYPE=hidden NAME='date' VALUE='$date'>
					<INPUT TYPE=submit VALUE='Re' title='Редактировать' alt='Редактировать'></form></br>
					<form method=post action=arm_nach_ceh.php>
					<INPUT TYPE=hidden NAME='copifile' VALUE='$filename'>
					<INPUT TYPE=hidden NAME='di' VALUE='$di'>
					<INPUT TYPE=hidden NAME='ech' VALUE='$ech'>
					<INPUT TYPE=hidden NAME='cehrus' VALUE='$cehrus'>
					<INPUT TYPE=hidden NAME='echrus' VALUE='$echrus'>
					<INPUT TYPE=hidden NAME='ceh' VALUE='$ceh'>
					<button TYPE=submit>
					<image src='img/copy1.png' width=15 alt='Копировать' title='Копировать'>
					</button>
					</form>
					
					</td>
					<td >
					<form method=post action=wind_delete.php><fieldset title='Удалить'>
					<INPUT TYPE=hidden NAME='filename' VALUE='$filename'>
					<INPUT TYPE=submit VALUE=' x '>
					</fieldset></form>
					</td>
					";
				}
				echo"
				</tr>";
			};
			unset ($brigada,$podU,$obespPC_PMS,$obespEMP, $obespPROCH, $na_VL_AB_PE_DPR,$obespRCS,$obespSHCH,$obhod,$obezd,$obezdVIKS,$v_okno,$sovm_okno,$maswork);
			unset ($t0, $t1, $t_p, $t_podgot, $t_zaversh, $t_z, $t_obsh, $n_chbrig, $maswork);

// конец вывода работ

		
		
		
		
		
?>
