<?php
	class CommentManagerPDO {
		/* SOMMAIRE :
		*
		*
		*
		*
		*
		*
		*/

		protected $_bdd;	// Base de données
		
		/*
		// - Fonction : Constructeur, enregistre l'instance PDO dans l'attribut $_bdd
		// - Paramètres : 
		*/
		public function __construct($bdd) { $this->_bdd = $bdd; }
		
		/*
		// - Renvoi un booléen selon que le commentaire est
		//	 nouveaux ou déjà existant dans la base de données.
		*/
		public function isNew(Comment $comment)
		{
			$requete = "SELECT COUNT(*) AS 'nb' FROM COMMENTS WHERE ID = :ID AND idNews = :idNews";
			$requeteFinale = $this->_bdd->prepare($requete);
			
			try
			{
				$requeteFinale->execute( array(
										'ID' => $comment->ID(),
										'idNews' => $comment->idNews()
											) );
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			return ( ($requeteFinale->fetchColumn) != 0 );
		}
		
		/*
		// - Fonction : Charge les données du commentaire.
		// - Paramètres : $comment de type Comment, le commetaire qui sera chargé.
		*/
		public function loadComment($comment)
		{
			$requete = 'SELECT * FROM COMMENTS WHERE ID = :ID AND idNews = :idNews';
			$requeteFinale = $this->_bdd->prepare($requete);
			
			try
			{
				if ( $this->isNew($comment) )
					throw new Exception("Commentaire innexistant");
				else
					$requeteFinale->execute( array(
											'ID' => $comment->ID()
											'idNews' => $comment->idNews()
												) );
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			
			$resultat=$requeteFinale->fetch();
			
			// Mise à jour des attributs de l'objet $news.
				$comment->set_ID($resultat['ID']);
				$comment->set_idNews($resultat['idNews']);
				$comment->set_idAuteur($resultat['idAuteur']);
				$comment->set_datePost($resultat['datePost']);
				$comment->set_heurePost($resultat['heurePost']);
				$comment->set_contenu($resultat['contenu']);
		}
		
		/*
		// - Rajoute le commentaire à la base de données
		// - Paramètres : $comment de type Comment, le commentaire qui sera ajouté à la base données.
		*/
		private function addComment(Comment $comment)
		{
			// D'abord on cherche l'ID du dernier commentaire de la même News.
			$requeteFinale = $this->_bdd->prepare("SELECT MAX(ID) AS 'max' FORM COMMENTS WHERE idNews = ?");
			$requeteFinale->execute( $comment->idNews() );
			$ID = $requeteFinale->fetch() + 1;
			
			// Puis on ajoute le commentaire en lui attribuant l'ID correspondant
			$requete = "INSERT INTO COMMENTS(ID, idNews, idAuteur, datePost, heurePost, contenu)
			VALUES(:ID, :idNews, :idAuteur, :datePost, :heurePost, :contenu)";
			$requeteFinale = $this->_bdd->prepare($requete);
			try
			{
				$requeteFinale->execute(array(
										'ID' => $ID,
										'idNews' => $comment->idNews(),
										'idAuteur' => $comment->idAuteur(),
										'datePost' => $comment->datePost(),
										'heurePost' => $comment->heurePost(),
										'contenu' => $comment->contenu()
											) );
			}
			catch (Exception $e)
			{
				die('Erreur : '.$e->getMessage());
		}
		
		/*
		// - Enregistre le commentaire
		// - Paramètres : $comment de type Comment, le commentaire qui sera enregistré.
		*/
		public function saveComment(Comment $comment)
		{
			if ( $this->isNew($comment) )
				$this->addComment($comment);
			else
				$this->modifyComment($comment);
		}
		
		/*
		// - Supprime le commentaire de la base de données
		// - Paramètres : $comment de type Comment, le commentaire qui sera supprimé de la base de données.
		*/
		public function deleteComment(Comment $comment)
		{
			$requete = "DELETE FROM COMMENTS WHERE ID = :ID AND idNews = :idNews";
			$requeteFinale = $this->_bdd->prepare($requete);
				
			try
			{
				if ( $this->isNew($comment) )
					throw new Exception("Commentaire innexistant");
				else
					$requeteFinale->execute(array (
											'ID' => $comment->ID(),
											'idNews' => $comment->idNews()
												) );
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}
		
		/*
		// - Modifie le commentaire
		// - Paramètres : $comment de type Comment, le commentaire qui sera modifié.
		*/
		private function modifyComment(Comment $comment)
		{
			$requete = "UPDATE COMMENTS
						SET idAuteur = :idAuteur,
							datePost = :datePost,
							heurePost = :heurePost,
							contenu = :contenu,
						WHERE ID = :ID AND idNews = :idNews";
						
			$requeteFinale = $this->_bdd->prepare($requete);
			try
			{
				$requeteFinale->execute(array(
										'idAuteur' => $comment->idAuteur(),
										'datePost' => $comment->datePost(),
										'heurePost' => $comment->heurePost(),
										'contenu' => $comment->contenu(),
										'ID' => $comment->ID(),
										'idNews' => $comment->idNews()
											) );
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}