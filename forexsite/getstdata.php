<?php
$bc = $_GET['bc'];
#open file to look up
$myFile = "stockdata/book1.csv";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);
$lines = explode("\n",$theData);
#create ISO country code and currency code map
$cccodes = array();
foreach ($lines as $key => $value) {
	$tokens = explode(",",$value);	
	$cccodes[trim($tokens[1])] = trim($tokens[4]);		
}
$dirs = glob('stockdata/parsed/*' , GLOB_ONLYDIR);
$latestdir = $dirs[count($dirs)-1];
$datafile = $latestdir.'/'.$cccodes[$bc].'.txt';
$fh = fopen($datafile, 'r');
$data = fread($fh, filesize($datafile)); 
fclose($fh);
echo $data;
?>