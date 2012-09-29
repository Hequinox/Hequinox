<?php
$title = "Accueil"; //Title of the page
$style = false; //No specific style to apply
$style_path = 'default'; //Default path
?>
<h1>Accueil</h1>
<section>
	<p>
		Bienvenue sur le site de la team Hequinox.<br />
		Hequinox est une team de codeurs actuellement composée de 4 membres :
	</p>

	<ul>
		<li><span title="Member since : 22 August 2012">Artpicre</span> - Developer : HTML, CSS, PHP, SQL, C</li>
		<li><span title="Member since : 22 August 2012">Knyxe</span> - Developer : HTML, CSS, PHP, SQL, C, C++, Visual Basic.NET</li>
		<li><span title="Member since : 22 August 2012">Lestiar</span> - Developer : HTML, CSS, PHP</li>
		<li><span title="Member since : 24 August 2012">Oxymore (Cornflower)</span> - Graphist : HTML, CSS</li>
	</ul>
</section>
<?php 
$contenuNews = $vue['lastNew']->contenu();
if (!empty($contenuNews)) {
?> 
<article>
	<h1><?= $vue['lastNew']->titre() ?></h1>
	<em>&Eacute;crit par <?= $vue['lastNew']->auteur().' le '.$vue['lastNew']->dateRedac() ?></em>
	<?= $vue['lastNew']->contenu(); ?> 
</article>
<?php
} else { //Else of : if !empty($vue['lastNew']->contenu())
?> 
<article>
	<p>Aucune news pour le moment !</p>
</article>
<?php
} //End if/else : if !empty($vue['lastNew']->contenu())
?> 
