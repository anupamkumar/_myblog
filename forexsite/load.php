<?php 
$myFile = "stockdata/book1.csv";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);
$lines = explode("\n",$theData);
$seloptions = "";
foreach ($lines as $key => $value) {
	$tokens = explode(",",$value);	
	$seloptions=$seloptions."<option value=".$tokens[4].">".$tokens[3]."</option>";
}
echo $seloptions;