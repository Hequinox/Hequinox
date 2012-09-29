<?php
	abstract class NewsManager {
		/* SOMMAIRE :
		*
		*
		*
		*
		*
		*
		*/

		protected $bdd;	// Base de données
		
		/*
		// - Fonction : Constructeur, enregistre l'instance PDO dans l'attribut $_bdd
		// - Paramètres : 
		*/
		public function NewsManager($bdd) { $this->_bdd = $bdd; }
		
		/*
		// - Fonction : Charge les données de la news.
		// - Paramètres : $news de type News, la news qui sera chargée.
		*/
		abstract public function loadNews($news);

		abstract public function loadLastNews();
		
		// Rajoute la news à la base de données
		abstract public function addNews(News $news);
		
		// Enregistre la news
		abstract public function saveNews(News $news);
		
		// Supprime la news de la base de données
		abstract public function deleteNews(News $news);
		
		// Modifie la news
		abstract public function modifyNews(News $news);
	}