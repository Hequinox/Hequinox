<?php

	include_once "classes/NewsManagerPDO.class.php";
	// CLASSE NEWS   /////////////////
	class News {
		/* SOMMAIRE :
		* Méthode de la classe :
				Getters :
					ID()
					titre()
					auteur()
					dateRedac()
					auteurModif()
					dateModif()
					theme()
					contenu()
				Setters :
					set_ID( $ID )
					set_Titre( $titre )
					set_Auteur( $auteur )
					set_DateRedac( $dateRedac )
					set_AuteurModif( $auteurModif )
					set_DateModif( $dateModif )
					set_Theme( $theme )
					set_Contenu( $contenu )
		*/

		private $_ID;			// ID de la news.
		private $_titre;		// Titre de la news.
		private $_auteur;		// Auteur de la news.
		private $_dateRedac;	// Date de rédaction de la news.
		private $_auteurModif;	// Auteur de la dernière modification.
		private $_dateModif;	// Date de la dernière modification.
		private $_theme;		// Thème de la news.
		private $_contenu;		// Contenu de la news.
		//private $_tags;		// Mots clefs reliés à la news.
		
		/*
		// - Fonction : Assigne les valeurs spécifiées aux attributs correspondants
		*/
		public function hydrate($donnees)
        {
            foreach ($donnees as $attribut => $valeur)
            {
                $methode = 'set_'.ucfirst($attribut);
                
                if (is_callable(array($this, $methode)))
                {
                    $this->$methode($valeur);
                }
            }
        }
		
		/*
		// - Fonction : construit une nouvelle instance de l'objet News.
		*/
		public function __construct( $valeurs = array() )
		{
			if( !empty($valeurs) )
				$this->hydrate($valeurs);
		}
		
		// GETTEURS    ///////////////
		// Renvoi la valeur de l'attribut $ID
		public function ID() { return $this->_ID; }
		
		// Renvoi la valeur de l'attribut $titre
		public function titre(){ return $this->_titre; }
		
		// Renvoi la valeur de l'attribut $auteur
		public function auteur() { return $this->_auteur; }
		
		// Renvoi la valeur de l'attribut $dateRedac
		public function dateRedac() { return $this->_dateRedac; }
		
		// Renvoi la valeur de l'attribut $auteurModif
		public function auteurModif() { return $this->_auteurModif; }
		
		// Renvoi la valeur de l'attribut $dateModif
		public function dateModif() { return $this->_dateModif; }
		
		// Renvoi la valeur de l'attribut $theme
		public function theme() { return $this->_theme; }
		
		// Renvoi la valeur de l'attribut $contenu
		public function contenu() { return $this->_contenu; }
		
		// SETTEURS    ///////////////
		
		// Modifie la valeur de l'attribut $ID
		public function set__id($ID) { $this->_ID = $ID; }
		
		// Modifie la valeur de l'attribut $titre
		public function set_titre($titre) { $this->_titre = $titre; }
		
		// Modifie la valeur de l'attribut $auteur
		public function set_auteur($auteur) { $this->_auteur = $auteur; }
		
		// Modifie la valeur de l'attribut $dateRedac
		public function set_dateRedac($dateRedac) { $this->_dateRedac = $dateRedac; }
		
		// Modifie la valeur de l'attribut $auteurModif
		public function set_auteurModif($auteurModif) { $this->_auteurModif = $auteurModif; }
		
		// Modifie la valeur de l'attribut $dateModif
		public function set_dateModif($dateModif) { $this->_dateModif = $dateModif; }
		
		// Modifie la valeur de l'attribut $theme
		public function set_theme($theme) { $this->_theme = $theme; }
		
		// Modifie la valeur de l'attribut $contenu
		public function set_contenu($contenu) { $this->_contenu = $contenu; }
	}
