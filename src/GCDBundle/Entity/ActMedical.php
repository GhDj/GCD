<?php

namespace GCDBundle\Entity;

use GCDBundle\Entity\Patient;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActMedical
 */
class ActMedical
{
    /**
     * @var string
     */
    private $libelle;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \GCDBundle\Entity\Patient
     */
    private $idPatient;


    /**
     * Set libelle
     *
     * @param string $libelle
     * @return ActMedical
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ActMedical
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set idPatient
     *
     * @param \GCDBundle\Entity\Patient $idPatient
     * @return ActMedical
     */
    public function setIdPatient(\GCDBundle\Entity\Patient $idPatient = null)
    {
        $this->idPatient = $idPatient;

        return $this;
    }

    /**
     * Get idPatient
     *
     * @return \GCDBundle\Entity\Patient 
     */
    public function getIdPatient()
    {
        return $this->idPatient;
    }
    
   
}
