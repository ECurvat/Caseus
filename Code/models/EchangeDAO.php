<?php 
require_once(PATH_MODELS.'DAO.php');

class EchangeDAO extends DAO {

    public function addEchange($para) {
        $result = $this->queryRow('INSERT INTO echange (ID_ETAT, ID_JOUR_EMETTEUR, ID_EMPLOYE_EMETTEUR, ID_JOUR_RECEPTEUR, ID_EMPLOYE_RECEPTEUR, DATE_PROPOSITION) VALUES (3, ?, ?, ?, ?, CURRENT_TIMESTAMP)', $para);
        return $result;
    }

    public function verifEchangeEnCours($idJourEmet) {
        $result = $this->queryRow('SELECT * FROM ECHANGE WHERE ID_ETAT = 3 AND ID_JOUR_EMETTEUR = ?', array($idJourEmet));
        if (!$result) {
            return null;
        }
        return true;
    }

}