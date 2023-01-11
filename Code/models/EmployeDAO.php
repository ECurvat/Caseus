<?php 
require_once(PATH_MODELS.'DAO.php');

class EmployeDAO extends DAO {

    public function getEmployeParMail($mail) {
        $result = $this->queryRow('SELECT * FROM EMPLOYE WHERE ADRESSE_MAIL = ?', array($mail));
        if ($result) {
            $employe = new Employe($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10]);
            return $employe;
        }
        return null;
    }

    public function getEmployeParId($id) {
        $result = $this->queryRow('SELECT * FROM EMPLOYE WHERE ID_EMPLOYE = ?', array($id));
        if ($result) {
            $employe = new Employe($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10]);
            return $employe;
        }
        return null;
    }

    public function getListeEmployes() {
        $result = $this->queryAll('SELECT * FROM EMPLOYE');
        if ($result) {
            $listeEmployes = array();
            foreach ($result as $elem) {
                $emp = new Employe($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6], $elem[7], $elem[8], $elem[9], $elem[10]);
                array_push($listeEmployes, $emp);
            }
            return $listeEmployes;
        }
        return null;
    }

    public function getEmployesParRang($rang) {
        $result = $this->queryAll('SELECT * FROM EMPLOYE WHERE POSITION = ?', array($rang));
        if ($result) {
            $listeEmployes = array();
            foreach ($result as $elem) {
                $emp = new Employe($elem[0], $elem[1], $elem[2], $elem[3], $elem[4], $elem[5], $elem[6], $elem[7], $elem[8], $elem[9], $elem[10]);
                array_push($listeEmployes, $emp);
            }
            return $listeEmployes;
        }
        return null;
    }

    public function addEmploye($para) {
        $result = $this->queryRow('INSERT INTO EMPLOYE (ID_EMPLOYE, NOM, PRENOM, ADRESSE_MAIL, DATE_EMBAUCHE, ADRESSE, CODE_POSTAL, VILLE, MDP, POSITION, HEURES_SUP) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $para);
        return $result;
    }

    public function removeEmploye($id) {
        $result = $this->queryRow('DELETE FROM EMPLOYE WHERE ID_EMPLOYE = ?', array($id));
        return $result;
    }

    public function updateMDP($para){
        $result = $this->queryRow('UPDATE employe SET mdp=? WHERE id_employe = ?', $para);
        return $result;
    }

}