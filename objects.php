<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "������������ - ��� ������������ ���� ";
include "head.html";

// ����������:

// 1. �������� ������� ��������/��/����
// 2. �������� ���������.
// 2.1. ������ �� ��������
// 3. ����� �� ����� ��������



$cehrus =  $_POST['ceh'];
$newobject =  $_POST['newobject'];


foreach ($_POST as $ArrKey => $ArrStr){
                $mass[] = $ArrStr; //����� �� ������� ������ �� POST
                if($stroka_post ==""){
					$stroka_post = "$ArrStr";
				}else{
					
				}
                $stroka_post = "$stroka_post";
                $keymas[] = $ArrKey;
        };
print_r ($mass); echo "<br>";
print_r ($keymas);



// 1. �������� ������� ��������/��/���� ----------------------------------------------
	if($di=="" or $ech==""){
		echo "������ ������� - �� ����������� �������� ��� ��!";
		exit;
	}else{
		$bdread =  file ("./config$ech.csv");
		
	}
	
	
	
	if($cehrus==""){
		$ceh = ($_COOKIE[cehv]);
	}
	include"cehrename.php";
//end of 1 ---------------------------------------------------------------------------
	
	
	
	
	
	


// 2. �������� ���������. ------------------------------------------------------------
	if($newobject =="ok") 
	{
		$object_str = "$mass[0];$mass[1];$mass[2];$mass[3];$mass[4];$mass[5];$mass[6];$mass[7];";
	    $object_str = str_replace("\r\n","b--b",$object_str);
	    $object_str = str_replace("\n","b--b",$object_str);
	    
	    //�����������
	    $file =  fopen ("$id_pc/objects/$ech/oborudovanie_$ech$ceh.csv","a+");
		if (flock($file, LOCK_EX))
		{ // ��������� ������������ ����������
			
				fputs ($file,"$object_str");
				fputs ($file,"\r\n");
				echo("object_str = $object_str");
			
		}else
		{
			echo "�� ������� �������� ���������� !<br/>";
		}
	        flock($file, LOCK_UN);
	        fclose ($file);
	}
	 
//end of 2.





// 2.1. ������ �� �������� ��������/��/���� ----------------------------------------------
//��������� ���� � ������ �� �������
	$filename = "./objects/$ech/oborudovanie_$ech$ceh.csv";
		
	if(file_exists($filename)){
    	$file_array =  file ("./objects/$ech/oborudovanie_$ech$ceh.csv");	
    	
    	if(isset($file_array)){
    		echo("$filename<br/>");
    		
			$n = count($file_array);
			$i_str = 0;
			
			foreach($file_array as $string){
				$massiv_obj2 = explode(";",$string);
			
				$key_tmp = $massiv_obj2[1];
				if($key_tmp ==""){
					$key_tmp = $massiv_obj2[2];
				}
				
				$massiv_obj [$key_tmp] [$i_str] = $string;
				
				$obj_keys[$i_str] = $key_tmp;

				$i_str++;
				echo("$string<br>");
			}
			unset($string);
			$obj_keys = array_unique($obj_keys);
			
		}else{
			echo("������ ������ �����<br/>");
		}
    	
	}else{
    	echo("����� �� ����������!<br/>");    	
	};

	
	
	




	
// 3. ����� �� ����� �������� --------------------------------------------------------
//	print_r ($bdread);
	echo
	"<div style='clear:both;'></div>
		<div id='bg1'>
			<div id='cont_main'>
				<form method='post' action='objects.php'>
				���:<br>
				<SELECT NAME='ceh'><OPTION>$cehrus<OPTION><OPTION>$ceha<OPTION></SELECT><br><br>
					
				�������:<br>
				<SELECT NAME='001'><OPTION>$bdread[5]<OPTION></SELECT><br><br>
				�������:<br>
				<SELECT NAME='002'><OPTION>$bdread[3]<OPTION></SELECT><br><br>
				
				��� ������������:<br>
				<SELECT NAME='003'><OPTION><OPTION>���������� ����<OPTION>��(��) ���<OPTION>��(��) ���<OPTION>��(��) ��<OPTION>��<OPTION>��<OPTION>���<OPTION>���<OPTION>���<OPTION>��<OPTION>���<OPTION>����<OPTION></SELECT><br><br>
				������������:<br>
				<INPUT type=text name='004' size='20' value=''><br><br>
				���������� � ������������:<br>
				<INPUT type=text name='005' size='40' value=''><br><br>
				<INPUT TYPE=hidden NAME='newobject' VALUE='ok'>
				<INPUT TYPE=submit class='green goodbutton' VALUE='���������'>
				</form>
			</div>";
			
			
			echo "<div id='cont_main'><!-- ����� �� ����� ������������ -->";
					
					foreach($obj_keys as $string){
						echo("$string<br>");
					}
							
			echo "</div>";
			
			
			echo "<div id='cont_main'>
				
			</div>";
//end of 3 ---------------------------------------------------------------------------





/*
	$tk_array = file("techkards.csv");
	foreach ($tk_array as $TK_Str){
		echo("$TK_Str<br>");
	}*/
		



echo "</body></HTML>";
 ?>