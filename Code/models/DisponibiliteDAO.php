<?php 
require_once(PATH_MODELS.'DAO.php');

class DisponibiliteDAO extends DAO {

    public function getDispo($valeurs) {
        $result = $this->queryAll('SELECT * FROM DISPONIBILITE WHERE 
        ID_EMPLOYE = ? 
        AND EXTRACT(MONTH FROM DEBUT_DISPO) = ? 
        AND EXTRACT(YEAR FROM DEBUT_DISPO) = ?', $valeurs);
        if ($result) {
            $listeDispos = array();
            foreach ($result as $elem) {
                $dispo = new Disponibilite($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listeDispos, $dispo);
            }
            return $listeDispos;
        }
        return null;
    }

}