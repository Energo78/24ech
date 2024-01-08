<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);

//содержание
//1. запрос и проверка куки - если есть сохраняем собств.эч и собств.цех 
//2. провека на ЭЧЦ
//3. получаем логин/пароль из post
//	3.1. запрос к БД логин/паролей
//	3.2. проверка совпадения
//		3.2.1. если есть - сохраняем эч и цех





//1. запрос и проверка куки - если есть сохраняем эч и цех
	$div = ($_COOKIE[div]);
	$echv = ($_COOKIE[echv]);
	$cehv = ($_COOKIE[cehv]);
	$fiov = ($_COOKIE[fiov]);
	$role = ($_COOKIE[role]);
	$ipv = $_SERVER["REMOTE_ADDR"];

	
		if($echv =="nte" or $cehv =="del"){
			$rukovoditel=1;
			if($cehv =="del"){
				$viks_pravo_udaleniya = 1;
			}else{
				unset($viks_pravo_udaleniya);
			}
		}else{
			unset($rukovoditel);
		}
	$login =  $_POST['login'];
	$passw =  $_POST['passw'];
	
	if($echv !="nte" ){
		$ech = $echv;
	}
		$ech2v = ($_COOKIE[ech]);
		if($ech2v !=""){
			$ech = $ech2v;
		}
		if($ech =="" and $cehv=="nte"){
			$ech="ech01";
		}
	$di = $div;
	$clearcookies =  $_POST['clearcookies'];
	
	if ($clearcookies=="on"){
		setcookie("echv", ""); setcookie("div", "");
		setcookie("ech", ""); setcookie("cehv", "");
		setcookie("ipv", ""); setcookie("fiov", "");
		setcookie("role", "");
		unset ($ech, $di, $rukovoditel, $fiov, $role, $echv);
	}
	//echo "clearcookies = $clearcookies  <br>";
	
	// echo"<br>ЭЧv = $echv, Цех = $cehv, Логин: $login Пароль:$passw";



//2. провека на ЭЧЦ

$ipechc = "127.0.0.1 10.43.128.106 10.43.128.107 10.43.132.243 10.43.128.37 10.43.161.235 10.43.161.211 10.43.161.230 10.43.161.231 10.43.161.224";//ip ЭЧЦ (всех)
	settype($ipv,string);
	$sovp_echc = substr_count($ipechc, $ipv);






//3. получаем логин/пароль из post
	if($login!=""){
		//	3.1. запрос к БД логин/паролей
		$userbd =  file ("userbd.csv");
//3.2. проверка совпадения
		for($i=0; $i < count($userbd); $i++){//пробегаем всех юзеров 
			$sovpad=substr_count($userbd[$i], $login);
			if($sovpad!=""){//3.2.1. если есть совпадение - сохраняем эч и цех
				$user = explode(";", "$userbd[$i]");
				$di = $user[2];
				setcookie("div", "$di", time() + 60000);
				$ech = "$user[3]";
				setcookie("echv", "$ech", time() + 60000);
								
				$ceh = $user[4];
				if($ceh =="nte" or $ceh =="del"){
					$rukovoditel=1;
				}else{
					unset($rukovoditel);
				}
				if($ech =="" and $cehv=="nte"){
					$ech="ech01";
				}
				setcookie("cehv", "$ceh", time() + 60000);
				
				$fiov = $user[5];
				setcookie("fiov", "$fiov", time() + 60000);
				
//				$ipv = $user[6];
//				setcookie("ipv", "$ipv", time() + 60000);
				
				$role = $user[7];
				setcookie("role", "$role", time() + 60000);
				
			}
		}
	}



?>