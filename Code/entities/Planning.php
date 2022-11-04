<?php
class Planning {

    private $id_planning;
    private $id_employe;
    private $id_etat;
    private $n_semaine;
    private $annee_planning;

    public function __construct($id_planning, $id_employe, $id_etat, $n_semaine, $annee_planning) {
        $this->id_planning = $id_planning;
        $this->id_employe = $id_employe;
        $this->id_etat = $id_etat;
        $this->n_semaine = $n_semaine;
        $this->annee_planning = $annee_planning;
    }

    public function getIdPlanning() {
        return $this->id_planning;
    }

    public function getIdEmploye() {
        return $this->id_employe;
    }

    public function getIdEtat() {
        return $this->id_etat;
    }

    public function getNSemaine() {
        return $this->n_semaine;
    }

    public function getAnneePlanning() {
        return $this->annee_planning;
    }

}