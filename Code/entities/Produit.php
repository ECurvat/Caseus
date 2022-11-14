<?php
class Produit {

    private $id_produit;
    private $id_unite;
    private $denomination;
    private $derniere_modif;
    private $quantite_en_stock;

    public function __construct($id_produit, $id_unite, $denomination, $derniere_modif, $quantite_en_stock) {
        $this->id_produit = $id_produit;
        $this->id_unite = $id_unite;
        $this->denomination = $denomination;
        $this->derniere_modif = $derniere_modif;
        $this->quantite_en_stock = $quantite_en_stock;
    }

    public function getIdProduit() {
        return $this->id_produit;
    }

    public function getIdUnite() {
        return $this->id_unite;
    }

    public function getDenomination() {
        return $this->denomination;
    }

    public function getDerniereModif() {
        return $this->derniere_modif;
    }

    public function getQteEnStock() {
        return $this->quantite_en_stock;
    }

}