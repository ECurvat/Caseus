<?php
/**
 * Classe Congé :
 * Demande d'un employé pour une période donnée qui peut être acceptée ou refusée
 */
class Conge {

    private $id_demande;
    private $id_etat;
    private $id_employe;
    private $debut_conge;
    private $fin_conge;
    private $date_demande;

    /**
     * Constructeur de la classe Congé
     * @param int $id_demande
     * @param int $id_etat
     * @param int $id_employe
     * @param string $debut_conge
     * @param string $fin_conge
     * @param string $date_demande
     * @see Etat
     * @see Employe
     */
    public function __construct($id_demande, $id_etat, $id_employe, $debut_conge, $fin_conge, $date_demande) {
        $this->id_demande = $id_demande;
        $this->id_etat = $id_etat;
        $this->id_employe = $id_employe;
        $this->debut_conge = $debut_conge;
        $this->fin_conge = $fin_conge;
        $this->date_demande = $date_demande;
    }

    /**
     * Getter de l'id de la demande
     * @return int
     */
    public function getIdDemande() {
        return $this->id_demande;
    }

    /**
     * Getter de l'id de l'état de la demande
     * @see Etat
     * @return int
     */
    public function getIdEtat() {
        return $this->id_etat;
    }

    /**
     * Getter de l'id de l'employé à l'origine de la demande
     * @see Employe
     * @return int
     */
    public function getIdEmploye() {
        return $this->id_employe;
    }

    /**
     * Getter du timestamp du début du congé
     * @return string
     */
    public function getDebut() {
        return $this->debut_conge;
    }

    /**
     * Getter du timestamp de la fin du congé
     * @return string
     */
    public function getFin() {
        return $this->fin_conge;
    }

    /**
     * Getter du timestamp de la date de la demande
     * @return string
     */
    public function getDateDemande() {
        return $this->date_demande;
    }

}