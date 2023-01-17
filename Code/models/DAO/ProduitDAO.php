<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des produits
 * @see Produit
 */
class ProduitDAO extends DAO {

    /**
     * Fonction qui permet de récupérer la liste de tous les produits
     * @return array
     */
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

    /**
     * Fonction qui ajoute une quantité d'un certain produit
     * @param array $para (quantité, id_produit)
     * @return int
     */
    public function ajouterQuantite($para) {
        $result = $this->queryRow('UPDATE PRODUIT SET QUANTITE_EN_STOCK = QUANTITE_EN_STOCK + ?, DERNIERE_MODIF = CURRENT_TIMESTAMP WHERE ID_PRODUIT = ?', $para);
        return $result;
    }

    /**
     * Fonction qui met à jour la quantité d'un produit
     * @param array $para (quantité, id_produit)
     * @return int
     */
    public function majQuantite($para) {
        $result = $this->queryRow('UPDATE PRODUIT SET QUANTITE_EN_STOCK = ?, DERNIERE_MODIF = CURRENT_TIMESTAMP WHERE ID_PRODUIT = ?', $para);
        return $result;
    }

}