<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des plannings
 * @see Planning
 */
class PlanningDAO extends DAO {

    /**
     * Fonction qui permet de récupérer un planning par son id d'employé, le numéro de la semaine et l'année
     * @param array $para (idEmploye, numeroSemaine, anneePlanning)
     * @return Planning
     */
    public function getPlanningParEmp($para) {
        $result = $this->queryRow('SELECT * FROM PLANNING WHERE (ID_EMPLOYE = ?) AND (N_SEMAINE = ?) AND (ANNEE_PLANNING = ?)', $para);
        if ($result) {
            $planning = new Planning($result[0], $result[1], $result[2], $result[3]);
            return $planning;
        }
        return null;
    }

    /**
     * Fonction qui permet d'ajouter un planning
     * @param array $para (idEmploye, numeroSemaine, anneePlanning)
     * @return int
     */
    public function addPlanning($para) {
        $result = $this->queryRow('INSERT INTO PLANNING (ID_EMPLOYE, N_SEMAINE, ANNEE_PLANNING) VALUES (?, ?, ?)', $para);
        return $result;
    }

    /**
     * Fonction qui permet de supprimer un planning
     * @param int $id
     * @return int
     */
    public function removePlanning($id) {
        $result = $this->queryRow('DELETE FROM PLANNING WHERE ID_PLANNING = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui permet de récupérer tous les plannings pour une semaine et année
     * @param array $para (numeroSemaine, anneePlanning)
     * @return array
     */
    public function getPlanningsTousEmps($para) {
        $result = $this->queryAll('SELECT * FROM PLANNING WHERE N_SEMAINE = ? AND ANNEE_PLANNING = ?', $para);
        if ($result) {
            $listePlannings = array();
            foreach ($result as $elem) {
                $planning = new Planning($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listePlannings, $planning);
            }
            return $listePlannings;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer tous les plannings d'un employé
     * @param int $id
     * @return array
     */
    public function getTousPlanningsParEmp($id) {
        $result = $this->queryAll('SELECT * FROM PLANNING WHERE ID_EMPLOYE = ?', array($id));
        if ($result) {
            $listePlannings = array();
            foreach ($result as $elem) {
                $planning = new Planning($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listePlannings, $planning);
            }
            return $listePlannings;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer un planning par son id
     * @param int $id
     * @return Planning
     */
    public function getPlanningParId($id) {
        $result = $this->queryRow('SELECT * FROM PLANNING WHERE ID_PLANNING = ?', array($id));
        if ($result) {
            $planning = new Planning($result[0], $result[1], $result[2], $result[3]);
            return $planning;
        }
        return null;
    }

}