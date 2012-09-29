<?php
	
	// CLASSE COMMENT   //////////////
	class Comment {
		/* SOMMAIRE :
		* Méthodes de la classe
				Getters :
					ID()
					idNews()
					idAuteur()
					datePost()
					heurePost()
					contenu()
				Setters :
					set_ID( $ID )
					set_idNews( $idNews )
					set_idAuteur( $idAuteur )
					set_datePost( $datePost )
					set_heurePost( $heurePost )
					set_contenu( $contenu )
		*/
	
		private $_ID;			// ID du commentaire.
		private $_idNews;		// ID de la news commentée.
		private $_idAuteur;		// ID de l'auteur du commentaire.
		private $_datePost;		// Date de postage du commentaire.
		private $_heurePost;	// Heure de postage du commentaire.
		private $_contenu;		// Contenu du commentaire.

		/*
		// - Fonction : construit une nouvelle instance de l'objet Comment.
		*/
		public function __construct($ID = NULL, $idNews = NULL)
		{ $this->_ID = $ID; $this->_idNews = $idNews; }
		
		// GETTEURS    /////////////////////////
		// Renvoi la valeur de l'attribut $ID
		public function ID() { return $this->_ID; }
		
		// Renvoi la valeur de l'attribut $_idNews
		public function idNews() { return $tihs->_idNews; }
		
		// Renvoi la valeur de l'attribut $_idAuteur
		public function idAuteur() { return $this->_idAuteur; }
		
		// Renvoi la valeur de l'attribut $_datePost
		public function datePost() { return $this->_datePost; }
		
		// Renvoi la valeur de l'attribut $_heurePost
		public function heurePost() { return $this->_heurePost; }
		
		// Renvoi la valeur de l'attribut $_contenu
		public function contenu() { return $this->_contenu; }

		// SETTEURS    /////////////////////////

		// Modifie la valeur de l'attribut $_ID
		public function set_ID($ID) { $this->_ID = $ID; }
		
		// Modifie la valeur de l'attribut $_idNews
		public function set_idNews($idNews) { $this->_idNews = $idNews; }
		
		// Modifie la valeur de l'attribut $idAuteur
		public function set_idAuteur($idAuteur) { $this->_idAuteur = $idAuteur; }
		
		// Modifie la valeur de l'attribut $_datePost
		public function set_datePost($datePost) { $this->_datePost = $datePost; }
		
		// Modifie la valeur de l'attribut $_heurePost
		public function set_heurePost($heurePost) { $this->_heurePost = $heurePost; }
		
		// Modifie la valeur de l'attribut $_contenu
		public function set_contenu($contenu) { $this->_contenu = $contenu; }
	
	}

	
	
	