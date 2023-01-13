<?php 
require_once(PATH_MODELS.'DAO.php');

class PlanningDAO extends DAO {

    public function getPlanningParEmp($para) {
        $result = $this->queryRow('SELECT * FROM PLANNING WHERE (ID_EMPLOYE = ?) AND (N_SEMAINE = ?) AND (ANNEE_PLANNING = ?)', $para);
        if ($result) {
            $planning = new Planning($result[0], $result[1], $result[2], $result[3], $result[4]);
            return $planning;
        }
        return null;
    }

    public function addPlanning($para) {
        $result = $this->queryRow('INSERT INTO PLANNING (ID_EMPLOYE, ID_ETAT, N_SEMAINE, ANNEE_PLANNING) VALUES (?, 1, ?, ?)', $para);
        return $result;
    }
    public function removePlanning($id) {
        $result = $this->queryRow('DELETE FROM PLANNING WHERE ID_PLANNING = ?', array($id));
        return $result;
    }

    public function getPlanningsTousEmps($para) {
        $result = $this->queryAll('SELECT * FROM PLANNING WHERE N_SEMAINE = ? AND ANNEE_PLANNING = ?', $para);
        if ($result) {
            $listePlannings = array();
            foreach ($result as $elem) {
                $planning = new Planning($elem[0], $elem[1], $elem[2], $elem[3], $elem[4]);
                array_push($listePlannings, $planning);
            }
            return $listePlannings;
        }
        return null;
    }

    public function getTousPlanningsParEmp($id) {
        $result = $this->queryAll('SELECT * FROM PLANNING WHERE ID_EMPLOYE = ?', array($id));
        if ($result) {
            $listePlannings = array();
            foreach ($result as $elem) {
                $planning = new Planning($elem[0], $elem[1], $elem[2], $elem[3], $elem[4]);
                array_push($listePlannings, $planning);
            }
            return $listePlannings;
        }
        return null;
    }

    public function getPlanningParId($id) {
        $result = $this->queryRow('SELECT * FROM PLANNING WHERE ID_PLANNING = ?', array($id));
        if ($result) {
            $planning = new Planning($result[0], $result[1], $result[2], $result[3], $result[4]);
            return $planning;
        }
        return null;
    }

}