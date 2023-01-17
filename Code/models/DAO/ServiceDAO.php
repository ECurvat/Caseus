<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des services
 * @see Service
 */
class ServiceDAO extends DAO {

    /**
     * Fonction qui permet de récupérer la liste de tous les services
     * @return array
     */
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

    /**
     * Fonction qui permet de récupérer un service par son id
     * @param int $id
     * @return Service
     */
    public function getServiceParId($id) {
        $result = $this->queryRow('SELECT * FROM SERVICE WHERE ID_SERVICE = ?', array($id));
        if ($result) {
            $service = new Service($result[0], $result[1], $result[2], $result[3]);
            return $service;
        }
        return null;
    }

}