<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//  ОТЧЁТ ПО ОКНАМ - для ЭЧЦС
$perehod = true;

$otmeny=$_POST["otmeny"];


//-1- --------------------------
unset ($n, $file);  
		if ($perehod == true)
        {
                $giv_url = "otchet_2.php";
        }
        else
        {
                $giv_url = "otchet_okn1.php";
        };
                $dir = "./data/$date1";
        if (file_exists($dir))
        {
                //получаем список файлов каталога (data)
                
				
                $dir = opendir ("./data/$date1");
                while ( $file2 = readdir ($dir))
                {
                if (( $file2 != ".") && ($file2 != ".."))
                        {
                                $fils[] = $file2;
                                $n=$n+1; 
								
                        }
                };
                        closedir ($dir);
		};
                $n2=$n;
                       //  sort ($fils);

                        for($i=0; $i < count($fils); $i++)//читаем файлы в массив
                        {
                                $file2 = fopen("./data/$date1/$fils[$i]","r");
                                if(!file2)
                                {
                                  echo("Ошибка открытия файла");
                                };
                                $otmena = 0;
                                $strip[$i] = fgets ($file2);

                                fclose ($file2);
                        };
                for ($i=0; $i < $n; $i++)
                {
                        $strip[$i] = str_replace("b--b","<br>",$strip[$i]);
						//echo "<tr>";
                        $str_exp = explode("|", $strip[$i]);
                        //{подсчёт для отчёта в ЦУСИ
                                $plan_time = $plan_time + $str_exp[6];
                                $plan_time2 = $plan_time2 + $str_exp[6];
                                $plan_H = $plan_time/60;
                                $sub = substr_count($str_exp[7],"ОТМЕНА");
                                if ($sub > 0)
                                {
                                        if ($n2 != 0){
											$n2 = $n2-1;
										};
										$plan_time2 = $plan_time2 - $str_exp[6];
                                };
                                $plan_H2 = $plan_time2/60;
								if ($str_exp[20] > 0){
									$n_otrab = $n_otrab + 1;
									$timeb1 = $timeb1 + $str_exp[20];
								};
								$timeb = $timeb1/60;
								if ($n_otrab != 0){
									$time_Sredne = $timeb/$n_otrab;
								};
								if ($str_exp[15]=="on")
                                {
                                        $str_exp[4] = "$str_exp[4]<br><b><font color='red'>Отказ ДНЦ</font></b>";
                                        $otk_dnc = $otk_dnc + 1;
                                        $otk_dnc2 = "$otk_dnc2<br>$str_exp[4]<br>$str_exp[16]";
                                };
								if ($str_exp[17]=="on")
                                {
                                        $str_exp[4] = "$str_exp[4]<br><b><font color='red'>Отказ ЭЧК</font></b>";
                                        $otk_echk = $otk_echk + 1;
                                        $otk_echk2 = "$otk_echk2<br>$str_exp[4]<br>$str_exp[16]";
                                };
                                $str_exp[16] = "<font color=#62066D><b>$str_exp[16]</b></font>";
								if ($str_exp[22]=="on")
                                {
                                        $sovm = $sovm + 1;
                                        $str_exp[16]="$str_exp[16]<br><b>СОВМЕЩЁННОЕ</b>";
                                };
                                if ($str_exp[19]=="on")
                                {
                                        $nar_E = $nar_E + 1;
                                        $str_exp[1]="$str_exp[1]<br><b>Обеспечение ЭМП</b>";
                                };
                                $str_exp[21] = "<font color=#62066D><b>$str_exp[21]</b></font>";
								if ($str_exp[18]!="")
                                {
                                        $str_exp[21]="$str_exp[21]<br><font color=blue>Устранено замечаний: $str_exp[18]</font>";
                                        $ustr_zam = $ustr_zam + $str_exp[18];
                                };
				};
								$otkaz = $n - $n2; //отказано при планировании
								


		// ----------- end блока считывания файлов окон -------------------- //
    

                //{средняя продолжительность окна
                        if ($n_otrab!="")
                        {
                        $time_Sredne = $timeb/$n_otrab;
                        $time_Sredne = round ($time_Sredne * 100);//okruglyaem
                        $time_Sredne = $time_Sredne / 100;
                        };
                //}x

                // отчёт в ЦУСИ ----------- !!!!!!!!!!!!!!!!

			$plan_H = (round ($plan_H * 100))/100;//okruglyaem
			$plan_H2 = (round ($plan_H2 * 100))/100;//okruglyaem
			$timeb = (round ($timeb * 100))/100;//okruglyaem
        echo "  <tr $tr>
                <td $td>$date1</td>
                <td $td>$n</td>
                <td $td>$plan_H</td>
                <td $td>$n2</td>
                <td $td>$plan_H2</td>
                <td $td>$n_otrab</td>
                <td $td>$timeb</td>
                <td $td>$time_Sredne</td>
                <td $td>$otkaz</td>
                <td $td>$otk_dnc $otk_dnc2</td>
                <td $td>$otk_echk $otk_echk2</td>
                ";

// БЛОК ПОДСЧЁТА РАБОТ 2016 BEGIN
if ($otchet2016 == 1){ //переменная из incE
	include "otchet_pers.php";
	
	echo "  
			<td $td>$pers_vrab_ech</td>
			<td $td>$n_rabot_ech</td>
			<td $td>$n_rab_na_echk</td>
			<td $td>$n_rab_na_tyagov</td>
			<td $td>$n_rab_na_echs</td>
			<td $td>$n_rab_na_rru</td>
			<td $td>$rab_VL
			</td><td $td>$nar_U
			</td><td $td>$tameU
			</td><td $td>$rasp_sum</td>
			<td $td>$rabot_v_tekexpl</td>
			<td $td>$obhodov</td>
            <td $td>$obezdov</td>
            <td $td>$prov_exp</td>
            <td $td>$prov_viks</td>
            <td $td>$obnaruz_zam</td>
			<td $td>$ustr_zam</td>
			<td $td>$prov_brig</td>
			<td $td>$instr</td>
			<td $td>$sobran</td>
			<td $td>$nar_P</td>
			<td $td>$nar_E</td>
			<td $td>$nar_SH</td>
			<td $td>$nar_RCS</td>
			<td $td>$obesp_SMP</td>
			<td $td>$obesp_proch</td>
			<td $td>$sovm</td>
			<td $td>$rem_zz</td></tr>"; //<td $td></td>
}else{
// БЛОК ПОДСЧЁТА РАБОТ 2016 END
		// Для общих работ:
                
        echo "  
				<td $td>$pers_vrab_ech</td>
				<td $td>$n_rabot_ech</td>
				<td $td>$n_rab_na_echk</td>
				<td $td>$n_rab_na_tyagov</td>
				<td $td>$n_rab_na_echs</td>
				<td $td>$n_rab_na_rru</td>
				<td $td>$rab_VL</td>
                <td $td>$rab_eche</td>
                <td $td>$nar_U</td>
                <td $td>$tameU</td>
                <td $td>$n_proch</td>
                <td $td>$obhodov</td>
                <td $td>$obezdov</td>
                <td $td>$prov_exp</td>
                <td $td>$prov_viks</td>
                <td $td>$obnaruz_zam</td>
                <td $td>$ustr_zam</td>
                <td $td>$instr</td>
                <td $td>$prov_brig</td>
                <td $td>$sobran</td>
                <td $td>$nar_P</td>
                <td $td>$nar_E</td>
                <td $td>$nar_SH</td>
                <td $td>$nar_RCS</td>
                <td $td>$obesp_SMP</td>
                <td $td>$obesp_proch</td>
                <td $td>$sovm</td>
                <td $td>$rem_zz</td></tr>";
};
unset ($rab_VL, $n_rab_na_tyagov, $nar_U, $tameU, $n_proch, $obhodov, $obezdov, $prov_exp, $prov_viks, $obnaruz_zam, $ustr_zam, $instr, $prov_brig, $sobran, $nar_P, $nar_E, $nar_SH, $nar_RCS, $obesp_SMP, $obesp_proch, $sovm, $rem_zz, $fio, $n_person_v_ech, $pers_vrab_ech, $rabot_v_tekexpl);



























?>