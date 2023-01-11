<?php
class Jour {

    private $id_jour;
    private $id_planning;
    private $n_jour;
    private $id_service;

    public function __construct($id_jour, $id_planning, $n_jour, $id_service) {
        $this->id_jour = $id_jour;
        $this->id_planning = $id_planning;
        $this->n_jour = $n_jour;
        $this->id_service = $id_service;
    }

    public function getIdJour() {
        return $this->id_jour;
    }

    public function getIdPlanning() {
        return $this->id_planning;
    }

    public function getNJour() {
        return $this->n_jour;
    }

    public function getIdService() {
        return $this->id_service;
    }

}