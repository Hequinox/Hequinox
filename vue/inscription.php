<?php
$title="Inscription";
?>
<h1>Inscription</h1>
<!--Formulaire-->
<form method="post" action="?page=inscription">
	<fieldset>
		<p>
			<legend>Champs obligatoires</legend> <!--Titre du fieldset-->
				<label for="pseudo">Votre pseudonyme* :</label>
				<input type="text" name="pseudo" id="pseudo" autofocus required />
				<br/>
				<label for="mdp">Votre mot de passe* :</label>
				<input type="password" name="mdp" id="mdp"required />
				<br/>
				<label for="mdp_verif">Confirmez votre mot de passe* :</label>
				<input type="password" name="mdp_verif" id="mdp_verif"required />
				<br/>
				<label for="email">Votre email* :</label>
				<input type="email" name="email" id="email" required/>
				<br/>
				<label for="email_verif">Confirmez votre email* :</label>
				<input type="email" name="email_verif" id="email_verif"required />
				<br/>
			<legend>Champs facultatifs</legend>
				<label for="tel">Votre téléphone :</label>
				<input type="tel" name="tel" id="tel" />
				<br/>
				<label for="age">Votre âge :</label>
				<input type="text" name="age" id="age" />
				<br/>
				<input type"submit" value="Envoyer" />
		</p>
	</fieldset>
</form>