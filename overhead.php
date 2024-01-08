<?php
//здесь будет код предвыполняемый для каждой страницы

include("$id_pc/ipv.php");//запрос и проверка куки - если есть сохраняем эч и цех

	if ($ech=="" or $di==""){
		include("$id_pc/ip.php");//старые ip без логинов (пора удалять)
	}

	if($echv ==""){
		if ($ech=="" or $di==""){
			include ("$id_pc/login.html");
			exit;
		}
	}
	
	include ("$id_pc/config.php");

	include("$id_pc/ceha.php");
	
	include "$id_pc/log_main.php"; //главный общий лог сайта







?>