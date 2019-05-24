<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alerte
 *
 * @ORM\Table(name="alerte")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlerteRepository")
 */
class Alerte
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
     * @ORM\Column(name="DateAlerte", type="date")
     */
    private $dateAlerte;

    /**
     * Alerte constructor.
     */
    public function __construct()
    {
        $this->dateAlerte=new \DateTime('now');
    }


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
     * Set dateAlerte
     *
     * @param \DateTime $dateAlerte
     *
     * @return Alerte
     */
    public function setDateAlerte($dateAlerte)
    {
        $this->dateAlerte = $dateAlerte;

        return $this;
    }

    /**
     * Get dateAlerte
     *
     * @return \DateTime
     */
    public function getDateAlerte()
    {
        return $this->dateAlerte;
    }
}
