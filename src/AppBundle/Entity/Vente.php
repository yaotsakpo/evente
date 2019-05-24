<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vente
 *
 * @ORM\Table(name="vente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VenteRepository")
 */
class Vente
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
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer")
     *
     *
     */
    private $quantite;

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
     * @ORM\Column(name="Total", type="decimal", precision=10, scale=2)
     */
    private $Total;





    /**
     *
     * @var Product $produit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product",inversedBy="ventes",cascade={"all"})
     *
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */


    Private $produit;



    /**
     *
     * @var Facture $facture
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Facture",inversedBy="ventes",cascade={"all"})
     *
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */


    Private $facture;
 



    /**
     * @return Product
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param Product $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * Vente constructor.
     */
    public function __construct()
    {

      $this->date=new \DateTime('now');

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Vente
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Vente
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
     * @return Vente
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
     * @return Facture
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * @param Facture $facture
     */
    public function setfacture($facture)
    {
        $this->facture = $facture;
    }



}
