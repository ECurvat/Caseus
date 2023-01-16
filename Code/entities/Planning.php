<?php
/**
 * Classe Planning :
 * Planning d'un employé
 */
class Planning {

    private $id_planning;
    private $id_employe;
    private $n_semaine;
    private $annee_planning;

    /**
     * Constructeur de la classe Planning
     * @param int $id_planning
     * @param int $id_employe
     * @param int $n_semaine
     * @param int $annee_planning
     * @see Employe
     */
    public function __construct($id_planning, $id_employe, $n_semaine, $annee_planning) {
        $this->id_planning = $id_planning;
        $this->id_employe = $id_employe;
        $this->n_semaine = $n_semaine;
        $this->annee_planning = $annee_planning;
    }

    /**
     * Getter de l'id du planning
     * @return int
     */
    public function getIdPlanning() {
        return $this->id_planning;
    }

    /**
     * Getter de l'id de l'employé
     * @see Employe
     * @return int
     */
    public function getIdEmploye() {
        return $this->id_employe;
    }

    /**
     * Getter du numéro de la semaine du planning
     * @return int
     */
    public function getNSemaine() {
        return $this->n_semaine;
    }

    /**
     * Getter de l'année du planning
     * @return int
     */
    public function getAnneePlanning() {
        return $this->annee_planning;
    }

}