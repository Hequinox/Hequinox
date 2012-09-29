<?php

$newsManager = new NewsManagerPDO($db);
$lastNew = $newsManager->loadLastNews();
$vue['lastNew'] = $lastNew;
$content = 'index.php'; 
