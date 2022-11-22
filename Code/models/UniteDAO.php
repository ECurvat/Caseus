<?php 
require_once(PATH_MODELS.'DAO.php');

class UniteDAO extends DAO {

    public function getListeUnites() {
        $result = $this->queryAll('SELECT * FROM UNITE');
        if ($result) {
            $listeUnites = array();
            foreach ($result as $elem) {
                $unite = new Unite($elem[0], $elem[1]);
                array_push($listeUnites, $unite);
            }
            return $listeUnites;
        }
        return null;
    }

}