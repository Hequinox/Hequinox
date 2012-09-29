<?php
$title = "Page non trouvée";
$style = false;
$style_path = 'default';

if ($_GET['page'] == '404') {
?>
<h1>Bienvenue sur la page 404</h1>

<p>Vous l'avez cherchée, vous l'avez trouvée ! :)</p>

<p><a href="index.html">Retour vers l'accueil</a></p>
<?php
} else {
?>
<h1>Erreur 404</h1>

<p>
	La page [<code><?= htmlspecialchars($_GET['page']) ?></code>] n'existe pas (ou plus) !
</p>

<p><a href="index.html">Retour vers l'accueil</a></p>
<?php
}