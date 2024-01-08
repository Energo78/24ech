<?php
ini_set('display_errors',1);
Error_Reporting(E_ALL & ~E_NOTICE);
set_time_limit(60);
include "config.php";

        //{Shapka table!
        echo "<html>
                <head>
                <meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
                <title>Отчёт $ech по работе за месяц</title>
                </head>
                <body>
                <table $tab2><tr $tr><td $td>Дата</td><td $td>Всего заказано</td><td $td>На(часов)</td><td $td>Всего спланировано</td><td $td>На(часов)</td><td $td>Всего отработано</td><td $td>На(часов)</td><td $td>Средняя продолжительность окна</td><td $td>Отказано при планировании</td><td $td>Отказ ДНЦ</td><td $td>Отказ ЭЧК
				</td><td $td>Кол-во персонала
				</td><td $td>Кол-во учтённых работ
				</td><td $td>Работ на ЭЧК
				</td><td $td>Работ на ЭЧЭ, ПСК
				</td><td $td>Работ на ЭЧС
				</td><td $td>Работ в РРУ
				</td><td $td>Работ на ВЛ АБ, ПЭ, ДПР
				</td><td $td>Всeго работ под U
				</td><td $td>На(часов)
				</td><td $td>Работы по распоряжению
				</td><td $td>Работы в порядке тек.экспл.
				</td><td $td>обходов:
				</td><td $td>объездов:
				</td><td $td>Проверено экспл. длины (км.):
				</td><td $td>Объезд ВИКС (км.):
				</td><td $td>Выявлено замечаний:
				</td><td $td>Устранено замечаний:
				</td><td $td>Количество проверенных бригад:
				</td><td $td>Проинструктировано работников:
				</td><td $td>Проведено совещаний (собраний):
				</td><td $td>ПМС-ПЧ:
				</td><td $td>ЭМП:
				</td><td $td>ШЧ:
				</td><td $td>РЦС:
				</td><td $td>СМП:
				</td><td $td>прочих обеспечений:
				</td><td $td>совмещённых окон:
				</td><td $td>Ремонт заземлений:</td></tr>";

        //дата  //БОЛЬШОЙ ЦИКЛ !
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
					//Обнуляем массивы @ переменные
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
							include "otchet_05.php";//старый отчёт по работам (date-R)
							include("otchet_04.php");
					   };
					   // include("");
					   settype($c,integer);
                };



/*$xls = new COM("Excel.Application"); // Создаем новый COM-объект
$xls->Application->Visible = 1;      // Заставляем его отобразиться
$xls->Workbooks->Add();              // Добавляем новый документ

$rangeValue = $xls->Range("A1");
$rangeValue->Value = "В выделенном блоке текст будет жирный, подчеркнутый, наклонный";
$rangeValue = $xls->Range("A2");
$rangeValue->Value = "Шрифт будет иметь высоту 12";
$rangeValue = $xls->Range("A3");
$rangeValue->Value = "Имя шрифта - Times New Roman";

$range=$xls->Range("A1:J10");               // Определяем область ячеек
$range->Select();                           // Выделяем ее
$fontRange=$xls->Selection();               // Присваиваем переменной выделенную область

// Далее задаем параметры форматирования текста в выделенной области
$fontRange->Font->Bold = true;              // Жирный
$fontRange->Font->Italic = true;            // Курсив
$fontRange->Font->Underline = true;         // Подчеркнутый
$fontRange->Font->Name = "Times New Roman"; // Имя шрифта
$fontRange->Font->Size = 12;                // Размер шрифта*/



echo "</table></body></HTML>";



 ?>