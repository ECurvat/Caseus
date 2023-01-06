<?php
class Service {

    private $id_service;
    private $nombre;
    private $debut;
    private $fin;

    public function __construct($id_service, $nombre, $debut, $fin) {
        $this->id_service = $id_service;
        $this->nombre = $nombre;
        $this->debut = $debut;
        $this->fin = $fin;
    }

    public function getId() {
        return $this->id_service;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDebut() {
        return $this->debut;
    }

    public function getFin() {
        return $this->fin;
    }

}