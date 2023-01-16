<?php
/**
 * Classe Etat :
 * Etat d'une demande de congé ou d'un échange
 */
class Etat {

    private $id_etat;
    private $nom_etat;

    /**
     * Constructeur de la classe Etat
     * @param int $id_etat
     * @param string $nom_etat
     */
    public function __construct($id_etat, $nom_etat) {
        $this->id_etat = $id_etat;
        $this->nom_etat = $nom_etat;
    }

    /**
     * Getter de l'id de l'état
     * @return int
     */
    public function getIdEtat() {
        return $this->id_etat;
    }

    /**
     * Getter du nom de l'état
     * @return string
     */
    public function getNomEtat() {
        return $this->nom_etat;
    }

}