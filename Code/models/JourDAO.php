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

}