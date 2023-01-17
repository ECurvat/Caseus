<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des absences
 * @see Absence
 */
class AbsenceDAO extends DAO {

    /**
     * Fonction qui permet de récupérer toutes les absences d'un employé pour un mois et une année donnée
     * @param array $valeurs (idEmploye, mois, année)
     */
    public function getAbsenceParDateParEmploye($valeurs) {
        $result = $this->queryAll('SELECT * 
                                    FROM ABSENCE 
                                    WHERE ID_EMPLOYE = ? 
                                        AND EXTRACT(MONTH FROM DEBUT_ABSENCE) = ? 
                                        AND EXTRACT(YEAR FROM DEBUT_ABSENCE) = ?', 
                                    $valeurs);
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

    /**
     * Fonction qui permet de récupérer toutes les absences de tous les employés pour un mois et une année donnée
     * @param array $valeurs (mois, année)
     */
    public function getAbsenceParDate($valeurs) {
        $result = $this->queryAll('SELECT * 
                                    FROM ABSENCE 
                                    WHERE EXTRACT(MONTH FROM DEBUT_ABSENCE) = ? 
                                        AND EXTRACT(YEAR FROM DEBUT_ABSENCE) = ?', 
                                    $valeurs);
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

    /**
     * Fonction qui permet de récupérer une absence par son id
     * @param int $id
     */
    public function getAbsenceParId($id) {
        $result = $this->queryRow('SELECT * FROM ABSENCE WHERE ID_ABSENCE = ?', array($id));
        if ($result) {
            $abs = new Absence($result[0], $result[1], $result[2], $result[3]);
            return $abs;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer l'absence d'un employé pour un jour donné
     * @param array $para (idEmploye, date)
     */
    public function getAbsenceParJourEtEmp($para) {
        $result = $this->queryAll('SELECT * 
                                    FROM ABSENCE 
                                    WHERE ID_EMPLOYE = ? 
                                        AND DATE(DEBUT_ABSENCE) = ?', 
                                    $para);
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

    /**
     * Fonction qui permet de modifier une absence par son id
     * @param Absence $absModifiee
     */
    public function modifierAbsenceParId($absModifiee) {
        $param = array(
            str_replace("T", " ", $absModifiee->getDebut()), 
            str_replace("T", " ", $absModifiee->getFin()), 
            (int) $absModifiee->getIdAbsence()
        );
        $result = $this->queryRow('UPDATE ABSENCE SET 
                                    DEBUT_ABSENCE = ?,
                                    FIN_ABSENCE = ?
                                    WHERE ID_ABSENCE = ?', 
                                    $param);
    }

    /**
     * Fonction qui permet de supprimer une absence par son id
     * @param int $id
     */
    public function supprimerAbsenceParId($id) {
        $result = $this->queryRow('DELETE FROM ABSENCE WHERE ID_ABSENCE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui permet de supprimer toutes les absences d'un employé
     * @param int $id
     */
    public function removeAbsencesParEmp($id) {
        $result = $this->queryRow('DELETE FROM ABSENCE WHERE ID_EMPLOYE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui permet d'ajouter une absence
     * @param array $params (idEmploye, debut, fin)
     */
    public function ajouterAbsence($params) {
        $result = $this->queryRow('INSERT INTO ABSENCE (ID_EMPLOYE, DEBUT_ABSENCE, FIN_ABSENCE) VALUES(?, ?, ?)', $params);
        return $result;
    }

}