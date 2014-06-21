<?php define("ROOT","xml/"); ?>
<html>
	<head>		
		<title>Anupam's blog [anupamkumars_blog(at)yahoo(d0t)c0m]</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" media="screen"/>
		<link href="assets/img/cringe.ico" rel="icon">
	</head>
	<body >		
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>	
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
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
				if(location[location.length-1] === "") {
					window.location = "/myhome/0";
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

