<?php

namespace GCDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 */
class Patient
{
    /**
     * @var string
     */
    private $nomPatient;

    /**
     * @var string
     */
    private $prenomPatient;

    /**
     * @var string
     */
    private $adressePatient;

    /**
     * @var integer
     */
    private $telPatient;

    /**
     * @var integer
     */
    private $idFiche;

    /**
     * @var integer
     */
    private $idPatient;


    /**
     * Set nomPatient
     *
     * @param string $nomPatient
     * @return Patient
     */
    public function setNomPatient($nomPatient)
    {
        $this->nomPatient = $nomPatient;

        return $this;
    }

    /**
     * Get nomPatient
     *
     * @return string 
     */
    public function getNomPatient()
    {
        return $this->nomPatient;
    }

    /**
     * Set prenomPatient
     *
     * @param string $prenomPatient
     * @return Patient
     */
    public function setPrenomPatient($prenomPatient)
    {
        $this->prenomPatient = $prenomPatient;

        return $this;
    }

    /**
     * Get prenomPatient
     *
     * @return string 
     */
    public function getPrenomPatient()
    {
        return $this->prenomPatient;
    }

    /**
     * Set adressePatient
     *
     * @param string $adressePatient
     * @return Patient
     */
    public function setAdressePatient($adressePatient)
    {
        $this->adressePatient = $adressePatient;

        return $this;
    }

    /**
     * Get adressePatient
     *
     * @return string 
     */
    public function getAdressePatient()
    {
        return $this->adressePatient;
    }

    /**
     * Set telPatient
     *
     * @param integer $telPatient
     * @return Patient
     */
    public function setTelPatient($telPatient)
    {
        $this->telPatient = $telPatient;

        return $this;
    }

    /**
     * Get telPatient
     *
     * @return integer 
     */
    public function getTelPatient()
    {
        return $this->telPatient;
    }

    /**
     * Set idFiche
     *
     * @param integer $idFiche
     * @return Patient
     */
    public function setIdFiche($idFiche)
    {
        $this->idFiche = $idFiche;

        return $this;
    }

    /**
     * Get idFiche
     *
     * @return integer 
     */
    public function getIdFiche()
    {
        return $this->idFiche;
    }

    /**
     * Get idPatient
     *
     * @return integer 
     */
    public function getIdPatient()
    {
        return $this->idPatient;
    }
    /**
     * @var string
     */
    private $dateNaiss;

    /**
     * @var integer
     */
    private $cnam;

    /**
     * @var string
     */
    private $sexe;


    /**
     * Set dateNaiss
     *
     * @param string $dateNaiss
     * @return Patient
     */
    public function setDateNaiss($dateNaiss)
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    /**
     * Get dateNaiss
     *
     * @return string 
     */
    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    /**
     * Set cnam
     *
     * @param integer $cnam
     * @return Patient
     */
    public function setCnam($cnam)
    {
        $this->cnam = $cnam;

        return $this;
    }

    /**
     * Get cnam
     *
     * @return integer 
     */
    public function getCnam()
    {
        return $this->cnam;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Patient
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }
    /**
     * @var integer
     */
    private $emailPatient;


    /**
     * Set emailPatient
     *
     * @param integer $emailPatient
     * @return Patient
     */
    public function setEmailPatient($emailPatient)
    {
        $this->emailPatient = $emailPatient;

        return $this;
    }

    /**
     * Get emailPatient
     *
     * @return integer 
     */
    public function getEmailPatient()
    {
        return $this->emailPatient;
    }
    /**
     * @var string
     */
    private $pwPatient;


    /**
     * Set pwPatient
     *
     * @param string $pwPatient
     * @return Patient
     */
    public function setPwPatient($pwPatient)
    {
        $this->pwPatient = $pwPatient;

        return $this;
    }

    /**
     * Get pwPatient
     *
     * @return string 
     */
    public function getPwPatient()
    {
        return $this->pwPatient;
    }
     public function __toString()
{
    return $this->nomPatient;
}
}
