<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;




class UserController extends Controller{

    /**
     * @Route("/users",name="users")
     * @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request){

        $formFactory = $this->get('fos_user.registration.form.factory');

         /** @var $userManager UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form3 = $formFactory->createForm();
        $form3->setData($user);

        $form3->handleRequest($request);

        if ($form3->isSubmitted()) {
                if ($form3->isValid()) {
                    $event = new FormEvent($form3, $request);
                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                    $userManager->updateUser($user);

                    if (null === $response = $event->getResponse()) {
                        $this->addFlash('notice','Bienvenue dans votre nouveau compte');

                        $url = $this->generateUrl('homepage');
                        $response = new RedirectResponse($url);
                    }

                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                    return $response;
                }

                $event = new FormEvent($form3, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

                if (null !== $response = $event->getResponse()) {
                    return $response;
                }
        }


        $user= new User();

        $form = $this->createform(UserType::class,$user);

        $form->handleRequest($request);

        $formView= $form->createView();


        $userManager=$this->get('fos_user.user_manager');

        $users=$userManager->findUsers();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        return $this->render('utilisateursList.html.twig',array('form'=>$formView,'form2'=>$form3->createView(),'users'=>$users,'Alertes_Produit'=>$Alertes_Produit,'Products'=>$Products));
    }

    /**
     * @Route("/mod/{id}",name="mod")
     * @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function editAction (Request $request, User $id)
    {
        $editForm = $this ->createForm( 'AppBundle\Form\UserType' , $id);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this ->getDoctrine()->getManager();
            $em->persist($id); $em->flush();
            return $this ->redirectToRoute( 'users' );
        }
        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();
        return $this->render( 'edit.html.twig' , array(
            'article' => $id,
            'Alertes_Produit'=>$Alertes_Produit,'Products'=>$Products,
            'edit_form' => $editForm->createView()));
    }

    /**
     * @Route("/effacer/{id}",name="effacer")
     *  @Security("has_role('ROLE_ADMIN')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function sAction (User $id)
    {
        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($id);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('users');
    }



    /**
     * @Route("/essaie",name="essaie")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function EssaieAction(){

        return $this->render('essaie.html.twig');
    }

}