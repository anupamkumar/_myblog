<?php
$x = $_POST['x'];

$list = "<list>";
$list = $list . "<title>" . strip_tags($_POST['title']) . "</title>";
$list = $list . "<author>" . strip_tags($_POST['author']) . "</author>";
$list = $list . "<publishdate>" . strip_tags($_POST['publishdate']) . "</publishdate>";
$list = $list . "<thumbnail_type>Images</thumbnail_type>";
$list = $list . "<thumbnail_w>100%</thumbnail_w>";

$list = $list . "<items>";
for($i=0;$i<$x;$i++) {
	$list = $list . "<item>";
	$list = $list . "<rank>" . strip_tags($_POST['rank-'.$i]) . "</rank>";
	$list = $list . "<thumbnail>" . htmlentities($_POST['thumbnail-'.$i]) . "</thumbnail>";
	$list = $list . "<itemname>" . strip_tags($_POST['itemname-'.$i]) . "</itemname>";
	$list = $list . "<description>" . htmlentities($_POST['description-'.$i]) . "</description>";	
	$list = $list . "<likes>0</likes>";
	$list = $list . "<dislikes>0</dislikes>";
	$list = $list . "</item>";
}
$list = $list . "</items>";
$list = $list . "</list>";
$filename = '../php/xml/lists/'.strip_tags($_POST['title']).'.xml';
$handle = fopen($filename,'w+') or exit('could not create article');
fwrite($handle,$list);
fclose($handle);
echo '<script>alert("article created");window.location = "make-list.php"</script>';
?>