<?php
/**
 * Classe Absence :
 * Faveur demandée par un employé pour ne pas travailler pendant une période définie
 */
class Absence {

    private $id_absence;
    private $id_employe;
    private $debut;
    private $fin;

    /**
     * Constructeur de la classe Absence
     * @param int $id_absence
     * @param int $id_employe
     * @param string $debut
     * @param string $fin
     * @see Employe
     */
    public function __construct($id_absence, $id_employe, $debut, $fin) {
        $this->id_absence = $id_absence;
        $this->id_employe = $id_employe;
        $this->debut = $debut;
        $this->fin = $fin;
    }

    /**
     * Getter de l'id de l'absence
     * @return int
     */
    public function getIdAbsence() {
        return $this->id_absence;
    }

    /**
     * Getter de l'id de l'employé à l'origine de l'absence
     * @see Employe
     * @return int
     */
    public function getIdEmploye() {
        return $this->id_employe;
    }

    /**
     * Getter du timestamp du début de l'absence
     * @return string
     */
    public function getDebut() {
        return $this->debut;
    }

    /**
     * Getter du timestamp de la fin de l'absence
     * @return string
     */
    public function getFin() {
        return $this->fin;
    }

}