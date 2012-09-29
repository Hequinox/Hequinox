<?php

require 'config.php';

require_once $path_includes.'functions.php';
spl_autoload_register('loadClass');

//Set to true to see Global variables
if (0) {
	echo voirArray($GLOBALS);
}


//Quick access
if (!empty($_GET['goto'])) {
	if (!empty($_GET['gotoparams'])) {
		header('Location: '.$_GET['goto'].'.html?'.$_GET['gotoparams']);
		exit();
	} else {
		header('Location: '.$_GET['goto'].'.html');
		exit();
	}
} elseif (isset($_GET['goto']) && empty($_GET['goto'])) {
	if (!empty($_GET['gotoparams'])) {
		header('Location: index.html?'.$_GET['gotoparams']);
		exit();
	} else {
		header('Location: index.html');
		exit();
	}
}

//SQL connexion by PDO
try {
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$db = new PDO('mysql:host='.$sql_host.';dbname='.$sql_dbname, $sql_user, $sql_password, $pdo_options);
}
catch (Exception $e) {
	die('Error : Connection to MySQL failed : <br />'.$e->getMessage());
}


//Pour les éventuelles Exceptions lancées dans le contrôleur
try {
	//Inclusion de la page en fonction de la requête de l'utilisateur
	//example.com/index.php?page=...
	if (!empty($_GET['page']) && strtolower($_GET['page']) == '404') {
		$content = '404.php';
	} elseif (!empty($_GET['page']) && strtolower($_GET['page']) != 'index') {
		//Si la page existe, on l'inclue
		if (file_exists($path_controleur.$_GET['page'].'.php'))
			include $path_controleur.$_GET['page'].'.php';
		//Sinon erreur 404
		else
			$content = '404.php';

	} else { //S'il n'y a pas de page spécifiée
		include $path_controleur.'index.php';
	}
} //If an Exception is thrown in the controller
catch (Exception $e) {
	die("Erreur lors de l'appel de la page : <br />\n".$e->getMessage()."<br />\nCode : <br />\n".$e->getCode());
}


//The page is set in a string : $display
if (!empty($content)) {
	ob_start();
	include_once $path_vue.$content; //$content is the name of the page in vue/, set in all controllers
	$display = ob_get_clean();
} else { 
	//Internal error, no content specified
	ob_start();
	include_once $path_vue.'no_content.php';
	$display = ob_get_clean();
}

?>
<!DOCTYPE HTML>
<html>
<!-- HEY ! WHAT ARE YOU DOING HERE ? -->
<!-- HEY ! QUE FAITES-VOUS ICI ?     -->
<!-- HEY ! QUE ESTA USTED HACIENDO ? -->
    <head>
        <meta charset="utf-8" />
        <title>Hequinox - <?php
//If there's a $title configured in the view
if (isset($title)) {
	echo $title;
} else {
	echo 'Sans titre';
} ?></title>
<?php
//If no style is wanted
if (isset($style_path) && $style_path == false) {}
//If another style file is wanted
elseif (isset($style_path) && $style_path != 'default') { ?>
        <link rel="stylesheet" href="<?php echo $style_path; ?>" />
<?php
//Default style will be used
} else { ?>
        <link rel="stylesheet" href="<?php echo $path_style; ?>" />
<?php
}
//If there's a specific style to apply
if (!empty($style)) {
?>
        <style>
<?php echo $style; ?> 
        </style>
<?php 
}
?>
    </head>
    <body>
<?php
include 'header.php';
include 'nav.php';

//Include the content of the page
echo $display;

include 'footer.php';
?>
    </body>
</html>