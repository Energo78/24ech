<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "��ר� �� �����";
include "head.html";

//soderjanie:
//1 �������� ������ post
//2 ������ ����� � �������� + ������� ������




//1 �������� ������ post
	$cehrus=$_POST["cehrus"];
	$mes=$_POST["mes"];
	$year=$_POST["year"];
	include "cehrename.php";
	
	
	unset($mass, $keymas, $mas_otch_v1);
	foreach ($_POST as $ArrKey => $ArrStr)
    {
		$mass[] = $ArrStr;
        $keymas[] = $ArrKey;
        $mas_otch_v1[$ArrKey] = $ArrStr;
	};
	
		
//	print_r($mass); echo("</br>");
//	print_r($keymas); echo("</br>");
	$keymas2 = array_splice($keymas, count($input), 4);
	
//	print_r($keymas2); echo("</br>");
	//print_r($keymas); echo("</br>$count_arr</br>"); // - ����� ������ ��������� ����� � �������
	$count_arr = count($keymas);
//	echo("</br>$count_arr</br>");
//	print_r($mas_otch_v1); echo("</br>");
	
	
	echo "��ר� � ������ $cehrus �� $mes ����� $year ����.<br>";

//2 ������ ����� � �������� + ������� ������
	$notchm=0;
	
	if($count_arr == 0){
		echo("������ �� �������, ������� ��� ������<br/>");
	};
	
	
	echo "<div id='rabots'><table>";
	
	
	for ($i=1; $i < 32; $i++){
		$day = "$i";
		$day = str_pad($day, 2, "0", STR_PAD_LEFT);
		$mesday = "$mes$day";
		//��������� ������� �����
		$dir = "./$di/$ech/$ceh/$year/$mesday";
		if (file_exists($dir)){
			//echo "$mesday -- ";
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir)){
				
				if (( $file != ".") && ($file != "..")){
						$notchm++;// ���������� ����� ������
						//echo "$file ---<br>";
						$otmena = substr_count("$file","otmena");
						if($otmena !=0){
							break;
						}
						$file = fopen("./$di/$ech/$ceh/$year/$mesday/$file","r");
						
						$strip = fgets ($file);
						
						fclose ($file);
						$dateotchmes = "$day.$mes.$year";
						$maswork = explode("|", $strip);
						
						//��������� ������
						if($count_arr > 1){
							foreach($keymas as $ke){
								if($maswork[$ke]=="on"){
									include "onework.php";//������� ������ �������
								}elseif($ke =="12"){
									if($maswork[$ke]!=""){
										include "onework.php";//������� ������ ������� (������������)
									}
								}
							}
						}else{
							/*echo("������ �� �������, ������� ��� ������<br/>");*/
							include "onework.php";//������� ������ �������
						}
						
						
						
						// echo "$strip<br>";
				};
			};
			closedir ($dir);
		}
	}	
	
	
	
	
	echo "</table></div>";
	echo"����� ���������������� �����: $notchm.";
	
//excel







?>