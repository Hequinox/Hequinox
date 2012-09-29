<?php
	include_once "classes/NewsManager.class.php";
	class NewsManagerPDO extends NewsManager {
		/* SOMMAIRE :
		* public bool idNew(News $news)
		* public News loadNews($id)
		* public News loadLastNews()
		* public void addNews(News $news)
		* public void saveNews(News $news)
		* public void deleteNews(News $news)
		* public void modifyNews(News $news)
		* public void setBdd($bdd)
		*/
		
		/*
		// - Fonction : Constructeur, enregistre l'instance PDO dans l'attribut $bdd
		// - Param�tres : 
		*/

		protected $bdd;

		public function __construct(PDO $bdd) { $this->setBdd($bdd); }
		
		/*
		// - Renvoi un bool�en selon que la News est
		//	 nouvelle ou d�j� existante dans la base de donn�es.
		*/
		public function isNew(News $news)
		{ 
			$requete = "SELECT COUNT(*) AS 'nb' FROM NEWS WHERE ID = :ID";
			$requeteFinale = $this->bdd->prepare($requete);
				$requeteFinale->bindParam(':ID', $news->ID(), PDO::PARAM_INT);
			try
			{
				$requeteFinale->execute();
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			return ( ($requeteFinale->fetchColumn) != 0 );
		}
		
		/*
		// - Fonction : Charge les donn�es de la news.
		// - Param�tres : $news de type News, la news qui sera charg�e.
		*/
		public function loadNews($id)
		{
			$requete = 'SELECT * FROM NEWS WHERE ID = :id';
			$requeteFinale = $this->bdd->prepare($requete);
			$requeteFinale->bindValue(':id', $id, PDO::PARAM_INT);
			$requeteFinale->execute();
			$resultat = $requeteFinale->fetch(PDO::FETCH_ASSOC); //Retourne le r�sultat en tant qu'array 
			
			//Cr�e un objet de type News
			return new News($resultat);
		}
		
		public function loadLastNews() {
			$sql = "SELECT * FROM `news` ORDER BY `dateRedac` DESC";
			$q = $this->bdd->query($sql);
			return new News($q->fetch(PDO::FETCH_ASSOC));
		}

		/*
		// - Rajoute la news � la base de donn�es
		// - Param�tres : $news de type News, la news qui sera rajout�e � la base de donn�es.
		*/
		public function addNews(News $news)
		{
			$requete = "INSERT INTO NEWS(ID, titre, auteur, dateRedac, auteurModif, dateModif, theme, contenu)
						VALUES('', :titre, :auteur, :dateRedac, ;heureRedac, ;auteurModif, ;dateModif, ;heureModif, ;theme, ;contenu)";
						
			$requeteFinale = $this->bdd->prepare($requete);
				$requeteFinale->bindParam(':titre', $news->titre(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':auteur', $news->auteur(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':dateRedac', $news->dateRedac(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':auteurModif', $news->auteurModif(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':dateModif', $news->dateModif(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':theme', $news->theme(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':contenu', $news->contenu(), PDO::PARAM_STR);
				
			try
			{
				$requeteFinale->execute();
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}
		
		/*
		// - Enregistre la news
		// - Param�tres : $news de type News, la news qui sera sauvegard�e.
		*/
		public function saveNews(News $news)
		{
			if ( $this->isNew($news) )
				$this->addNews($news);
			else
				$this->modifyNews($news);
		}
		
		/*
		// - Supprime la news de la base de donn�es
		// - Param�tres : $news de type News, la news qui sera supprim�e de la base de donn�es.
		*/
		public function deleteNews(News $news)
		{
			$requete = "DELETE FROM NEWS WHERE ID = :ID";	
			$requeteFinale = $this->bdd->prepare($requete);
				$requeteFinale->bindParam(':ID', $news->ID(), PDO::PARAM_INT);
			try
			{
				if ( $this->isNew($news) )
					throw new Exception("News innexistante");
				else
					$requeteFinale->execute();
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}
		
		/*
		// - Modifie la news
		// - Param�tres : $news de type News, la news qui sera modifi�e.
		*/
		public function modifyNews(News $news)
		{
			$requete = "UPDATE NEWS
						SET titre = :titre,
							auteur = :auteur,
							dateRedac = :dateRedac,
							auteurModif = :auteurModif,
							dateModif = :dateModif,
							theme = :theme,
							contenu = :contenu,
						WHERE ID = :ID";
						
			$requeteFinale = $this->bdd->prepare($requete);
				$requeteFinale->bindParam(':titre', $news->titre(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':auteur', $news->auteur(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':dateRedac', $news->dateRedac(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':auteurModif', $news->auteurModif(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':dateModif', $news->dateModif(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':theme', $news->theme(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':contenu', $news->contenu(), PDO::PARAM_STR);
				$requeteFinale->bindParam(':ID', $news->ID(), PDO::PARAM_INT);
			try
			{
				$requeteFinale->execute();
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}


		//Setter
		public function setBdd(PDO $bdd) { $this->bdd = $bdd; }
	}
