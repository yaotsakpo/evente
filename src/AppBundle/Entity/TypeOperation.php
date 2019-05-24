<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeOperation
 *
 * @ORM\Table(name="TypeOperation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeOperationRepository")
 */
class TypeOperation
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Operation",mappedBy="typeoperation",cascade={"remove"})
     */

    private $operations;


    /**
     * Type constructor.
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
     * @return string
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * @param string $Nom
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
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
