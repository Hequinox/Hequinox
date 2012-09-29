<?php
/*
TODO :

END TODO
------------
SOMMAIRE : 

Variable : $dao
Const : ATTR_MEMBRE, ATTR_ID, ATTR_PSEUDO
__construct(PDO $dao)
add(Membre $membre)
update(Membre $membre)
get($info) //Pseudo or id
delete($info, $type = ATTR_MEMBRE)
getList()
exists()
setdao()

END SOMMAIRE

SQL STRUCTURE :

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `banned` tinyint(1) NOT NULL,
  `date_register` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`,`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

END SQL
*/
class MembreManagerPDO extends MembreManager
{
	protected $dao;

	const ATTR_MEMBRE	= 100;
	const ATTR_ID		= 101;
	const ATTR_PSEUDO	= 102;

	function __construct(PDO $dao) {}
		parent::__construct($dao);
	}

	public function add(Membre $membre) {
		if (!$membre->isValid()) {
			throw new Exception("Les informations du membre sont invalides.");
		}
		$sql  = "INSERT INTO membres(pseudo, nom, prenom, mdp, mail, tel, date_register, description, banned)
				VALUES(:pseudo, :nom, :prenom, :mdp, :mail, :tel, NOW(), :description, 0)";
		$q = $this->dao->prepare($sql);

		$mdp = $membre->mdp();
		$mdp_hashed = md5($mdp);

		$q->bindValue(':pseudo', $membre->pseudo(), PDO::PARAM_STR);
		$q->bindValue(':nom', $membre->nom(), PDO::PARAM_STR);
		$q->bindValue(':prenom', $membre->prenom(), PDO::PARAM_STR);
		$q->bindValue(':mdp', $mdp_hashed, PDO::PARAM_STR);
		$q->bindValue(':mail', $membre->mail(), PDO::PARAM_STR);
		$q->bindValue(':tel', $membre->tel(), PDO::PARAM_STR);
		$q->bindValue(':description', $membre->description(), PDO::PARAM_STR);
		$q->execute();

		return true;
	}

	public function update(Membre $membre) {
		if (!$membre->isValid()) {
			throw new Exception("Les informations du membre sont invalides.");
		}
		$sql  = "UPDATE membres SET
				pseudo 		= :pseudo,
				nom 		= :nom,
				prenom 		= :prenom,
				mdp 		= :mdp,
				mail 		= :mail,
				tel 		= :tel,
				description = :description,
				banned = :banned
			WHERE id = :id";
		$q = $this->dao->prepare($sql);

		$mdp = $membre->mdp();
		$mdp_hashed = md5($mdp);

		$q->bindValue(':pseudo', $membre->pseudo(), PDO::PARAM_STR);
		$q->bindValue(':nom', $membre->nom(), PDO::PARAM_STR);
		$q->bindValue(':prenom', $membre->prenom(), PDO::PARAM_STR);
		$q->bindValue(':mdp', $mdp_hashed, PDO::PARAM_STR);
		$q->bindValue(':mail', $membre->mail(), PDO::PARAM_STR);
		$q->bindValue(':tel', $membre->tel(), PDO::PARAM_STR);
		$q->bindValue(':description', $membre->description(), PDO::PARAM_STR);
		$q->bindValue(':banned', $banned, PDO::PARAM_BOOL);

		$q->bindValue(':id', $membre->id(), PDO::PARAM_INT);
		return $q->execute(); //True on success, false on failure
	}

	public function get($info) { //Pseudo or id
		if (is_int($info)) {
			$sql = "SELECT * WHERE id = :info";
			$info_param_type = PDO::PARAM_INT;
		} else {
			$sql = "SELECT * WHERE pseudo = :info";
			$info_param_type = PDO::PARAM_STR;
		}
		$q = $this->dao->prepare($sql);
		$mdp_hashed = md5($mdp);
		$q->bindValue(':info', $info, $info_param_type);
		$q->execute();
		$q->closeCursor();
		return new Membre($q->fetch(PDO::FETCH_ASSOC));
	}

	public function delete($info, $type = MembreManagerPDO::ATTR_MEMBRE) {
		if ($type == MembreManagerPDO::ATTR_ID) {
			$sql = "DELETE FROM membres WHERE id = :info";
			$info_param_type = PDO::PARAM_INT;
		} elseif ($type == self::ATTR_MEMBRE) {
			if ($info instanceof self) {
				$sql = "DELETE FROM membres WHERE id = :info";
				$info = $info->id();
				$info_param_type = PDO::PARAM_INT
			} else {
				throw new InvalidArgumentException("L'objet passé en paramètre n'est pas un Membre");
			}
		} else {
			$sql = "DELETE FROM membres WHERE pseudo = :info";
			$info_param_type = PDO::PARAM_STR;
		}
		$q = $this->dao->prepare($sql);
		$q->bindValue(':info', $info, $info_param_type);
		return $q->execute();
	}

	public function getList() {
		$sql = "SELECT * FROM membres";
		$q = $this->dao->query($sql);
		while ($membre = $q->fetch(PDO::FETCH_ASSOC)) {
			$membres[] = new Membre($membre);
		}
		return $membres;
	}

	public function exists($info) {
		if (is_int($info)) {
			$sql = "SELECT COUNT(*) as nbmatch WHERE id = :info";
			$info_param_type = PDO::PARAM_INT;
		} else {
			$sql = "SELECT COUNT(*) as nbmatch WHERE pseudo = :info";
			$info_param_type = PDO::PARAM_STR;
		}
		$q = $this->dao->prepare($sql);
		$q->bindValue(':info', $info, $info_param_type);
		$q->execute()
		return (bool) $q->fetchColumn; //Convertit en booléen le résulat
	}

	//Setter
	public function setDao(PDO $dao) { $this->dao = $dao; }
}