<?php
/**
 * Classe Echange :
 * Demande d'un employé pour échanger un service avec un autre employé
 */
class Echange {

    private $id_echange;
    private $id_etat;
    private $id_jour_emet;
    private $id_emp_emet;
    private $id_jour_recep;
    private $id_emp_recep;
    private $date_proposition;

    /**
     * Constructeur de la classe Echange
     * @param int $id_echange
     * @param int $id_etat
     * @param int $id_jour_emet
     * @param int $id_emp_emet
     * @param int $id_jour_recep
     * @param int $id_emp_recep
     * @param string $date_proposition
     * @see Etat
     * @see Jour
     * @see Employe
     * @see Service
     */
    public function __construct($id_echange, $id_etat, $id_jour_emet, $id_emp_emet, $id_jour_recep, $id_emp_recep, $date_proposition) {
        $this->id_echange = $id_echange;
        $this->id_etat = $id_etat;
        $this->id_jour_emet = $id_jour_emet;
        $this->id_emp_emet = $id_emp_emet;
        $this->id_jour_recep = $id_jour_recep;
        $this->id_emp_recep = $id_emp_recep;
        $this->date_proposition = $date_proposition;
    }

    /**
     * Getter de l'id de l'échange
     * @return int
     */
    public function getIdEchange() {
        return $this->id_echange;
    }

    /**
     * Getter de l'id de l'état de l'échange
     * @see Etat
     * @return int
     */
    public function getIdEtat() {
        return $this->id_etat;
    }

    /**
     * Getter de l'id du jour de l'employé émetteur
     * @see Jour
     * @return int
     */
    public function getIdJourEmet() {
        return $this->id_jour_emet;
    }

    /**
     * Getter de l'id de l'employé émetteur
     * @see Employe
     * @return int
     */
    public function getIdEmpEmet() {
        return $this->id_emp_emet;
    }

    /**
     * Getter de l'id du jour de l'employé récepteur
     * @see Jour
     * @return int
     */
    public function getIdJourRecep() {
        return $this->id_jour_recep;
    }

    /**
     * Getter de l'id de l'employé récepteur
     * @see Employe
     * @return int
     */
    public function getIdEmpRecep() {
        return $this->id_emp_recep;
    }

    /**
     * Getter de la date de proposition de l'échange
     * @return string
     */
    public function getDateProposition() {
        return $this->date_proposition;
    }

}