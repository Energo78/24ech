<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";
include "ip2.php";

//получаем данные
$date=$_POST['Date3'];
$filname=$_POST['redactf'];

	//пишем лог
	if ($filname !=""){
		$file = fopen("./data/$date-R/$filname","r");
        if(!file)
        {
			echo("Ошибка открытия файла");
        }
                $stripr = fgets ($file);
        fclose ($file);
		$log =  fopen ("./log.csv","a");
		if(!$log)
		  {
			echo("Ошибка открытия файла log.csv!");
		  }
		$datetime = date("d.m.Y время H:i:s внесено изменение в $date - $filname");
		fputs ($log, "---!--- $datetime\n");
		fputs ($log, $stripr);fputs ($log, "\n ip:$ip");
		fputs ($log, "\n---!---\n");
		fclose ($log);
	};
		


        //{работа на подстанциях\проверенных бригад\собраний\инструктажей
                if ($filname =="")
                {
                        $prov[1]=$_POST['eche1'];
                        $prov[2]=$_POST['provereno1'];

                        $prov[3]=$_POST['sobranie1'];
                        $prov[4]=$_POST['insruktagi1'];
						
						$p_prov = $prov[1]+$prov[2]+$prov[3]+$prov[4];

                        /*$prov[5]=$_POST['eche2'];
                        $prov[6]=$_POST['provereno2'];

                        $prov[7]=$_POST['sobranie2'];
                        $prov[8]=$_POST['insruktagi2'];
						*/

  //{ вводим данные данных
		if ($p_prov > 0){
			//$file = "./data/$date1-R/eche1.csv";
			$file = fopen("./data/$date-R/eche.csv","w");
			if(!file){echo("Ошибка открытия файла");exit;};
			fputs ($file,"eche");fputs ($file,"|");//пусть будет )

			for ($i=1;$i < 6; $i++)
			{
                //укладываем в файл
                fputs ($file,"$prov[$i]");
				fputs ($file,"|");
			};
			fclose ($file);
		};	
  //}x




                }
        //}х

//1. БЛОК ЗАПИСИ ПОЛУЧЕННЫХ ДАННЫХ

foreach ($_POST as $ArrKey => $ArrStr)
        {
                $mass[] = $ArrStr;
                $keymas[] = $ArrKey;
        };
for ($i=0;$i < count($keymas); $i++)
        {
                $massiv[$keymas[$i]] = $mass[$i];
        };

$massiv = str_replace("\r\n","b-b",$massiv);
$massiv = str_replace("\r","b-b",$massiv);
$massiv = str_replace("\"","",$massiv);
$massiv = str_replace("\\","",$massiv);
//х
//2 БЛОК ИЗМЕНЕНИЯ ФАЙЛА.
        //читаем данные в массив
        $massiv2[0]=$_POST['w0'];$massiv2[1]=$_POST['w1'];$massiv2[2]=$_POST['w2'];
        $massiv2[3]=$_POST['w3'];$massiv2[4]=$_POST['w4'];$massiv2[5]=$_POST['w5'];
        $massiv2[6]=$_POST['w6'];$massiv2[7]=$_POST['w7'];$massiv2[8]=$_POST['w8'];
        $massiv2[9]=$_POST['w9'];$massiv2[10]=$_POST['w10'];$massiv2[11]=$_POST['w11'];
        $massiv2[12]=$_POST['w12'];$massiv2[13]=$_POST['w13'];$massiv2[14]=$_POST['w14'];
        $massiv2[15]=$_POST['w15'];$massiv2[16]=$_POST['w16'];$massiv2[17]=$_POST['w17'];
        $massiv2[18]=$_POST['w18'];$massiv2[19]=$_POST['w19'];$massiv2[20]=$_POST['w20'];
        $massiv2[21]=$_POST['w21'];$massiv2[22]=$_POST['w22'];$massiv2[23]=$_POST['w23'];$massiv2[24]=$_POST['w24'];$massiv2[25]=$_POST['w25'];$massiv2[26]=$_POST['w26'];$massiv2[27]=$_POST['w27'];$massiv2[28]=$_POST['w28'];$massiv2[29]=$_POST['w29'];
        $massiv2[30]=$_POST['w30'];$massiv2[31]= $_POST['w31'];
		
		
        $massiv2 = str_replace("\r\n","b-b",$massiv2);
        $massiv2 = str_replace("\r","b-b",$massiv2);
        $massiv2 = str_replace("\"","",$massiv2);
        $massiv2 = str_replace("\\","",$massiv2);

        if ($filname != "")
        {
                echo "редактируем..";
                        //открываем файл
                $dirf = "./data/$date-R/$filname";
                $file = fopen("$dirf","w+");
                  if(!$file)
                  {
                        echo("Ошибка создания файла!");
                  };
                        //укладываем данные
                        //print_r($massiv2);

                                fputs ($file,"$massiv2[0]");fputs ( $file,"|"); //0-цех
                                fputs ($file,"$massiv2[1]");fputs ( $file,"|"); //1-№наряда
                                fputs ($file,"$massiv2[2]");fputs ( $file,"|"); //2-фио произв
                                fputs ($file,"$massiv2[3]");fputs ( $file,"|"); //3-time1
                                fputs ($file,"$massiv2[4]");fputs ( $file,"|"); //4-time2
                                fputs ($file,"$massiv2[5]");fputs ( $file,"|"); //5-time3
                                fputs ($file,"$massiv2[6]");fputs ( $file,"|"); //6-time4
                                fputs ($file,"$massiv2[7]");fputs ( $file,"|");//7-peregons
                                fputs ($file,"$massiv2[8]");fputs ( $file,"|");//8-путь перегона
                                fputs ($file,"$massiv2[9]");fputs ( $file,"|");//9-станция
                                fputs ($file,"$massiv2[10]");fputs ( $file,"|");//10-путь станции
                                fputs ($file,"$massiv2[11]");fputs ( $file,"|");//11-РАБОТА
                                fputs ($file,"$massiv2[12]");fputs ( $file,"|"); //12-№расп
                                fputs ($file,"$massiv2[13]");fputs ( $file,"|");//13-участок работ
                                fputs ($file,"$massiv2[14]");fputs ( $file,"|"); //14-под U
                                fputs ($file,"$massiv2[15]");fputs ( $file,"|");//15-Обеспечение ПЧ-ПМС
                                fputs ($file,"$massiv2[16]");fputs ( $file,"|");//16-Обеспечение ЭМП
                                fputs ($file,"$massiv2[17]");fputs ( $file,"|");//17-Проверено км.эксп.дл.
                                fputs ($file,"$massiv2[18]");fputs ( $file,"|");//18-Выявлено Замечаний
                                fputs ($file,"$massiv2[19]");fputs ( $file,"|");//19-Устранено Замечаний
                                fputs ($file,"$massiv2[20]");fputs ( $file,"|");//20-обесп ШЧ
                                fputs ($file,"$massiv2[21]");fputs ( $file,"|");//21-обесп РЦС
                                fputs ($file,"$massiv2[22]");fputs ( $file,"|");//22-обход
                                fputs ($file,"$massiv2[23]");fputs ( $file,"|");//23-объезд
                                fputs ($file,"$massiv2[24]");fputs ( $file,"|");//24-объезд ВИКС
                                fputs ($file,"$massiv2[25]");fputs ( $file,"|");//25-в окно
                                fputs ($file,"$massiv2[26]");fputs ( $file,"|");//26-совм.окно
                                fputs ($file,"$massiv2[27]");fputs ( $file,"|");//27-рем.зз.
                                fputs ($file,"$massiv2[28]");fputs ( $file,"|");//28-обесп.СМП
                                fputs ($file,"$massiv2[29]");fputs ( $file,"|");//29-обесп.проч.
                                fputs ($file,"$massiv2[30]");fputs ( $file,"|");//30-на ВЛ АБ, ПЭ, ДПР
								fputs ($file,"$massiv2[31]");fputs ( $file,"|");//31-бригада
				fclose ($file);//закрываем файл
                echo "ГОТОВО!";
                exit;
        };
//х

//3 БЛОК ЗАПИСИ НОВЫХ ДАННЫХ
$dir = "./data/$date-R";

if (file_exists($dir)) {
    echo "Каталог найден<br>";
} else {
    mkdir("./data/$date-R");
         };

//Цикл ввода данных из $u циклов
$t = 1;                //для персчёта массива
for ($i=1; $i <= 5; $i++)
        {
                //присваиваем имя новому файлу и проверяем нет ли совпадения
                srand((double) microtime()*1000000);
                $random = rand();
                $w = "1work$t";
                $Y = $i - 1;
                if ($massiv[$w]=="")
                        {
                        echo "<table align=center><TR>
                        <TD><FONT COLOR=red>Информация успешно записана в базу данных. <br>Всего внесено работ: <b>$Y</b> шт.</FONT></TD>
                        <td><form action='otchet_2.php' method=post>
                        <INPUT TYPE=hidden NAME='Date' VALUE='$date'>
                        <INPUT TYPE=submit NAME=button1 VALUE=OK!> </form></td>
                        </TR></TABLE><br>
                        <table align=center>
                        <tr align=center></TR>
                        </table></body></HTML>";
                        exit;
                        };
                        $dirf = "./data/$date-R/$massiv[$w]-$random.csv";
                        if (file_exists($dirf))
                        {
                                echo "Такой наряд уже введён в базу данных, для редактирования воспользуйтесь формой ОТЧЁТЫ";
                                exit;
                        }
                        else
                        {
                                $filname = "$massiv[$w]-$random.csv";
                                $file = fopen("./data/$date-R/$filname","w");
                                if(!file)
                                {
                                        echo("Ошибка открытия файла");
                                        exit;
                                };

                        //Цикл записи данных в файл
                        //print_r($massiv);
                                //echo "+ $massiv[$w2]";
                                $w1 = "1work$t";$w2 = "2work$t";$w3 = "3work$t";$w4 = "4work$t";$w5 = "5work$t";$w6 = "6work$t";$w7 = "7work$t";$w8 = "8work$t";$w9 = "9work$t";$w10 = "10work$t";$w11 = "11work$t";$w12 = "12work$t";$w13 = "13work$t";$w14 = "14work$t";$w15 = "15work$t";$w16 = "16work$t";$w17 = "17work$t";$w18 = "18work$t";$w19 = "19work$t";$w20 = "20work$t"; $w21 = "21work$t"; $w22 = "22work$t";$w23 = "23work$t";$w24 = "24work$t";$w25 = "25work$t";$w26 = "26work$t";$w27 = "27work$t";$w28 = "28work$t";$w29 = "29work$t";$w30 = "30work$t"; $w31 = "31work$t";

                                fputs ($file,"$massiv[$w1]");fputs ( $file,"|"); //0-наименование цеха
                                fputs ($file,"$massiv[$w2]");fputs ( $file,"|"); //1-№наряда
                                fputs ($file,"$massiv[$w4]");fputs ( $file,"|"); //2-фио произв
                                fputs ($file,"$massiv[$w6]");fputs ( $file,"|"); //3-time1
                                fputs ($file,"$massiv[$w7]");fputs ( $file,"|"); //4-time2
                                fputs ($file,"$massiv[$w8]");fputs ( $file,"|"); //5-time3
                                fputs ($file,"$massiv[$w9]");fputs ( $file,"|"); //6-time4
                                fputs ($file,"$massiv[$w10]");fputs ( $file,"|");//7-peregons
                                fputs ($file,"$massiv[$w11]");fputs ( $file,"|");//8-путь перегона
                                fputs ($file,"$massiv[$w12]");fputs ( $file,"|");//9-станция
                                fputs ($file,"$massiv[$w13]");fputs ( $file,"|");//10-путь станции
                                fputs ($file,"$massiv[$w15]");fputs ( $file,"|");//11-РАБОТА
                                fputs ($file,"$massiv[$w3]");fputs ( $file,"|"); //12-№расп
                                fputs ($file,"$massiv[$w14]");fputs ( $file,"|");//13-участок работ
                                fputs ($file,"$massiv[$w5]");fputs ( $file,"|"); //14-под U
                                fputs ($file,"$massiv[$w16]");fputs ( $file,"|");//15-Обеспечение ПЧ-ПМС
                                fputs ($file,"$massiv[$w17]");fputs ( $file,"|");//16-Обеспечение ЭМП
                                fputs ($file,"$massiv[$w18]");fputs ( $file,"|");//17-Проверено км.эксп.дл.
                                fputs ($file,"$massiv[$w19]");fputs ( $file,"|");//18-Выявлено Замечаний
                                fputs ($file,"$massiv[$w20]");fputs ( $file,"|");//19-Устранено Замечаний
                                fputs ($file,"$massiv[$w21]");fputs ( $file,"|");//20-обесп ШЧ
                                fputs ($file,"$massiv[$w22]");fputs ( $file,"|");//21-обесп РЦС
                                fputs ($file,"$massiv[$w23]");fputs ( $file,"|");//22-обход
                                fputs ($file,"$massiv[$w24]");fputs ( $file,"|");//23-объезд
                                fputs ($file,"$massiv[$w25]");fputs ( $file,"|");//24-объезд ВИКС
                                fputs ($file,"$massiv[$w26]");fputs ( $file,"|");//25-в окно
                                fputs ($file,"$massiv[$w27]");fputs ( $file,"|");//26-совм.окно
                                fputs ($file,"$massiv[$w28]");fputs ( $file,"|");//27-рем.зз.
                                fputs ($file,"$massiv[$w29]");fputs ( $file,"|");//28-обесп.СМП
                                fputs ($file,"$massiv[$w30]");fputs ( $file,"|");//29-обесп.проч.
                                fputs ($file,"$massiv[$w31]");fputs ( $file,"|");//30-обесп.проч.
                        fclose ($file);

                };
                $t = $t + 1;
        };

                        echo "<table align=center><TR>
                        <TD><FONT COLOR=red>Информация успешно записана в базу данных.</FONT></TD>
                        <td><form action='otchet_2.php' method=post>
                        <INPUT TYPE=hidden NAME='Date' VALUE='$date'>
                        <INPUT TYPE=submit NAME=button1 VALUE=OK!> </form></td>
                        </TR></TABLE><br>
                        <table align=center>
                        <tr align=center></TR>
                        </table></body></HTML>";
//х








 ?>