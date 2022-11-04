<?php 
require_once(PATH_MODELS.'DAO.php');

class DisponibiliteDAO extends DAO {

    public function getDispoParDate($valeurs) {
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

    public function getDispoParId($id) {
        $result = $this->queryRow('SELECT * FROM DISPONIBILITE WHERE ID_DISPO = ?', array($id));
        if ($result) {
            $dispoEditee = new Disponibilite($result[0], $result[1], $result[2], $result[3]);
            return $dispoEditee;
        }
        return null;
    }

    public function modifierDispoParId($dispoModifiee) {
        $param = array(str_replace("T", " ", $dispoModifiee->getDebutDispo()), str_replace("T", " ", $dispoModifiee->getFinDispo()), (int) $dispoModifiee->getIdDispo());
        $result = $this->queryRow('UPDATE DISPONIBILITE SET 
        DEBUT_DISPO = ?,
        FIN_DISPO = ?
        WHERE ID_DISPO = ?', $param);
    }

    public function supprimerDispoParId($id) {
        $result = $this->queryRow('DELETE FROM DISPONIBILITE WHERE ID_DISPO = ?', array($id));
        return $result;
    }

    public function ajouterDispo($params) {
        $result = $this->queryRow('INSERT INTO DISPONIBILITE (ID_EMPLOYE, DEBUT_DISPO, FIN_DISPO) VALUES(?, ?, ?)', $params);
        return $result;
    }

}