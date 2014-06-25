<?php 
	include 'opendir.php' ;
	$section='lists/';
	$sortedFiles = getFilesInDir($section);
	$listname=array();
	$i=0;
	foreach($sortedFiles as $file)
	{
		$d = date('F d Y',filemtime("xml/".$section.'/'.$file));
		$listname[$i]=$d.' - '.substr($file, 0,sizeof($file)-5);
		$i++;
	}
?>
<script type="text/javascript">
function toggleView()
{
	var v = document.getElementById('ds').innerHTML;

	if(v==='mediaList')
	{
		document.getElementById('ds').innerHTML = 'Carousel';
	}
	else
	{
		document.getElementById('ds').innerHTML = 'mediaList';
	}
	$.ajax({ 
		url: '/php/loadList.php?index='+document.getElementById("cur").innerHTML+'&style='+document.getElementById("ds").innerHTML,
		success: function(data)
		{			
			$("#cbody").html(data);

		}
	});
}
$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');  
    
    if ($(this).find('.btn-primary').size()>0) {
    	$(this).find('.btn').toggleClass('btn-primary');
    }
    if ($(this).find('.btn-danger').size()>0) {
    	$(this).find('.btn').toggleClass('btn-danger');
    }
    if ($(this).find('.btn-success').size()>0) {
    	$(this).find('.btn').toggleClass('btn-success');
    }
    if ($(this).find('.btn-info').size()>0) {
    	$(this).find('.btn').toggleClass('btn-info');
    }
    
    $(this).find('.btn').toggleClass('btn-default');
       
});


function loadAJAX(id)
{
	$.ajax({ 
		url: '/php/loadList.php?index='+id+'&style='+document.getElementById("ds").innerHTML,
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
		if(cur < t)
		{
			$.ajax({ 
				url: '/php/loadList.php?index='+cur+'&style='+document.getElementById("ds").innerHTML,
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
		if(cur >-1)
		{
			$.ajax({ 
				url: '/php/loadList.php?index='+cur+'&style='+document.getElementById("ds").innerHTML,
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
	function fnIncreaseCount(voteid)
	{
		var altvoteid;
		var v = document.getElementById(voteid+'s').innerHTML;
		v++;
		if(/^dislike/.test(voteid))
		{
			var altvoteid = voteid.substring(3);			
		}
		if(/^like/.test(voteid))
		{
			var altvoteid = "dis"+voteid;
		}
		console.log(voteid+" "+altvoteid);
		var q = document.getElementById(altvoteid+'s').innerHTML;
			if(q > 0)
				q--;
		document.getElementById(altvoteid).disabled = false;
		document.getElementById(voteid+'s').innerHTML = v;
		document.getElementById(altvoteid+'s').innerHTML = q;
		document.getElementById(voteid).disabled = true;
	}
</script>
<p hidden id="t" ><?php echo sizeof($sortedFiles); ?></p>
<p hidden id="ds"  >mediaList</p>
<p hidden id="cur" ><?php echo sizeof($sortedFiles); ?></p>
<script type="text/javascript">
	function updateLocation() {
		var loc = window.location.href;				
		var loca = loc.split("/");
		console.log(loca[loca.length-1]);
		if(loca[loca.length-1] == "") {
			loadAJAX(<?php echo sizeof($sortedFiles); ?>-1);			
		}
		else if((parseInt(document.getElementById("t").innerHTML) > parseInt(loca[loca.length-1]))
			&& parseInt(loca[loca.length-1]) >=0) {
			document.getElementById("cur").innerHTML = loca[loca.length-1];
			loadAJAX(loca[loca.length-1]);
		}
		else {
			alert("Oops! the article you are looking for does not exist! Showing the latest article.");
			loadAJAX(<?php echo sizeof($sortedFiles); ?>-1);
		}
	}
	updateLocation();
</script>
<div class="col-lg-9">
	<div class="content row">	
		<div id="alertPagerNav">
		</div>
		<ul class="pager">
	  		<li class="previous"><a style="cursor:pointer;" id="next">&larr; Next List</a></li>
	  		<li class="next"><a style="cursor:pointer;" id="prev">Previous List &rarr;</a></li>
		</ul>
	</div>
</div>
<section class="content row">
	<div class="col-lg-9">
		<div class="content-row">			
			<strong>View List as:</strong>
	  		<div class="btn-group btn-toggle" id="viewStyle" align="middle" onclick="toggleView()">
    			<button class="btn btn-primary active" >Media List</button>
    			<button class="btn btn-default" >Carousel</button>
			</div>
		</div>
		<section class="content row" id="cbody">
		</section>
		<div class="content row">
			<?php include "comments.php" ?>	
		</div>
	</div>
	<div class="col-lg-3">	
		<div class="aside row" >
			<div class="list-group">
				<?php 
				$j=sizeof($sortedFiles)-1;
				for($i=$j;$i>=0;$i--)
				{?>
					<a style="cursor:pointer;" class="list-group-item" onclick="loadAJAX(<?php echo $i ?>)" id="<?php echo $i ?>"><?php echo $listname[$i] ?></a>
				<?php 
					
				} ?>
				
			</div>
		</div>
	</div>
</section>