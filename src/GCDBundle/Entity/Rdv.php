<?php

namespace GCDBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 */
class Rdv
{
    /**
     * @var \DateTime
     */
    private $dateRdv;

    /**
     * @var \DateTime
     */
    private $horraireRdv;

    /**
     * @var string
     */
    private $idPatient;

    /**
     * @var integer
     */
    private $idRdv;


    /**
     * Set dateRdv
     *
     * @param \DateTime $dateRdv
     * @return Rdv
     */
    public function setDateRdv($dateRdv)
    {
        $this->dateRdv = $dateRdv;

        return $this;
    }

    /**
     * Get dateRdv
     *
     * @return \DateTime 
     */
    public function getDateRdv()
    {
        return $this->dateRdv;
    }

    /**
     * Set horraireRdv
     *
     * @param \DateTime $horraireRdv
     * @return Rdv
     */
    public function setHorraireRdv($horraireRdv)
    {
        $this->horraireRdv = $horraireRdv;

        return $this;
    }

    /**
     * Get horraireRdv
     *
     * @return \DateTime 
     */
    public function getHorraireRdv()
    {
        return $this->horraireRdv;
    }

    /**
     * Set idPatient
     *
     * @param string $idPatient
     * @return Rdv
     */
    public function setIdPatient($idPatient)
    {
        $this->idPatient = $idPatient;

        return $this;
    }

    /**
     * Get idPatient
     *
     * @return string 
     */
    public function getIdPatient()
    {
        return $this->idPatient;
    }

    /**
     * Get idRdv
     *
     * @return integer 
     */
    public function getIdRdv()
    {
        return $this->idRdv;
    }
}
