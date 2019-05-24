<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="nomProduit", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $nomProduit;

    /**
     * @var int
     *
     * @ORM\Column(name="QuantiteProduit", type="integer")
     *
     * @Assert\NotBlank()
     */
    private $quantiteProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="PrixAchat", type="decimal", precision=10, scale=2)
     *
     *
     * @Assert\NotBlank()
     */
    private $prixAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="PrixVente", type="decimal", precision=10, scale=2)
     *
     * @Assert\NotBlank()
     */
    private $prixVente;

    /**
     * @var int
     *
     * @ORM\Column(name="StockMinimum", type="integer")
     */
    private $stockMinimum;


    /**
     *
     * @var Categorie $categorie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie",inversedBy="Products",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=true)
     */

    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RAVITALLEMENT",mappedBy="Product",cascade={"remove"})
     */

    private $RAVITALLEMENTS;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Alerte_Produit",mappedBy="Produit")
     */

    private $alertes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vente",mappedBy="produit",cascade={"remove"})
     */

    private $ventes;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProduitPrixVente", type="string", length=255)
     */


    private $nomProduitPrixVente;

    /**
     * @return string
     */
    public function getNomProduitPrixVente()
    {
        return $this->nomProduitPrixVente;
    }

    /**
     * @param string $nomProduitPrixVente
     */
    public function setNomProduitPrixVente($nomProduitPrixVente)
    {
        $this->nomProduitPrixVente = $nomProduitPrixVente;
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
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Product
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * Set quantiteProduit
     *
     * @param integer $quantiteProduit
     *
     * @return Product
     */
    public function setQuantiteProduit($quantiteProduit)
    {
        $this->quantiteProduit = $quantiteProduit;

        return $this;
    }

    /**
     * Get quantiteProduit
     *
     * @return int
     */
    public function getQuantiteProduit()
    {
        return $this->quantiteProduit;
    }

    /**
     * Set prixAchat
     *
     * @param string $prixAchat
     *
     * @return Product
     */
    public function setPrixAchat($prixAchat)
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    /**
     * Get prixAchat
     *
     * @return string
     */
    public function getPrixAchat()
    {
        return $this->prixAchat;
    }

    /**
     * Set prixVente
     *
     * @param string $prixVente
     *
     * @return Product
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * Get prixVente
     *
     * @return string
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }

    /**
     * Set stockMinimum
     *
     * @param integer $stockMinimum
     *
     * @return Product
     */
    public function setStockMinimum($stockMinimum)
    {
        $this->stockMinimum = $stockMinimum;

        return $this;
    }

    /**
     * Get stockMinimum
     *
     * @return int
     */
    public function getStockMinimum()
    {
        return $this->stockMinimum;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->RAVITALLEMENTS = new \Doctrine\Common\Collections\ArrayCollection();

    }


    /**
     * Add alerte
     *
     * @param \AppBundle\Entity\Alerte_Produit $alerte
     *
     * @return Product
     */
    public function addAlerte(\AppBundle\Entity\Alerte_Produit $alerte)
    {
        $this->alertes[] = $alerte;

        return $this;
    }

    /**
     * Remove alerte
     *
     * @param \AppBundle\Entity\Alerte_Produit $alerte
     */
    public function removeAlerte(\AppBundle\Entity\Alerte_Produit $alerte)
    {
        $this->alertes->removeElement($alerte);
    }

    /**
     * Get alertes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlertes()
    {
        return $this->alertes;
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
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Product
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function getRAVITALLEMENTS()
    {
        return $this->RAVITALLEMENTS;
    }

    /**
     * @param mixed $RAVITALLEMENTS
     */
    public function setRAVITALLEMENTS($RAVITALLEMENTS)
    {
        $this->RAVITALLEMENTS = $RAVITALLEMENTS;
    }



}
