<?php 
include 'opendir.php';

function parseAndRenderXML($index,$section)
	{

		$sortedFiles = getFilesInDir($section);
		$xmlString = file_get_contents("xml/".$section.'/'.$sortedFiles[$index]);
		$xml = new SimpleXMLElement($xmlString);
		if($xml===FALSE)
		{
			echo "<h1>Welcome!</h1>";
		}
		else
		{
			$b = html_entity_decode($xml->body);
			$t = $xml->title;
			$a = $xml->author;
			$p = $xml->publishdate;
			$ref = html_entity_decode($xml->references);
			$size = sizeof($ref);
			if($size > 1)
			{
				$htmlFormatted='<h1>'.$t.'<br/><small>By '.$a.'</small></h1>'.'<div><p><em>'.$p.'</em></p></div><div>'.$b.'</div><div><h4>References:</h4><ul><li>'.$ref.'</li></ul></div>';
			}
			else
			{
				$htmlFormatted='<h1>'.$t.'<br/><small>By '.$a.'</small></h1>'.'<div><p><em>'.$p.'</em></p></div><div>'.$b.'</div>';
			}
			return $htmlFormatted;
		}

	}

echo parseAndRenderXML($_GET['index'],$_GET['section']);

?>