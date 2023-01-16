<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des échanges
 * @see Echange
 */
class EchangeDAO extends DAO {

    /**
     * Fonction qui permet d'ajouter un échange
     * @param array $para (idJourEmet, idEmployeEmet, idJourRecep, idEmployeRecep)
     * @return int $result
     */
    public function ajouterEchange($para) {
        $result = $this->queryRow('INSERT INTO echange (ID_ETAT, ID_JOUR_EMETTEUR, ID_EMPLOYE_EMETTEUR, ID_JOUR_RECEPTEUR, ID_EMPLOYE_RECEPTEUR, DATE_PROPOSITION) VALUES (3, ?, ?, ?, ?, CURRENT_TIMESTAMP)', $para);
        return $result;
    }

    /**
     * Fonction qui permet de supprimer un échange
     * @param int $id
     * @return int
     */
    public function supprimerEchange($id) {
        $result = $this->queryRow('DELETE FROM ECHANGE WHERE ID_ECHANGE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui change l'état d'un échange
     * @param array $para (idEtat, idEchange)
     * @return int
     */
    public function changerEtatEchange($para) {
        $result = $this->queryRow('UPDATE ECHANGE SET ID_ETAT = ? WHERE ID_ECHANGE = ?', $para);
        return $result;
    }

    /**
     * Fonction qui vérifie si un échange est en cours pour un certain jour
     * @param int $idJourEmet
     * @return boolean
     */
    public function verifEchangeEnCours($idJourEmet) {
        $result = $this->queryRow('SELECT * FROM ECHANGE WHERE ID_JOUR_EMETTEUR = ?', array($idJourEmet));
        if (!$result) {
            return null;
        }
        return true;
    }

    /**
     * Fonction qui permet de récupérer tous les échanges envoyés par un employé pour une année donnée
     * @param array $param (idEmploye, année)
     * @return array
     */
    public function getEchangesEnvoyes($param) {
        $result = $this->queryAll('SELECT * 
                                    FROM ECHANGE 
                                    WHERE ID_EMPLOYE_EMETTEUR = ? 
                                    AND EXTRACT(YEAR FROM DATE_PROPOSITION) = ?', 
                                    $param);
        if ($result) {
            $listeEnvoyes = array();
            foreach ($result as $elem) {
                $echange = new Echange($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6]);
                array_push($listeEnvoyes, $echange);
            }
            return $listeEnvoyes;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer tous les échanges reçus par un employé pour une année donnée
     * @param array $param (idEmploye, année)
     * @return array
     */
    public function getEchangesRecus($param) {
        $result = $this->queryAll('SELECT * 
                                    FROM ECHANGE 
                                    WHERE ID_ETAT = 3 
                                    AND ID_EMPLOYE_RECEPTEUR = ? 
                                    AND EXTRACT(YEAR FROM DATE_PROPOSITION) = ?', 
                                    $param);
        if ($result) {
            $listeRecus = array();
            foreach ($result as $elem) {
                $echange = new Echange($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6]);
                array_push($listeRecus, $echange);
            }
            return $listeRecus;
        }
        return null;
    }

    /**
     * Fonction qui récupère un échange
     * @param int $id
     * @return Echange
     */
    public function getEchangeParId($id) {
        $result = $this->queryRow('SELECT * FROM ECHANGE WHERE ID_ECHANGE = ?', array($id));
        if ($result) {
            return new Echange($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6]);
        }
        return null;
    }

}