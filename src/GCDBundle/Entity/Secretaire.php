<?php

namespace GCDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Secretaire
 */
class Secretaire
{
    /**
     * @var string
     */
    private $nomSecretaire;

    /**
     * @var string
     */
    private $prenomSecretaire;

    /**
     * @var string
     */
    private $adresseSecretaire;

    /**
     * @var integer
     */
    private $telSecretaire;

    /**
     * @var integer
     */
    private $idDentiste;

    /**
     * @var integer
     */
    private $idSecretaire;


    /**
     * Set nomSecretaire
     *
     * @param string $nomSecretaire
     * @return Secretaire
     */
    public function setNomSecretaire($nomSecretaire)
    {
        $this->nomSecretaire = $nomSecretaire;

        return $this;
    }

    /**
     * Get nomSecretaire
     *
     * @return string 
     */
    public function getNomSecretaire()
    {
        return $this->nomSecretaire;
    }

    /**
     * Set prenomSecretaire
     *
     * @param string $prenomSecretaire
     * @return Secretaire
     */
    public function setPrenomSecretaire($prenomSecretaire)
    {
        $this->prenomSecretaire = $prenomSecretaire;

        return $this;
    }

    /**
     * Get prenomSecretaire
     *
     * @return string 
     */
    public function getPrenomSecretaire()
    {
        return $this->prenomSecretaire;
    }

    /**
     * Set adresseSecretaire
     *
     * @param string $adresseSecretaire
     * @return Secretaire
     */
    public function setAdresseSecretaire($adresseSecretaire)
    {
        $this->adresseSecretaire = $adresseSecretaire;

        return $this;
    }

    /**
     * Get adresseSecretaire
     *
     * @return string 
     */
    public function getAdresseSecretaire()
    {
        return $this->adresseSecretaire;
    }

    /**
     * Set telSecretaire
     *
     * @param integer $telSecretaire
     * @return Secretaire
     */
    public function setTelSecretaire($telSecretaire)
    {
        $this->telSecretaire = $telSecretaire;

        return $this;
    }

    /**
     * Get telSecretaire
     *
     * @return integer 
     */
    public function getTelSecretaire()
    {
        return $this->telSecretaire;
    }

    /**
     * Set idDentiste
     *
     * @param integer $idDentiste
     * @return Secretaire
     */
    public function setIdDentiste($idDentiste)
    {
        $this->idDentiste = $idDentiste;

        return $this;
    }

    /**
     * Get idDentiste
     *
     * @return integer 
     */
    public function getIdDentiste()
    {
        return $this->idDentiste;
    }

    /**
     * Get idSecretaire
     *
     * @return integer 
     */
    public function getIdSecretaire()
    {
        return $this->idSecretaire;
    }
    /**
     * @var string
     */
    private $emailSecretaire;

    /**
     * @var string
     */
    private $pwSecretaire;


    /**
     * Set emailSecretaire
     *
     * @param string $emailSecretaire
     * @return Secretaire
     */
    public function setEmailSecretaire($emailSecretaire)
    {
        $this->emailSecretaire = $emailSecretaire;

        return $this;
    }

    /**
     * Get emailSecretaire
     *
     * @return string 
     */
    public function getEmailSecretaire()
    {
        return $this->emailSecretaire;
    }

    /**
     * Set pwSecretaire
     *
     * @param string $pwSecretaire
     * @return Secretaire
     */
    public function setPwSecretaire($pwSecretaire)
    {
        $this->pwSecretaire = $pwSecretaire;

        return $this;
    }

    /**
     * Get pwSecretaire
     *
     * @return string 
     */
    public function getPwSecretaire()
    {
        return $this->pwSecretaire;
    }
    /**
     * @var string
     */
    private $sexe;


    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Secretaire
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
}
