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
use AppBundle\Entity\RAVITALLEMENT;
use AppBundle\Form\RAVITALLEMENTType;

class Alerte_ProduitController extends Controller

{
    /**
     * @Route("/AlertPproduit",name="AlerteProduit")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function listAlerte_ProduitAction( Request $request )
    {

        $RAVITALLEMENT= new RAVITALLEMENT();

        $form = $this->createform(RAVITALLEMENTType::class,$RAVITALLEMENT);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $nvquantite=$RAVITALLEMENT->getQuantite();

            $produit=$RAVITALLEMENT->getProduct();

            $ancqte=$produit->getQuantiteProduit();

            $enregistrement = $this->getDoctrine()->getManager();

            $produit->setQuantiteProduit($ancqte+$nvquantite);


            if($produit->getQuantiteProduit()>$produit->getStockMinimum())

            {

                $alertes=$this->getDoctrine()->getManager()->getRepository('AppBundle:Alerte_Produit')->findAll();

                foreach($alertes as $alerte)
                {
                    if($alerte->getProduit()== $produit)
                    {
                        $this->getDoctrine()->getManager()->remove($alerte);
                    }
                }
            }

            $RAVITALLEMENT->setQuantiteAvant($ancqte);

            $enregistrement->persist($RAVITALLEMENT);

            $enregistrement->flush();


            $this->addFlash('notice','Enregistrement reussi');

            return $this->redirectToRoute('homepage');

        }

        $formView= $form->createView();


        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();


        $today=new \DateTime('now');

        return $this->render('Alerte_ProduitList.html.twig',
                 ['form'=>$formView,
                 'Alertes_Produit'=>$Alertes_Produit,
                'Products'=>$Products,
                'today'=>$today
                ]);
    }



}