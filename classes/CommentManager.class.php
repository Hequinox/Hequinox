<?php
	class abstract CommentManager {
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
		public function __construct($bdd);
		
		/*
		// - Renvoi un booléen selon que le commentaire est
		//	 nouveau ou déjà existant dans la table 'COMMENTS'.
		*/
		abstract protected function isNew(Comment $comment);
		
		/*
		// - Fonction : Charge les données du commentaire.
		// - Paramètres : $comment de type Comment, le commentaire qui sera chargé.
		*/
		abstract protected function loadComment($comment);
		
		/*
		// - Rajoute le commentaire à la base de données
		// - Paramètres : $comment de type Comment, le commentaire qui sera ajouté dans la table 'COMMENTS'.
		*/
		abstract protected function addComment(Comment $comment);
		
		/*
		// - Enregistre le commentaire
		// - Paramètres : $comment de type Comment, le commentaire qui sera enregistré.
		*/
		abstract protected function saveComment(Comment $comment);
		
		/*
		// - Supprime le commentaire de la base de données
		// - Paramètres : $comment de type Comment, le commentaire qui sera supprimé de la table 'COMMENTS'.
		*/
		abstract protected function deleteComment(Comment $comment);
		
		/*
		// - Modifie le commentaire
		// - Paramètres : $comment de type Comment, le commentaire qui sera modifié.
		*/
		abstract protected function modifyComment(Comment $comment);
	}