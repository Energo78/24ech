<?php
// ini_set('display_errors',1);
// Error_Reporting(E_ALL & ~E_NOTICE);

$titl = "�������� �����";
include "head.html";

// ����������:
// 1. 
// 2. 
// 3. 

$vhod = $_POST[vhod];
//echo "vhod: $vhod<br>";
//1. �������� ����� � ��������� � ������ ����� ��� ����������� ���������� ����� ------------
if($vhod =="zagruzka"){
	ini_set('upload_max_filesize', '4M'); //����������� � 3 ��
	unset($massiv_pitch);
	 if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // ���������, �������� �� ������������ ����
	 	
		 $destiation_dir = dirname(__FILE__) .'/upload/'.$_FILES['inputfile']['name']; // ���������� ��� ���������� �����
		 $typ = $_FILES['inputfile']['type'];
		 if($typ =="application/vnd.ms-excel" OR $typ=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
		 move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // ���������� ���� � �������� ����������
	//	 echo '���� ��������!<br>';  //��������� �� �������� �������� �����
		 
	//	 echo "��� �����: $typ<br>";	
		 
		 
		// ���������� ����� ��� ������ � excel
		require_once('Classes/PHPExcel.php');
		
		
		$excel = PHPExcel_IOFactory::load("$destiation_dir");
		//����� ��������� ������ �� ���� ������ Excel ����� � ������� �����:

		Foreach($excel ->getWorksheetIterator() as $worksheet) {
		 $lists[] = $worksheet->toArray();
		}
		//����� ��������������� ������� � ���� HTML ������(�) :
		foreach($lists as $list){
			
			// ������� �����
			foreach($list as $row){
				
				// ������� ��������
				unset($sovpad, $string);
				
				foreach($row as $col){
					$col = iconv("utf-8", "windows-1251", $col);
					
					// ������������ ---------------
					$col = str_replace("\r\n","",$col);
					$col = str_replace('\" ',"",$col);
					$col = str_replace('\"',"",$col);
					$col = str_replace('&quot;'," ",$col);
					$col = str_replace('&apos;',"",$col);
					$col = str_replace('&acute;',"",$col);
					$col = str_replace('&Prime;',"",$col);
					$col = str_replace('&lsquo;',"",$col);
					$col = str_replace('&ldquo;',"",$col);
					$col = str_replace('&rdquo;',"",$col);
					$col = str_replace('&prime;',"",$col);
					$col = str_replace('&tilde;',"",$col);
					$col = str_replace('&rsquo;',"",$col);
					$col = str_replace('"','',$col);
					$col = str_replace('\""',"",$col);
					$col = str_replace('\"""',"",$col);
					$col = str_replace("\r","",$col);
					$col = str_replace("\n","",$col);
					$col = str_replace("\ \"","",$col);
					$col = str_replace("  "," ",$col);
					$col = str_replace("   "," ",$col);
					$col = htmlspecialchars($col);
									
					
					$sovpad=substr_count("$col", "����� ����������");
					$sovpad2=substr_count("$col", "�� ������� ����������");
					$sovpad3=substr_count("$col", "������ ����������");
					$sovpad4=substr_count("$col", "������ ����������");
					$sovpad5=substr_count("$col", "����� ����������");
					
					$sovpad = $sovpad + $sovpad2 + $sovpad3 + $sovpad4 + $sovpad5;
				
					$string = "$string"."$col;";

				}
				
					$sovpad=substr_count($string, "����� ����������");
					$sovpad2=substr_count($string, "�� ������� ����������");
					$sovpad3=substr_count($string, "������ ����������");
					$sovpad4=substr_count($string, "������ ����������");
					$sovpad5=substr_count($string, "����� ����������");
					$sovpad5=substr_count($string, "��-");
					
					$sovpad = $sovpad + $sovpad2 + $sovpad3 + $sovpad4 + $sovpad5;
					
					
						if($sovpad > 0){
							$massiv_pitch[]="$string";
	//						echo "$string<br/><br/>";
							
						}
					
					
			}
				
		}	
		 
		 
		 }else{
		 
		 		echo '������ �������� �����1!';
		  }
		 
	 }else{
	 	 	echo '������ �������� �����2!';
	}

}
//end of 1 -------------------------------------------------------------------




// 2 ���������� ���� � ���� � ������� � �� ������������� �� ����� ���� (������ � $massiv_pitch) ----------
if($vhod =="zagruzka"){
	if($massiv_pitch !=""){
		$date=$_POST["date3"];
		$n=0;
	echo("<form method='post' action='upload.php'>");
	
	foreach($massiv_pitch as $pitch){
		
		
		echo("<br/>�������� ���:<SELECT name='cehrus_$n'><option>$ceha</select><br>$pitch
		<input type='hidden' name = 'str_$n' VALUE='$pitch' />
		<br/><br/>");
		$n++;
	}
	echo("<input type='hidden' name = 'vhod' VALUE='saving' />
		<input type='hidden' name = 'n' VALUE='$n' />
		<input type='hidden' name = 'date_apvo2' VALUE='$date' />
		<INPUT TYPE=submit NAME=button1 VALUE='���������!'>
		</form>");
	
		$no_form1 = "ok";
	}
}

// end of 2 ----------------------------------------------------------------------




//3. ��������� ���������� ������ �� ������ ����� � � ���� ��������� ���� ------------------
$vhod = $_POST[vhod];
if($vhod =="saving"){
	//�������� --------
	foreach ($_POST as $ArrKey => $ArrStr){
                $mass_k[$ArrKey] = $ArrStr;
        };
    $date=$_POST["date_apvo2"];
    
    
//    include("head_check.php");
    /*echo("<br/><br/>mass_k<br/><br/>");
    print_r($mass_k);
    echo("<br/><br/>end<br/><br/>");*/


	$n = $_POST[n];
	
	
	for($i = 0; $i < $n+1; $i++){
		$key = "cehrus_$i";
		$key2 = "str_$i";
	
		
			$arr_min = explode(";", $mass_k[$key2]);
//			print_r($arr_min);
			$cehrus = "$mass_k[$key]";
			$ceh="";
			include ("cehrename.php");
			include("date_functions.php");
			
			//		��������� ������ ��� ������� � ����
			$stroka_for = "$ceh|||||||||||||$arr_min[1], $arr_min[2]||||||||||||on|||||||||||||||||||$mass_k[$key2]|";
			
//			echo("<br/>$mass_k[$key], $ceh   $date<br/>end<br/><br/><br/>");
			
		if($mass_k[$key] !=""){
			// ���������
			$dir = "./$di/$ech/$ceh/$year";
			if (file_exists($dir)) {
			    // echo "������� $dir ������<br>";
			} else {
			    mkdir("./$di/$ech/$ceh/$year");
				// echo "������� $dir ������<br>";
			};
			$dir = "./$di/$ech/$ceh/$year/$mesday";

			if (file_exists($dir)) {
			    // echo "������� $dir ������<br>";
			} else {
			    mkdir("./$di/$ech/$ceh/$year/$mesday");
				// echo "������� $dir ������<br>";
			};
			
				srand((double) microtime()*1000000);
		    	$filename = rand();
				$filename = "okno$otmena$filename";
			
			$dirf = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";
		    
		    if (file_exists($dirf)) {
		    	srand((double) microtime()*1000000);
	            $filename = rand();
	            $filename = "okno$otmena$filename";
				$dirf = "./$di/$ech/$ceh/$year/$mesday/$filename.csv";			
				}
		    
		    //��������� ����
		    $file = fopen("$dirf","w+");	
			//������ ������
			fputs ($file,"$stroka_for");
			// ��������� ����
			fclose ($file);
			
//			echo("<br/>������� ���� $stroka_for<br/><br/>");
		}else{
		 	// ��������� � ���� ��������� ���� (����� okna_bezhoz)
			$dir = "./okna_bezhoz/$year";
			if (file_exists($dir)) {
			    // echo "������� $dir ������<br>";
			} else {
			    mkdir("./okna_bezhoz/$year");
				// echo "������� $dir ������<br>";
			};
			
			$dirf = "./okna_bezhoz/$year/$mesday.csv";
		    
		    
		    //��������� ����
		    $file = fopen("$dirf","a+");	
			//������ ������
			fputs ($file,"$stroka_for\r\n");
			// ��������� ����
			fclose ($file);
		 }
			unset($stroka_for);
			
		
	}
	
	
	
	// ---------------
	
	echo("<br/><b>������ ������� �������.</b><br/><br/>");
	
//	$date_from_upload = $date;
//	include("otchet_okn2.php");
	
}
//end of 3 -----------------------------------------------------------




//4. ����� ����� �������� ����� ---------------------------------------------------
	if($no_form1 !="ok"){
		echo "
		<h3>�������� ����� (������ xls ��� xlsx):</h3>
		<form method='post' action='upload.php' enctype='multipart/form-data'>
		<input type='hidden' name = 'vhod' VALUE='zagruzka' />
		<label>�������� ����: </label>
		<input autocomplete='off' name='date3' type='text' value='$datenext' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
		<label for='inputfile'>�������� excel ���� ������� �� ���� (�� 4 ��������): </label>
		<input type='file' id='inputfile' name='inputfile'></br></br>
		<input type='submit' value='���������'>
		</form>
		";
	}


// end of 4 -----------------------------------------------------------------------




echo "</body></HTML>";







/*if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
	if ($_FILES['inputfile']['error'] == UPLOAD_ERR_OK && $_FILES['inputfile']['type'] == 'image/pjpeg') { //�������� �� ������� ������
		$destiation_dir = dirname(__FILE__) . '/upload/' . $_FILES['inputfile']['name']; // ���������� ��� ���������� �����
		if (move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir)) { //����������� � �������� ����������
			echo '���� �������� �������!'; //��������� ������������ �� �������� �������� �����
		} else {
			echo '������ �������� �����..';
		}
	} else {
		switch ($_FILES['inputfile']['error']) {
			case UPLOAD_ERR_FORM_SIZE:
			case UPLOAD_ERR_INI_SIZE:
			echo '������ ����� ��������';
			brake;
			case UPLOAD_ERR_NO_FILE:
			echo '���� �� ������';
			break;
			default:
			echo '�������� ������';
		}
	}
}
*/
 ?>