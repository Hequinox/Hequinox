<?php
/*
TODO :
setDate_register : Vérifier le formet de date
setNom : Vérification de la chaine
setPseudo : Vérification de la chaine
Setters :
	Message d'exceptions à reformuler
	(?) Mettre des codes erreur aux exceptions : throw new Exception("Message de l'exception, (int) $codePerso)
	(?) Des Exceptions plus précises pour les conditions requises aux pseudos, noms, prénoms (eg: longueur, caractères)

END TODO
------------
SOMMAIRE :

Attributs: id, nom, prenom, pseudo, mdp, mail, tel, ip, banned, date_register, description, afk, online

Methods: 
__construct(array $data) Hydrate l'objet
hydrate(array $data) Hydrate l'objet
*isStatus*:
	isValid() True si toutes les informations sont valides et si l'objet a tous les attributs nécessaires
	isAfk() True si AFK
	isBanned() True si banni
	isOnline() True si connecté
Setters: setAttr($value)
Getters: attr()

END SOMMAIRE
*/
class Membre {
	protected $id;
	protected $nom;
	protected $prenom;
	protected $pseudo;
	protected $mdp;
	protected $mail;
	protected $tel;
	protected $ip;
	protected $banned;
	protected $date_register;
	protected $description;
	protected $afk;
	protected $online;

	public function __construct(array $data) {
		$this->hydrate($data);
	}

	public function hydrate(array $data) {
		foreach ($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (is_callable(array($this, $method))) {
				$this->$method($value);
			}
		}
	}

	public function connect() { $this->setOnline(true); }
	public function disconnect() { $this->setOnline(false); }

	//Is status
	public function isValid() {
		if (empty($this->pseudo) || empty($this->mail) || empty($this->mdp)) {
			return false;
		}
		return true;
	}

	public function isAfk() { return $this->afk(); }
	public function isBanned() { return $this->banned(); }
	public function isOnline() { return $this->online(); }

	//Setters & Getters	
	public function setId($value) {
		$this->id = (int) $value;
	}

	public function setNom($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException("Le nom est invalide.");
		}
		$this->nom = $value;
	}

	public function setPrenom($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException("Le prenom est invalide.");
		}
		$this->prenom = $value;
	}

	public function setPseudo($value) {
		if (!preg_match("#^([A-Za-z0-9_.-]{4,20})$#", $value)) {
			throw new InvalidArgumentException("Le pseudo est invalide.");
		}
		$this->pseudo = $value;
	}

	public function setMdp($value) {
		if (!preg_match("#[A-Za-z0-9]{8,32}#", $value)) {
			throw new InvalidArgumentException("Le mdp est invalide.");
		}
		$this->mdp = $value;
	}

	public function setMail($value) {
		if (!preg_match("#^([A-Za-z0-9_.-]+)@([A-Za-z0-9-]{2,})\.([A-Za-z]{2,4})$#", $value)) {
			throw new InvalidArgumentException("Le mail est invalide.");
		}
		$this->mail = $value;
	}

	public function setTel($value) {
		if (!preg_match("#^(+?)([0-9(). _-]{10,20})$#", $value)) {
			throw new InvalidArgumentException("Le tel est invalide.");
		}
		$this->tel = $value;
	}

	public function setIp($value) {
		if (!preg_match("#^([0-9]{1,3}\.){3}([0-9]{1,3})$#", $value)) {
			throw new InvalidArgumentException("Le ip est invalide.");
		}
		$this->ip = $value;
	}

	public function setBanned($value) {
		$value = ($value == 1) ? true : $value;
		$value = ($value == 0) ? false : $value;
		if (!is_bool($value)) {
			throw new InvalidArgumentException("Le banned est invalide.");
		}
		$this->banned = $value;
	}

	public function setDate_register($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException("Le date_register est invalide.");
		}
		$this->date_register = $value;
	}

	public function setDescription($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException("Le description est invalide.");
		}
		$this->description = $value;
	}

	public function setAfk($value) {
		if (!is_string($value)) {
			throw new InvalidArgumentException("Le afk est invalide.");
		}
		$this->afk = $value;
	}

	public function setOnline($value) {
		if (!is_bool($value)) {
			throw new InvalidArgumentException("Le online est invalide.");
		}
		$this->online = $value;
	}

	//Getters
	public function id() { return $this->id; }
	public function nom() { return $this->nom; }
	public function prenom() { return $this->prenom; }
	public function pseudo() { return $this->pseudo; }
	public function mdp() { return $this->mdp; }
	public function mail() { return $this->mail; }
	public function tel() { return $this->tel; }
	public function ip() { return $this->ip; }
	public function banned() { return $this->banned; }
	public function date_register() { return $this->date_register; }
	public function description() { return $this->description; }
	public function afk() { return $this->afk; }
	public function online() { return $this->online; }
} 