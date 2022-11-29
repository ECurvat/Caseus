<?php
class Jour {

    private $id_jour;
    private $id_planning;
    private $id_echange;
    private $n_jour;
    private $retard;
    private $debut_journee;
    private $fin_journee;
    private $conge;

    public function __construct($id_jour, $id_planning, $id_echange, $n_jour, $retard, $debut_journee, $fin_journee, $conge) {
        $this->id_jour = $id_jour;
        $this->id_planning = $id_planning;
        $this->id_echange = $id_echange;
        $this->n_jour = $n_jour;
        $this->retard = $retard;
        $this->debut_journee = $debut_journee;
        $this->fin_journee = $fin_journee;
        $this->conge = $conge;
    }

    public function getIdJour() {
        return $this->id_jour;
    }

    public function getIdPlanning() {
        return $this->id_planning;
    }

    public function getIdEchange() {
        return $this->id_echange;
    }

    public function getNJour() {
        return $this->n_jour;
    }

    public function getRetard() {
        return $this->retard;
    }

    public function getDebutJournee() {
        return $this->debut_journee;
    }

    public function getFinJournee() {
        return $this->fin_journee;
    }

    public function getConge() {
        return $this->conge;
    }

}