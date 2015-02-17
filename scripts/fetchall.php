<?php
#read the reference lookup csv file containing country name, iso country code, capital, currency, currency code
$myFile = "stockdata/book1.csv";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);
$lines = explode("\n",$theData);

#get unique currency codes into array $curcodes
$curcodes = array();
$cccodes = array();
foreach ($lines as $key => $value) {
	$tokens = explode(",",$value);
	if(!in_array($tokens[4],$curcodes)) {
		array_push($curcodes, $tokens[4]);
	}
}

#prepare to start fetching, create the directory where the data will be stored
date_default_timezone_set('Etc/Universal');
$dir="stockdata/fetched/".date("Y_m_d__H",time());
mkdir($dir,"0700",true);

#begin fetching
for($i=0;$i<count($curcodes);$i++) {
	$pairs="";	
	for($j=0;$j<count($curcodes);$j++) {
		#make currency pairs from $curcodes to send to yahoo finance api and recieve their exchange rates eg: for exchange rate of 1 USD to 1 EUR - USDEUR - is the yql pairID	
		if($j==$i)
			continue;
		$pairs = $pairs.trim($curcodes[$i]).trim($curcodes[$j]).",";

	}
	$pairs = rtrim($pairs, ",");
	
	#fetching all exchange rates for $curcodes[$i] currency vs all other currencies via YQL eg YQL: select...where pair = 'USDEUR,USDPHP'
	$data = file_get_contents("http://query.yahooapis.com/v1/public/yql?q=".rawurlencode("SELECT * FROM yahoo.finance.xchange WHERE pair=\"".$pairs."\"")."&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=");
	
	#save result to file with the base name
	$myFile = $dir."/".trim($curcodes[$i]).".txt";
	echo "fetching pairs for currency ".$curcodes[$i]."\n";
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $data);
	fclose($fh);
}
echo "\nDone all\n";
?>