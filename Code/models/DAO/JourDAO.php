<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des jours
 * @see Jour
 */
class JourDAO extends DAO {

    /**
     * Fonction qui permet de récupérer les jours d'un planning
     * @param int $idPlanning
     * @return array
     */
    public function getJoursParPlanning($idPlanning) {
        $result = $this->queryAll('SELECT * FROM JOUR WHERE ID_PLANNING = ?', array($idPlanning));
        if ($result) {
            $listeJours = array();
            foreach ($result as $elem) {
                $jour = new Jour($elem[0], $elem[1], $elem[2], $elem[3]);
                $listeJours[$elem[2]] = $jour;
            }
            return $listeJours;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer un jour par son id de planning et son numéro dans la semaine
     * @param array $para (idPlanning, numeroJour)
     * @return Jour
     */
    public function getJourParPlanningEtNumero($para) {
        $result = $this->queryRow('SELECT * FROM JOUR WHERE ID_PLANNING = ? AND N_JOUR = ?', $para);
        if ($result) {
            $jour = new Jour($result[0], $result[1], $result[2], $result[3]);
            return $jour;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer un jour par son id
     * @param int $idJour
     * @return Jour
     */
    public function getJourParId($idJour) {
        $result = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour));
        if ($result) {
            $jour = new Jour($result[0], $result[1], $result[2], $result[3]);
            return $jour;
        }
        return null;
    }

    /**
     * Fonction qui permet d'ajouter un jour
     * @param array $para (idPlanning, numeroJour, idService)
     * @return int
     * @see Service
     */
    public function addJour($para) {
        $result = $this->queryRow("INSERT INTO JOUR (ID_PLANNING, N_JOUR, ID_SERVICE) VALUES (?, ?, ?)", $para);
        return $result;
    }

    /**
     * Fonction qui permet d'ajouter un jour de congé
     * @param array $para (idJour, idService)
     * @return int
     * @see Service
     */
    public function addJourConge($para) {
        $result = $this->queryRow("INSERT INTO JOUR (ID_PLANNING, N_JOUR, ID_SERVICE) VALUES (?, ?, 'y')", $para);
        return $result;
    }

    /**
     * Fonction qui permet de modifier un jour en jour de congé
     * @param int $id
     * @return int
     * @see Service
     */
    public function changeToConge($id) {
        $result = $this->queryRow("UPDATE JOUR SET ID_SERVICE = 'y' WHERE ID_JOUR = ?", array($id));
        return $result;
    }

    /**
     * Fonction qui supprime tous les jours d'un planning
     * @param int $id
     * @return int
     */
    public function removeJoursParPlanning($id) {
        $result = $this->queryRow("DELETE FROM JOUR WHERE ID_PLANNING = ?", array($id));
        return $result;
    }

    /**
     * Fonction qui échange 2 jours ensemble
     * @param int $idJour1
     * @param int $idJour2
     * @return int
     */
    public function echangerJours($idJour1, $idJour2) {
        // On met les 2 jours dans 2 variables
        $result1 = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour1));
        $result2 = $this->queryRow('SELECT * FROM JOUR WHERE ID_JOUR = ?', array($idJour2));
        if ($result1 && $result2) {
            $jour1 = new Jour($result1[0], $result1[1], $result1[2], $result1[3]);
            $jour2 = new Jour($result2[0], $result2[1], $result2[2], $result2[3]);
            // On change id_service du jour 1 en id_service du jour 2
            $result3 = $this->queryRow('UPDATE JOUR 
                                        SET ID_SERVICE = ?
                                        WHERE ID_JOUR = ?', 
                                        array(
                                            $jour2->getIdService(), 
                                            $idJour1));
            // On change id_service du jour 2 en id_service du jour 1
            $result4 = $this->queryRow('UPDATE JOUR 
                                        SET ID_SERVICE = ?
                                        WHERE ID_JOUR = ?', 
                                        array(
                                            $jour1->getIdService(), 
                                            $idJour2));
            return $result3 && $result4;
        }        
        return null;
    }

}