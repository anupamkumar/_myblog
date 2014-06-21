<?php
$section = $_POST['section'];
$section = strip_tags($_POST['section']);
$title = strip_tags($_POST['title']);
$author = strip_tags($_POST['author']);
$pubdt = strip_tags($_POST['publishdate']);
$body = htmlentities($_POST['body']);
$ref = htmlentities($_POST['reference']);

$filename = '../php/xml/'.$section.'/'.$title.'.xml';
$xmlContent = '<doc><title>'.$title.'</title><author>'.$author.'</author><publishdate>'.$pubdt.'</publishdate><body>'.$body.'</body><references>'.$ref.'</references></doc>';
$handle = fopen($filename,'w+') or exit('could not create article');
fwrite($handle,$xmlContent);
fclose($handle);
echo '<script>alert("article created");window.location = "make-article.php"</script>';
?>