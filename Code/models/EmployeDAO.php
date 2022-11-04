<?php 
require_once(PATH_MODELS.'DAO.php');

class EmployeDAO extends DAO {

    public function getEmployeParMail($mail) {
        $result = $this->queryRow('SELECT * FROM EMPLOYE WHERE ADRESSE_MAIL = ?', array($mail));
        if ($result) {
            $employe = new Employe($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $result[8], $result[9]);
            return $employe;
        }
        return null;
    }

}