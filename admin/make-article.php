<htmL>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" media="screen"/>
		<link href="assets/img/cringe.ico" rel="icon"></head>
		<body class="container">
			<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
			<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
			<h2>Add Article</h2>
			<div class="col-lg-8">
				<form action="AddArticle.php" method="post" role="form">
					<div class="form-group"><label for="section">Section name</label>
					<select name="section" class="form-control">
						<option value="myhome">Home Page</option>
						<option value="thoughts">Thoughts</option>
						<option value="tech">Tech Bubble</option>
						<option value="games">Games</option>
						<option value="entertainment">Entertainment</option>
						<option value="travel">Travel</option>
						<option value="lists">Lists!</option>
					</select>
				</div>
				<div class="form-group"><label for="title">Title</label><input class="form-control" type="text" id="title" name="title"/></div>
				<div class="form-group"><label for="author">Author</label><input class="form-control" type="text" id="author" name="author"/></div>
				<div class="form-group"><label for="publishdate">Publishing date</label><input type="text" class="form-control" name="publishdate" id="publishdate"/></div>
				<div class="form-group"><label for="body">Body</label><textarea rows="20" id="body" name="body" class="form-control" placeholder="HTML allowed. Script not allowed"></textarea></div>
				<div class="form-group"><label for="reference">References</label><textarea rows="6" name="reference" id="reference" class="form-control" placeholder="HTML allowed. Script not allowed"></textarea></div>
				<div class="form-group"><input type="submit" value="submit" class="btn btn-danger"/>
			</form>
		</div>
	</body>
</htmL>