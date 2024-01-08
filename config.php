<?php
if($ech =="ntel"){
	
}else{
	$conf = "$id_pc/config$ech.csv";
	
	if (file_exists($conf)){
        $config =  file ("$conf");
		$peregons = $config[3];
		$kontr_punct = $config[4];
		$stancii = $config[5];
    }
	
	$tab = "x:str border='0' cellpadding='3' align = 'center' cellspacing='0' style='border-collapse: collapse;text-align: center'";
	$td = "style='border: 1px solid #000000; vertical-align: top;'";
	$td2 = "style='border: 1px solid #000000; text-align: left; vertical-align: justify'";	
	

	
}

$tab2 = "x:str border='0' cellpadding='3' align = 'center' cellspacing='0' style='border-collapse: collapse;text-align: left'";
$zayavka0 = "";
















?>