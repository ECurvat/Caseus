<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des états
 * @see Etat
 */
class EtatDAO extends DAO {

    /**
     * Fonction qui permet de récupérer la liste de tous les états
     * @return array
     */
    public function getListeEtats() {
        $result = $this->queryAll('SELECT * FROM ETAT');
        if ($result) {
            $listeEtats = array();
            foreach ($result as $elem) {
                $etat = new Etat($elem[0], $elem[1]);
                array_push($listeEtats, $etat);
            }
            return $listeEtats;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer un état par son id
     * @param int $id
     * @return Etat
     */
    public function getEtatParId($id) {
        $result = $this->queryRow('SELECT * FROM ETAT WHERE ID_ETAT = ?', array($id));
        if ($result) {
            return new Etat($result[0], $result[1]);
        }
        return null;
    }

}