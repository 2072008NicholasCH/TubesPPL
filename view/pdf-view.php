<?php 
$url = filter_input(INPUT_POST, 'url');
$url = str_replace("/", '\\', $url);
?>

<iframe src="http://beritaacara.ddns.net/BeritaAcara/<?= $url ?>" height='100%' width='100%'>