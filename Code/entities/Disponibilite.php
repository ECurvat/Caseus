<?php
class Disponibilite {

    private $id_dispo;
    private $id_employe;
    private $debut_dispo;
    private $fin_dispo;

    public function __construct($id_dispo, $id_employe, $debut_dispo, $fin_dispo) {
        $this->id_dispo = $id_dispo;
        $this->id_employe = $id_employe;
        $this->debut_dispo = $debut_dispo;
        $this->fin_dispo = $fin_dispo;
    }

    public function getIdDispo() {
        return $this->id_dispo;
    }

    public function getIdEmploye() {
        return $this->id_employe;
    }

    public function getDebutDispo() {
        return $this->debut_dispo;
    }

    public function getFinDispo() {
        return $this->fin_dispo;
    }

}