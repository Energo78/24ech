<?php

// 2. ------- �����s �� ������� ----------
        $dir = "./data/$date1-R";
        if (file_exists($dir)) 
		{
                //�������� ������ ������ �������� (data)
        $n=0;
        $dir = opendir ("./data/$date1-R");
        while ( $file = readdir ($dir))
        {
                if (( $file != ".") && ($file != ".."))
                {
                        if ($file != "eche.csv")
                        {
                                $filsr[] = $file;
                                $n++;
                        };
                };
        };
        closedir ($dir);

        // ���������� ����� ������
        $n2=$n-1;

//        sort ($filsr);

        for($i=0; $i < count($filsr); $i++)
        {
                $file = fopen("./data/$date1-R/$filsr[$i]","r");
                if(!file)
                {
                 echo("������ �������� �����");
                }
                $stripr[$i] = fgets ($file);//�������� ������ �� �����
                $stripr[$i] = htmlspecialchars($stripr[$i]);
                fclose ($file);
        };


        $stripr = str_replace("b-b","<br>",$stripr);

        //���������� �� ���  � �� �������\�������������(2)
        for ($i=0; $i < $n; $i++)
	{
        $stripr[$i] = str_replace("eche","deletim",$stripr[$i]);
        $maswork = explode("|", $stripr[$i]);
        if ($maswork[12]=="")
        {
                $stripr2[][$maswork[0]]= $stripr[$i];
                $filsr2[] = $filsr[$i];
        }else
        {
            $stripr3[][$maswork[0]] = $stripr[$i];
            $filsr3[] = $filsr[$i];
        };
        //��� ������!
        //pod U
        if ($maswork[14] != "")
        {
                $nar_U = $nar_U + 1;
                $tameU = $tameU +($maswork[5] + $maswork[6]/60) - ($maswork[3] + $maswork[4]/60);
        };
        // obesp PC-PMS
        if ($maswork[15] != "")
        {
                $nar_P = $nar_P + 1;
        };
        // obesp EMP
        if ($maswork[16] != "")
        {
                $nar_E = $nar_E + 1;
        };
        // ��������� ����� ������
        if ($maswork[17] != "")
        {$prov_exp = $prov_exp + $maswork[17];};
        if ($maswork[18] != "")
        {$obnaruz_zam = $obnaruz_zam + $maswork[18];};
        if ($maswork[19] != "")
        {$ustr_zam         = $ustr_zam + $maswork[19];};

        if ($maswork[20] != "")//obesp SHCH
        {
                $nar_SH = $nar_SH + 1;
        };
        if ($maswork[21] != "")//obesp RCS
        {
                $nar_RCS = $nar_RCS + 1;
        };
        if ($maswork[22] != "")//obhod
        {
                $obhodov = $obhodov + 1;
        };
        if ($maswork[23] != "")//obezd
        {
                $obezdov = $obezdov + 1;
        };
        if ($maswork[26] != "")//����������� ����
        {
                $sovm = $sovm + 1;
                $sovm_arr[] = $stripr[$i];
        };
        if ($maswork[27] != "")//��������������� ����������
        {
                $rem_zz = $rem_zz + $maswork[27];
        };
        if ($maswork[28] != "")//�����. ���
        {
                $obesp_SMP = $obesp_SMP + 1;
        };
        if ($maswork[29] != "")//�����. ������
        {
                $obesp_proch = $obesp_proch + 1;
        };
        if ($maswork[24] != "")
        {
                $prov_viks = $prov_viks + $maswork[17];
        }else{
                $prov_eksp = $prov_eksp + $maswork[17];
        };
        if ($maswork[30] != "")// �� �� ��, ��, ���
        {
                $rab_VL = $rab_VL + 1;
        };
};

 // ������� ������ � �������: ����� $i �����

 $z=0;

for ($p=8; $p <= 33; $p++)
{
for($i=0; $i < count($stripr2); $i++)
 {
        if ($stripr2[$i][$p]!="")
        {
                       
                        $str_exp = explode("|", $stripr2[$i][$p]);
                        $str2 = "��� $str_exp[1]";
                        if ($str_exp[14] == "on")
                        {$podU = "<b>������ ��� ����������� </b>";};
                        if ($str_exp[15] == "on")
                        {$obespPC_PMS = "<b>����������� ��-��� </b>";};
                        if ($str_exp[16] == "on")
                        {$obespEMP = "<b>����������� ��� </b>";};
                        if ($str_exp[20] == "on")
                        {$obespSHCH = "<b>����������� �� </b>";};
                        if ($str_exp[21] == "on")
                        {$obespRCS = "<b>����������� ��� </b>";};
                        if ($str_exp[22] == "on")
                        {$obhod = "<b>�����</b>";};
                        if ($str_exp[23] == "on")
                        {$obezd = "<b>������ � ��������</b>";};
                        if ($str_exp[24] == "on")
                        {$obezdVIKS = "<b>������ � ����</b>";};
                        if ($str_exp[25] == "on")
                        {$v_okno = "<b>� ����</b><br>";};
                        if ($str_exp[26] == "on")
                        {$sovm_okno = "<b>����������� ����</b><br>";};
                        if ($str_exp[17] != "")
                        {$str_exp[17] = "<br>��������� �����. �����: $str_exp[17] ��.";};
                        if ($str_exp[18] != "")
                        {$str_exp[18] = "<br>�������� ���������: $str_exp[18] ��.";};
                        if ($str_exp[19] != "")
                        {$str_exp[19] = "<br>��������� ���������: $str_exp[19] ��.";};
                        if ($str_exp[27] != "")
                        {$str_exp[27] = "<br>��������������� ����������: $str_exp[27] ��.";};

                        $str_mesto = "$str_exp[7] $str_exp[8]<br>$str_exp[9] $str_exp[10]<br>$str_exp[13]";
          
                $podU=""; $obespPC_PMS=""; $obespEMP=""; $obespRCS=""; $obespSHCH="";
                $obhod=""; $obezd=""; $obezdVIKS=""; $v_okno=""; $sovm_okno="";

                 };
 };
 };// ����� ������� ����� �� �������
};


//��� ������:
$rabot_po_nar = $i;


 for ($p=8; $p <= 33; $p++)
{

 for($i=0; $i < count($stripr3); $i++)
 {
         if ($stripr3[$i][$p]=="")
         {}
         else
         {
        $str_exp = explode("|", $stripr3[$i][$p]);
        $str2 = "����.� $str_exp[12]";

        if ($str_exp[14] == "on")
        {$podU = "<b>������ ��� ����������� </b>";};
        if ($str_exp[15] == "on")
        {$obespPC_PMS = "<b>����������� ��-��� </b>";};
        if ($str_exp[16] == "on")
        {$obespEMP = "<b>����������� ��� </b>";};
        if ($str_exp[20] == "on")
        {$obespSHCH = "<b>����������� �� </b>";};
        if ($str_exp[21] == "on")
        {$obespRCS = "<b>����������� ��� </b>";};
        if ($str_exp[22] == "on")
        {$obhod = "<b>�����</b>";};
        if ($str_exp[23] == "on")
        {$obezd = "<b>������ � ��������</b>";};
        if ($str_exp[24] == "on")
        {$obezdVIKS = "<b>������ � ����</b>";};
        if ($str_exp[25] == "on")
        {$v_okno = "<b>� ����</b><br>";};
        if ($str_exp[26] == "on")
        {$sovm_okno = "<b>����������� ����</b><br>";};
        if ($str_exp[17] != "")
        {$str_exp[17] = "<br>��������� �����. �����: $str_exp[17] ��.";};
        if ($str_exp[18] != "")
        {$str_exp[18] = "<br>�������� ���������: $str_exp[18] ��.";};
        if ($str_exp[19] != "")
        {$str_exp[19] = "<br>��������� ���������: $str_exp[19] ��.";};
        if ($str_exp[27] != "")
        {$str_exp[27] = "<br>��������������� ����������: $str_exp[27] ��.";};

        $str_mesto = "$str_exp[7] $str_exp[8]<br>$str_exp[9] $str_exp[10]<br>$str_exp[13]";

                unset ($podU, $obespPC_PMS, $obespEMP, $obespRCS, $obespSHCH, $obhod, $obezd, $obezdVIKS, $v_okno, $sovm_okno);

         };
 };
 };
        //{ ��������� ������ �� �����������\����������� ������\��������\�����������
                $file = "./data/$date1-R/eche.csv";
                if (is_file($file))
                {
                        $file2 = fopen("./data/$date1-R/eche.csv","a+");
                        $eche = fgets ($file2);
                        $str_rab = explode("|", $eche);
                        fclose ($file2);
                };
                $rab_eche = $str_rab[1]+$str_rab[2]; 
                $prov_brig = $str_rab[3]+$str_rab[4];
                $sobran = $str_rab[5]+$str_rab[6];
                $instr = $str_rab[7]+$str_rab[8];
        //}x

$rasp_sum = $i; //�����-�� ����� �� �������������

$prov_exp = $prov_exp - $prov_viks;
                $n_proch = $rabot_po_nar + $rasp_sum - $rab_VL - $nar_U - $obhodov - $obezdov - $nar_P - $nar_E - $nar_SH - $nar_RCS - $obesp_SMP - $obesp_proch;
                $n_proch2 = "$rabot_po_nar + $rasp_sum - $rab_VL - $nar_U - $obhodov - $obezdov - $nar_P - $nar_E - $nar_SH - $nar_RCS - $obesp_SMP - $obesp_proch";
        //echo "! -- $n_proch2 -- !";
        if ($n_proch < 0)
        {
          $n_proch = 0;
        };


?>