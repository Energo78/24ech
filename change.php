<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

if($menuis!=1){
	include "head.html";
}


		//получаем данные

		$date1=$_POST['date'];
		$redactf=$_POST['redactf'];
		$data[2]=$_POST['echknum'];
		$data[3]=$_POST['work'];
		$data[4]=$_POST['mesto'];
		//$data[6]=$_POST['time6'];
		$time11 = $_POST['time11'];
		if ($time11 != "ОТМЕНА"){
			settype($time11,integer);
			$time12 = $_POST['time12'];settype($time12,integer);
			$time21 = $_POST['time21'];settype($time21,integer);
			$time22 = $_POST['time22'];settype($time22,integer);
			$data[7]="$time11:$time12-$time21:$time22";
			$data[6]=($time21*60+$time22)-($time11*60+$time12);
		}else{
			$data[7]="$time11";
		};
		$time31 = $_POST['time31'];settype($time31,integer);
		$time32 = $_POST['time32'];settype($time32,integer);
		$time41 = $_POST['time41'];settype($time41,integer);
		$time42 = $_POST['time42'];settype($time42,integer);
		$data[8]="$time31:$time32-$time41:$time42";
		
		$data[9]=$_POST['adm'];
		//$data[10]=$_POST['loco'];
		$data[10]=$_POST['proizvod'];
		$data[11]=$_POST['osob_treb'];
		$data[13]=$_POST['narnum'];
		$data[14]=$_POST['zayavka'];
		$data[15]=$_POST['otmena1'];
		$data[16]=$_POST['primechanie'];
		$data[17]=$_POST['otmena2'];
		$data[18]=$_POST['ustr_zam'];
		$data[19]=$_POST['emp'];
		//$data[20]=$_POST['time20'];
		$data[20]= ($time41*60+$time42)-($time31*60+$time32);//время факт в минутах
		$data[21]=$_POST['workf'];
		$data[22]=$_POST['sovmesh'];
		        
		for ($i=0; $i <= 23; $i++) //замена перевода строк
        {
                $data[$i] = str_replace("\r\n","b--b",$data[$i]);
        };
        $i = 0;
        /* отмены ЭМП закомент.
		if ($data[11] =="on" and $data[15]=="on")
        {
                include "head.html";
                echo "<b>Отмены окон ЭМП не фиксируем как отмены ДНЦ.<br>В примечаниях следует только указать причину отмены окна.<br>Вернитесь назад.</b>";
                exit;
        };
                if ($data[13] =="on" and $data[15]=="on")
        {
                include "head.html";
                echo "<b>Отказы от окон ЭМП не фиксируем как отказы ЭЧК.<br>В примечаниях следует только указать причину отказа от окна.<br>Вернитесь назад.</b>";
                exit;
        };*/

		$dir = "./data/$date1";
		$dirf = "./data/$date1/$redactf";

		chdir("./data/$date1");

		$file = fopen("$redactf","w+");
        if(!$file)
        {
                echo("Ошибка открытия файла");
        };

        for ($i=0; $i <= 23; $i++)
        {
                fputs ( $file,"$data[$i]");fputs ( $file,"|");
        };
        $i = 0;

fclose ($file);
chdir("..");
chdir("..");

//вставляем кусок кода из otchet_2.php для отображения таблицы.

$date = $date1;

// echo "date = $date -!<br>
		// date1 = $date1 -!<br>";

include "otchet_2.php";

//-------------------

echo "
</body></HTML>";
 ?>