<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "config.php";
$otmeny=$_POST["otmeny"];


$da1=$_POST[date3];
$da2=$_POST[dateold];
$da3=$_POST[datenext];

if($da1!=""){
	$date1=$da1;
}elseif($da2!=""){
	$date1=$da2;
}elseif($da3!=""){
	$date1=$da3;
}else{
	$date1 = $date;
};
$date = $date1;
include "date_functions.php";
if($date1==""){
	$date1 = $date;
}


//-1- --------------------------
        // if ($perehod == true){
                // $giv_url = "otchet_2.php";
        // }else{
                // $giv_url = "otchet_okn1.php";
        // };
 $dir = "./data/$date1";
        if (file_exists($dir)){
			//$date = $date1;
			include "date_functions.php";
            echo "<table align='center'><tr>
                    <td><form method='post' action='otchet_okn2.php'>
                    <INPUT TYPE=hidden NAME='date3' VALUE='$dateold'>
                    <INPUT TYPE=submit VALUE='<< $dateold'>
                    </form></td>
                    <td><font size=3 color=blue><b>Отчёт о работе в ОКНА за $date1:</b></font><br></td>
                    <td><form method='post' action='otchet_okn2.php'>
                    <INPUT TYPE=hidden NAME='date3' VALUE='$datenext'>
                    <INPUT TYPE=submit VALUE='$datenext >>'>
                    </form></td>
                    </tr></table>";
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
										sort ($fils);
                                }
                };
                        closedir ($dir);
                        $n2=$n;



                        

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
                 echo "<table $tab>
                 <tr><td $td>ЦЕХ</td><td $td>РАБОТА</td><td $td>Место работы</td><td $td>План.Время</td><td $td>Факт.Время</td><td $td>Хоз.Единицы,<br>Локомотивы</td><td $td>Руководитель</td><td $td>Особ.тебования, Бригада</td><td $td></td><td $td></td><td $td>#</td><td $td>#</td></tr>";

                        //СОРТИРОВКА ПО ЭЧК
                for ($i=0; $i < $n; $i++)
                {
                        $strip[$i] = str_replace("Выдающий наряд:b--b                                b--bОтветственный руководитель:b--b                                    b--bПроизводитель:b--b                                  b--bНаблюдающие:b--b                               b--bСостав бригады:b--b                           b--bУсловия и точное место работы:b--b                             b--bДля работы прошуb--bОтключить: b--b                                               b--bВключить:                              b--b                                         b--bкол-во з/з____ у оп.______b--bОтдельные указания:                    b--b                                    ","",$strip[$i]);
                        $strip[$i] = str_replace("b--b","<br>",$strip[$i]);
						
						
						echo "<tr>";
						unset ($otozvano, $sub, $str_exp);
						$otozvano = substr_count($strip[$i],"ОТОЗВАНО");
						
                        $str_exp = explode("|", $strip[$i]);
                        //{подсчёт для отчёта в ЦУСИ
                                $plan_time = $plan_time + $str_exp[6];
                                $plan_time2 = $plan_time2 + $str_exp[6];
                                $plan_H = $plan_time/60;
								$sub = substr_count($str_exp[7],"ОТМЕНА");
								settype ($str_exp[6], integer);
								// echo "<br>n2 = $n2 - чисто<br>$strip[$i]";
								if ($str_exp[6]== 1)
								{
									$n2 = $n2-1;
									// echo "<br>n2 = $n2 - на str_exp6";
								}; 
								// echo "<br>otozvano = $otozvano, sub = $sub";
                                if ($sub > 0 or $otozvano !="")
                                {
                                        if ($n2 != 0){
											$n2 = $n2-1;
											// echo "<br>n2 = $n2 - на otmena-otozvano";
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
                                if ($otmeny !="" or $otozvano !="") {
									echo "<td $td2>$str_exp[2]<br>Наряд №$str_exp[13]</td>
									<td $td2>План:<br>$str_exp[3]
									<br>Факт:<br>$str_exp[21]</td>
									<td $td2>$str_exp[4]<br>$str_exp[16]</td>
									<td $td2>$str_exp[7]
									<br>$str_exp[6] мин.</td>
									<td $td2>$str_exp[8]
									<br>$str_exp[20] мин.</td>
									<td $td2>$str_exp[9]
									<!--<br>$str_exp[10]-->
									</td>
									<td $td2>$str_exp[10]</td>
									<td $td2>$str_exp[11]<br/>$str_exp[14]</td>
									<td $td2></td>";
									
									echo "<td $td></td><td $td><form method=post action=redact_1.php>                <INPUT TYPE=hidden NAME='date' VALUE='$date1'>        <INPUT TYPE=hidden NAME='redactf' VALUE='$fils[$i]'>                <fieldset title='Редактировать'><INPUT TYPE=submit VALUE='Re'></fieldset>                </form></td>                <td $td>                <form method=post action=wind_delete.php><fieldset title='Удалить'>                <INPUT TYPE=hidden NAME='date' VALUE='$date1'>                <INPUT TYPE=hidden NAME='redactf' VALUE='$fils[$i]'>                <INPUT TYPE=submit VALUE=' x '>                </fieldset></form>                </td>";
									echo "</tr>";
								} else {
									if ($str_exp[7] > 0) {
										echo "<td $td2>$str_exp[2]<br>Наряд №$str_exp[13]</td>
										<td $td2>План:<br>$str_exp[3]
										<br>Факт:<br>$str_exp[21]</td>
										<td $td2>$str_exp[4]<br>$str_exp[16]</td>
										<td $td2>$str_exp[7]
										<br>$str_exp[6] мин.</td>
										<td $td2>$str_exp[8]
										<br>$str_exp[20] мин.</td>
										<td $td2>$str_exp[9]
										<!--<br>$str_exp[10]-->
										</td>
										<td $td2>$str_exp[10]</td>
										<td $td2>$str_exp[11]<br/><b><font color='#040CB2'>$str_exp[14]</font></b></td>
										<td $td2></td><td $td></td><td $td><form method=post action=redact_1.php>                <INPUT TYPE=hidden NAME='date' VALUE='$date1'><INPUT TYPE=hidden NAME='redactf' VALUE='$fils[$i]'>                <fieldset title='Редактировать'><INPUT TYPE=submit VALUE='Re'></fieldset></form></td><td $td><form method=post action=wind_delete.php><fieldset title='Удалить'>                <INPUT TYPE=hidden NAME='date' VALUE='$date1'><INPUT TYPE=hidden NAME='redactf' VALUE='$fils[$i]'> <INPUT TYPE=submit VALUE=' x '></fieldset></form></td></tr>";
									};
								};
                };
                //echo "$plan_time";
                echo "</table>";
				$otkaz = $n - $n2; //отказано при планировании

        };

	//Начало отчёта
	include "date_functions.php";
	echo "
    <table align = center><tr>
    <td><form method='post' action='otchet_okn2.php'>
    <INPUT TYPE=hidden NAME='dateold' VALUE='$dateold'>
    <INPUT TYPE=submit VALUE='<< $dateold'>
    </form></td>

            <td><font size=3 color=blue><b>_________________________________________ </b></font></td>

    <td><form method='post' action='otchet_okn2.php'>
    <INPUT TYPE=hidden NAME='datenext' VALUE='$datenext'>
    <INPUT TYPE=submit VALUE='$datenext >>'>
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
    </tr></table>";
								
        //----------------------------------------


 
 
 
 
 
 
 
 
 
 ?>