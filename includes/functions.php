<?php
function loadClass ($className) {
	global $path_classes;
	require_once $path_classes.$className.'.class.php';
}

function voir ($donnee) {
	echo htmlspecialchars($donnee);
}

function voirArray(array $array) {
	echo "<pre>\n",print_r($array),"\n</pre>\n";
}