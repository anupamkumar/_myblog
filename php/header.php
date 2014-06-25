<script type="text/javascript">
	$(function() {
		setHeader();	
	});
	function setHeader()
	{
		$("#header1").effect("highlight", 1200);
		headers = ["The sweetest page on the Internet",
		"The coolest page on the Internet",
		"The dopest page on the Internet",
		"Anupam's Home on the Internet"];
		var index = Math.floor(Math.random() * 4);
		$("#header1").html(headers[index]);
	}
	
</script>
<style>
label {
display: inline-block;
width: 5em;
}
</style>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
	<div class="jumbotron">
		<div class="container">
			<div class="col-lg-9 col-md-8 col-sm-8 col-xs-7">
				<h1 id="header1" ></h1>
				<h3><small>Welcome to my blog where I talk about tech &amp; non-tech stuff. Hope you enjoy your stay...</small></h3>
			</div>
			<span valign="center">
			<a href="http://www.linkedin.com/in/ak1512/"  target="_blank">
			<img id="linkedin" src="/assets/img/derp me.jpg" class="img-rounded img-circle img-thumbnail" data-toggle="tooltip" data-placement="bottom" title="Click to see my LinkedIn Page" width='200' height='200' />
			</a>
			</span>
		</div>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNav">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/myhome/ ">HOME &rarr; Check out:</a>
			</div>
			<div class="collapse navbar-collapse" id="myNav">
				<ul class="nav navbar-nav">
					<li id='tech'><a href="/tech/ " class="main-nav"  id='n0'>Tech Bubble</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="tb">Thought Bubble<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li id='thoughts'><a href="/thoughts/ " class="main-nav"  id='n1'>Random Thoughts</a></li>
							<li id='entertainment'><a href="/entertainment/ " class="main-nav"  id='n2'>Entertainment</a></li>
							<li id='games'><a href="/games/ " class="main-nav"  id='n3'>Games</a></li>
							<li id='travel'><a href="/travel/ " class="main-nav"  id='n4'>Travel Blog</a></li>
							<li class="divider"></li>
							<li id='lists'><a href="/lists/ " class="main-nav"  id='n5'>Lists!</a></li>
						</ul>
					</li>					
					<li id='stuff'><a href="/stuff" class="main-nav"  id='n6'>Stuff I made</a></li>
					<li id='about'><a href="/about" class="main-nav"  id='n7'>About</a></li>
				</ul>
			</div>
		</div>
	</div>

	<script type="text/javascript">

	function doNavigate(navid)
	{
		document.getElementById('tb').innerHTML = "Thought Bubble<b class=\"caret\">";
		$('li').removeClass('active');
		$('#'+navid).addClass('active');
		if(navid === 'thoughts' || navid === 'entertainment' || navid === 'games' || navid === 'travel' || navid === 'lists')
		{
			$('.dropdown').addClass('active');			
		}
		switch(navid)
		{
			case 'tech':
				$("#linkedin").attr("src","/assets/img/tech.jpg");
				setHeader();	
				//setContent('tech');
				break;
			case 'thoughts':
				$("#linkedin").attr("src","/assets/img/derpme_thinking.jpg");
				document.getElementById('tb').innerHTML = "Thought Bubble &rarr; Thoughts";
				setHeader();
				//setContent('thoughts');
				break;
			case 'entertainment':
				$("#linkedin").attr("src","/assets/img/entertainment.png");
				document.getElementById('tb').innerHTML = "Thought Bubble &rarr; Entertainment";
				setHeader();
				//setContent('entertainment');
				break;
			case 'games':
				$("#linkedin").attr("src","/assets/img/games.jpg");
				document.getElementById('tb').innerHTML = "Thought Bubble &rarr; Games";
				setHeader();
				//setContent('games');
				break;
			case 'travel':
				$("#linkedin").attr("src","/assets/img/travel.jpg");
				document.getElementById('tb').innerHTML = "Thought Bubble &rarr; Travel Blog";
				setHeader();
				//setContent('travel');
				break;
			case 'lists':
				$("#linkedin").attr("src","/assets/img/derpme_lists.jpg");
				document.getElementById('tb').innerHTML = "Thought Bubble &rarr; Lists!";
				setHeader();
				//setContent('lists');
				break;
			case 'stuff':
				$("#linkedin").attr("src","/assets/img/stuff-i-made.png");
				setHeader();
				//setContent('stuff');
				break;
			case 'about':
				$("#linkedin").attr("src","/assets/img/me.jpg");
				setHeader();
				//setContent('about');
				break;
		}
	}

	function setContent(cat)
	{
		$.ajax({ url: '/php/content.php?section='+cat,
			 success: function(data) {
			 	$("#mainContent").html(data);
			 }
	     });
	}
	</script>