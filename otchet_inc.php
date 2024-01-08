<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "config.php";

//-1-формируем дату для быстрого прощёлкивания дней....
        $dat = explode(".", $date1);

        settype($dat[0],integer);
        settype($dat[1],integer);
        settype($dat[2],integer);
        $dat2 = $dat;

        $dat[0]=$dat[0]-1;
        $dat2[0]=$dat2[0]+1;

//логика на убывание даты:
        if ($dat[0] == 0)
        {
                $dat[0]=31;
                $dat[1]=$dat[1]-1;

                if($dat[1]==0)
                {
                        $dat[1]=12;
                        $dat[2]=$dat[2]-1;
                };
        };

        settype($dat[0],string);
        settype($dat[1],string);
        settype($dat[2],string);
        $dat[0] = str_pad($dat[0], 2, "0", STR_PAD_LEFT);
        $dat[1] = str_pad($dat[1], 2, "0", STR_PAD_LEFT);

        $date_back = "$dat[0].$dat[1].$dat[2]";

//логика на увеличение даты:
        if ($dat2[0] == 32)
        {
                $dat2[0]=1;
                $dat2[1]=$dat2[1]+1;

                if($dat2[1]==13)
                {
                        $dat2[1]=1;
                        $dat2[2]=$dat2[2]+1;
                };
        };

        settype($dat2[0],string);
        settype($dat2[1],string);
        settype($dat2[2],string);
        $dat2[0] = str_pad($dat2[0], 2, "0", STR_PAD_LEFT);
        $dat2[1] = str_pad($dat2[1], 2, "0", STR_PAD_LEFT);

        $date_next = "$dat2[0].$dat2[1].$dat2[2]";


//2. ------- выводим таблицу работ по нарядам ----------

         $dir = "./data/$date1-R";
        if (file_exists($dir)) {
    echo "<table align='center'><tr>
        <td><form method='post' action='otchet_okn1.php'>
        <INPUT TYPE=hidden NAME='Dateold' VALUE='$date_back'>
        <INPUT TYPE=submit VALUE=' < '>
        </form></td>
        <td><font size=3 color=blue><b>Отчёт о работе за $date1:</b></font><br></td>
        <td><form method='post' action='otchet_okn1.php'>
        <INPUT TYPE=hidden NAME='Dateold' VALUE='$date_next'>
        <INPUT TYPE=submit VALUE=' > '>
        </form></td>
        </tr></table>";
        //получаем список файлов каталога (data)
$n=0;
$dir = opendir ("./data/$date1-R");
        while ( $file = readdir ($dir))
        {
                if (( $file != ".") && ($file != ".."))
                {
                        if ($file != "eche.csv")
                        {
                                $filsr[] = $file;
                                $n++;
                        };
                };
        };
        closedir ($dir);

        // возвращаем число файлов
        $n2=$n-1;//с учётом файла инструктажей
		if ($filsr !=""){
			sort ($filsr);
		};
        for($i=0; $i < count($filsr); $i++)
        {
                $file = fopen("./data/$date1-R/$filsr[$i]","r");
                if(!file)
                        {
                          echo("Ошибка открытия файла");
                        }
                $stripr[$i] = fgets ($file);
                $stripr[$i] = htmlspecialchars($stripr[$i]);

                fclose ($file);
        };


 // шапка таблицы:
 $shapka ="<tr><td $td>ЦЕХ</td><td $td>№ Нар/расп</td><td $td>Производитель</td><td $td>Нач</td><td $td>Оконч</td><td $td>Всего</td><td $td>Место работы</td><td $td>Работа</td><td $td></td><td $td></td></tr>";

        $stripr = str_replace("b-b","<br>",$stripr);

        $z=0;
        echo "Работа по нарядам:<br>";
        echo "<table $tab>$shapka";

        for ($i=0; $i < $n; $i++)//цикл - пробегаем по файлам
        {
                        $stripr[$i] = str_replace("eche","deletim",$stripr[$i]);//удаляем из опроса файл eche
                        $maswork = explode("|", $stripr[$i]);

                        //для отчёта!
                        //pod U
                        if ($maswork[14] != "")
                        {
                                $nar_U = $nar_U + 1;
                                $tameU = $tameU +($maswork[5] + $maswork[6]/60) - ($maswork[3] + $maswork[4]/60);
                        };
                        // obesp PC-PMS
                        if ($maswork[15] != "")
                        {
                                $nar_P = $nar_P + 1;
                        };
                        // obesp EMP
                        if ($maswork[16] != "")
                        {
                                $nar_E = $nar_E + 1;
                        };
                        // проверено экспл длинны
                        if ($maswork[17] != "")
                        {
                                $prov_exp = $prov_exp + $maswork[17];
                        };
                        if ($maswork[18] != "")
                        {$obnaruz_zam = $obnaruz_zam + $maswork[18];};
                        if ($maswork[19] != "")
                        {$ustr_zam         = $ustr_zam + $maswork[19];};

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
                                $prov_eksp = $prov_eksp + $maswork[17];
                        };
                        if ($maswork[30] != "")// на ВЛ АБ, ПЭ, ДПР
                        {
                                $rab_VL = $rab_VL + 1;
                        };

                        if ($maswork[14] == "on")
                        {$podU = "<b>Работа под напряжением </b>";};
                        if ($maswork[15] == "on")
                        {$obespPC_PMS = "<b>Обеспечение ПЧ-ПМС </b>";};
                        if ($maswork[16] == "on")
                        {$obespEMP = "<b>Обеспечение ЭМП </b>";};
                        if ($maswork[20] == "on")
                        {$obespSHCH = "<b>Обеспечение ШЧ </b>";};
                        if ($maswork[21] == "on")
                        {$obespRCS = "<b>Обеспечение РЦС </b>";};
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
                        if ($maswork[17] != "")
                        {$maswork[17] = "<br>Проверено экспл. длины: $maswork[17] км.";};
                        if ($maswork[18] != "")
                        {$maswork[18] = "<br>Выявлено замечаний: $maswork[18] шт.";};
                        if ($maswork[19] != "")
                        {$maswork[19] = "<br>Устранено замечаний: $maswork[19] шт.";};
                        if ($maswork[27] != "")
                        {$maswork[27] = "<br>Отремонтировано заземлений: $maswork[27] шт.";};

                        $str_mesto = "$maswork[7] $maswork[8]<br>$maswork[9] $maswork[10]<br>$maswork[13]";
						if ($maswork[31] !="")//бригада
                        {
                                $maswork[31] = "<b><font color='#040CB2'><br>Бригада:<br>$maswork[31]</b></font>";
                        }

                        if ($maswork[1] =="")//наряд или распоряжение
                        {
                                $str2 = "Расп.№ $maswork[12]";
                                $rasp_sum = $rasp_sum + 1;
                        }
                        else
                        {
                                $str2 = "Нар№ $maswork[1]";
                                $rabot_po_nar = $rabot_po_nar + 1;
                        };
						//подсчёт времени
						$t0 = $maswork[5];
						if ($maswork[5] < $maswork[3])
						{
							$maswork[5] = $maswork[5] + 24;
						};
						$t1 = (($maswork[5]*60)+$maswork[6]) - (($maswork[3]*60)+$maswork[4]); 
                                
								
                                echo "<tr><td $td2>$maswork[0]</td><td $td2>$str2</td><td $td2>$maswork[2]</td><td $td2>$maswork[3]:$maswork[4]</td><td $td2>$t0:$maswork[6]</td><td $td2>$t1 мин.</td><td $td2>$str_mesto</td><td $td2>$v_okno $sovm_okno $podU $obespPC_PMS $obespEMP $obespSHCH $obespRCS $obhod $obezd $obezdVIKS $maswork[11] $maswork[17] $maswork[18] $maswork[19] $maswork[27]$maswork[31]</td>
								<td $td>
								<form method=post action=redact_2.php>
								<INPUT TYPE=hidden NAME='date' VALUE='$date1'>
								<INPUT TYPE=hidden NAME='redactf' VALUE='$filsr[$i]'>
								<INPUT TYPE=submit VALUE='Re'>
								</form>
								</td>
								<td $td>
								<form method=post action=wind_delete.php><fieldset title='Удалить'>
								<INPUT TYPE=hidden NAME='date' VALUE='$date1-R'>
								<INPUT TYPE=hidden NAME='redactf' VALUE='$filsr[$i]'>
								<INPUT TYPE=submit VALUE=' x '>
								</fieldset></form>
								</td></tr>";
								
						$podU=""; $obespPC_PMS=""; $obespEMP=""; $obespRCS=""; $obespSHCH="";
                        $obhod=""; $obezd=""; $obezdVIKS=""; $v_okno=""; $sovm_okno="";

        };

 // конец таблицы работ по нарядам
} else {
    echo "<table align='center'><tr>
        <td><form method='post' action='otchet_okn1.php'>
        <INPUT TYPE=hidden NAME='Dateold' VALUE='$date_back'>
        <INPUT TYPE=submit VALUE=' < '>
        </form></td>
        <td><font size=3 color=blue><b>Работа $date1 не производилась.</b></font><br></td>
        <td><form method='post' action='otchet_okn1.php'>
        <INPUT TYPE=hidden NAME='Dateold' VALUE='$date_next'>
        <INPUT TYPE=submit VALUE=' > '>
        </form></td>
        </tr></table>";
};

        echo "<table><tr><td>
        Всего $i работ по нарядам</td></tr></table>";

// Okna
$perehod = true;
$n = "";//обнуляем переменную
$n2 = "";//обнуляем переменную
include "otchet_okna.php";//отчёт по окнам инклюдим !!!

// отчёт в ЦУСИ ----------- !!!!!!!!!!!!!!!!
        //{ прочитаем работы на подстанциях\проверенных бригад\собраний\инстуктажей
                $file = "./data/$date1-R/eche.csv";
                if (is_file($file))
                {
                        $file2 = fopen("./data/$date1-R/eche.csv","a+");
                        $eche = fgets ($file2);
                        $str_rab = explode("|", $eche);
                        fclose ($file2);
                };
                $rab_eche = $str_rab[1];
                $prov_brig = $str_rab[2];
                $sobran = $str_rab[3];
                $instr = $str_rab[4];
        //}x
        $prov_exp = $prov_exp - $prov_viks;
        $n_proch = $rabot_po_nar + $rasp_sum - $rab_VL - $nar_U - $obhodov - $obezdov - $nar_P - $nar_E - $nar_SH - $nar_RCS - $obesp_SMP - $obesp_proch;
        $n_proch2 = "$rabot_po_nar + $rasp_sum - $rab_VL - $nar_U - $obhodov - $obezdov - $nar_P - $nar_E - $nar_SH - $nar_RCS - $obesp_SMP - $obesp_proch";
        //echo "! -- $n_proch2 -- !";
        if ($n_proch < 0)
        {
                $n_proch = 0;
        };
        echo "<br><table $tab>
                <tr $tr><td $td>(c 21 мая отчёт по работам смотреть <a href='otchet_pers.php'>ЗДЕСЬ</a>)<br>Работ на ВЛ АБ, ПЭ, ДПР:</td><td $td>$rab_VL</td></tr>
                <tr $tr><td $td>Работ на ЭЧЭ, ПСК:</td><td $td>$rab_eche</td></tr>
                <tr $tr><td $td>Всeго работ под U:</td><td $td>$nar_U на $tameU часов.</td></tr>
                <tr $tr><td $td>Работы по распоряжению и прочие работы по нарядам:</td><td $td>$n_proch</td></tr>
                <tr $tr><td $td>обходов:</td><td $td>$obhodov</td></tr>
                <tr $tr><td $td>объездов:</td><td $td>$obezdov</td></tr>
                <tr $tr><td $td>Проверено экспл. длины (км.):</td><td $td>$prov_exp</td></tr>
                <tr $tr><td $td>Объезд ВИКС (км.):</td><td $td>$prov_viks</td></tr>
                <tr $tr><td $td>Выявлено замечаний:</td><td $td>$obnaruz_zam</td></tr>
                <tr $tr><td $td>Устранено замечаний:</td><td $td>$ustr_zam</td></tr>
                <tr $tr><td $td>Количество проверенных бригад:</td><td $td>$prov_brig</td></tr>
                <tr $tr><td $td>Проинструктировано работников:</td><td $td>$instr</td></tr>
                <tr $tr><td $td>Проведено совещаний (собраний):</td><td $td>$sobran</td></tr>

                <tr $tr><td $td><b>Обеспечений:</b></td><td $td></td></tr>
                <tr $tr><td $td>ПМС-ПЧ:</td><td $td>$nar_P</td></tr>
                <tr $tr><td $td>ЭМП:</td><td $td>$nar_E</td></tr>
                <tr $tr><td $td>ШЧ:</td><td $td>$nar_SH</td></tr>
                <tr $tr><td $td>РЦС:</td><td $td>$nar_RCS</td></tr>
                <tr $tr><td $td>СМП:</td><td $td>$obesp_SMP</td></tr>
                <tr $tr><td $td>прочих обеспечений:</td><td $td>$obesp_proch</td></tr>
                <tr $tr><td $td>совмещённых окон:</td><td $td>$sovm</td></tr>
                <tr $tr><td $td>Ремонт заземлений:</td><td $td>$rem_zz</td></tr>
				</table>

        ";

 ?>