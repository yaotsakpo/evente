<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FactureRepository")
 */
class Facture
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vente",mappedBy="facture",cascade={"remove"})
     */

    private $ventes;


    /**
     * @var string
     *
     * @ORM\Column(name="MontantEncaisse", type="decimal", precision=10, scale=2)
     */
    private $MontantEncaisse;


    /**
     * @var string
     *
     * @ORM\Column(name="MonnaieRendue", type="decimal", precision=10, scale=2)
     */
    private $MonnaieRendue;


    /**
     * @var string
     *
     * @ORM\Column(name="Total", type="decimal", precision=10, scale=2)
     */
    private $Total;



    /**
     * @var string
     *
     * @ORM\Column(name="Remise", type="decimal", precision=10, scale=2)
     */
    private $Remise;


    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

       /**
     *
     * @var User $User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="Factures",)
     *
     * @ORM\JoinColumn(nullable=false)
     */

    private $User;


    /**
     * Facture constructor.
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Facture
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
     * Add vente
     *
     * @param \AppBundle\Entity\Vente $vente
     *
     * @return Product
     */
    public function addVente(\AppBundle\Entity\Vente $vente)
    {
        $this->ventes[] = $vente;

        return $this;
    }

    /**
     * Remove vente
     *
     * @param \AppBundle\Entity\Vente $vente
     */
    public function removeVente(\AppBundle\Entity\Vente $vente)
    {
        $this->ventes->removeElement($vente);
    }

    /**
     * Get ventes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVentes()
    {
        return $this->ventes;
    }

    /**
     * Set MontantEncaisse
     *
     * @param string $MontantEncaisse
     *
     * @return Vente
     */
    public function setMontantEncaisse($MontantEncaisse)
    {
        $this->MontantEncaisse = $MontantEncaisse;

        return $this;
    }

    /**
     * Get MontantEncaisse
     *
     * @return string
     */
    public function getMontantEncaisse()
    {
        return $this->MontantEncaisse;
    }

        /**
     * Set MonnaieRendue
     *
     * @param string $MonnaieRendue
     *
     * @return Vente
     */
    public function setMonnaieRendue($MonnaieRendue)
    {
        $this->MonnaieRendue = $MonnaieRendue;

        return $this;
    }

    /**
     * Get MonnaieRendue
     *
     * @return string
     */
    public function getMonnaieRendue()
    {
        return $this->MonnaieRendue;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Vente
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }


        /**
     * Set User
     *
     * @param \AppBundle\Entity\User $User
     *
     * @return Vente
     */
    public function setUser(\AppBundle\Entity\User $User)
    {
        $this->User = $User;

        return $this;
    }

    /**
     * Get User
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->Total;
    }

    /**
     * @param string $Total
     */
    public function setTotal($Total)
    {
        $this->Total = $Total;
    }

    /**
     * @return string
     */
    public function getRemise()
    {
        return $this->Remise;
    }

    /**
     * @param string $Remise
     */
    public function setRemise($Remise)
    {
        $this->Remise = $Remise;
    }
    

}
