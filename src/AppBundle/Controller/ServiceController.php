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
use AppBundle\Entity\Service;
use AppBundle\Form\ServiceType;
use AppBundle\Entity\TypeOperation;
use AppBundle\Form\TypeOperationType;
use AppBundle\Entity\Operation;
use AppBundle\Form\OperationType;

class ServiceController extends Controller

{
    /**
     * @Route("/Service",name="Service")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */


    public function ServiceAction(Request $request)
    {

        $Service= new Service();

        $form = $this->createform(ServiceType::class,$Service);

        $form->handleRequest($request);

        $formView= $form->createView();


        $edition = $this->createform(ServiceType::class,$Service);

        $edition->handleRequest($request);

        $editionView= $edition->createView();

        if($form->isSubmitted() && $form->isValid()  ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Service');

            $Services= $repository->findAll();
            $bool=0;
            foreach ($Services as $s)
            {
                if($s->getnom()==$Service->getnom())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Service);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('Service');

            }else
            {
                $this->addFlash('notice', 'Service deja existant!!');

                return $this->redirectToRoute('Service');

            }


        }

        $TypeOperation= new TypeOperation();

        $form2 = $this->createform(TypeOperationType::class,$TypeOperation);

        $form2->handleRequest($request);

        $formView2= $form2->createView();

        if($form2->isSubmitted() && $form2->isValid()  ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeOperation');

            $TypeOperations= $repository->findAll();
            $bool=0;
            foreach ($TypeOperations as $t)
            {
                if($t->getnom()==$TypeOperation->getnom())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($TypeOperation);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('Service');

            }else
            {
                $this->addFlash('notice', 'Type d\'operation deja existant!!');

                return $this->redirectToRoute('Service');

            }


        }

        $edition2 = $this->createform(TypeOperationType::class,$TypeOperation);

        $edition2->handleRequest($request);

        $editionView2= $edition2->createView();


        $Operation= new Operation();

        $form3 = $this->createform(OperationType::class,$Operation);

        $form3->handleRequest($request);

        $formView3= $form3->createView();


        $edition3 = $this->createform(OperationType::class,$Operation);

        $edition3->handleRequest($request);

        $editionView3= $edition3->createView();

        if($form3->isSubmitted() && $form3->isValid()  ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Operation');

            $Operations= $repository->findAll();
            $bool=0;
            foreach ($Operations as $o)
            {
                if( ($o->getdate()->format('d-m-Y')==$Operation->getdate()->format('d-m-Y')) and ( $o->getservice()==$Operation->getservice() ) )
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Operation);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('Service');

            }else
            {
                $this->addFlash('notice', 'Operation deja enregistré pour ce service aujourd\'hui!!');

                return $this->redirectToRoute('Service');

            }


        }


        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Service');

        $Services= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:TypeOperation');

        $TypeOperations= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Operation');

        $Operations= $repository->findAll();


        $today=new \DateTime('now');

        return $this->render('Services.html.twig',
                 [
                'form'=>$formView,
                'edition'=>$editionView,
                'form2'=>$formView2,
                'edition2'=>$editionView2,
                'Alertes_Produit'=>$Alertes_Produit,
                'Products'=>$Products,
                'Services'=>$Services,
                'TypeOperations'=>$TypeOperations,
                'form3'=>$formView3,
                'edition3'=>$editionView3,
                'Operations'=>$Operations,
                'today'=>$today
                ]);
    }


     /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/deleteService/{id}",name="supprimer_Service")
     *
     *
     *
     */

    public function deleteService(Service $Service)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
  
        $enregistrement->remove($Service);
        $enregistrement->flush();


        $this->addFlash('notice','Suppression reussie');


        return $this->redirectToRoute('Service');
    }



   /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/deleteTypeOperation/{id}",name="supprimer_TypeOperation")
     *
     *
     *
     */

    public function deleteTypeOperation(TypeOperation $TypeOperation)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
  
        $enregistrement->remove($TypeOperation);
        $enregistrement->flush();


        $this->addFlash('notice','Suppression reussie');


        return $this->redirectToRoute('Service');
    }


          /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/editService/{id}",name="edit_Service")
     *
     *
     *
     */

    public function editService(Request $request, Service $Service)
    {
        
        $form = $this->createform(ServiceType::class,$Service);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Service');

            $Services= $repository->findAll();

            $bool=0;

            foreach ($Services as $c)
            {
                if($c->getnom()==$Service->getnom() && $c->getId()!=$Service->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('Service');

            }else
            {
                $this->addFlash('notice', 'Service deja existant!!');

                return $this->redirectToRoute('Service');

            }

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');



        return $this->redirectToRoute('Service');
    }

    /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/editTypeOperation/{id}",name="edit_TypeOperation")
     *
     *
     *
     */

    public function editTypeOperation(Request $request, TypeOperation $TypeOperation)
    {
        
        $form = $this->createform(TypeOperationType::class,$TypeOperation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:TypeOperation');

            $TypeOperations= $repository->findAll();

            $bool=0;

            foreach ($TypeOperations as $c)
            {
                if($c->getnom()==$TypeOperation->getnom() && $c->getId()!=$TypeOperation->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('Service');

            }else
            {
                $this->addFlash('notice', 'Type d\'operation deja existant!!');

                return $this->redirectToRoute('Service');

            }

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');



        return $this->redirectToRoute('Service');
    }

        /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/editoperation/{id}",name="edit_operation")
     *
     *
     *
     */

    public function editoperation(Request $request, operation $operation)
    {
        
        $form = $this->createform(operationType::class,$operation);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

      
            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('Service');

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');



        return $this->redirectToRoute('Service');
    }


     /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/deleteoperation/{id}",name="supprimer_operation")
     *
     *
     *
     */

    public function deleteoperation(Operation $operation)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
  
        $enregistrement->remove($operation);
        $enregistrement->flush();


        $this->addFlash('notice','Suppression reussie');


        return $this->redirectToRoute('Service');
    }



}