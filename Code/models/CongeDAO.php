<?php 
require_once(PATH_MODELS.'DAO.php');

class CongeDAO extends DAO {

    public function getCongeParDateParEmploye($valeurs) {
        $result = $this->queryAll('SELECT * FROM CONGE 
                                    WHERE ID_EMPLOYE = ?
                                    AND EXTRACT(YEAR FROM DEBUT_CONGE) = ?', $valeurs);
        if ($result) {
            $listeConges = array();
            foreach ($result as $elem) {
                $conge = new Conge($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5]);
                array_push($listeConges, $conge);
            }
            return $listeConges;
        }
        return null;
    }

    public function addConge($valeurs) {
        $result = $this->queryRow('INSERT INTO CONGE (ID_ETAT, ID_EMPLOYE, DEBUT_CONGE, FIN_CONGE, DATE_DEMANDE) VALUES (3, ?, ?, ?, CURRENT_TIMESTAMP)', $valeurs);
        return $result;
    }

    public function removeConge($valeurs) {
        $result = $this->queryRow('DELETE FROM CONGE WHERE ID_DEMANDE = ?', array($valeurs));
        return $result;
    }

}