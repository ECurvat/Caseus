<?php 
require_once(PATH_MODELS_DAO.'DAO.php');

/**
 * Classe d'accès aux données des employés
 * @see Employe
 */
class EmployeDAO extends DAO {

    /**
     * Fonction qui permet de récupérer un employé par son adresse mail
     * @param string $mail
     * @return Employe
     */
    public function getEmployeParMail($mail) {
        $result = $this->queryRow('SELECT * FROM EMPLOYE WHERE ADRESSE_MAIL = ?', array($mail));
        if ($result) {
            $employe = new Employe($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10]);
            return $employe;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer un employé par son id
     * @param int $id
     * @return Employe
     */
    public function getEmployeParId($id) {
        $result = $this->queryRow('SELECT * FROM EMPLOYE WHERE ID_EMPLOYE = ?', array($id));
        if ($result) {
            $employe = new Employe($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9], $result[10]);
            return $employe;
        }
        return null;
    }

    /**
     * Fonction qui permet de récupérer tous les employés
     * @return array
     */
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

    /**
     * Fonction qui permet de récupérer tous les employés d'une position précise
     * @param string $position
     * @return array
     */
    public function getEmployesParRang($position) {
        $result = $this->queryAll('SELECT * FROM EMPLOYE WHERE POSITION = ?', array($position));
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

    /**
     * Fonction qui ajoute un employé
     * @param array $para (nom, prenom, adresse mail, date d'embauche, adresse, code postal, ville, mot de passe, position, heures supplémentaires)
     * @return int
     */
    public function addEmploye($para) {
        $result = $this->queryRow('INSERT INTO EMPLOYE (ID_EMPLOYE, NOM, PRENOM, ADRESSE_MAIL, DATE_EMBAUCHE, ADRESSE, CODE_POSTAL, VILLE, MDP, POSITION, HEURES_SUP) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $para);
        return $result;
    }

    /**
     * Fonction qui supprime un employé
     * @param int $id
     * @return int
     */
    public function removeEmploye($id) {
        $result = $this->queryRow('DELETE FROM EMPLOYE WHERE ID_EMPLOYE = ?', array($id));
        return $result;
    }

    /**
     * Fonction qui modifie le mot de passe d'un employé
     * @param array $para (mot de passe, id employé)
     * @return int
     */
    public function updateMDP($para) {
        $result = $this->queryRow('UPDATE employe SET MDP=? WHERE ID_EMPLOYE = ?', $para);
        return $result;
    }

    /**
     * Fonction qui modifie les informations d'un employé
     * @param array $modif (nom, prenom, adresse mail, adresse, code postal, ville, heures supplémentaires, id employé)
     * @return int
     */
    public function alterEmploye($modif) {
        $modif = $this->queryRow('UPDATE EMPLOYE SET NOM=?, PRENOM=?, ADRESSE_MAIL=?, ADRESSE=?, CODE_POSTAL=?, VILLE=?, HEURES_SUP=? WHERE ID_EMPLOYE=?', $modif);
        $employeDAO = new EmployeDAO(true);
        $_SESSION['compte'] = $employeDAO->getEmployeParId($_SESSION['compte']->getId());
        return $modif;
    }

}