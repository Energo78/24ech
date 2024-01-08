<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "Отчёт по окнам";
include "head.html";
include "config.php";
include "ceha.php";

        $d1 = date('d.m.Y');
		$d2 = date('Y');
        //$datebac=$_POST["datebac"];
//получаем дату1 и 2, номер цеха
        $date=$_POST["date3"];
        $ceh=$_POST["ceh"];
        $mes=$_POST["mes"];
        $year=$_POST["year"];
	/*if($date_from_upload !=""){
		$date = $date_from_upload;
	}*/
include("date_functions.php");

	
	
	
	
	echo "<table align='center'><tr>
                    <td><form method='post' action='otchet_okn2.php'>
                    <INPUT TYPE=hidden NAME='date3' VALUE='$dateold'>
                    <INPUT TYPE=submit VALUE='<< $dateold'>
                    </form></td>
                    <td><font size=3 color=blue><b>Отчёт о работе в ОКНА за $date:</b></font> <br></td>
                    <td><form method='post' action='otchet_okn2.php'>
                    <INPUT TYPE=hidden NAME='date3' VALUE='$datenext'>
                    <INPUT TYPE=submit VALUE='$datenext >>'>
                    </form></td><td><a href='upload.php'><img src='img/Cydia.png' alt='Внести окна из АС АПВО-2' title='Внести окна из АС АПВО-2' width='40px' /></a></td>
                    </tr></table>";




//------------ новый отчёт (все ЭЧ)--------------------------------------- 

	//читаем dir с датой по цехам (цикл по цехам)
	$n_okn = 0;
	echo "<div id='rabots'><table>";
	foreach($dirs as $ceh){
		unset($cehrus);
		include ("cehrename.php");
		$direct = "./$di/$ech/$ceh/$year/$mesday/";
		//echo("dir=$dir<br>");
		if (file_exists($direct)) {
			$dir_okn = opendir ("$direct");
			
			while (false !==( $file = readdir ($dir_okn))){
					if (( $file != ".") && ($file != "..")){
						unset($otmena, $okno);
						$otmena = substr_count("$file","otmena");
						$okno = substr_count("$file","okno");
						if($otmena ==0 and $okno !=0){
							//$filsr[] = $file;
//							echo("file=$file  n_okn=$n_okn<br>");
							//читаем файл и выводим данные на экран --------------
							$file_tmp = file("$direct$file");
							$striprf = "$file_tmp[0]";
							//print_r($file_tmp);
//							echo("$striprf<br>");
							
							//вывод формы окна $striprf
							$dop02 = $n_okn;
							
							$filename = "./$di/$ech/$ceh/$year/$mesday/$file";
					$striprf = str_replace("b-b","</br>", $striprf);
							$maswork = explode("|", $striprf);
							$i=$n_okn;
							include("onework.php");
							
							$n_okn = $n_okn +1;
						}else{
							$otkaz = $otkaz+1;
						}
					}
			}
			closedir ($dir_okn);
		}
	}	
	$n2 = $n_okn;
	echo "</table></div>";
	//end цикл по цехам
//------------ новый отчёт (все ЭЧ) КОНЕЦ ---------------------------------------


//инклюдю старый отчёт
include ("otchet_okn1.php");



echo "</table></body></HTML>";

 ?>