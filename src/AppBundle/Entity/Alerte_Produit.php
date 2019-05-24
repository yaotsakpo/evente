<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alerte_Produit
 *
 * @ORM\Table(name="alerte__produit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Alerte_ProduitRepository")
 */
class Alerte_Produit 
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
     *
     * @var Product $Produit
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product",inversedBy="alertes",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */

    private $Produit;




        /**
     * Alerte_Produit constructor.
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
     * Set produit
     *
     * @param \AppBundle\Entity\Product $produit
     *
     * @return Alerte_Produit
     */
    public function setProduit(\AppBundle\Entity\Product $produit = null)
    {
        $this->Produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduit()
    {
        return $this->Produit;
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
