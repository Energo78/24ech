<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

include "head.html";

//�������� ����
         $date1=$_POST["Date2"];
         if ($date1=="")
        {
        echo "�� �� ������� ����!";
        exit;
        };
        //--------------------

        $dir = "./data/$date1";
//++++++++++++++++++++++++++++++++ �������� ������:
$n=0;
$dir = opendir ("./data/$date1");
  while ( $file = readdir ($dir))
  {
    if (( $file != ".") && ($file != ".."))
    {

        $fils[] = $file;
        $n=$n+1;
  }
  };
        closedir ($dir);
        $n2=$n-1;
        //$n=0;
// +++++++++++++++++++++ ������ $fils[]  - �������� ������ � ������
        sort ($fils);

        // ���������
        for($i=0; $i < count($fils); $i++)
        {
$file = fopen("./data/$date1/$fils[$i]","r");
  if(!file)
    {
      echo("������ �������� �����");
    }
                $strip[$i] = fgets ($file);

 fclose ($file);
 };


 //���������� �� ���  $tok - ����� ����� ���

for ($i=0; $i < $n; $i++)
{
        $tok = strtok ($strip[$i],"|");
        $tok2 = $strip[$i];
        $strip2[$i][$tok] = $strip[$i];
//        echo ($strip2[$i][$tok]);
        //echo "<br>";
};
 //++++++++++++++++++++++!!!!!!!!!!!!!!!

 echo "<table align=center border=1>
<tr align=left><td></td>
        <td>$date1 ������������ ��-3 ���������������  ����� �� ������� ���������� � ���������� ����:<br><br>";

 //++++++++++++++++++++++������� ������:

 for ($p=8; $p <= 31; $p++)
{
if ($p==8){$dsp = "�����";};
if ($p==9){$dsp = "���";};
if ($p==10){$dsp = "�����";};
if ($p==11){$dsp = "���������";};
if ($p==12){$dsp = "���";};
if ($p==13){$dsp = "���������";};
if ($p==14){$dsp = "�����";};
if ($p==15){$dsp = "����������";};
if ($p==16){$dsp = "��������";};
if ($p==30){$dsp = "�����";};
if ($p==31){$dsp = "�������";};


 for($i=0; $i < count($strip); $i++)
 {
 if ($strip2[$i][$p]=="")
 {}
 else
 {
        //$otmena = substr_count($strip2[$i][$p],"������");

        $str_exp = explode("|", $strip2[$i][$p]);
                if($str_exp[2]!="")//otseivaem otmeny
                {
                        echo "���-$str_exp[0] � $str_exp[2] �� $str_exp[3]<br>";
                        echo "�� ��������: $str_exp[1]<br>";
                        echo "$str_exp[5]<br>";
                        echo "��� $dsp ��������� $str_exp[6] �� ����.<br>";
                        echo "������������� �� ������������ �������� � $str_exp[7]<br><br>";
                        //��� �������:
                        $echk[] = $str_exp[0];
                        $dsp_m[] = $dsp;
                };

 };};};

echo "<br>��� �_";
        for($i=0; $i < count($echk); $i++)
        {
                echo "$echk[$i], ";
        };
echo "<br>���: ";
        for($i=0; $i < count($dsp_m); $i++)
        {
                echo "$dsp_m[$i], ";
        };
echo "</td></tr></table>";
echo "</body></HTML>";







 ?>