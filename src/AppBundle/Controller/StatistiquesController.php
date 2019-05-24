<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Facture;
use AppBundle\Entity\Product;
use AppBundle\Form\FactureType;
use AppBundle\Entity\Vente;
use AppBundle\Form\VenteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;


class StatistiquesController extends Controller
{

    /**
     * @Route("/Statistique",name="Statistique")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function listStatistiquesAction(Request $request)
    {
        


        $vente= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Ventes= $vente->findAll();

        $today=new \DateTime('now');
        $d=new \DateTime('now');
        $precedent=$d->modify('-7 day');

        $Fact= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures= $Fact->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $Statistiques= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Statistiques= $Statistiques->findAll();



        return $this->render('Statistiques.html.twig',[
            'today'=>$today,'prec'=>$precedent,
            'Ventes'=>$Ventes,
            'Factures'=>$Factures,
            'Alertes_Produit'=>$Alertes_Produit,
            'Products'=>$Products,
            'Statistiques'=>$Statistiques,
        ]);
    }


    /**
     * @Route("/Stat/{debut}/{fin}",name="Stat")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function listStatAction(Request $request,\DateTime $debut,\DateTime $fin)
    {
        

        $vente= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Ventes= $vente->getStat($debut->format('Y-m-d'),$fin->format('Y-m-d'));

        $today=new \DateTime('now');
        $d=new \DateTime('now');
        $precedent=$d->modify('-7 day');

        $Fact= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures= $Fact->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();


        //$Statistiques= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Statistiques= $Ventes;



        return $this->render('StatistiquesResultat.html.twig',[
            'today'=>$today,
            'prec'=>$precedent,
            'Ventes'=>$Ventes,
            'Factures'=>$Factures,
            'debut'=>$debut,'fin'=>$fin,
            'Alertes_Produit'=>$Alertes_Produit,
            'Products'=>$Products,
            'Statistiques'=>$Statistiques,

        ]);
    }


    /**
     * @Route("/StatistiqueProduit/{id}",name="ProduitStatistique")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function ProduitStatistiquesAction(Request $request,Product $product)
    {
        


        $vente= $this->getDoctrine()->getRepository('AppBundle:Vente');

        $Ventes= $vente->getProduitStat($product->getId());

        $today=new \DateTime('now');
        $d=new \DateTime('now');
        $precedent=$d->modify('-7 day');

        $Fact= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures= $Fact->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $Statistiques= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Statistiques= $Statistiques->findAll();



        return $this->render('ProduitStat.html.twig',[
            'today'=>$today,'prec'=>$precedent,
            'product'=>$product,
            'Ventes'=>$Ventes,
            'Factures'=>$Factures,
            'Alertes_Produit'=>$Alertes_Produit,
            'Products'=>$Products,
            'Statistiques'=>$Statistiques,
        ]);
    }


        /**
     * @Route("/StatistiqueProduit/DateStatistiqueProduit/{id}/{debut}/{fin}",name="DateProduitStatistique")
     *
     * 
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function DateProduitStatistiquesAction(Request $request,Product $product,\DateTime $debut,\DateTime $fin)
    {
        


        $vente= $this->getDoctrine()->getRepository('AppBundle:Vente');

        $Ventes= $vente->getDateProduitStat($product->getId(),$debut->format('Y-m-d'),$fin->format('Y-m-d'));

        $today=new \DateTime('now');
        $d=new \DateTime('now');
        $precedent=$d->modify('-7 day');

        $Fact= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures= $Fact->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $Statistiques= $this->getDoctrine()->getRepository('AppBundle:Statistique');

        $Statistiques= $Statistiques->findAll();



        return $this->render('ProductStatistiquesResultat.html.twig',[
            'today'=>$today,'prec'=>$precedent,
            'product'=>$product,
            'Ventes'=>$Ventes,
            'Factures'=>$Factures,
            'debut'=>$debut,'fin'=>$fin,
            'Alertes_Produit'=>$Alertes_Produit,
            'Products'=>$Products,
            'Statistiques'=>$Statistiques,
        ]);
    }

}
