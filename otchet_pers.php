<?php 
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);


if ($otchet2016 != 1){ //���������� �� otchet_04.php
	$di=$_POST["di"];
	$ech=$_POST["ech"];
	$filtr = $_POST["filtr"];
	$podUf = $_POST["podUf"];
	$obhodf = $_POST["obhodf"];
	$rab_VLf = $_POST["rab_VLf"];
	$rasporyazheniyaf = $_POST["rasporyazheniyaf"];
	
	$titl = "�����";

	if ($datepers ==""){
		$datepers=$_POST["date"];
	}
		
	if ($datepers==""){
		$datepers = date('d.m.Y');
	};

	if ($date1 != ""){
		$datepers = $date1;
	};
	
	include "head.html";
	
	include "config.php";
	
	$date = $datepers;

	include "date_functions.php";
	include "ceha.php";
	// ������
	if($filtr=="ok"){
		/*echo"
			<div style='clear:both;'></div>
			<div id='bg1'>
			<div id='cont30'>
			<form method='post' action='otchet_pers.php'>
			<p style='text-align:left;'>
			<big>�������� ����:</big>
			<input autocomplete='off' name='date' type='text' value='' size='10' onfocus='this.select();lcs(this)'onclick='event.cancelBubble=true;this.select();lcs(this)'>
			
			<INPUT TYPE=hidden NAME='filtr' VALUE='ok'>
			</br><INPUT TYPE=checkbox NAME='podUf'>������ ��� �����������
			</br><INPUT TYPE=checkbox NAME='rab_VLf'>������ �� �� ��, ��, ���
			</br><INPUT TYPE=checkbox NAME='obhodf'>������ � �������� ���������
			</br><INPUT TYPE=checkbox NAME='obezdf'>������� � �������� ���������
			</br><INPUT TYPE=checkbox NAME='rasporyazheniyaf'>������ �� ������������
			</br><INPUT TYPE=submit NAME=buttonfiltr VALUE='��������� ������'>
			</form></p>
			</div>
			<div id='cont31'>
			<p style='text-align:left;'>
			����� �� ���� ������� �� ����:<br>
			<form method='post' action='otchet_mes.php'>
			<big>�������� ���:</big>
			<SELECT name='cehrus'><option>$cehrus<option>$ceha</select><br><br>
			<big>�������� �����:</big>
			<SELECT name='mes'>$mesyachs</select> � ���:<SELECT name='year'>$years</select><br>
			<INPUT TYPE=hidden NAME='filtr2' VALUE='ok'>
			</br><INPUT TYPE=submit NAME=buttonfiltr VALUE='������� �����'>
			</form></p>
			
			</div>
			</div>
		";*/
	};
	
	echo //������������� ����
	"
		<div style='clear:both;'></div>
		<div id='list'><table><tr><td>
		<form method='post' action='otchet_pers.php'>
			<INPUT TYPE=hidden NAME='filtr' VALUE='$filtr'>
			<INPUT TYPE=hidden NAME='podUf' VALUE='$podUf'>
			<INPUT TYPE=hidden NAME='obhodf' VALUE='$obhodf'>
			<INPUT TYPE=hidden NAME='date' VALUE='$dateold'>
			<INPUT TYPE=hidden NAME='rab_VLf' VALUE='$rab_VLf'>
			<INPUT TYPE=hidden NAME='obezdf' VALUE='$obezdf'>
			<INPUT TYPE=hidden NAME='rasporyazheniyaf' VALUE='$rasporyazheniyaf'>
			<INPUT TYPE=hidden NAME='otchet_ech' VALUE='ok'> 
			<INPUT TYPE=submit NAME=button1 VALUE='<< $dateold'>
		</form>
		</td><td>
		<form method='post' action='otchet_pers.php'>
			<INPUT TYPE=hidden NAME='filtr' VALUE='$filtr'>
			<INPUT TYPE=hidden NAME='podUf' VALUE='$podUf'>
			<INPUT TYPE=hidden NAME='obhodf' VALUE='$obhodf'>
			<INPUT TYPE=hidden NAME='rasporyazheniyaf' VALUE='$rasporyazheniyaf'>
			<INPUT TYPE=hidden NAME='rab_VLf' VALUE='$rab_VLf'>
			<INPUT TYPE=hidden NAME='obezdf' VALUE='$obezdf'>
			<INPUT TYPE=hidden NAME='date' VALUE='$datenext'>
			<INPUT TYPE=hidden NAME='otchet_ech' VALUE='ok'> 
			<INPUT TYPE=submit NAME=button2 VALUE='$datenext >>'>
		</form></td></tr></table>
		</div>
	";
};

// ������ �� ������ ������������
	// ������ ����� ��
	//�������� ������ ������ ��������
		// $n=0;
		$dir = "./$di/$ech/";
		unset ($n_rabot_ech, $dirs, $n_cehov, $ce, $sovpad, $n_rab_na_echk, $n_rab_na_echs, $n_rab_na_tyagov, $n_rab_na_rru); //��������
		if (file_exists($dir)) {
			$dir = opendir ("$dir");
			while ( $file = readdir ($dir)){
					if (( $file != ".") && ($file != "..")){
						$dirs[] = $file;
						$n_cehov++;
					};
			};
			closedir ($dir);
			// sort ($dirs);
			// print_r ($dirs);
			// echo "</br>! $n_cehov !</br>";// ���������� ����� �����
		};
		
	if($filtr !=""){
		echo"<div id='rabots'><table>";
	}
		$n_rab_na_echk = $n_rabot_ech; //������� ������ �� ��K
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "echk");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		$n_rab_na_echk = $n_rabot_ech - $n_rab_na_echk;
		
		$n_rab_na_echs = $n_rabot_ech; //������� ������ �� ���
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "echs");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		$n_rab_na_echs = $n_rabot_ech - $n_rab_na_echs;
		
		$n_rab_na_tyagov = $n_rabot_ech; //������� ������ �� ���
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "eche");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		$n_rab_na_tyagov = $n_rabot_ech - $n_rab_na_tyagov;
		
		$n_rab_na_rru = $n_rabot_ech; //������� ������ �� ���
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "echr");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		
		
		$n_rab_ntel = $n_rabot_ech; //������� ������ ����
		for($ce=0; $ce < count($dirs); $ce++){
			$sovpad=substr_count("$dirs[$ce]", "ntel");
			if ($sovpad!=""){
				$ceh = "$dirs[$ce]";
				$inotchet = 1;
				include "arm_nach_ceh.php";
				unset ($ceh);
			};
		};
		
		$n_rab_na_rru = $n_rabot_ech - $n_rab_na_rru;
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echp");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echc");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echm");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echd");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
		
		// for($ce=0; $ce < count($dirs); $ce++){
			// $sovpad=substr_count("$dirs[$ce]", "echa");
			// if ($sovpad!=""){
				// $ceh = "$dirs[$ce]";
				// $inotchet = 1;
				// include "arm_nach_ceh.php";
				// unset ($ceh);
			// };
		// };
	if($filtr !=""){
		echo"</table></div>";
	}	

// end ������ �� ������ ������������


// ������� ����� �� ����� date
if ($otchet2016 != 1 and $filtr==""){ //���������� �� otchet_04.php (�������� echo ��� ��������� ������) 
	    echo "<div id='rabots'><table>
				<tr><td>����� �� ������� � $ech �� $datepers</td><td></td></tr>
				<tr><td>���������� �����:</td><td>$n_person_v_ech</td></tr>
				<tr><td>���������� �� ������� �������������:</td><td>$pers_vrab_ech</td></tr>
				<tr><td>��������� ������������:</td><td>$instr</td></tr>
				<tr><td>����� ������������ �����:</td><td>$n_rabot_ech</td></tr>
				<tr><td>����� �� ���:</td><td>$n_rab_na_echk</td></tr>
                <tr><td>����� �� ��C:</td><td>$n_rab_na_echs</td></tr>
                <tr><td>����� �� ���, ���:</td><td>$n_rab_na_tyagov</td></tr>
				<tr><td>����� ���� ���:</td><td>$n_rab_na_rru</td></tr>
				
                <tr><td>��e�� ����� ��� U:</td><td>$nar_U �� $tameU �����.</td></tr>
                <tr><td>����� �� �� ��, ��, ���:</td><td>$rab_VL</td></tr>
				<tr><td>������ �� ������������:</td><td>$rasp_sum</td></tr>
				<tr><td>����� � ������� ������� ������������:</td><td>$rabot_v_tekexpl</td></tr>
                <tr><td>�������:</td><td>$obhodov</td></tr>
                <tr><td>��������:</td><td>$obezdov</td></tr>
                <tr><td>��������� �����. ����� (��.):</td><td>$prov_exp</td></tr>
                <tr><td>������ ���� (��.):</td><td>$prov_viks</td></tr>
                <tr><td>�������� ���������:</td><td>$obnaruz_zam</td></tr>
                <tr><td>��������� ���������:</td><td>$ustr_zam</td></tr>
                
                <tr><td>��������� ��������� (��������):</td><td>$sobran</td></tr>

                <tr><td><b>�����������:</b></td><td></td></tr>
                <tr><td>���-��:</td><td>$nar_P</td></tr>
                <tr><td>���:</td><td>$nar_E</td></tr>
                <tr><td>��:</td><td>$nar_SH</td></tr>
                <tr><td>���:</td><td>$nar_RCS</td></tr>
                <tr><td>���:</td><td>$obesp_SMP</td></tr>
                <tr><td>������ �����������:</td><td>$obesp_proch</td></tr>
                <tr><td>����������� �����:</td><td>$sovm</td></tr>
                <tr><td>������ ����������:</td><td>$rem_zz</td></tr></table>
			</div>

        ";


	if ($filtr==""){
		if ($di=="di_01" and $ech=="ech01"){//����� �� �����
			$date1 = $datepers;
			$from_otchet_pers = 1;
			include "otchet_okna.php";
			unset ($from_otchet_pers);
		};
		
		
	// {��������� ��������� ��-��
			include "config.php";
			include "read_tudu.php";
			// ����� �������:
			echo "<p align=center><i><b><font color=#0000FF size=4><span lang=ru>��������� ��-�� �� $data_mod</span></font></b></i></p><table $tab><tr><td $td>�����</td><td $td>������</td><td $td>�������������</td><td $td>���� ������</td><td $td>������� ��<br>����������</td><td $td>�������������</td></tr>";
			 for ($i=0; $i < $n; $i++)
			{
				$str_exp = explode("|", $massiv[$i]);

				if ($str_exp[6]!="")
				{
					echo "<tr><td $str_exp[6] $td>$str_exp[0]</td><td $str_exp[6] $td>$str_exp[1]</td><td $str_exp[6] $td>$str_exp[2]</td><td $str_exp[6] $td>$str_exp[3]</td><td $str_exp[6] $td>$str_exp[4]</td><td $str_exp[6] $td>$str_exp[5]</td></tr>";
				 };
			};
			echo "</table>";
		  //}


		 // {��������� �������������
			include "neispr_read.php";
			
			// ����� �������:
			echo "<p align=center><i><b><font color=#0000FF size=4><span lang=ru>������������� �� $data_mod</span></font></b></i></p><table $tab><tr><td $td>�����</td><td $td>������</td><td $td>�������������</td><td $td>���� ������</td><td $td>������� ��<br>����������</td><td $td>�������������</td></tr>";
			for ($i=0; $i < $n; $i++)
			{

				$str_exp = explode("|", $massiv[$i]);

				if ($str_exp[6]!="")
				{
					echo "<tr><td $str_exp[6] $td>$str_exp[0]</td><td $str_exp[6] $td>$str_exp[1]</td><td $str_exp[6] $td>$str_exp[2]</td><td $str_exp[6] $td>$str_exp[3]</td><td $str_exp[6] $td>$str_exp[4]</td><td $str_exp[6] $td>$str_exp[5]</td></tr>";
				 };

			
			};
			echo "</table>";
		  //}
	// end ����� �� �����
	};
};


?>