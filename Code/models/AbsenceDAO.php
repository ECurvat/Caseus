<?php 
require_once(PATH_MODELS.'DAO.php');

class AbsenceDAO extends DAO {

    public function getAbsenceParDateParEmploye($valeurs) {
        $result = $this->queryAll('SELECT * FROM ABSENCE WHERE 
        ID_EMPLOYE = ? 
        AND EXTRACT(MONTH FROM DEBUT_ABSENCE) = ? 
        AND EXTRACT(YEAR FROM DEBUT_ABSENCE) = ?', $valeurs);
        if ($result) {
            $listeAbsences = array();
            foreach ($result as $elem) {
                $abs = new Absence($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listeAbsences, $abs);
            }
            return $listeAbsences;
        }
        return null;
    }

    public function getAbsenceParDate($valeurs) {
        $result = $this->queryAll('SELECT * FROM ABSENCE WHERE 
        EXTRACT(MONTH FROM DEBUT_ABSENCE) = ? 
        AND EXTRACT(YEAR FROM DEBUT_ABSENCE) = ?', $valeurs);
        if ($result) {
            $listeAbsences = array();
            foreach ($result as $elem) {
                $abs = new Absence($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listeAbsences, $abs);
            }
            return $listeAbsences;
        }
        return null;
    }

    public function getAbsenceParId($id) {
        $result = $this->queryRow('SELECT * FROM ABSENCE WHERE ID_ABSENCE = ?', array($id));
        if ($result) {
            $abs = new Absence($result[0], $result[1], $result[2], $result[3]);
            return $abs;
        }
        return null;
    }

    public function getAbsenceParJourEtEmp($para) {
        $result = $this->queryAll('SELECT * FROM ABSENCE 
        WHERE ID_EMPLOYE = ? 
        AND DATE(DEBUT_ABSENCE) = ?', $para);
        if ($result) {
            $listeAbsences = array();
            foreach ($result as $elem) {
                $abs = new Absence($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listeAbsences, $abs);
            }
            return $listeAbsences;
        }
        return null;
    }

    public function modifierAbsenceParId($absModifiee) {
        $param = array(str_replace("T", " ", $absModifiee->getDebut()), str_replace("T", " ", $absModifiee->getFin()), (int) $absModifiee->getIdAbsence());
        $result = $this->queryRow('UPDATE ABSENCE SET 
        DEBUT_ABSENCE = ?,
        FIN_ABSENCE = ?
        WHERE ID_ABSENCE = ?', $param);
    }

    public function supprimerAbsenceParId($id) {
        $result = $this->queryRow('DELETE FROM ABSENCE WHERE ID_ABSENCE = ?', array($id));
        return $result;
    }

    public function ajouterAbsence($params) {
        $result = $this->queryRow('INSERT INTO ABSENCE (ID_EMPLOYE, DEBUT_ABSENCE, FIN_ABSENCE) VALUES(?, ?, ?)', $params);
        return $result;
    }

}