<?php
class Echange {

    private $id_echange;
    private $id_etat;
    private $id_jour_emet;
    private $id_emp_emet;
    private $id_jour_recep;
    private $id_emp_recep;
    private $date_proposition;

    public function __construct($id_echange, $id_etat, $id_jour_emet, $id_emp_emet, $id_jour_recep, $id_emp_recep, $date_proposition) {
        $this->id_echange = $id_echange;
        $this->id_etat = $id_etat;
        $this->id_jour_emet = $id_jour_emet;
        $this->id_emp_emet = $id_emp_emet;
        $this->id_jour_recep = $id_jour_recep;
        $this->id_emp_recep = $id_emp_recep;
        $this->date_proposition = $date_proposition;
    }

    public function getIdEchange() {
        return $this->id_echange;
    }

    public function getIdEtat() {
        return $this->id_etat;
    }

    public function getIdJourEmet() {
        return $this->id_jour_emet;
    }

    public function getIdEmpEmet() {
        return $this->id_emp_emet;
    }

    public function getIdJourRecep() {
        return $this->id_jour_recep;
    }

    public function getIdEmpRecep() {
        return $this->id_emp_recep;
    }

    public function getDateProposition() {
        return $this->date_proposition;
    }

}