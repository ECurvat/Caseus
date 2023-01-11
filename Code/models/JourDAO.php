<?php 
require_once(PATH_MODELS.'DAO.php');

class JourDAO extends DAO {

    public function getJoursParPlanning($idPlanning) {
        $result = $this->queryAll('SELECT * FROM JOUR WHERE ID_PLANNING = ?', array($idPlanning));
        if ($result) {
            $listeJours = array();
            foreach ($result as $elem) {
                $jour = new Jour($elem[0], $elem[1], $elem[2], $elem[3]);
                $listeJours[$elem[2]] = $jour;
            }
            return $listeJours;
        }
        return null;
    }

    public function getJourParPlanningEtNumero($para) {
        $result = $this->queryRow('SELECT * FROM JOUR WHERE ID_PLANNING = ? AND N_JOUR = ?', $para);
        if ($result) {
            $jour = new Jour($result[0], $result[1], $result[2], $result[3]);
            return $jour;
        }
        return null;
    }

    public function getJourParId($idJour) {
        $result = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour));
        if ($result) {
            $jour = new Jour($result[0], $result[1], $result[2], $result[3]);
            return $jour;
        }
        return null;
    }

    public function addJour($para) {
        $result = $this->queryRow("INSERT INTO JOUR (ID_PLANNING, N_JOUR, ID_SERVICE) VALUES (?, ?, ?)", $para);
        return $result;
    }

    public function addJourConge($para) {
        $result = $this->queryRow("INSERT INTO JOUR (ID_PLANNING, N_JOUR, ID_SERVICE) VALUES (?, ?, 'y')", $para);
        return $result;
    }

    public function changeToConge($id) {
        $result = $this->queryRow("UPDATE JOUR SET ID_SERVICE = 'y' WHERE ID_JOUR = ?", array($id));
        return $result;
    }

    public function removeJoursParPlanning($id) {
        $result = $this->queryRow("DELETE FROM JOUR WHERE ID_PLANNING = ?", array($id));
        return $result;
    }

    public function echangerJours($idJour1, $idJour2) {
        // on met les 2 jours dans 2 variables
        $result1 = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour1));
        $result2 = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour2));
        if ($result1) {
            $jour1 = new Jour($result1[0], $result1[1], $result1[2], $result1[3]);
            $jour2 = new Jour($result2[0], $result2[1], $result2[2], $result2[3]);
            // on change id_service du jour 1 en id_service du jour 2
            $result3 = $this->queryRow('UPDATE JOUR 
                                        SET ID_SERVICE = ?
                                        WHERE ID_JOUR = ?', 
                                        array(
                                            $jour2->getIdService(), 
                                            $idJour1));
            // on change id_service du jour 2 en id_service du jour 1
            $result4 = $this->queryRow('UPDATE JOUR 
                                        SET ID_SERVICE = ?
                                        WHERE ID_JOUR = ?', 
                                        array(
                                            $jour1->getIdService(), 
                                            $idJour2));
            return $result3 && $result4;
        }        
        return null;
    }

}