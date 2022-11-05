<?php 
$url = filter_input(INPUT_POST, 'url');
$url = str_replace("/", '\\', $url);
?>

<iframe src="http://localhost/TubesPPL/<?= $url ?>" height='100%' width='100%'>