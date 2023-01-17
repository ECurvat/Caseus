<?php
/**
 * Classe Unite :
 * Unité de mesure d'un produit
 */
class Unite {

    private $id_unite;
    private $nom_unite;

    /**
     * Constructeur de la classe Unite
     * @param int $id_unite
     * @param string $nom_unite
     */
    public function __construct($id_unite, $nom_unite) {
        $this->id_unite = $id_unite;
        $this->nom_unite = $nom_unite;
    }

    /**
     * Getter de l'id de l'unité
     * @return int
     */
    public function getIdUnite() {
        return $this->id_unite;
    }

    /**
     * Getter du nom de l'unité
     * @return string
     */
    public function getNomUnite() {
        return $this->nom_unite;
    }

}