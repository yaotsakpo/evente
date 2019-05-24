<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

        /**
     * @var ArrayCollection Factures
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Facture",mappedBy="User",cascade={"remove"})
     */


    private $Factures;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

        /**
     * Add vente
     *
     * @param \AppBundle\Entity\Vente $vente
     *
     * @return Utilisateur
     */
    public function addVente(\AppBundle\Entity\Vente $vente)
    {
        $this->Factures[] = $vente;

        return $this;
    }

    /**
     * Remove vente
     *
     * @param \AppBundle\Entity\Vente $vente
     */
    public function removeVente(\AppBundle\Entity\Vente $vente)
    {
        $this->Factures->removeElement($vente);
    }

    /**
     * Get Factures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFactures()
    {
        return $this->Factures;
    }
}