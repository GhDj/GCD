<?php

namespace GCDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dentiste
 */
class Dentiste
{
    /**
     * @var string
     */
    private $nomDentiste;

    /**
     * @var string
     */
    private $prenomDentiste;

    /**
     * @var string
     */
    private $adresseDentiste;

    /**
     * @var integer
     */
    private $telDentiste;

    /**
     * @var string
     */

    /**
     * @var integer
     */
    private $id;


    /**
     * Set nomDentiste
     *
     * @param string $nomDentiste
     * @return Dentiste
     */
    public function setNomDentiste($nomDentiste)
    {
        $this->nomDentiste = $nomDentiste;

        return $this;
    }

    /**
     * Get nomDentiste
     *
     * @return string 
     */
    public function getNomDentiste()
    {
        return $this->nomDentiste;
    }

    /**
     * Set prenomDentiste
     *
     * @param string $prenomDentiste
     * @return Dentiste
     */
    public function setPrenomDentiste($prenomDentiste)
    {
        $this->prenomDentiste = $prenomDentiste;

        return $this;
    }

    /**
     * Get prenomDentiste
     *
     * @return string 
     */
    public function getPrenomDentiste()
    {
        return $this->prenomDentiste;
    }

    /**
     * Set adresseDentiste
     *
     * @param string $adresseDentiste
     * @return Dentiste
     */
    public function setAdresseDentiste($adresseDentiste)
    {
        $this->adresseDentiste = $adresseDentiste;

        return $this;
    }

    /**
     * Get adresseDentiste
     *
     * @return string 
     */
    public function getAdresseDentiste()
    {
        return $this->adresseDentiste;
    }

    /**
     * Set telDentiste
     *
     * @param integer $telDentiste
     * @return Dentiste
     */
    public function setTelDentiste($telDentiste)
    {
        $this->telDentiste = $telDentiste;

        return $this;
    }

    /**
     * Get telDentiste
     *
     * @return integer 
     */
    public function getTelDentiste()
    {
        return $this->telDentiste;
    }

   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string
     */
    private $adresseCabinet;

    /**
     * @var integer
     */
    private $telCabinet;

    /**
     * @var string
     */
    private $sexe;


    /**
     * Set adresseCabinet
     *
     * @param string $adresseCabinet
     * @return Dentiste
     */
    public function setAdresseCabinet($adresseCabinet)
    {
        $this->adresseCabinet = $adresseCabinet;

        return $this;
    }

    /**
     * Get adresseCabinet
     *
     * @return string 
     */
    public function getAdresseCabinet()
    {
        return $this->adresseCabinet;
    }

    /**
     * Set telCabinet
     *
     * @param integer $telCabinet
     * @return Dentiste
     */
    public function setTelCabinet($telCabinet)
    {
        $this->telCabinet = $telCabinet;

        return $this;
    }

    /**
     * Get telCabinet
     *
     * @return integer 
     */
    public function getTelCabinet()
    {
        return $this->telCabinet;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Dentiste
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
     * @var string
     */
    private $emailDentiste;


    /**
     * Set emailDentiste
     *
     * @param string $emailDentiste
     * @return Dentiste
     */
    public function setEmailDentiste($emailDentiste)
    {
        $this->emailDentiste = $emailDentiste;

        return $this;
    }

    /**
     * Get emailDentiste
     *
     * @return string 
     */
    public function getEmailDentiste()
    {
        return $this->emailDentiste;
    }
    /**
     * @var string
     */
    private $password;


    /**
     * Set password
     *
     * @param string $password
     * @return Dentiste
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
}
