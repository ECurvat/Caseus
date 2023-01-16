<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des unités
 * @see Unite
 */
class UniteDAO extends DAO {

    /**
     * Fonction qui permet de récupérer la liste de toutes les unités
     * @return array
     */
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