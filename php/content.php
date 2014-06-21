<?php 
	include 'opendir.php';

	if(isset($_GET['section']))
	{
		$section = $_GET['section'];		
	}
	else 
	{
		$section = 'myhome';
	}

	if($section == 'lists')
	{
		header( 'Location: list.php' );
	}
	else if($section == 'stuff')
	{
		header( 'Location: stuff.php' );
	}
	else if($section == 'about')
	{
		header( 'Location: about.php' );
	}
	else
	{
		$sortedFiles = getFilesInDir($section);
		$listname=array();
		$i=0;
		foreach($sortedFiles as $file)
		{
			$d = date('F d Y',filemtime("xml/".$section.'/'.$file));
			$listname[$i]=$d.' - '.substr($file, 0,sizeof($file)-5);
			$i++;
		}
	}
	

?>


<script type="text/javascript">
function loadAJAX(id)
{
	console.log(id);
	var sec = document.getElementById("sec").innerHTML;	
	$.ajax({ 
		url: '/php/loadContent.php?index='+id+'&section='+sec,
		success: function(data)
		{
			$("#cbody").html(data);
		}
	});	
	document.getElementById("cur").innerHTML = id;
	history.pushState(null,null,id);
	$('.list-group-item').removeClass('active');
	$("#"+id).addClass('active');

}

$(function(){
	$("#next").click(function() {
		var t = document.getElementById("t").innerHTML;
		var cur = document.getElementById("cur").innerHTML;
		cur++;
		var sec = document.getElementById("sec").innerHTML;					
		if(cur < t)
		{
			$.ajax({ 
				url: '/php/loadContent.php?index='+cur+'&section='+sec,
				success: function(data)
				{
					$("#cbody").html(data);
				}
			});	
			
			document.getElementById("cur").innerHTML = cur;
			history.pushState(null,null,cur);
			$('.list-group-item').removeClass('active');
			$("#"+cur).addClass('active');
		}
		else
		{
			var alertMsg = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>No more articles to show.</div>"
			document.getElementById('alertPagerNav').innerHTML = alertMsg;
		}
		
	});
	$("#prev").click(function() {

		var t = document.getElementById("t").innerHTML;
		var cur = document.getElementById("cur").innerHTML;
		cur--;
		var sec = document.getElementById("sec").innerHTML;			
		if(cur >-1)
		{
			$.ajax({ 
				url: '/php/loadContent.php?index='+cur+'&section='+sec,
				success: function(data)
				{
					$("#cbody").html(data);
				}
			});					
			document.getElementById("cur").innerHTML = cur;
			history.pushState(null,null,cur);
			$('.list-group-item').removeClass('active');
			$("#"+cur).addClass('active');
		}
		else
		{
			var alertMsg = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>No more articles to show.</div>"
			document.getElementById('alertPagerNav').innerHTML = alertMsg;
		}
		
	});
});
</script>
<p hidden id="t" ><?php echo sizeof($sortedFiles); ?></p>
<p hidden id="sec"  ><?php echo $section; ?></p>
<p hidden id="cur" >0</p>
<script type="text/javascript">
	function updateLocation() {
		var loc = window.location.href;				
		var loca = loc.split("/");
		if(document.getElementById("t").innerHTML > loca[loca.length-1]) {
			document.getElementById("cur").innerHTML = loca[loca.length-1];
			loadAJAX(loca[loca.length-1]);
		}
		else {
			alert("Oops! the article you are looking for does not exist! Showing the latest article.");
			loadAJAX(0);
		}
	}
	updateLocation();
</script>
<div class="col-lg-9">
	<div class="content row">	
		<div id="alertPagerNav">
		</div>
		<ul class="pager">
	  		<li class="previous"><a style="cursor:pointer;" id="prev">&larr; Latest Article</a></li>
	  		<li class="next"><a style="cursor:pointer;" id="next">Older Article &rarr;</a></li>
		</ul>
	</div>
</div>
<section class="content row">
	<div class="col-lg-9">
		<section class="content row" id="cbody"></section>
		<div class="content row">
			<?php include "comments.php" ?>	
		</div> 
	</div>
	<div class="col-lg-3">	
		<div class="aside row" >
			<div class="list-group">
				<?php 
				$i=0;
				foreach($listname as $file)
				{?>
					<a style="cursor:pointer;" class="list-group-item" onclick="loadAJAX(<?php echo $i ?>)" id="<?php echo $i ?>"><?php echo $file ?></a>
				<?php 
					$i++;
				} ?>
				
			</div>
		</div>
	</div>
</section>

