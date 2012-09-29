<?php
$title="Connexion"
?>
<h1>Connexion</h1>
<!--Formulaire-->
<form method="post" action="?page=connexion">
	<p>
		<label for="pseudo">Votre pseudonyme* :</label>
		<input type="text" name="pseudo" id="pseudo" autofocus required />
		<br />
		<label for="mdp">Votre mot de passe* :</label>
		<input type="password" name="mdp" id="mdp" required/>
	</p>
</form>