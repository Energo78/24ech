<?php
$date1 = $date;

// Okna
$perehod = true;

//отчёт по окнам инклюдим !!!


//-1- --------------------------
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
                $n=0;
				$n2=0;
                $dir = opendir ("./data/$date1");
                while ( $file = readdir ($dir))
                {
                        if (( $file != ".") && ($file != ".."))
                                {
                                        $fils[] = $file;
                                        $n=$n+1;
                                }
                };
                        closedir ($dir);
                        $n2=$n;
                        sort ($fils);

                        for($i=0; $i < count($fils); $i++)
                        {
                                $file = fopen("./data/$date1/$fils[$i]","r");
                                if(!file)
                                {
                                  echo("Ошибка открытия файла");
                                };
                                $otmena = 0;
                                $strip[$i] = fgets ($file);

                                fclose ($file);
                        };
                 // шапка таблицы:

                        //СОРТИРОВКА ПО ЭЧК
                for ($i=0; $i < $n; $i++)
                {
                        $strip[$i] = str_replace("b--b","<br>",$strip[$i]);
						echo "<tr>";
                        $str_exp = explode("|", $strip[$i]);
                        //{подсчёт для отчёта в ЦУСИ
                                $plan_time = $plan_time + $str_exp[6];
                                $plan_time2 = $plan_time2 + $str_exp[6];
                                $plan_H = $plan_time/60;
                                $sub = substr_count($str_exp[7],"ОТМЕНА");
                                if ($str_exp[6]== 1)
								{
									$n2 = $n2-1;
								}; 
								
								if ($sub > 0)
                                {
                                        if ($n2 != 0){
											$n2 = $n2-1;
										};
										$plan_time2 = $plan_time2 - $str_exp[6];
                                };
                                $plan_H2 = $plan_time2/60;
								if ($str_exp[20] > 1){
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
                        //}
                                //выводим таблицу окон
    							//include "alert.html";
	           };
                //echo "$plan_time";
    			$otkaz = $n - $n2; //отказано при планировании

        };
						//Начало отчёта
                        echo "
                                <table align = center><tr>
                                <td><form method='post' action='$giv_url'>
                                <INPUT TYPE=hidden NAME='Date' VALUE='$date_back'>
                                <INPUT TYPE=submit VALUE=' < '>
                                </form></td>

                                        <td><font size=3 color=blue><b>_________________________________________ </b></font></td>

                                <td><form method='post' action='$giv_url'>
                                <INPUT TYPE=hidden NAME='Date' VALUE='$date_next'>
                                <INPUT TYPE=submit VALUE=' > '>
                                </form></td></tr></table>

                                <table align = center><tr>
                                <td><font size=3 color=blue><b>ОТЧЁТ ПО РАБОТЕ ЭЧ-1 ЗА $date1</b></font></td>
                                </tr></table>

                                <table $tab2>
                                <tr $tr><td $td>Всего заказано</td><td $td>$n окон на $plan_H часов</td>
                                </tr>
                                <tr>
                                <td $td>Всего спланировано</td><td $td>$n2 окон на $plan_H2 часов</td>
                                </tr>
                                <tr>
                                <td $td>Всего отработано</td><td $td>$n_otrab окон на $timeb часов</td>
                                </tr>
                                <tr>
                                <td $td>Средняя продолжительность окна</td><td $td>$time_Sredne (ч.)</td>
                                </tr>
                                <tr>
                                <td $td>Отказано при планировании</td><td $td>$otkaz</td>
                                </tr>
                                <tr>
                                <td $td>Отказ ДНЦ</td><td $td>$otk_dnc $otk_dnc2</td>
                                </tr>
                                <tr>
                                <td $td>Отказ ЭЧК</td><td $td>$otk_echk $otk_echk2</td>
                                </tr>";
        //----------------------------------------



 ?>