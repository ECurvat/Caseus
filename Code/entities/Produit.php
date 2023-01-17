<?php
/**
 * Classe Produit :
 * Produit du stock
 */
class Produit {

    private $id_produit;
    private $id_unite;
    private $denomination;
    private $derniere_modif;
    private $quantite_en_stock;

    /**
     * Constructeur de la classe Produit
     * @param int $id_produit
     * @param int $id_unite
     * @param string $denomination
     * @param string $derniere_modif
     * @param int $quantite_en_stock
     * @see Unite
     */
    public function __construct($id_produit, $id_unite, $denomination, $derniere_modif, $quantite_en_stock) {
        $this->id_produit = $id_produit;
        $this->id_unite = $id_unite;
        $this->denomination = $denomination;
        $this->derniere_modif = $derniere_modif;
        $this->quantite_en_stock = $quantite_en_stock;
    }

    /**
     * Getter de l'id du produit
     * @return int
     */
    public function getIdProduit() {
        return $this->id_produit;
    }

    /**
     * Getter de l'id de l'unité
     * @see Unite
     * @return int
     */
    public function getIdUnite() {
        return $this->id_unite;
    }

    /**
     * Getter de la dénomination du produit
     * @return string
     */
    public function getDenomination() {
        return $this->denomination;
    }

    /**
     * Getter de la date de dernière modification
     * @return string
     */
    public function getDerniereModif() {
        return $this->derniere_modif;
    }

    /**
     * Getter de la quantité en stock
     * @return int
     */
    public function getQteEnStock() {
        return $this->quantite_en_stock;
    }

}