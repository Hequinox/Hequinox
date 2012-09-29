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

		protected $bdd;	// Base de donn�es
		
		/*
		// - Fonction : Constructeur, enregistre l'instance PDO dans l'attribut $_bdd
		// - Param�tres : 
		*/
		public function NewsManager($bdd) { $this->_bdd = $bdd; }
		
		/*
		// - Fonction : Charge les donn�es de la news.
		// - Param�tres : $news de type News, la news qui sera charg�e.
		*/
		abstract public function loadNews($news);

		abstract public function loadLastNews();
		
		// Rajoute la news � la base de donn�es
		abstract public function addNews(News $news);
		
		// Enregistre la news
		abstract public function saveNews(News $news);
		
		// Supprime la news de la base de donn�es
		abstract public function deleteNews(News $news);
		
		// Modifie la news
		abstract public function modifyNews(News $news);
	}