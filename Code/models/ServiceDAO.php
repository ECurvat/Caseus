<?php 
require_once(PATH_MODELS.'DAO.php');

class ServiceDAO extends DAO {

    public function getListeServices() {
        $result = $this->queryAll('SELECT * FROM SERVICE');
        if ($result) {
            $listeServices = array();
            foreach ($result as $elem) {
                $service = new Service($elem[0], $elem[1], $elem[2], $elem[3]);
                array_push($listeServices, $service);
            }
            return $listeServices;
        }
        return null;
    }

}