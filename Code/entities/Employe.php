<?php
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

    public function __construct($id_employe, $nom, $prenom, $adresse_mail, $date_embauche, $adresse, $code_postal, $ville, $mdp, $position) {
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
    }

    public function getId() {
        return $this->id_employe;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getMail() {
        return $this->adresse_mail;
    }

    public function getEmbauche() {
        return $this->date_embauche;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getCodePostal() {
        return $this->code_postal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getPosition() {
        return $this->position;
    }

}