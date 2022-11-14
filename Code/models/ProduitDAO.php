<?php 
require_once(PATH_MODELS.'DAO.php');

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

}