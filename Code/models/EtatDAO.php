<?php 
require_once(PATH_MODELS.'DAO.php');

class EtatDAO extends DAO {

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

    public function getEtatParId($id) {
        $result = $this->queryRow('SELECT * FROM ETAT WHERE ID_ETAT = ?', array($id));
        if ($result) {
            return new Etat($result[0], $result[1]);
        }
        return null;
    }

}