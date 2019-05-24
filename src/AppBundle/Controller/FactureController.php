<?php
/**
 * Created by PhpStorm.
 * User: elom
 * Date: 11/07/2017
 * Time: 06:36
 */

namespace AppBundle\Controller;




use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;
use AppBundle\Entity\Facture;


class FactureController extends Controller

{
    /**
     * @Route("/ListeFacture",name="ListeFacture")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function listeFactureAction()
    {


        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');

        $repository= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures = $repository->findAll();

        return $this->render('FactureList.html.twig',
                 ['Alertes_Produit'=>$Alertes_Produit,
                'Products'=>$Products,
                'today'=>$today,
                'Factures'=>$Factures,

                ]);
    }



    /**
     * @Route("/FermerFacture/{id}",name="FermerFacture")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function FermerFactureAction(Request $request,Facture $id)
    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $facture = $repository->findOneBy(['id'=>$id]);

        $facture->setMonnaieRendue($facture->getMontantEncaisse()-$facture->getTotal());

        $facture->setEtat(0);

        $enregistrement = $this->getDoctrine()->getManager();

        $this->addFlash('notice','Edition reussie');

        $enregistrement->flush();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');

        $repository= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures = $repository->findAll();

        return $this->redirectToRoute('ListeFacture');

    }


     /**
     * @Route("/DetailsFacture/{id}",name="DetailsFacture")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function DetailsFactureAction(Request $request,Facture $id)
    {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $facture = $repository->findOneBy(['id'=>$id]);

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');

        $repository= $this->getDoctrine()->getRepository('AppBundle:Facture');

        $Factures = $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Vente');

        $Ventes = $repository->findAll();

         return $this->render('DetailsFacture.html.twig',
                 ['Alertes_Produit'=>$Alertes_Produit,
                'Products'=>$Products,
                'today'=>$today,
                'Factures'=>$Factures,
                'facture'=>$facture,
                'ventes'=>$Ventes,
                ]);

    }



}