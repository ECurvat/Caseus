<?php 
require_once(PATH_MODELS.'DAO.php');

class PlanningDAO extends DAO {

    public function getPlanningCourant($para) {
        $result = $this->queryRow('SELECT * FROM PLANNING WHERE ID_EMPLOYE = ? AND N_SEMAINE = ? AND ANNEE_PLANNING = ?', $para);
        if ($result) {
            $planning = new Planning($result[0], $result[1], $result[2], $result[3], $result[4]);
            return $planning;
        }
        return null;
    }

}