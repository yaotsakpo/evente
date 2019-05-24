<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="Service")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 */
class Service
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
     * @var \string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Operation",mappedBy="service",cascade={"remove"})
     */

    private $operations;


    /**
     * Service constructor.
     */
    public function __construct()
    {
       
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
     * Set Nom
     *
     * @param \string $Nom
     *
     * @return Service
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * Get Nom
     *
     * @return \string
     */
    public function getNom()
    {
        return $this->Nom;
    }


    /**
     * Add operation
     *
     * @param \AppBundle\Entity\operation $operation
     *
     * @return Product
     */
    public function addoperation(\AppBundle\Entity\operation $operation)
    {
        $this->operations[] = $operation;

        return $this;
    }

    /**
     * Remove operation
     *
     * @param \AppBundle\Entity\operation $operation
     */
    public function removeoperation(\AppBundle\Entity\operation $operation)
    {
        $this->operations->removeElement($operation);
    }

    /**
     * Get operations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getoperations()
    {
        return $this->operations;
    }



}
