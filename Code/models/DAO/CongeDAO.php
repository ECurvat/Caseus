<?php
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des congés
 * @see Conge
 */
class CongeDAO extends DAO {

    /**
     * Fonction qui permet de récupérer tous les congés d'un employé pour une année donnée
     * @param array $valeurs (idEmploye, année)
     * @return array
     */
    public function getCongeParDateParEmploye($valeurs) {
        $result = $this->queryAll('SELECT * FROM CONGE 
                                    WHERE ID_EMPLOYE = ?
                                        AND EXTRACT(YEAR FROM DEBUT_CONGE) = ?', 
                                    $valeurs);
        if ($result) {
            $listeConges = array();
            foreach ($result as $elem) {
                $conge = new Conge($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5]);
                array_push($listeConges, $conge);
            }
            return $listeConges;
        }
        return null;
    }

    /**
     * Fonction qui permet d'ajouter une demande de congé
     * @param array $valeurs (idEmploye, debutConge, finConge)
     * @return int
     */
    public function addConge($valeurs) {
        $result = $this->queryRow('INSERT INTO CONGE (ID_ETAT, ID_EMPLOYE, DEBUT_CONGE, FIN_CONGE, DATE_DEMANDE) VALUES (3, ?, ?, ?, CURRENT_TIMESTAMP)', $valeurs);
        return $result;
    }

    /**
     * Fonction qui permet de supprimer une demande de congé
     * @param int $id
     * @return int
     */
    public function removeConge($id) {
        $result = $this->queryRow('DELETE FROM CONGE WHERE ID_DEMANDE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui permet de supprimer toutes les demandes de congé d'un employé
     * @param int $id
     * @return int
     */
    public function removeCongesParEmp($id) {
        $result = $this->queryRow('DELETE FROM CONGE WHERE ID_EMPLOYE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui accepte une demande de congé
     * @param int $id
     * @return int
     */
    public function accepterConge($id) {
        $result = $this->queryRow('UPDATE CONGE SET ID_ETAT = 4 WHERE ID_DEMANDE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui refuse une demande de congé
     * @param int $id
     * @return int
     */
    public function refuserConge($id) {
        $result = $this->queryRow('UPDATE CONGE SET ID_ETAT = 5 WHERE ID_DEMANDE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui permet de récupérer les congés en attente
     * @return array
     */
    public function getCongeEnAttente() {
        $result = $this->queryAll('SELECT * 
                                    FROM CONGE 
                                    WHERE ID_ETAT = 3');
        if ($result) {
            $listeCongesEnAttente = array();
            foreach ($result as $elem) {
                $conge = new Conge($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5]);
                array_push($listeCongesEnAttente, $conge);
            }
            return $listeCongesEnAttente;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer une demande de congé
     * @param int $id
     * @return Conge
     */
    public function getCongeParId($id) {
        $result = $this->queryRow('SELECT * 
                                    FROM CONGE 
                                    WHERE ID_DEMANDE = ?', 
                                    array($id));
        if ($result) {
            $conge = new Conge($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]);
            return $conge;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer les congés acceptés pour une année et un mois donnés
     * @param array $para (mois, année)
     * @return array
     */
    public function getListeCongesAcceptesParDate($para) {
        $result = $this->queryAll('SELECT * FROM CONGE 
                                    WHERE ID_ETAT = 4 AND 
                                    (
                                        (EXTRACT(MONTH FROM DEBUT_CONGE) = ? AND EXTRACT(YEAR FROM DEBUT_CONGE) = ?) 
                                        OR 
                                        (EXTRACT(MONTH FROM FIN_CONGE) = ? AND EXTRACT(YEAR FROM FIN_CONGE) = ?)
                                    )', 
                                    $para);
        if ($result) {
            $listeCongesAcceptes = array();
            foreach ($result as $elem) {
                $conge = new Conge($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5]);
                array_push($listeCongesAcceptes, $conge);
            }
            return $listeCongesAcceptes;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer les congés acceptés après la date actuelle
     * @return array
     */
    public function getCongesFuturs() {
        $result = $this->queryAll('SELECT * 
                                    FROM CONGE 
                                    WHERE ID_ETAT = 4 
                                    AND FIN_CONGE >= CURRENT_TIMESTAMP');
        if ($result) {
            $listeCongesFuturs = array();
            foreach ($result as $elem) {
                $conge = new Conge($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5]);
                array_push($listeCongesFuturs, $conge);
            }
            return $listeCongesFuturs;
        }
        return null;
    }

}