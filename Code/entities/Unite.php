<?php
class Unite {

    private $id_unite;
    private $nom_unite;

    public function __construct($id_unite, $nom_unite) {
        $this->id_unite = $id_unite;
        $this->nom_unite = $nom_unite;
    }

    public function getIdUnite() {
        return $this->id_unite;
    }

    public function getNomUnite() {
        return $this->nom_unite;
    }

}