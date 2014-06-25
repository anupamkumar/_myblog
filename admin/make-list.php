<!DOCTYPE html>
<html>
<head>
	<title>Make a new List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" media="screen"/>
	<link href="assets/img/cringe.ico" rel="icon">
	<script type="text/javascript">
	var x=0;
		function fillItemsDiv() {
			var numberOfItems = prompt("How many items are there in the list ?");
			var s="";
			for(i=x;i<parseInt(numberOfItems);i++) {
				x++;
				s = s + "<section class='content row'><div class='form-group'><div class='col-lg-4'><label for='rank-"+i+"'>Item "+parseInt(i+1)+"'s Rank</label></div><div class='col-lg-8'><input class='form-control' type='text' id='rank-"+i+"' name='rank-"+i+"' placeholder='No HTML'/></div></div>";
				s = s + "<div class='form-group'><div class='col-lg-4'><label for='thumbnail-"+i+"'>Item "+parseInt(i+1)+"'s Thumbnail URL</label></div><div class='col-lg-8'><input class='form-control' type='text' id='thumbnail-"+i+"' name='thumbnail-"+i+"' placeholder='http://'/></div></div>";
				s = s + "<div class='form-group'><div class='col-lg-4'><label for='itemname-"+i+"'>Item "+parseInt(i+1)+"'s Name</label></div><div class='col-lg-8'><input class='form-control' type='text' id='itemname-"+i+"' name='itemname-"+i+"'placeholder='No HTML'/></div></div>";
				s = s + "<div class='form-group'><div class='col-lg-4'><label for='description-"+i+"'>Item "+parseInt(i+1)+"'s Description</label></div><div class='col-lg-8'><textarea class='form-control' id='description-"+i+"' name='description-"+i+"'placeholder='Formatting HTML allowed'></textarea></div></div></section><hr>";
			}
			document.getElementById("itemsDiv").innerHTML = s;
			
		}
		function addItem() {
			var s = "";
			var i = x++;
			s = s + "<section class='content row'><div class='form-group'><div class='col-lg-4'><label for='rank-"+i+"'>Item "+parseInt(i+1)+"'s Rank</label></div><div class='col-lg-8'><input class='form-control' type='text' id='rank-"+i+"' name='rank-"+i+"'/></div></div>";
			s = s + "<div class='form-group'><div class='col-lg-4'><label for='thumbnail-"+i+"'>Item "+parseInt(i+1)+"'s Thumbnail URL</label></div><div class='col-lg-8'><input class='form-control' type='text' id='thumbnail-"+i+"' name='thumbnail-"+i+"'/></div></div>";
			s = s + "<div class='form-group'><div class='col-lg-4'><label for='itemname-"+i+"'>Item "+parseInt(i+1)+"'s Name</label></div><div class='col-lg-8'><input class='form-control' type='text' id='itemname-"+i+"' name='itemname-"+i+"'/></div></div>";
			s = s + "<div class='form-group'><div class='col-lg-4'><label for='description-"+i+"'>Item "+parseInt(i+1)+"'s Description</label></div><div class='col-lg-8'><textarea class='form-control' id='description-"+i+"' name='description-"+i+"'></textarea></div></div></section><hr>";
			var e = document.createElement('div');
			e.innerHTML = s;
			document.getElementById("itemsDiv").appendChild(e);
			getX();
		}
		function getX() {
			document.getElementById("x").value = x;
		}
	</script>
</head>
<body class="container">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<h2>Add List</h2>
	<div class="col-lg-8">
		<form action="/admin/AddList.php" method="post" role="form">				
			<div class="form-group"><label for="title">Title</label><input class="form-control" type="text" id="title" name="title" placeholder="No HTML"/></div>
			<div class="form-group"><label for="author">Author</label><input class="form-control" type="text" id="author" name="author" placeholder="No HTML"/></div>
			<div class="form-group"><label for="publishdate">Publishing date</label><input type="text" class="form-control" name="publishdate" id="publishdate" placeholder="No HTML"/></div>			
			<div id="itemsDiv" ><script type="text/javascript">fillItemsDiv();</script></div>
			<input type="text" id="x" name="x" hidden/><script type="text/javascript">getX();</script>
			<div class="form-group col-lg-8"><input class="btn btn-primary" type="button" id="add" name="add" value="Add another item" onclick="addItem()"/><input type="submit" class="btn btn-danger" id="submit" name="submit" value="Submit"/></div>
		</form>
	</div>	
</body>
</html>