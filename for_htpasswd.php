<!DOCTYPE html>
<html>
	<head>
		<title>Page protégée</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<h1>Générateur de compte</h1>
<?php
if (!empty($_GET['login']) && !empty($_GET['password'])) {
	echo '<p>Ligne à copier dans le .htpasswd : <br />'."\n"
		.$_GET['login'] . ':' . $_GET['password'] . '</p>';
}
?> 
		<form method="get" action="for_htpasswd.php">
			<fieldset>
				<legend>Informations</legend>
				<label for="login">Login : </label><input type="text" name="login" id="login" placeholder="Ex: kikoodu93." autofocus /><br />
				<label for="mdp">Mot de passe : </label><input type="password" name="password" id="mdp" /><br />
				<input type="submit" value="Générer" />
			</fieldset>
		</form>
	</body>
</html>