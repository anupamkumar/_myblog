<?php 


include 'opendir.php';
function getList($index,$style)
{

	$section="lists/";
	$sortedFiles = getFilesInDir('lists');
	$xmlString = file_get_contents("xml/".$section.$sortedFiles[$index]);
	$xml = new SimpleXMLElement($xmlString);
	if($xml===FALSE)
	{
		echo "<h1>Welcome!</h1>";
	}
	else
	{
		$outputHTML='<h2>'.$xml->title.'<br/><small>By '.$xml->author.'</small></h2><em>'.$xml->publishdate.'</em>';
		$tt = $xml->thumbnail_type;
		$h=$xml->thumbnail_h;
		$w=$xml->thumbnail_w;
		if($style=='mediaList')
		{
			
			$i=1;
			foreach($xml->items->item as $item)
			{	
				$name = $item->itemname;
				$rank = $item->rank;
				$th = $item->thumbnail;
				$desc = $item->description;
				$likes=$item->likes;
				$likes=$item->dislikes;
				if($tt == 'Images')
				{
					
					$outputHTML=$outputHTML.'<div class="media"><img src="'.$th.'" class="media-object img-thumbnail pull-left" height="150" width="150"/>';
					$outputHTML=$outputHTML.'<div class="media-body"><h3 class="media-heading">'.$rank.'.&nbsp;'.$name.'</h3>';
					$outputHTML=$outputHTML.'<p>'.$desc.'</p></div></div><hr/>';
				}
				$i++;			
			}
			return $outputHTML;	
		}
		else if($style=='Carousel')
		{
			$c ='<br/><br/><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-local="#list-c">Go FullScreen</button><br/><div id="list-c" class="carousel slide carousel-fit" data-ride="carousel" data-pause="hover" data-wrap="true" data-interval="4000" style="border:2px solid;">';
			$ci='<ol class="carousel-indicators">';
			$cinn = '<div class="carousel-inner" style="background: linear-gradient(to right, black , grey);" >';
			$i=0;
			foreach($xml->items->item as $item)
			{	
				$name = $item->itemname;
				$rank = $item->rank;
				$th = $item->thumbnail;
				$desc = $item->description;
				$likes=$item->likes;
				$likes=$item->dislikes;
				if($tt == 'Images')
				{
					if($i==0)
					{
						$ci=$ci.'<li data-target="#list-c" data-slide-to="'.$i.'" class="active"></li>';
						$cinn = $cinn.'<div class="item active"><img src="'.$th.'" style="height:100%; "/><div class="carousel-caption" align="right"><h3>'.$rank.'.&nbsp;'.$name.'</h3>';
						$cinn = $cinn.'<p>'.$desc.'</p></div></div>';
					}
					else
					{
						$ci=$ci.'<li data-target="#list-c" data-slide-to="'.$i.'"></li>';
						$cinn = $cinn.'<div class="item"><img src="'.$th.'" style="height:100%; "/><div class="carousel-caption" align="right"><h3>'.$rank.'.&nbsp;'.$name.'</h3>';
						$cinn = $cinn.'<p>'.$desc.'</p></div></div>';
					}
					
				}
				$i++;
			}
			$ci=$ci.'</ol>';
			$cinn=$cinn.'</div>';
			$c=$c.$ci.$cinn;
			$c=$c.'<a class="left carousel-control" href="#list-c" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control" href="#list-c" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a></div>';
			$outputHTML=$outputHTML.$c;
			return $outputHTML;
		}
	}
}

echo getList($_GET['index'],$_GET['style']);
?>
