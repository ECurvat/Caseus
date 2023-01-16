<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

class ProduitDAO extends DAO {

    public function getListeProduits() {
        $result = $this->queryAll('SELECT * FROM PRODUIT');
        if ($result) {
            $listeProduits = array();
            foreach ($result as $elem) {
                $produit = new Produit($elem[0], $elem[1], $elem[2], $elem[3], $elem[4]);
                array_push($listeProduits, $produit);
            }
            return $listeProduits;
        }
        return null;
    }

    public function ajouterQuantite($para) {
        $result = $this->queryRow('UPDATE PRODUIT SET QUANTITE_EN_STOCK = QUANTITE_EN_STOCK + ?, DERNIERE_MODIF = CURRENT_TIMESTAMP WHERE ID_PRODUIT = ?', $para);
        return $result;
    }

    public function majQuantite($para) {
        $result = $this->queryRow('UPDATE PRODUIT SET QUANTITE_EN_STOCK = ?, DERNIERE_MODIF = CURRENT_TIMESTAMP WHERE ID_PRODUIT = ?', $para);
        return $result;
    }

}