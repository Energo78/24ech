<?php
include "head_check.php";
	if ($zapretredact == 1){//Запрет редактирования
		echo "У Вас нет доступа к редактированию. Обратитесь по адресу di-PlyaskinEV@nrr.rzd";
		exit;
	};

	//получаем дату и имя файла
        $date=$_POST['date'];
        $redactf=$_POST['redactf'];
		$filename=$_POST['filename'];
		$ip = $_SERVER["REMOTE_ADDR"];


	//УДАЛЯЕМ..
//		для старой базы (2011г.)
		/*if ($redactf !=""){
			$file = "./data/$date/$redactf";
			unlink ($file);
			echo "ФАЙЛ $redactf УДАЛЁН!";
		};*/
		
		//для файлов планирования (2015г)
		if ($filename !=""){
			unlink ($filename);
			echo "ФАЙЛ $filename УДАЛЁН!";
		};
	







?>