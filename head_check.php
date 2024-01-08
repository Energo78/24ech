<?php

//	здесь выделил голову head.html для разделения шапки от контроля юзера

	//1. запрос и проверка куки - если есть сохраняем эч и цех
	$server = $_SERVER["HTTP_HOST"];
	$id_pc = $_SERVER["DOCUMENT_ROOT"];
	
	
	include("$id_pc/ipv.php");

	if ($ech=="" or $di==""){
		include("$id_pc/ip.php");
	}

	if($echv ==""){
		if ($ech=="" or $di==""){
			include "$id_pc/login.html";
			exit;
		}
	}
	
	include "$id_pc/config.php";

	include "$id_pc/ceha.php";
	
	if ($ip ==""){
		$ip = $_SERVER["REMOTE_ADDR"];
	}
	
	include "$id_pc/log_main.php"; //главный общий лог сайта


?>