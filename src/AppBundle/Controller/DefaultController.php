<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Alerte_Produit;
use AppBundle\Entity\Vente;
use AppBundle\Form\VenteType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        $vente= new Vente();

        $form = $this->createform(VenteType::class,$vente);

        $form->handleRequest($request);

        $formView= $form->createView();


        $edition = $this->createform(VenteType::class,$vente);

        $edition->handleRequest($request);

        $editionView= $edition->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();


        /*if($this->getUser()->getPassword()==$this->getUser()->setPassword( $this->getUser()->setPlainPassword('Evente')) )
        {

        $this->addFlash('notice','Vous avez un mot de passe par défaut! veuillez le modifier pour plus de sécurité');

        }*/

        //var_dump( );



        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,'Alertes_Produit'=>$Alertes_Produit,'form'=>$formView,'Products'=>$Products,'edition'=>$editionView,
        ]);
       
    }
}
