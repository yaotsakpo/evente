<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Product;

/**
 * RAVITALLEMENT
 *
 * @ORM\Table(name="r_a_v_i_t_a_l_l_e_m_e_n_t")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RAVITALLEMENTRepository")
 */
class RAVITALLEMENT
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
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="QuantiteAvant", type="integer")
     */
    private $QuantiteAvant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;


    /**
     *
     * @var Product $Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product",inversedBy="RAVITALLEMENTSs",cascade={"persist"})
     *
     * @ORM\JoinColumn(nullable=true)
     */

    private $Product;



    /**
     * RAVITALLEMENT constructor.
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return RAVITALLEMENT
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
     * @return RAVITALLEMENT
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
     * Set QuantiteAvant
     *
     * @param integer $QuantiteAvant
     *
     * @return RAVITALLEMENT
     */
    public function setQuantiteAvant($QuantiteAvant)
    {
        $this->QuantiteAvant = $QuantiteAvant;

        return $this;
    }

    /**
     * Get QuantiteAvant
     *
     * @return int
     */
    public function getQuantiteAvant()
    {
        return $this->QuantiteAvant;
    }

    /**
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->Product;
    }

    /**
     * @param \AppBundle\Entity\Product $Product
     */
    public function setProduct($Product)
    {
        $this->Product = $Product;
    }



}
