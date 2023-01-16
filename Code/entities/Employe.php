<?php
/**
 * Classe Employe :
 * Employé de l'entreprise
 */
class Employe {

    private $id_employe;
    private $nom;
    private $prenom;
    private $adresse_mail;
    private $date_embauche;
    private $adresse;
    private $code_postal;
    private $ville;
    private $mdp;
    private $position;
    private $heures_sup;

    /**
     * Constructeur de la classe Employe
     * @param int $id_employe
     * @param string $nom
     * @param string $prenom
     * @param string $adresse_mail
     * @param string $date_embauche
     * @param string $adresse
     * @param int $code_postal
     * @param string $ville
     * @param string $mdp
     * @param string $position
     * @param int $heures_sup
     */
    public function __construct($id_employe, $nom, $prenom, $adresse_mail, $date_embauche, $adresse, $code_postal, $ville, $mdp, $position, $heures_sup) {
        $this->id_employe = $id_employe;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse_mail = $adresse_mail;
        $this->date_embauche = $date_embauche;
        $this->adresse = $adresse;
        $this->code_postal = $code_postal;
        $this->ville = $ville;
        $this->mdp = $mdp;
        $this->position = $position;
        $this->heures_sup = $heures_sup;
    }

    /**
     * Getter de l'id de l'employé
     * @return int
     */
    public function getId() {
        return $this->id_employe;
    }

    /**
     * Getter du nom de l'employé
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Getter du prénom de l'employé
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Getter de l'adresse mail de l'employé
     * @return string
     */
    public function getMail() {
        return $this->adresse_mail;
    }

    /**
     * Getter de la date d'embauche de l'employé
     * @return string
     */
    public function getEmbauche() {
        return $this->date_embauche;
    }

    /**
     * Getter de l'adresse de l'employé
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Getter du code postal de l'employé
     * @return int
     */
    public function getCodePostal() {
        return $this->code_postal;
    }

    /**
     * Getter de la ville de l'employé
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Getter du mot de passe de l'employé
     * @return string
     */
    public function getMdp() {
        return $this->mdp;
    }

    /**
     * Getter de la position de l'employé 
     * @return string (POLY/ASSI/MANA)
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Getter des heures supplémentaires de l'employé
     * @return int
     */
    public function getHeuresSup() {
        return $this->heures_sup;
    }

}