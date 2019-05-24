<?php

namespace AppBundle\Repository;

/**
 * VenteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Doctrine\ORM\EntityRepository;

class VenteRepository extends \Doctrine\ORM\EntityRepository
{

	public function getProduitStat($id)
    {
        $query="
        SELECT SUM(s.quantite) as quantite ,SUM(s.Total) as Total ,SUM(s.gain) as Gain ,s.date,p.nomProduitPrixVente
        FROM AppBundle:Vente s
        JOIN AppBundle:Product p
        WHERE s.produit ='$id' and p.id='$id'
        GROUP BY s.date ";

       

        return $this->getEntityManager()->createQuery($query)->getResult();
    }

    public function getDateProduitStat($id,$debut,$fin)
    {
        $query="
        SELECT SUM(s.quantite) as quantite ,SUM(s.Total) as Total ,SUM(s.gain) as Gain ,s.date,p.nomProduitPrixVente
        FROM AppBundle:Vente s
        JOIN AppBundle:Product p
        WHERE s.produit ='$id' and p.id='$id' and s.date BETWEEN '$debut' and '$fin'
        GROUP BY s.date ";

       

        return $this->getEntityManager()->createQuery($query)->getResult();
    }
}
