<?php
class Absence {

    private $id_absence;
    private $id_employe;
    private $debut;
    private $fin;

    public function __construct($id_absence, $id_employe, $debut, $fin) {
        $this->id_absence = $id_absence;
        $this->id_employe = $id_employe;
        $this->debut = $debut;
        $this->fin = $fin;
    }

    public function getIdAbsence() {
        return $this->id_absence;
    }

    public function getIdEmploye() {
        return $this->id_employe;
    }

    public function getDebut() {
        return $this->debut;
    }

    public function getFin() {
        return $this->fin;
    }

}