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

    public function getEchangesEnvoyes($param) {
        $result = $this->queryAll('SELECT * FROM ECHANGE WHERE ID_EMPLOYE_EMETTEUR = ? AND EXTRACT(YEAR FROM DATE_PROPOSITION) = ?', $param);
        if ($result) {
            $listeEnvoyes = array();
            foreach ($result as $elem) {
                $echange = new Echange($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6]);
                array_push($listeEnvoyes, $echange);
            }
            return $listeEnvoyes;
        }
        return null;
    }

    public function getEchangesRecus($param) {
        $result = $this->queryAll('SELECT * FROM ECHANGE WHERE ID_ETAT = 3 AND ID_EMPLOYE_RECEPTEUR = ? AND EXTRACT(YEAR FROM DATE_PROPOSITION) = ?', $param);
        if ($result) {
            $listeRecus = array();
            foreach ($result as $elem) {
                $echange = new Echange($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6]);
                array_push($listeRecus, $echange);
            }
            return $listeRecus;
        }
        return null;
    }

}