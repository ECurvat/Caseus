<?php
/**
 * Classe Service :
 * Service d'un planning
 */
class Service {

    private $id_service;
    private $nombre;
    private $debut;
    private $fin;

    /**
     * Constructeur de la classe Service
     * @param int $id_service
     * @param int $nombre
     * @param string $debut
     * @param string $fin
     */
    public function __construct($id_service, $nombre, $debut, $fin) {
        $this->id_service = $id_service;
        $this->nombre = $nombre;
        $this->debut = $debut;
        $this->fin = $fin;
    }

    /**
     * Getter de l'id du service
     * @return int
     */
    public function getId() {
        return $this->id_service;
    }

    /**
     * Getter du nombre de personnes qui effectuent ce service par jour
     * @return int
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Getter de l'heure de début du service
     * @return string
     */
    public function getDebut() {
        return $this->debut;
    }

    /**
     * Getter de l'heure de fin du service
     * @return string
     */
    public function getFin() {
        return $this->fin;
    }

}