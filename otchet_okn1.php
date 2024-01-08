<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "Отчёт по окнам";
//include "head.html";
//include "config.php";
//include "ceha.php";

        $d1 = date('d.m.Y');
		$d2 = date('Y');
        //$datebac=$_POST["datebac"];
//получаем дату1 и 2, номер цеха
        $ceh=$_POST["ceh"];
        $mes=$_POST["mes"];
        $year=$_POST["year"];
//echo "!!! $mes $year !!!";
        /*echo "<table align=center>
		<form method='post' action='otchet_okn2.php'>
        <tr>
			<td>
				Фильтр: 
			</td>		
		</tr>
        <tr>
			<td>
				ЦЕХ: <SELECT name=ceh><OPTION>	<OPTION>$ceh<OPTION>$ceha<OPTION></select>
				Месяц: <SELECT name=mes>$mesyachs</select>
				Год: <SELECT name=year>$years</select>
				<INPUT TYPE=submit NAME=button1 VALUE='СМОТРЕТЬ ОТЧЁТ'>
				<INPUT TYPE=hidden NAME='otchet_ceh' VALUE='on'>
				</form>
			</td>
		</tr>
			</table>";*/


//проверка данных:
        if ($mes=="" or $ceh=="")
        {
                echo "Не указан месяц выборки.<br>";
                if ($ceh=="")
                        {
                                echo "Не указан цех<br>";
                        };
                $date1 = $d1;
                $dir = "./data/$date1";
                include "otchet_okna.php";
                exit;
        }else{
			$date1 = "01.$mes.$year";
		};


        // шапка таблицы:
				echo "<table $tab>
                 <tr><td $td>ЦЕХ</td><td $td>РАБОТА</td><td $td>Место работы</td><td $td>План.Время</td><td $td>Факт.Время</td><td $td>Хоз.Единицы,<br>Локомотивы</td><td $td>Руководитель</td><td $td>Особ.тебования</td></tr>";
        //--------------------

		for ($i=1; $i<31; $i++)//пробегаем месяц
		{
			$i = str_pad($i, 2, "0", STR_PAD_LEFT);
			$date1 = "$i.$mes.$year";//формируем дату
			if (file_exists("./data/$date1"))//проверка наличия директории
			{
				$dir = opendir ("./data/$date1");
				echo "<tr><td $td>$date1</td></tr>";
				while ( $file = readdir ($dir))
				{
					if (( $file != ".") && ($file != ".."))//откидываем служебные моменты
					{
						$fils[] = $file;

						$substr_count = substr_count ($file, "$ceh");
						if ($ceh == "ЭЧК-1"){
						$echk17 = substr_count ($file, "ЭЧК-17");
						if ($echk17 > 0)
						{$substr_count = 0;};
						};
						if ($substr_count > 0)
						{
							$filik = fopen("./data/$date1/$file","r");
							if(!filik)
                            {
                                echo("Ошибка открытия файла");
                            };
                            $strip = fgets ($filik);
							$strip = str_replace("Выдающий наряд:b--b                                b--bОтветственный руководитель:b--b                                    b--bПроизводитель:b--b                                  b--bНаблюдающие:b--b                               b--bСостав бригады:b--b                           b--bУсловия и точное место работы:b--b                             b--bДля работы прошуb--bОтключить: b--b                                               b--bВключить:                              b--b                                         b--bкол-во з/з____ у оп.______b--bОтдельные указания:                    b--b                                    ","",$strip);
							$strip = str_replace("b--b","<br>",$strip);
                            $str_exp = explode("|", $strip);
				
							    //{преобразования
                              
								if ($str_exp[15]=="on")
                                {
                                        $str_exp[4] = "$str_exp[4]<br><b><font color='red'>Отказ ДНЦ</font></b>";
                                        $otk_dnc2 = "$otk_dnc2<br>$str_exp[4]<br>$str_exp[16]";
                                };
								if ($str_exp[17]=="on")
                                {
                                        $str_exp[4] = "$str_exp[4]<br><b><font color='red'>Отказ ЭЧК</font></b>";
                                        $otk_echk2 = "$otk_echk2<br>$str_exp[4]<br>$str_exp[16]";
                                };
                                $str_exp[16] = "<font color=#62066D><b>$str_exp[16]</b></font>";
								if ($str_exp[22]=="on")
                                {
                                        $str_exp[16]="$str_exp[16]<br><b>СОВМЕЩЁННОЕ</b>";
                                };
                                if ($str_exp[19]=="on")
                                {
                                        $str_exp[1]="$str_exp[1]<br><b>Обеспечение ЭМП</b>";
                                };
                                $str_exp[21] = "<font color=#62066D><b>$str_exp[21]</b></font>";
								if ($str_exp[18]!="")
                                {
                                        $str_exp[21]="$str_exp[21]<br><font color=blue>Устранено замечаний: $str_exp[18]</font>";
                                };
				
								//}
                                //выводим таблицу окон
                                 echo "<td $td2>$str_exp[2]<br>Наряд №$str_exp[13]</td>
										<td $td2>План:<br>$str_exp[3]
										<br>Факт:<br>$str_exp[21]</td>
										<td $td2>$str_exp[4]<br>$str_exp[16]</td>
										<td $td2>$str_exp[7]
										<br>$str_exp[6] мин.</td>
										<td $td2>$str_exp[8]
										<br>$str_exp[20] мин.</td>
										<td $td2>$str_exp[9]
										<br>$str_exp[10]</td>
										<td $td2>$str_exp[11]</td>
										<td $td2>$str_exp[12]<br/><b><font color='#040CB2'>$str_exp[14]</font></b></td>
										<td $td2></td><td $td></td></tr>";


                            fclose ($filik);
						};
					
					};
				};
				closedir ($dir);
			};

};
        $n2=$n-1;

        //end-2.
        //4. прибавление даты
        $dat = explode(".", $date1);
        settype($dat[0],integer);
        settype($dat[1],integer);
        settype($dat[2],integer);
        $dat[0] = $dat[0]+1;

        if ($dat[0] == 32)
        {
                $dat[0]=1;
                $dat[1]=$dat[1]+1;
                if($dat[1]==13)
                {
                        $dat[1]=1;
                        $dat[2]=$dat[2]+1;
                };
        };

        $dat[0] = str_pad($dat[0], 2, "0", STR_PAD_LEFT);
        $dat[1] = str_pad($dat[1], 2, "0", STR_PAD_LEFT);
        $date1 = "$dat[0].$dat[1].$dat[2]";
        //echo "$date1";
        if ($date1==$date2)
        {
                $i = 9999;
        };
        //end-4.

//end-1.

echo "</table></body></HTML>";

 ?>