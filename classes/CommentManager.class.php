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

		protected $_bdd;	// Base de donn�es
		
		/*
		// - Fonction : Constructeur, enregistre l'instance PDO dans l'attribut $_bdd
		// - Param�tres : 
		*/
		public function __construct($bdd);
		
		/*
		// - Renvoi un bool�en selon que le commentaire est
		//	 nouveau ou d�j� existant dans la table 'COMMENTS'.
		*/
		abstract protected function isNew(Comment $comment);
		
		/*
		// - Fonction : Charge les donn�es du commentaire.
		// - Param�tres : $comment de type Comment, le commentaire qui sera charg�.
		*/
		abstract protected function loadComment($comment);
		
		/*
		// - Rajoute le commentaire � la base de donn�es
		// - Param�tres : $comment de type Comment, le commentaire qui sera ajout� dans la table 'COMMENTS'.
		*/
		abstract protected function addComment(Comment $comment);
		
		/*
		// - Enregistre le commentaire
		// - Param�tres : $comment de type Comment, le commentaire qui sera enregistr�.
		*/
		abstract protected function saveComment(Comment $comment);
		
		/*
		// - Supprime le commentaire de la base de donn�es
		// - Param�tres : $comment de type Comment, le commentaire qui sera supprim� de la table 'COMMENTS'.
		*/
		abstract protected function deleteComment(Comment $comment);
		
		/*
		// - Modifie le commentaire
		// - Param�tres : $comment de type Comment, le commentaire qui sera modifi�.
		*/
		abstract protected function modifyComment(Comment $comment);
	}