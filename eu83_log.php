<?php
ini_set('display_errors',0);
Error_Reporting(E_ALL & ~E_NOTICE);
 
 
 //пишем лог-файл изменения события
		
		// echo "!- logtime = $logtime -!";
                $log =  fopen ("./eu83/eu83log$ech.$mes.$year.csv","a");
                if(!$log){
                    echo("Ошибка открытия файла eu83log$ech.$mes.$year.csv при добавлении записи!");
                    exit;
                }else{
					if (flock($log, LOCK_EX)) { // выполняем эксклюзивную блокировку
						$datetime = date("d.m.Y Время H:i:s");
						fputs ($log, $datetime);
		                fputs ($log, "\n ip: $ip  ФИО: $fiov \n");
		                fputs ($log, "--- Изменено событие:\n");
		                fputs ($log, "$forlog1\n");
		                fputs ($log, "--- После изменения: \n");
		                fputs ($log, "$forlog2\n");
					}else{
						echo "Не удалось получить блокировку !";
					}
					flock($log, LOCK_UN);
				}
                fclose ($log); //окончание записи лог-файла...




?>