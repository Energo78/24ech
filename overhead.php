<?php
//����� ����� ��� ��������������� ��� ������ ��������

include("$id_pc/ipv.php");//������ � �������� ���� - ���� ���� ��������� �� � ���

	if ($ech=="" or $di==""){
		include("$id_pc/ip.php");//������ ip ��� ������� (���� �������)
	}

	if($echv ==""){
		if ($ech=="" or $di==""){
			include ("$id_pc/login.html");
			exit;
		}
	}
	
	include ("$id_pc/config.php");

	include("$id_pc/ceha.php");
	
	include "$id_pc/log_main.php"; //������� ����� ��� �����







?>