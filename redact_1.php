<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";
include "config.php";

//�������� ���� � ��� �����
        $date=$_POST['date'];
        $redactf=$_POST['redactf'];

// ���� �������
        $dir = "./data/$date";
        if (file_exists($dir)) {
        }else{
                echo "� ���� ���� ������ �� �������������<br><br><br>";
                exit;
        };

        $file = "./data/$date/$redactf";
        if (file_exists($file))
        {
           // echo "���� ������<br>$redactf<br>";
        };

        chdir("./data/$date");

        $file = fopen("$redactf","r+");
        if(!$file)
        {
                echo("������ �������� �����");
        };

// ������ ������ �� �����
        $strok = fgets ($file);
		$strok = str_replace("b--b","\n",$strok);

// ��������� ������
                $str_exp = explode("|", $strok);

                //�������� ��������
                if ($str_exp[15]=="on")
                {
                        $chek1 = "checked";   //����� ���
                };
                if ($str_exp[17]=="on")
                {
                        $chek2 = "checked";   //����� ��
                };
                if ($str_exp[19]=="on")
                {
                        $chek3 = "checked";  //����������� ���
                };
                if ($str_exp[22]=="on")
                {
                        $chek4 = "checked";   // �����������
                };

				//�������� ������
				if ($str_exp[14]=="")
                {
                        $str_exp[14] = $zayavka0;   // ��������� ������
                };
				$str_exp[14] = str_replace("b--b","\r\n",$str_exp[14]);
//��������� ����� �������
        $time_a = explode("-", $str_exp[7]);
        $time1 = explode(":", $time_a[0]);
        $time2 = explode(":", $time_a[1]);
        $time_b = explode("-", $str_exp[8]);
        $time3 = explode(":", $time_b[0]);
        $time4 = explode(":", $time_b[1]);


// ������� �������-����� ��� ��������������
  // ����� �������:
 echo "<table $tab>
 <tr><td $td>� ���</td><td $td>������</td><td $td>����� ������</td><td $td>����� (����)</td><td $td>����� (����)</td><td $td>�������</td><td $td>������������</td></tr>";
 // �����:
 echo "
 <tr><td $td align=left>
 <form method=post action=change.php>
 <textarea rows=3 name=echknum cols=20>$str_exp[2]</textarea><br>
	<INPUT TYPE=checkbox NAME='otmena1' $chek1> - ����� ���<br>
    <INPUT TYPE=checkbox NAME='otmena2' $chek2> - ����� ���,��,��<br>
    <INPUT TYPE=checkbox NAME='sovmesh' $chek4> - ����������� � ��-���<br>
    <INPUT TYPE=checkbox NAME='emp' $chek3> - ����������� ���<br><br>
	����� �<INPUT type=text name=narnum size=2 value=$str_exp[13]><br>
 </td>
 <td $td>
 ����:<br><textarea rows=8 name=work cols=25>$str_exp[3]</textarea><br>
 ����:<br><textarea rows=8 name=workf cols=25>$str_exp[21]</textarea><br>
 ��������� ���������: <INPUT type=text name=ustr_zam size=3 value=$str_exp[18]>
 </td>
 <td $td><textarea rows=6 name=mesto cols=20>$str_exp[4]</textarea></td>
 <td $td>
 <INPUT type=text name=time11 size=2 value=$time1[0]>:
 <INPUT type=text name=time12 size=2 value=$time1[1]><br><br>
 <INPUT type=text name=time21 size=2 value=$time2[0]>:
 <INPUT type=text name=time22 size=2 value=$time2[1]><br>
 <!--
 <br>�����(���):<br><INPUT type=text name=time6 size=3 value=$str_exp[6]> -->
 </td>
 <td $td>
 <INPUT type=text name=time31 size=2 value=$time3[0]>:
 <INPUT type=text name=time32 size=2 value=$time3[1]><br><br>
 <INPUT type=text name=time41 size=2 value=$time4[0]>:
 <INPUT type=text name=time42 size=2 value=$time4[1]>
 <!--<br><br>
 �����(���):<br><INPUT type=text name=time20 size=3 value=$str_exp[20]> -->
 </td>
 <td $td>
 <textarea rows=3 name=adm cols=15>$str_exp[9]</textarea><br>
 <!--
 ����������:<br>
 <textarea rows=3 name=loco cols=15>$str_exp[10]</textarea>
 -->
 </td>
 <td $td>
<textarea rows=4 name=proizvod cols=25>$str_exp[10]</textarea>
<br>������ ����������:<br><textarea rows=4 name='osob_treb' cols=25>$str_exp[11]</textarea><br>
<br>����������:<br><textarea rows=10 name='primechanie' cols=25>$str_exp[16]</textarea>

</table><br>

<table align=center border=0>
 <tr><td>
 <INPUT TYPE=hidden NAME='date' VALUE='$date'>
 <INPUT TYPE=hidden NAME='redactf' VALUE='$redactf'>
 <INPUT TYPE=submit VALUE='���������'>
 </form>
 </td></tr></table>
 ";

fclose ($file);
chdir("..");









echo "</body></HTML>";
 ?>