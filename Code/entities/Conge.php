<?php
class Conge {

    private $id_demande;
    private $id_etat;
    private $id_employe;
    private $debut_conge;
    private $fin_conge;
    private $date_demande;

    public function __construct($id_demande, $id_etat, $id_employe, $debut_conge, $fin_conge, $date_demande) {
        $this->id_demande = $id_demande;
        $this->id_etat = $id_etat;
        $this->id_employe = $id_employe;
        $this->debut_conge = $debut_conge;
        $this->fin_conge = $fin_conge;
        $this->date_demande = $date_demande;
    }

    public function getIdDemande() {
        return $this->id_demande;
    }

    public function getIdEtat() {
        return $this->id_etat;
    }

    public function getIdEmploye() {
        return $this->id_employe;
    }

    public function getDebut() {
        return $this->debut_conge;
    }

    public function getFin() {
        return $this->fin_conge;
    }

    public function getDateDemande() {
        return $this->date_demande;
    }

}