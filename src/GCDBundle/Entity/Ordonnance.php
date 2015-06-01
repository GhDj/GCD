<?php

namespace GCDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ordonnance
 */
class Ordonnance
{
    /**
     * @var string
     */
    private $contenu;

    /**
     * @var integer
     */
    private $idpatient;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Ordonnance
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set idpatient
     *
     * @param integer $idpatient
     * @return Ordonnance
     */
    public function setIdpatient($idpatient)
    {
        $this->idpatient = $idpatient;

        return $this;
    }

    /**
     * Get idpatient
     *
     * @return integer 
     */
    public function getIdpatient()
    {
        return $this->idpatient;
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
}
