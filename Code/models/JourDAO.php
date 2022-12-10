<?php 
require_once(PATH_MODELS.'DAO.php');

class JourDAO extends DAO {

    public function getJoursParPlanning($idPlanning) {
        $result = $this->queryAll('SELECT * FROM JOUR WHERE ID_PLANNING = ?', array($idPlanning));
        if ($result) {
            $listeJours = array();
            foreach ($result as $elem) {
                $jour = new Jour($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6], $elem[7]);
                $listeJours[$elem[3]] = $jour;
            }
            return $listeJours;
        }
        return null;
    }

    public function getJourParPlanningEtNumero($para) {
        $result = $this->queryAll('SELECT * FROM JOUR WHERE ID_PLANNING = ? AND N_JOUR = ?', $para);
        if ($result) {
            $result = $result[0];
            $jour = new Jour($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7]);
            return $jour;
        }
        return null;
    }

    public function getJourParId($idJour) {
        $result = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour));
        if ($result) {
            $jour = new Jour($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7]);
            return $jour;
        }
        return null;
    }

    public function addJourConge($para) {
        $result = $this->queryRow('INSERT INTO JOUR (ID_PLANNING, N_JOUR, CONGE) VALUES (?, ?, 1)', $para);
        return $result;
    }

    public function changeToConge($id) {
        $result = $this->queryRow('UPDATE JOUR SET CONGE = 1, RETARD = NULL, DEBUT_JOURNEE = NULL, FIN_JOURNEE = NULL WHERE ID_JOUR = ?', array($id));
        return $result;
    }

}