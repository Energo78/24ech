<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";
include "ip2.php";
include "config.php";

//�������� ���� � ��� �����
        $date=$_POST['date'];
        $redactf=$_POST['redactf'];

// ���� �������

        $dir = "./data/$date-R";
        if (file_exists($dir)) {
  //  echo "������� ������<br>$date<br>";
} else {
    echo "� ���� ���� ������ �� �������������<br><br><br>";
        exit;
         };

         $file = "./data/$date-R/$redactf";
         if (file_exists($file))
{
  //  echo "���� ������<br>$redactf<br>";
};

chdir("./data/$date-R");

$file = fopen("$redactf","r+");
  if(!$file)
  {
    echo("������ �������� �����");
  }

// ������ ������ �� �����
  $strok = fgets ($file);
//        echo "$strok<br>";

// ��������� ������ �� ������
                $str_exp = explode("|", $strok);
                $str_exp = str_replace("b-b","\r\n",$str_exp);
                $str_exp = str_replace("raq","\"",$str_exp);
 for($i=0; $i < count($str_exp); $i++)
        {
        //        echo "$str_exp[$i]<br>";
        };
        // �������� checbox
        if ($str_exp[14] =="on")
        {$chec_podU = "checked";};
        if ($str_exp[15] =="on")
        {$chec_obespPMS = "checked";};
        if ($str_exp[16] =="on")
        {$chec_obespEMP = "checked";};
        if ($str_exp[20] =="on")
        {$chec_obespSHCH = "checked";};
        if ($str_exp[21] =="on")
        {$chec_obespRCS = "checked";};
        if ($str_exp[22] =="on")
        {$chec_obhod = "checked";};
        if ($str_exp[23] =="on")
        {$chec_obezd = "checked";};
        if ($str_exp[24] =="on")
        {$chec_obezdVIKS = "checked";};
        if ($str_exp[25] =="on")
        {$v_okno = "checked";};
        if ($str_exp[26] =="on")
        {$sovm_okno = "checked";};
        if ($str_exp[28] == "on")
        {$chec_obespSMP = "checked";};
        if ($str_exp[29] == "on")
        {$chec_obespProch = "checked";};
        if ($str_exp[30] == "on")
        {$rab_VL = "checked";};
	
	
                // ������� �������-����� ��� ��������������

                echo
                        "<table $tab><tr $tr>
                        <td $td>$date<br><form method='post' action='dataput_new.php'>
                        ��ʹ<SELECT NAME='w0'><OPTION>$str_exp[0]<OPTION>$ceha</select></span></font><br>
                        �����<INPUT type=text name='w1' size='3' value=$str_exp[1]><br>
                        ���� <INPUT type=text name='w12' size='3' value=$str_exp[12]><br>
                        <p align=left>
                        <INPUT TYPE=checkbox NAME='w25' $v_okno> � ����<br>
                        <INPUT TYPE=checkbox NAME='w26' $sovm_okno> ����.����<br>";
				echo "
                        </td>
                        <td $td>
                        <SELECT NAME='w2'>
                        <OPTION>$str_exp[2]<OPTION>
                        $proizvoditeli</select><br>
                        <p align=left>
                        <INPUT TYPE=checkbox NAME='w14' $chec_podU> - ��� U<br>
                        <INPUT TYPE=checkbox NAME='w30' $rab_VL > - �� �� ��, ��, ���<br>
                        <INPUT TYPE=checkbox NAME='w15' $chec_obespPMS> - ����������� ��-���<br>
                        <INPUT TYPE=checkbox NAME='w16' $chec_obespEMP> - ����������� ���<br>
                        <INPUT TYPE=checkbox NAME='w20' $chec_obespSHCH> - ����������� ��<br>
                        <INPUT TYPE=checkbox NAME='w21' $chec_obespRCS> - ����������� ���<br>
                        <INPUT TYPE=checkbox NAME='w28' $chec_obespSMP> - ����������� ���<br>
                        <INPUT TYPE=checkbox NAME='w29' $chec_obespProch> - ����������� ����.
                        </td>
                        <td $td>
                        <INPUT type=text name='w3' size='2' value=$str_exp[3]>
                        <b>: </b>
                        <INPUT type=text name='w4' size='2' value=$str_exp[4]><br>
                        <INPUT type=text name='w5' size='2' value=$str_exp[5]>
                        <b>: </b>
                        <INPUT type=text name='w6' size='2' value=$str_exp[6]>
                        </td>
                        <td $td>
                        <SELECT NAME='w7'>
                        <OPTION>$str_exp[7]<OPTION>
                        $peregons</select>
                        <INPUT type=text name='w8' size='2' value=$str_exp[8]><br>
                        <SELECT NAME='w9'>
                        <OPTION>$str_exp[9]<OPTION>
                        $stancii</select>
                        <INPUT type=text name='w10' size='2' value=$str_exp[10]><br>
                        <INPUT type=text name='w13' size='23' value='$str_exp[13]'>

                        <p align=left>
                        <INPUT TYPE=checkbox NAME='w22' $chec_obhod> - �����<br>
                        <INPUT TYPE=checkbox NAME='w23' $chec_obezd> - ������<br>
                        <INPUT TYPE=checkbox NAME='w24' $chec_obezdVIKS> - ������ ����
                        </td>
                        <td $td><p align=left>
                        <textarea rows='4' name='w11' cols='30'>$str_exp[11]</textarea><br>
                        <INPUT type=text name='w17' size='2' value=$str_exp[17]> - ��������� ��.����.��.<br>
                        <INPUT type=text name='w18' size='2' value=$str_exp[18]> - �������� ���������<br>
                        <INPUT type=text name='w19' size='2' value=$str_exp[19]> - ��������� ���������<br>
                        <INPUT type=text name='w27' size='2' value=$str_exp[27]> - ��������������� ����������<br>
						�������:<br>
						<textarea rows='4' name='w31' cols='30'>$str_exp[31]</textarea><br>
                        </td>
                        </tr>
                        ";
						echo "<tr $tr><td $td colspan='5' align='left'>��������:<br>";
	//����� �������
	$ceh_person = "$str_exp[0]";
	include "personal.php";

		$ceh_person = "���";
		include "personal.php";

						
						echo "<tr><td colspan=5>
						<INPUT TYPE=hidden NAME='ceh_pers' VALUE='$str_exp[0]'>
                        <INPUT TYPE=hidden NAME='n_ceh_person' VALUE='$n_ceh_person'>
                        <INPUT TYPE=hidden NAME='redactf' VALUE='$redactf'>
                        <INPUT TYPE=hidden NAME='Date3' VALUE='$date'>
                        <INPUT TYPE=submit NAME=button1 VALUE='���������!'></font>
                        </td></tr></form></table>";

/*echo "

<TABLE border=0 align=center width='100%'>
<tr><td colspan='2' align='center'>
<br><u><b><i><font color='#0000FF' size='4'>����� ����� ������:<br><br></font></i></b></u>
</td></tr>
    <form method='post' action='change2.php'>
        <Tr>
                <td width='40%' valign='top'>
      <font size='4'>����:
                <INPUT type=text size=10 name='Date3' value = '$date'>
            &nbsp;<span lang='ru'>&nbsp;&nbsp;&nbsp; ��ʹ
        <SELECT NAME='echknum'>
<OPTION>$str_exp[0]<OPTION>8<OPTION>9<OPTION>10<OPTION>11<OPTION>31<OPTION>12<OPTION>13<OPTION>14<OPTION>15<OPTION>16<OPTION>30</span></font><p></TD>
<td width='60%'>
<font size='4'>
&nbsp;<span lang='ru'>����� � </span>
<INPUT type=text name='narnum' size='3' value=$str_exp[1]><span lang='ru'> ������������ �
        </span>
<INPUT type=text name='raspnum' size='3' value=$str_exp[12]><span lang='ru'>
        </span>
            </font>
<p><font size='4'>
            &nbsp;<span lang='ru'>������������� �����:
<SELECT NAME='proizvod'>
<OPTION>$str_exp[2]$proizvoditeli
        </span>
            </font></select></p>
<p>&nbsp;</TD>
        </tr>
        <tr>
        <td width='100%' colspan='2'>
        <font size='4'>������ ������:&nbsp;&nbsp;
        <INPUT type=text name='time1' size='2' value=$str_exp[3]>
        <b>: </b>
        <INPUT type=text name='time2' size='2' value=$str_exp[4]>
        (���.:���.). ����� ������:&nbsp;&nbsp;
        <INPUT type=text name='time3' size='2' value=$str_exp[5]>
        <b>: </b>
        <INPUT type=text name='time4' size='2' value=$str_exp[6]> (���.���.)</font><p>&nbsp;</TD>
        </tr>
        <tr>
                <td width='40%' valign='top'>
                        <font size='4'>&nbsp; �����
                        ������:<br> <span lang='ru'>
        &nbsp;</span> <span lang='ru'>
        <SELECT NAME='peregon'>
<OPTION>$str_exp[7]$peregons";
echo "
        </span></font></select><span lang='ru'><font size='4'> ����:</font></span><font size='4'>
        <INPUT type=text name='put1' size='2' value=$str_exp[8]><br> <span lang='ru'>
        &nbsp;</span> <span lang='ru'>
        <SELECT NAME='stanc'>
<OPTION>$str_exp[9]<OPTION>$stancii

        </span></font></select><font size='4'> <span lang='ru'>����:</span>
        <INPUT type=text name='put2' size='2' value=$str_exp[10]></font><p>
                        <span lang='ru'><font size='4'>&nbsp; ��� �������: </font></span>
        <font size='4'>
        <textarea rows='2' name='uchastok' cols='35'>$str_exp[13]</textarea>
        </font><p>
                        <font size='4'>
                        <br><br>
                        </font></td>
                <td width='60%' valign='top'>
                        <p>������������ ������:<br><textarea rows='8' name='work' cols='46'>$str_exp[11]</textarea></p>
                        </td>
        </tr>

        <tr>
                <td width='100%' colspan='2'>

                </td>
        </tr>

        <tr>
                <td width='100%' colspan='2'>

                </td>
        </tr>

        <tr>
        <td width='100%' colspan='2'>
        <p align='center'><font size='4'>
        <INPUT TYPE=hidden NAME='redactf' VALUE='$redactf'>
        <INPUT TYPE=submit NAME=button1 VALUE='���������!'></font>
        </form>
        </td>
        </tr>
        </TABLE>
";
*/
fclose ($file);
chdir("..");

echo "</body></HTML>";
 ?>