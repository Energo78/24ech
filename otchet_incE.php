<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
set_time_limit(60);
include "config.php";

        //{Shapka table!
        echo "<html>
                <head>
                <meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
                <title>����� $ech �� ������ �� �����</title>
                </head>
                <body>
                <table $tab2><tr $tr><td $td>����</td><td $td>����� ��������</td><td $td>��(�����)</td><td $td>����� ������������</td><td $td>��(�����)</td><td $td>����� ����������</td><td $td>��(�����)</td><td $td>������� ����������������� ����</td><td $td>�������� ��� ������������</td><td $td>����� ���</td><td $td>����� ���
				</td><td $td>���-�� ���������
				</td><td $td>���-�� ������� �����
				</td><td $td>����� �� ���
				</td><td $td>����� �� ���, ���
				</td><td $td>����� �� ���
				</td><td $td>����� � ���
				</td><td $td>����� �� �� ��, ��, ���
				</td><td $td>��e�� ����� ��� U
				</td><td $td>��(�����)
				</td><td $td>������ �� ������������
				</td><td $td>������ � ������� ���.�����.
				</td><td $td>�������:
				</td><td $td>��������:
				</td><td $td>��������� �����. ����� (��.):
				</td><td $td>������ ���� (��.):
				</td><td $td>�������� ���������:
				</td><td $td>��������� ���������:
				</td><td $td>���������� ����������� ������:
				</td><td $td>������������������ ����������:
				</td><td $td>��������� ��������� (��������):
				</td><td $td>���-��:
				</td><td $td>���:
				</td><td $td>��:
				</td><td $td>���:
				</td><td $td>���:
				</td><td $td>������ �����������:
				</td><td $td>����������� ����:
				</td><td $td>������ ����������:</td></tr>";

        //����  //������� ���� !
              $mesyac=$_POST["mesyac"];
                if ($mesyac=="")
                {
                        $mesyac = date(m);
                };
                $year = $_POST["year"];
				if ($year=="")
                {
                        $year = date(Y);
                };

                for ($c=1; $c < 32; $c++)
				{
					//�������� ������� @ ����������
                 unset($fils, $str_exp, $maswork, $filsr, $strip, $strip2, $stripr, $stripr2, $stripr3, $filsr2, $filsr3, $dir, $n, $file, $n2, $i, $nar_U, $timeU, $tameU, $nar_P, $nar_E, $nar_U, $n_otrab, $prov_exp, $obnaruz_zam, $obhodov, $obezdov, $obesp_SMP, $obesp_proch, $obespPC_PMS, $obespEMP, $obespSHCH, $obespRCS, $obespRCS, $obhod, $obezd, $obezdVIKS, $otmeny, $otmena, $otk_dnc, $otk_dnc2, $otk_echk, $otk_echk2, $otkaz, $o, $ustr_zam, $sovm, $sovm_arr, $s, $str2, $sovm_okno, $str_mesto, $str_rab, $prov_exp, $prov_viks, $prov_eksp, $p, $file2, $nar_SH, $nar_RCS, $rasp_sum, $stripr, $str2, $str_mesto, $str_rab, $n_splan_okn, $n_proch, $n_proch2, $zak_okn, $time_zak_okn, $timea, $timeb, $eche, $rem_zz, $rab_VL, $perehod, $z, $podU, $v_okno, $rabot_po_nar, $giv_url, $tok, $timeU, $time6, $time61, $time1, $time11, $time22, $time33, $time7, $time71, $time72, $time_Sredne,$plan_H, $plan_H2, $plan_time, $plan_time2, $timeb1);
					   settype($c,string);
					   $c = str_pad($c, 2, "0", STR_PAD_LEFT);
					   $date1 = "$c.$mesyac.$year";
					   settype($year,integer);
					   settype($mesyac,integer);
					   if ($year > 2015){
							
								settype($year,string);
								settype($mesyac,string);
								$mesyac = str_pad($mesyac, 2, "0", STR_PAD_LEFT);
								$otchet2016 = 1;
								include("otchet_04.php");
							
					   }else{
							settype($year,string);
							settype($mesyac,string);
							$mesyac = str_pad($mesyac, 2, "0", STR_PAD_LEFT);
							include "otchet_05.php";//������ ����� �� ������� (date-R)
							include("otchet_04.php");
					   };
					   // include("");
					   settype($c,integer);
                };



/*$xls = new COM("Excel.Application"); // ������� ����� COM-������
$xls->Application->Visible = 1;      // ���������� ��� ������������
$xls->Workbooks->Add();              // ��������� ����� ��������

$rangeValue = $xls->Range("A1");
$rangeValue->Value = "� ���������� ����� ����� ����� ������, ������������, ���������";
$rangeValue = $xls->Range("A2");
$rangeValue->Value = "����� ����� ����� ������ 12";
$rangeValue = $xls->Range("A3");
$rangeValue->Value = "��� ������ - Times New Roman";

$range=$xls->Range("A1:J10");               // ���������� ������� �����
$range->Select();                           // �������� ��
$fontRange=$xls->Selection();               // ����������� ���������� ���������� �������

// ����� ������ ��������� �������������� ������ � ���������� �������
$fontRange->Font->Bold = true;              // ������
$fontRange->Font->Italic = true;            // ������
$fontRange->Font->Underline = true;         // ������������
$fontRange->Font->Name = "Times New Roman"; // ��� ������
$fontRange->Font->Size = 12;                // ������ ������*/



echo "</table></body></HTML>";



 ?>