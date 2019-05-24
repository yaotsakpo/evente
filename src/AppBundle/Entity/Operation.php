<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operation
 *
 * @ORM\Table(name="Operation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OperationRepository")
 */
class Operation
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
     * @ORM\Column(name="Montant", type="decimal", precision=10, scale=2)
     */
    private $Montant;

    /**
     *
     * @var Service $service
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Service",inversedBy="operations")
     *
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */

    Private $service;

    /**
     *
     * @var TypeOperation $typeoperation
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeOperation",inversedBy="operations")
     *
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */

    Private $typeoperation;

    /**
     * Operation constructor.
     */
    public function __construct()
    {
         $this->date=new \DateTime('now');   
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
    public function getMontant()
    {
        return $this->Montant;
    }

    /**
     * @param string $Montant
     */
    public function setMontant($Montant)
    {
        $this->Montant = $Montant;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return TypeOperation
     */
    public function getTypeoperation()
    {
        return $this->typeoperation;
    }

    /**
     * @param TypeOperation $typeoperation
     */
    public function setTypeoperation($typeoperation)
    {
        $this->typeoperation = $typeoperation;
    }






}
