<?php 

function getFilesInDir($section)
{
	$files = array();
		if($handle = opendir("xml/".$section))
		{
			while(false !== ($file = readdir($handle)))
			{
				if($file != '.' && $file != '..')
				{
					$files[filemtime("xml/".$section.'/'.$file)] = $file;
				}
			}
			closedir($handle);
			krsort($files);
			$mf = end($files);
		}
		$sortedFiles = array();
		$i=0;
		foreach($files as $file)
		{
			$sortedFiles[$i]=$file;
			$i++;
		}
		return $sortedFiles;
}
?>