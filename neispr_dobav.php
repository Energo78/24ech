<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "neispr_read.php";
//        echo "$massiv[$n]<br>";
//echo "!---$n---!<br>";

//получаем данные
$i=$_POST['i'];
$mas[0]=$_POST['stanc'];
$mas[1]=$_POST['obekt'];
$mas[2]=$_POST['neispr'];
$mas[3]=$_POST['date1'];
$mas[4]=$_POST['date2'];
$mas[5]=$_POST['otv'];
$slujba=$_POST['slujba'];

if ($slujba=="on")
{$mas[6]="bgcolor=yellow";};
//-----------------------------------------------------------------------------------------удаление строки $del
$del=$_POST['delete'];
	if ($i =="")
        {
                $deletex=$_POST['deletex'];
                settype($deletex,string);
        };
        if ($del!="")
        {
            if($menuis!=1){
				include "head.html";
			}
                include "config.php";
                echo "
                <table $tab><tr><td colspan=5>
                Вы уверены что хотите удалить запись?<br>
                <form method=post action='neispr_dobav.php'><fieldset title='Удалить'><INPUT TYPE=hidden NAME='deletex' VALUE='$del'><INPUT TYPE=submit VALUE=' ДА! '></fieldset></form>
                <form method=post action='neispr.php'><fieldset title='Не удалять'><INPUT TYPE=submit VALUE=' Отмена '></fieldset></form>
                </td></tr></table>
                ";
                exit;
        };

if ($deletex !=""){
	//пишем лог-файл
	$log =  fopen ("./neispr/log.csv","a");
	if(!$log){
		echo("Ошибка открытия файла log.csv");
	}
	$datetime = date("d.m.Y Время H:i:s Удалена запись неисправности");
	fputs ($log, "---!---\n");
	fputs ($log, $datetime);fputs ($log, "\n$ip");fputs ($log, "\n$massiv[$deletex]конец записи!\n");
	fclose ($log);

	//пишем delete-файл
	$delete =  fopen ("./neispr/delete$di$ech.csv","a");
	if(!$delete){
		echo("Ошибка открытия файла delete$di$ech.csv");
	}
	$datetime = date("d.m.Y Время H:i:s|");
	fputs ($delete, $datetime);fputs ($delete, "$ip|");fputs ($delete, "$massiv[$deletex]");
	fclose ($delete);

	//удаляем строку
	$file =  fopen ("$dirf","w+");

	for ($x=0; $x < $deletex ; $x++){
		$massiv[$x] = str_replace("\r\n","",$massiv[$x]);
		$massiv[$x] = str_replace("\n","",$massiv[$x]);
		fputs ($file,"$massiv[$x]");
		if ($x<$n){
			fputs ( $file,"\n");
		}
	};
	$del2 = $deletex+1;
	for ($x=$del2; $x < $n ; $x++){
		$massiv[$x] = str_replace("\r\n","",$massiv[$x]);
		$massiv[$x] = str_replace("\n","",$massiv[$x]);
		fputs ($file,"$massiv[$x]");
		if ($x<$n){
			fputs ( $file,"\n");
		};
	};

	fclose ($file);

	include "neispr.php";
	exit;
};

//----------------------------

//---------------------добавляем новую строку
if ($i ==""){
	echo "
	<script language=JavaScript>
	<!-- hide from old browsers

	alert('Вы не ввели порядковый номер для записи')

	// -->
	</script>

	";
	include "neispr_dobav.html";
	exit;
};
$new_str="$mas[0]|$mas[1]|$mas[2]|$mas[3]|$mas[4]|$mas[5]|$mas[6]|";
$new_str = str_replace("\r\n","",$new_str);

//пишем лог-файл_добавление строки
$log =  fopen ("./neispr/log.csv","a");
if(!$log){
    echo("Ошибка открытия файла log.csv при добавлении записи!");
}
$datetime = date("d.m.Y Время H:i:s Добавлена запись неисправности");
fputs ($log, "---!---\n");
fputs ($log, $datetime);fputs ($log, "\n$ip");fputs ($log, "\n$new_str\nконец записи!\n");
fclose ($log);

$file =  fopen ("$dirf","w+");

for ($x=0; $x < $i ; $x++){
	$massiv[$x] = str_replace("\r\n","",$massiv[$x]);
	$massiv[$x] = str_replace("\n","",$massiv[$x]);
	fputs ($file,"$massiv[$x]");
	if ($x<$n){
		fputs ( $file,"\n");
	}
};

fputs ($file,"$new_str");
fputs ( $file,"\n");

for ($x=$i; $x <=$n ; $x++){
	$massiv[$x] = str_replace("\r\n","",$massiv[$x]);
	$massiv[$x] = str_replace("\n","",$massiv[$x]);
	fputs ($file,"$massiv[$x]");
	if ($x<$n){
		fputs ( $file,"\n");
	}
};



fclose ($file);

include "neispr.php";





echo "</body></HTML>";
?>