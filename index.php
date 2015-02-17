<?php define("ROOT","xml/"); ?>
<html>
	<head>		
		<title>Anupam's blog</title>
		<meta name="msvalidate.01" content="9C435D10DD96EDDD841CE65858AC7A79" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" media="screen"/>
		<link href="assets/img/cringe.ico" rel="icon">
		<link href="/assets/css/bootstrap-modal-carousel.min.css" rel="stylesheet" />
		
	</head>
	<body >		
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>	
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<script src="/assets/js/bootstrap-modal-carousel.min.js"/></script/>
		<section class="container">
			<div class="content row">
				<?php include "php/header.php" ?>
			</div>
			<div class="content row" id="mainContent">				
				<script type="text/javascript">
				function checkLocation() {
				var loc = window.location.href;				
				var loca = loc.split("/");
				var location = new Array();
				for(i=loca.length-1;i>=0;i--) {
					if(loca[i]!=="anupamsblog.net23.net")
						location.push(loca[i]);
					else 
						break;
				}
				redirector(location);
			}
			function redirector(location) {
				if( location[location.length-1] != "myhome" && 
					location[location.length-1] != "tech" && 
					location[location.length-1] != "thoughts" &&
					location[location.length-1] != "entertainment" && 
					location[location.length-1] != "travel" && 
					location[location.length-1] != "lists" && 
					location[location.length-1] != "games" && 
					location[location.length-1] != "about" && 
					location[location.length-1] != "stuff" ) {
					window.location = "/myhome/";
				}
				else {
					$.ajax({ url: '/php/content.php?section='+location[location.length-1],
			 				success: function(data) {
			 				$("#mainContent").html(data);
				 		}
	    	 		});
	    	 		doNavigate(location[location.length-1]);
				}	
			}
				checkLocation();			
				</script>
			</div>						
		</section>			
	</body>	
</html>

