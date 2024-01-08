<?php
//Заменяем названия
if ($ceh==""){
	$ceh=$cehrus;
	$ceh=str_replace("ЭЧК-","echk",$ceh);
	$ceh=str_replace("ЭЧЭ-","eche",$ceh);
	$ceh=str_replace("ЭЧЦ-","echc",$ceh);
	$ceh=str_replace("ЭЧС-","echs",$ceh);
	$ceh=str_replace("РРУ","echr",$ceh);
	$ceh=str_replace("ПТО","echp",$ceh);
	$ceh=str_replace("АУР","echa",$ceh);
	$ceh=str_replace("ЭЧМ","echm",$ceh);
	$ceh=str_replace("НТЭЛ","ntel",$ceh);
};
if ($cehrus =="" or $inotchet == 1){
	$cehrus=$ceh;
	$cehrus=str_replace("echk","ЭЧК-",$cehrus);
	$cehrus=str_replace("eche","ЭЧЭ-",$cehrus);
	$cehrus=str_replace("echc","ЭЧЦ-",$cehrus);
	$cehrus=str_replace("echs","ЭЧС-",$cehrus);
	$cehrus=str_replace("echr","РРУ",$cehrus);
	$cehrus=str_replace("echp","ПТО",$cehrus);
	$cehrus=str_replace("echa","АУР",$cehrus);
	$cehrus=str_replace("echm","ЭЧМ",$cehrus);
	$cehrus=str_replace("echd","ЭТИ",$cehrus);
	$cehrus=str_replace("ntel","НТЭЛ",$cehrus);
};



$echrus=str_replace("ech","ЭЧ-",$ech);

	
?>