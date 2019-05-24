<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatistiqueRepository")
 */
class Statistique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="Gain", type="decimal", precision=10, scale=2)
     */
    private $gain;

    /**
     * @var string
     *
     * @ORM\Column(name="TotalVente", type="decimal", precision=10, scale=2)
     */
    private $TotalVente;


     /**
     * @var string
     *
     * @ORM\Column(name="Caisse", type="decimal", precision=10, scale=2)
     */
    private $Caisse;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Statistique
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set gain
     *
     * @param string $gain
     *
     * @return Statistique
     */
    public function setGain($gain)
    {
        $this->gain = $gain;

        return $this;
    }

    /**
     * Get gain
     *
     * @return string
     */
    public function getGain()
    {
        return $this->gain;
    }



    /**
     * Set totalVente
     *
     * @param string $totalVente
     *
     * @return Statistique
     */
    public function setTotalVente($totalVente)
    {
        $this->TotalVente = $totalVente;

        return $this;
    }

    /**
     * Get totalVente
     *
     * @return string
     */
    public function getTotalVente()
    {
        return $this->TotalVente;
    }

    
    /**
     * Set Caisse
     *
     * @param string $Caisse
     *
     * @return Statistique
     */
    public function setCaisse($Caisse)
    {
        $this->Caisse = $Caisse;

        return $this;
    }

    /**
     * Get Caisse
     *
     * @return string
     */
    public function getCaisse()
    {
        return $this->Caisse;
    }
}
