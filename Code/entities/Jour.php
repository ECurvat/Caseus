<?php
/**
 * Classe Jour :
 * Jour d'un planning
 */
class Jour {

    private $id_jour;
    private $id_planning;
    private $n_jour;
    private $id_service;

    /**
     * Constructeur de la classe Jour
     * @param int $id_jour
     * @param int $id_planning
     * @param int $n_jour
     * @param int $id_service
     * @see Planning
     * @see Service
     */
    public function __construct($id_jour, $id_planning, $n_jour, $id_service) {
        $this->id_jour = $id_jour;
        $this->id_planning = $id_planning;
        $this->n_jour = $n_jour;
        $this->id_service = $id_service;
    }

    /**
     * Getter de l'id du jour
     * @return int
     */
    public function getIdJour() {
        return $this->id_jour;
    }

    /**
     * Getter de l'id du planning
     * @see Planning
     * @return int
     */
    public function getIdPlanning() {
        return $this->id_planning;
    }

    /**
     * Getter du numéro du jour
     * @return int
     */
    public function getNJour() {
        return $this->n_jour;
    }

    /**
     * Getter de l'id du service
     * @see Service
     * @return int
     */
    public function getIdService() {
        return $this->id_service;
    }

}