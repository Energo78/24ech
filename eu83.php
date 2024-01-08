<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "Журнал ЭУ-83";
//проверка куки
//менюшка
//0.0 Читаем БД если role = rukovoditel (читаем все ЭЧ)
//0.1. Читаем файл eu83db.csv  (если role = rukovoditel пропускаем этот раздел)
//2. Выводим на экран 


              
$sort = $_POST["sort"];

//проверка куки ---------------------------------------------------------
	if($sort == "ok"){
		$sort_from_cookie = ($_COOKIE[sort]);
		if($sort_from_cookie==""){
			$sort = "resort";
			setcookie("sort", "resort", time() + 60000);
		}else{
			
			if($sort_from_cookie == "sort"){
				$sort = "resort";
				setcookie("sort", "resort", time() + 60000);
			}elseif($sort_from_cookie == "resort"){
				$sort = "sort";
				setcookie("sort", "sort", time() + 60000);
			}
			
		}
	}else{
		$sort = ($_COOKIE[sort]);
	}


if($menuis!=1){
	include "head.html";
}


	if($inc_83 != 1){
		$mes=$_POST["mes"];
		$year=$_POST["year"];
	}
              
    if($mes ==""){
		$mes = $_POST["eu83_mes"];
		$year=$_POST["eu83_year"];
	}
                
$osveschenie = $_POST[osveschenie];

                // получаем текущий месяц и год:
                if ($mes==""){
                	$mes = date(m);
                }else{
                     $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
                };
                
                if ($year==""){
                    $year = date(Y);
                };
                //если первый месяц, значит минус год;
                if($mes==01){
                    $date_back = 12;
                    $year_back = $year - 1;
                }else{
                     $date_back = $mes -1;
                     $year_back = $year;
                };
                if($mes==12)
                {
                        $date_next = 01;
                        $year_next = $year + 1;
                }
                else
                {
                        $date_next = $mes + 1;
                        $year_next = $year;
                };



		
	echo "<div style='clear:both;'></div>
		
		<!-- MENU -->
			<div id='menu_eu83_2020'>
			<div id='menu_eu83_2020_in'>
				
			<div id='menu_eu83_2020_in2'>
				
			</div>
			
			<div id='menu_eu83_2020_in2'>
				<form action='eu83.php' method='POST'>
					<big>Выберите месяц:</big>
					<SELECT name='eu83_mes'><option>$mes<option>$mesyachs</select> и год:<SELECT name='eu83_year'>$years</select>
					<INPUT TYPE=hidden NAME='eu83' VALUE='ok'>
					<INPUT TYPE=submit NAME=button1 VALUE='Смотреть'>
				</form>
			</div>";
			
			if($role != "rukovoditel"){
				echo"
			<div id='menu_eu83_2020_in2'>
				<a class='red goodbutton' href=eu83_redact.php>Добавить событие</a>
			</div>
			";
			}
			
			
			
			echo"
			<div id='menu_eu83_2020_in2'>
				<form method='post' action='eu83.php'>
		        <INPUT TYPE=hidden NAME='mes' VALUE='$date_back'>
		        <INPUT TYPE=hidden NAME='year' VALUE='$year_back'>
		        <INPUT TYPE=submit VALUE=' < '>
		        </form>
			</div>
			
			<div id='menu_eu83_2020_in2'>
				<font size=3 color=blue><b>ЖУРНАЛ ЭУ-83 за $mes месяц $year года.</b>
			</div>
			
			<div id='menu_eu83_2020_in2'>
			    <form method='post' action='eu83.php'>
		        <INPUT TYPE=hidden NAME='mes' VALUE='$date_next'>
		        <INPUT TYPE=hidden NAME='year' VALUE='$year_next'>
		        <INPUT TYPE=submit VALUE=' > '>
		        </form>
			</div>
			
			
			<div id='menu_eu83_2020_in2'>
			    <form method='post' action='eu83.php'>
		        <INPUT TYPE=hidden NAME='mes' VALUE='$mes'>
		        <INPUT TYPE=hidden NAME='year' VALUE='$year'>
		        <INPUT TYPE=hidden NAME='sort' VALUE='ok'>
		        <INPUT TYPE=submit VALUE='в обратном порядке'>
		        </form>
			</div>
			
			<div id='menu_eu83_2020_in2'>
			    <form method='post' action='eu83.php'>
		        <INPUT TYPE=hidden NAME='mes' VALUE='$mes'>
		        <INPUT TYPE=hidden NAME='year' VALUE='$year'>
		        <INPUT TYPE=hidden NAME='osveschenie' VALUE='on'>
		        <INPUT TYPE=submit VALUE='Освещение'>
		        </form>
			</div>
			
			<div id='menu_eu83_2020_in2'>
				<form action='eu83_excel.php' method='POST'>
					<INPUT TYPE=hidden NAME='mes' VALUE='$mes'>
					<INPUT TYPE=hidden NAME='year' VALUE='$year'>
					<INPUT TYPE=hidden NAME='ipv' VALUE='$ipv'>
					<INPUT TYPE=hidden NAME='di_excel' VALUE='$di'>
					<INPUT TYPE=hidden NAME='ech_excel' VALUE='$ech'>
					<INPUT TYPE=hidden NAME='role' VALUE='$role'>
					<INPUT TYPE=hidden NAME='rukovoditel' VALUE='$rukovoditel'>
					<INPUT TYPE=submit NAME=button1 VALUE='Скачать Excel'>
				</form>
			</div>
			
				
			</div>
			
			
			</div>
			
			<div style='clear:both;'></div>
			
			
	";




//0.0 Читаем БД если role = rukovoditel (читаем все ЭЧ)-------------------------------------------------
if($role == "rukovoditel"){
	
//читаем папку дирекции//получаем список файлов каталога
	$dir = "./$di/";
	unset ($dirs, $n_cehov);
	if (file_exists($dir)){
		$dir = opendir ("$dir");
		while ( $file = readdir ($dir)){
			if (( $file != ".") && ($file != "..")){
				$dirs[] = $file;
				$n_cehov++;
			};
		};
		closedir ($dir);
		//print_r ($dirs);
//		echo "Всего $n_cehov предприятий подключены к программе !</br>		Активно: $echrus</br>";
	};
//	print_r($dirs);
	
	
	$massiv = array();
	foreach($dirs as $ech_i){
		$dirf = "./eu83/eu83db$di$ech_i$mes.$year.csv";
		
		if (!file_exists($dirf)){
//			echo("<br>Файл БД ЭУ-83 $ech_i за $mes месяц $year года не найден.<br>");
		}else{
			//разбиваем файл в массив по строкам
			$file_array =  file ("./eu83/eu83db$di$ech_i$mes.$year.csv");
			$massiv = array_merge($massiv, $file_array);
		}
		
	}
	
	
	sort($massiv);
	if($sort =="resort"){
		rsort($massiv);
	}

//print_r($massiv);
$n = count($massiv);
	
};




//  0.1.  Читаем файл eu83db.csv (если роль не руководитель) ----------------------------------------------------------------------- 
if($role != "rukovoditel"){
	

        $dirf = "./eu83/eu83db$di$ech$mes.$year.csv";
		// echo "$dirf";

                if (file_exists($dirf)){
                        $filetime = stat($dirf);
//                        echo "$filetime[9]";
                        //  echo "Файл найден<br>";
                }else{
					echo "В $mes месяце $year года учитываемых событий не происходило<br>";
					if ($rukovoditel!=1){
						echo "<table align=center><tr><td><a class='red goodbutton' href=eu83_redact.php>Добавить событие</a>
						</td></tr></table>";
					}
					exit;
				};
// время создания файла
$stat=stat("$dirf");
$data_mod=date("H:i d F 20y ", $stat[9]);

//разбиваем файл в массив по строкам
$file_array =  file ("./eu83/eu83db$di$ech$mes.$year.csv");
//echo "$file_array";
$n=0;
  if(!$file_array){
    echo("В $mes месяце $year года учитываемых событий не происходило<br>");
        if ($rukovoditel!=1){
			echo "<table align=center><tr><td><a class='red goodbutton' href=eu83_redact.php>Добавить событие</a></td></tr></table>";
		}
        exit;
  }else{
    for($i=0; $i < count($file_array); $i++)
    {
        $massiv[$i] = "$file_array[$i]|<*<$i";
        //echo "$massiv[$n]<br>";
        $n++;
    }
  sort($massiv);
  };


	if($sort =="resort"){
		rsort($massiv);
	}

//-1-//


};








// 2. Выводим на экран -------------------------------------------------------------------
        // шапка таблицы:
if($rukovoditel!=1){
	$td22 = "<td $td></td>";
};
echo "<table $tab><tr><td $td>№</td><td $td>Дата</td><td $td>Место повреждения</td><td $td>Хронология</td><td $td>Отметка об устранении</td><td $td>Кому сообщено</td><td $td>Причина</td><td $td>Мероприятия</td>$td22</tr>";




     $nom = 0;
for ($i=0; $i < $n; $i++){
	$pos_id = strstr($massiv[$i], ord("<*<")); //ищем id (номер строки в БД)
	
	$massiv[$i] = str_replace("$pos_id", "", $massiv[$i]);
	
	$pos_id = str_replace("<*<", "", $pos_id);
	
	$str_exp = explode("|", $massiv[$i]);
    
    if($str_exp[10]!="hidden"){// отсекаем удалённые
		
		$str_expa = explode(" ", $str_exp[0]);
			    
	    for ($x=0; $x <=7 ; $x++){
			$str_exp[$x] = str_replace("b--b","<br>",$str_exp[$x]);
		};
		
		$ceh_leng = strlen($str_exp[8]);
		if($ceh_leng > 3){
			$str_exp[8] = "Ответственный Цех: $str_exp[8]";
		}
		
		
		$ustr_leng = strlen($str_exp[3]);
			
		if($ustr_leng < 3){
			$back_ustr = "<fieldset title='Нет записи об устранении!'><img src='img/crash.png' width='30' height='40' alt='нет записи об устранении'></fieldset>";
			// $back_ustr ="style='background-image:url(./img/back_ustr.jpg); filter:Alpha(Opacity=30,style=0)'";
		}else{
			$back_ustr = "";
		};
		

		if ($str_exp[14]=="on") {
			$eu83svet = "<img width='96' src='../img/svet.jpg'/>";
		}else{
			$eu83svet = "";
		}

		
		
		if ($str_exp[11]=="on") {
			if ($sovp_echc != "") {
				$dontsee = "";
				$dontsee2 = "<br><fieldset title='Ограниченная видимость!'><image src='img/Eyenot.png' width=20 alt=''></fieldset>";
			}else{
				$dontsee = "on";
				$dontsee2 = "";
				
			}
		}else{
			$dontsee = "";
			$dontsee2 = "";
		}
		
		if($osveschenie=="on" AND $str_exp[14]!="on"){
			$dontsee="on";
		}
		
		 
		$ech_wr=str_replace("ech","ЭЧ-",$str_exp[13]);
		$ech_wr=str_replace("ntel","НТЭЛ",$ech_wr);
		
		if ($str_exp[6]=="on" AND $dontsee==""){
			//передано в нтэ
			if($rukovoditel!=1){
				$nte = "<br><fieldset title='На контроле НТЭ!'><image src='img/nte.png' width=40 alt='НТЭ'></fieldset>";
			}
			$nom = $nom+1;
			
			
			
			echo "<tr><td $td valign='top'>$nom<br>$ech_wr</td><td  $td valign='top'>$str_expa[0]<br>$str_expa[1] $nte $dontsee2<br/><br/>$eu83svet</td><td  $td valign='top'>$str_exp[1]<br><br>$str_exp[8]</td><td  $td align='left' valign='top'>$str_exp[2]</td><td $td valign='top' align='left'>$back_ustr$str_exp[3]</td><td  $td align='left' valign='top'>$str_exp[4]</td><td valign='top' $td align='left'>$str_exp[5]</td><td valign='top' $td align='left'>$str_exp[7]</td>";
		}else{
			$nte="";
			
			if ($rukovoditel!=1 AND $dontsee==""){
				$nom = $nom+1;
				echo "<tr><td $td valign='top'>$nom<br>$ech_wr</td><td  $td valign='top'>$str_expa[0]<br>$str_expa[1] $nte $dontsee2<br/><br/>$eu83svet</td><td  $td valign='top'>$str_exp[1]<br><br>$str_exp[8]</td><td  $td align='left' valign='top'>$str_exp[2]</td><td $td valign='top' $td align='left'>$back_ustr$str_exp[3]</td><td  $td align='left' valign='top'>$str_exp[4]</td><td valign='top' $td align='left'>$str_exp[5]</td><td valign='top' $td align='left'>$str_exp[7]</td>";
			}
		}
		if ($rukovoditel!=1 AND $dontsee=="") {
				echo "
				
				<td $td><form method=post action=eu83_redact.php>
				<INPUT TYPE=hidden NAME='id' VALUE='$pos_id'>
				<INPUT TYPE=hidden NAME='mes' VALUE='$mes'>
				<INPUT TYPE=hidden NAME='year' VALUE='$year'>
				<INPUT TYPE=hidden NAME='filetime' VALUE='$filetime[9]'>
				<fieldset title='Редактировать'><INPUT TYPE=submit VALUE='Re'></fieldset></form>

				<form method=post action=eu83_redact.php><fieldset title='Удалить'>
				<INPUT TYPE=hidden NAME='mes' VALUE='$mes'>
				<INPUT TYPE=hidden NAME='year' VALUE='$year'>
				<INPUT TYPE=hidden NAME='delete' VALUE='$pos_id'>
				<INPUT TYPE=hidden NAME='filetime' VALUE='$filetime[9]'>
				<INPUT TYPE=submit VALUE=' x '></fieldset></form></td></tr>";
		}
	}

	
};
echo "</table>";

//end//-2-//------------------------------------------------------------------------------------
 
 
 
 
if ($rukovoditel!=1){
	 echo "<table align=center>
	<tr><td>
	<a class='red goodbutton' href=eu83_redact.php>Добавить событие</a>
	</td></tr>
	</table>";
}




?>