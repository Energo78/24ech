<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
$titl = "������ �� ���";
include "head.html";
include "config.php";
$date=$_POST["date"];
include "date_functions.php";
$otmeny=$_POST["otmeny"];
$circle=$_POST["circle"];
$fioechc=$_POST["fio"];


//- --------------------------


	//������ dir � ����� �� ����� (���� �� �����)
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
							//������ ���� � ������� ������ �� ����� --------------
							$file_tmp = file("$direct$file");
							$striprf = "$file_tmp[0]";
							//print_r($file_tmp);
//							echo("$striprf<br>");
							
							//����� ����� ���� $striprf
							$dop02 = $n_okn;
							
							$filename = "./$di/$ech/$ceh/$year/$mesday/$file";
							$striprf = str_replace("b-b","</br>", $striprf);
							$maswork = explode("|", $striprf);
							$i=$n_okn;
							
							
							$asapvo = "$maswork[44]";
							$asapvo_mas = explode(";", $asapvo);
							
							$hours = floor($asapvo_mas[1]/60);
							$minutes = $asapvo_mas[1] - ($hours*60);
							
							$asapvo_mas[5] = str_replace("���������� �����: ��-1 ","", $asapvo_mas[5]);
							
							$mestorabot = $maswork[13];
							
							$mestorabot = str_replace("������� ", "", $mestorabot);
							
							unset($put, $put_ok);
							$put_ok = $mestorabot;
							
							unset($put);
							$put = substr_count("$mestorabot", "�.2");
							if($put > 0){
								$put_ok = "�� 2 ���� �������� $mestorabot</br>
								�� ������� �  ������� </br>
								�� ������� �  ������� </br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "�.1");
							if($put > 0){
								$put_ok = "�� 1 ���� �������� $mestorabot</br>
								�� ������� �  ������� </br>
								�� ������� �  ������� </br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "���� 2");
							if($put > 0){
								$put_ok = "�� 2 ����, �� ��������:  ������� $mestorabot</br>
								�� �������� ��������� �׻</br>
								�� �������� ��������� ��Ļ</br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "���� 1");
							if($put > 0){
								$put_ok = "�� 1 ����, �� ��������:  ������� $mestorabot</br>
								�� �������� ��������� �ͻ</br>
								�� �������� ��������� ��Ļ</br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "���� 2");
							if($put > 0){
								$put_ok = "�� 2 ����, �� ��������:  ������� $mestorabot</br>
								�� �������� ��������� �׻</br>
								�� �������� ��������� ��Ļ</br>";
							}
							
							unset($put);
							$put = substr_count("$mestorabot", "���� 1");
							if($put > 0){
								$put_ok = "�� 1 ����, �� ��������:  ������� $mestorabot</br>
								�� �������� ��������� �ͻ</br>
								�� �������� ��������� ��Ļ</br>";
							}
							
							
							
							//echo("$asapvo<br>");
							echo "<tr COLSPAN='5'><td>
								<hr color='#006633' />
								<p style='text-align: center;'>
								<b>������ �</b>
								</p>
								<p style='text-align: left;'>
								������� ��-1</br>
								$date</br>
								</br>
								���� <b>$circle</b>  �����			�� ���-1</br>
								��� ������������ ����� �� ���������� ����</br>
								����� ����� ���������� � ���������� ����:</br>
								<b>$put_ok 
								</br></b>
								������������������ $hours ���. $minutes ���.</br>
								��� ���� ������� ��� �������� ���� �������</br>
								��� ��������� ���� � ������ ��� ������ � <b>�����������</b>.</br>
								�����������:  $maswork[11].</br>
								</br>
								<b>$asapvo_mas[5]</b></br>
													���-1  <b>$fioechc</b></br>
								</p>
								
								<!-- ������ �______ � _____ �� ________��� _____________��� _____________</br>
								����������� �_______ � ________������ ��� �� �������� � _________</br>
								</br>
								-->
								</td></tr>
								";
							
							
							$n_okn = $n_okn +1;
						}
					}
			}
			closedir ($dir_okn);
		}
	}	
	$n2 = $n_okn;
	echo "</table></div>";
	//end ���� �� �����












								
        //----------------------------------------


 
 
 
 
 
 
 
 
 
 ?>