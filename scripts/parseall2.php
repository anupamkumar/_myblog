<?php

#read the reference lookup csv file containing country name, iso country code, capital, currency, currency code
$myFile = "stockdata/book1.csv";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);
$lines = explode("\n",$theData);

#create ISO country code and currency code map
$cccodes = array();
$cc = array();
foreach ($lines as $key => $value) {
	$tokens = explode(",",$value);	
	$cccodes[trim($tokens[1])] = trim($tokens[4]);	
	$cc[trim($tokens[4])] = trim($tokens[3]);
}

print_r(array_keys($cccodes,"USD"));

#prepare to start parsing, create the directory where the data will be stored
date_default_timezone_set('Etc/Universal');
$dir="stockdata/parsed/".date("Y_m_d__H",time());
mkdir($dir,"0700",true);

#parse
foreach ($cccodes as $countrycode => $currencycode) {	
	echo "Parsing File ".$currencycode."\t";
	$fetchedFile = "stockdata/fetched/".date("Y_m_d__H",time())."/".($currencycode).".txt";
	$fh = fopen($fetchedFile, 'r');
	$data = fread($fh, filesize($fetchedFile)); 
	fclose($fh);
	$jsonObj = json_decode($data, true);
	$rates = $jsonObj["query"]["results"]["rate"];
	$parsedFile = "stockdata/parsed/".date("Y_m_d__H",time())."/".($currencycode).".txt";
	$fh = fopen($parsedFile, 'w');
	fwrite($fh,"{ \"base\":\"".$cc[$currencycode]."\",");
	$ratestr="\"rates\":{";
	$askstr="\"ask\":{";
	$bidstr="\"bid\":{";
	$cnamestr="\"cname\":{";
	for($i=0;$i<count($rates);$i++) {
		$othercc= substr($rates[$i]["id"], 3);
		$isocodes = array_keys($cccodes,$othercc);
		if(count($isocodes)>1) {
			if($i == count($rates)-1) {
				for($j=0;$j<count($isocodes);$j++) {
					if($j == count($isocodes)-1) {
						if($rates[$i]["Rate"] != "N/A") 
							$ratestr = $ratestr."\"".$isocodes[$j]."\":".$rates[$i]["Rate"]."}";
						else
							$ratestr = $ratestr."\"".$isocodes[$j]."\":0}";
						if($rates[$i]["Ask"] != "N/A") 
							$askstr = $askstr."\"".$isocodes[$j]."\":".$rates[$i]["Ask"]."}";
						else 
							$askstr = $askstr."\"".$isocodes[$j]."\":0}";
						if($rates[$i]["Bid"] != "N/A") 
							$bidstr = $bidstr."\"".$isocodes[$j]."\":".$rates[$i]["Bid"]."}";
						else
							$bidstr = $bidstr."\"".$isocodes[$j]."\":0}";						
						$cnamestr = $cnamestr."\"".$isocodes[$j]."\":\"".$cc[$othercc]."\"}";						
					}
					else {
						if($rates[$i]["Rate"] != "N/A") 
							$ratestr = $ratestr."\"".$isocodes[$j]."\":".$rates[$i]["Rate"].",";
						else
							$ratestr = $ratestr."\"".$isocodes[$j]."\":0,";
						if($rates[$i]["Ask"] != "N/A") 
							$askstr = $askstr."\"".$isocodes[$j]."\":".$rates[$i]["Ask"].",";
						else 
							$askstr = $askstr."\"".$isocodes[$j]."\":0,";
						if($rates[$i]["Bid"] != "N/A") 
							$bidstr = $bidstr."\"".$isocodes[$j]."\":".$rates[$i]["Bid"].",";
						else
							$bidstr = $bidstr."\"".$isocodes[$j]."\":0,";						
						$cnamestr = $cnamestr."\"".$isocodes[$j]."\":\"".$cc[$othercc]."\",";		
					}
				}
			}
			else {
				for($j=0;$j<count($isocodes);$j++) {
					if($rates[$i]["Rate"] != "N/A") 
							$ratestr = $ratestr."\"".$isocodes[$j]."\":".$rates[$i]["Rate"].",";
					else
						$ratestr = $ratestr."\"".$isocodes[$j]."\":0,";
					if($rates[$i]["Ask"] != "N/A") 
						$askstr = $askstr."\"".$isocodes[$j]."\":".$rates[$i]["Ask"].",";
					else 
						$askstr = $askstr."\"".$isocodes[$j]."\":0,";
					if($rates[$i]["Bid"] != "N/A") 
						$bidstr = $bidstr."\"".$isocodes[$j]."\":".$rates[$i]["Bid"].",";
					else
						$bidstr = $bidstr."\"".$isocodes[$j]."\":0,";						
					$cnamestr = $cnamestr."\"".$isocodes[$j]."\":\"".$cc[$othercc]."\",";		
				}
			}
			continue;
		}
		if($i == count($rates)-1) {
			if($rates[$i]["Rate"] != "N/A") 
				$ratestr = $ratestr."\"".$isocodes[0]."\":".$rates[$i]["Rate"]."}";
			else
				$ratestr = $ratestr."\"".$isocodes[0]."\":0}";
			if($rates[$i]["Ask"] != "N/A") 
				$askstr = $askstr."\"".$isocodes[0]."\":".$rates[$i]["Ask"]."}";
			else 
				$askstr = $askstr."\"".$isocodes[0]."\":0}";
			if($rates[$i]["Bid"] != "N/A") 
				$bidstr = $bidstr."\"".$isocodes[0]."\":".$rates[$i]["Bid"]."}";
			else
				$bidstr = $bidstr."\"".$isocodes[0]."\":0}";						
			$cnamestr = $cnamestr."\"".$isocodes[0]."\":\"".$cc[$othercc]."\"}";		
		}
		else {
			if($rates[$i]["Rate"] != "N/A") 
				$ratestr = $ratestr."\"".$isocodes[0]."\":".$rates[$i]["Rate"].",";
			else
				$ratestr = $ratestr."\"".$isocodes[0]."\":0,";
			if($rates[$i]["Ask"] != "N/A") 
				$askstr = $askstr."\"".$isocodes[0]."\":".$rates[$i]["Ask"].",";
			else 
				$askstr = $askstr."\"".$isocodes[0]."\":0,";
			if($rates[$i]["Bid"] != "N/A") 
				$bidstr = $bidstr."\"".$isocodes[0]."\":".$rates[$i]["Bid"].",";
			else
				$bidstr = $bidstr."\"".$isocodes[0]."\":0,";						
			$cnamestr = $cnamestr."\"".$isocodes[0]."\":\"".$cc[$othercc]."\",";	
		}
	}
	fwrite($fh,$ratestr.",".$askstr.",".$bidstr.",".$cnamestr);
	fwrite($fh,"}");
	fclose($fh);
	echo 'done'."\n";
}
