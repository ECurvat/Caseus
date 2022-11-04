<?php
class Etat {

    private $id_etat;
    private $nom_etat;

    public function __construct($id_etat, $nom_etat) {
        $this->id_etat = $id_etat;
        $this->nom_etat = $nom_etat;
    }

    public function getIdEtat() {
        return $this->id_etat;
    }

    public function getNomEtat() {
        return $this->nom_etat;
    }

}