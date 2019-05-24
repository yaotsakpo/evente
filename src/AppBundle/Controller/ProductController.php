<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Alerte_Produit;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Product;
use AppBundle\Form\CategorieType;
use AppBundle\Form\ProductType;
use AppBundle\Entity\RAVITALLEMENT;
use AppBundle\Form\RAVITALLEMENTType;
use AppBundle\Entity\Facture;
use AppBundle\Entity\Vente;
use AppBundle\Entity\Statistique;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Persistence\ObjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProductController extends Controller

{
    /**
     * @Route("/add",name="addProduct")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * 
     */
    public function addAction(Request $request)
    {
        
        $product= new Product();


        $form = $this->createform(ProductType::class,$product);

        $form->handleRequest($request);



        $edition = $this->createform(ProductType::class,$product);

        $edition->handleRequest($request);




        $Categorie= new Categorie();

        $form2 = $this->createform(CategorieType::class,$Categorie);

        $form2->handleRequest($request);


        $edition1 = $this->createform(CategorieType::class,$Categorie);

        $edition1->handleRequest($request);
        

        if($form2->isSubmitted() && $form2->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Categorie');

            $Categories= $repository->findAll();
            $bool=0;
            foreach ($Categories as $c)
            {
                if($c->getlibelleCategorie()==$Categorie->getlibelleCategorie())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Categorie);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('addProduct');

            }else
            {
                $this->addFlash('notice', 'Categorie deja existant!!');

                return $this->redirectToRoute('addProduct');

            }

        }

        $formView2= $form2->createView();


        if($form->isSubmitted() && $form->isValid()  ){

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $P= $repository->findAll();
        $bool=0;
        foreach ($P as $pro) 
        {
           if($pro->getNomProduitPrixVente()==($product->getCategorie()->getlibelleCategorie() . " " . ' - ' . " " . $product->getNomProduit()))
           {
                $bool=1;
           }
        }

        if($bool==0)
        {
            if($product->getQuantiteProduit()>0 ) {

                if($product->getStockMinimum()>0) {


                    $enregistrement = $this->getDoctrine()->getManager();
                    $product->setNomProduitPrixVente($product->getCategorie()->getlibelleCategorie() . " " . ' - ' . " " . $product->getNomProduit());

                    if (($product->getQuantiteProduit()) < ($product->getStockMinimum()) or ($product->getQuantiteProduit()) == ($product->getStockMinimum())) {
                        $Alerte = new Alerte_Produit();



                        $em = $this->getDoctrine()->getManager();

                        $Alerte->setProduit($product);

                        $em->persist($Alerte);

                        $em->flush();
                    }

                    $enregistrement->persist($product);
                    $enregistrement->flush();

                    $this->addFlash('notice', 'Enregistrement reussi');

                    return $this->redirectToRoute('addProduct');
                }else
                {
                    $this->addFlash('notice', 'Enregistrement échoué.Stock minimum de produit négative!!');

                    return $this->redirectToRoute('addProduct');
                }

            }
            else
            {
                $this->addFlash('notice', 'Enregistrement échoué.Quantite de produit négative!!');

                return $this->redirectToRoute('addProduct');
            }
        }else
        {
             $this->addFlash('notice', 'Produit deja existant!!');

             return $this->redirectToRoute('addProduct');

        }

        }

        $formView= $form->createView();

        $RAVITALLEMENT= new RAVITALLEMENT();

        $form4 = $this->createform(RAVITALLEMENTType::class,$RAVITALLEMENT);

        $form4->handleRequest($request);

        if($form4->isSubmitted() && $form4->isValid() ){

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

            return $this->redirectToRoute('addProduct');

        }

        $formView4= $form4->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();  

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Categorie');

        $Categories= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:RAVITALLEMENT');

        $RAVITALLEMENTS= $repository->findAll();


        $today=new \DateTime('now');

        $editionview=$edition->createView();

        $editionview1=$edition1->createView();


       
        return $this->render('productAdd.html.twig',['edition1'=>$editionview1,'edition'=>$editionview,'RAVITALLEMENTS'=>$RAVITALLEMENTS,'ravform'=>$formView4,'Catform'=>$formView2,'form'=>$formView,'Alertes_Produit'=>$Alertes_Produit,'Categories'=>$Categories,'Products'=>$Products,'today'=>$today]);
    }

    
    /**
     *
     *
     * @return Response
     *
     *
     *
     * @Route("/edit_produit/{id}",name="edit_Produit")
     *
     *
     *
     */


    public function edit(Request $request, Product $product)
    {

        $Categorie= new Categorie();

        $form2 = $this->createform(CategorieType::class,$Categorie);

        $form2->handleRequest($request);

        if($form2->isSubmitted() && $form2->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Categorie');

            $Categories= $repository->findAll();
            $bool=0;
            foreach ($Categories as $c)
            {
                if($c->getlibelleCategorie()==$Categorie->getlibelleCategorie())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
                $enregistrement = $this->getDoctrine()->getManager();

                $enregistrement->persist($Categorie);
                $enregistrement->flush();

                $this->addFlash('notice','Enregistrement reussi');

                return $this->redirectToRoute('addProduct');

            }else
            {
                $this->addFlash('notice', 'Categorie deja existant!!');

                return $this->redirectToRoute('addProduct');

            }

        }

        $formView2= $form2->createView();


        $form = $this->createform(ProductType::class,$product);

        $form->handleRequest($request);


        $anc=0;


        if($form->isSubmitted() && $form->isValid() )
        {

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $P= $repository->findAll();
        
        $bool=0;
        foreach ($P as $pro) 
        {
           if( ($pro->getNomProduitPrixVente()==($product->getCategorie()->getlibelleCategorie() . " " . ' - ' . " " . $product->getNomProduit())) and($pro->getId()!=$product->getId() ) )
           {
                $bool=1;
           }
        }

        if($bool==0)
        {

            if($product->getQuantiteProduit()>0 ) {

                if($product->getStockMinimum()>0) {


                $enregistrement = $this->getDoctrine()->getManager();

            if($product->getQuantiteProduit()>$product->getStockMinimum())

            {
                $alertes=$this->getDoctrine()->getManager()->getRepository('AppBundle:Alerte_Produit')->findAll();

                foreach($alertes as $alerte)
                {
                    if($alerte->getProduit()== $product)
                    {
                        $this->getDoctrine()->getManager()->remove($alerte);

                    }
                }
            }

            $alertes=$this->getDoctrine()->getManager()->getRepository('AppBundle:Alerte_Produit')->findAll();

            foreach($alertes as $alerte)
            {
                if($alerte->getProduit()== $product)
                {
                    $anc=1;

                }
            }


                if (($product->getQuantiteProduit()) < ($product->getStockMinimum()) or ($product->getQuantiteProduit()) == ($product->getStockMinimum())) {

                    if($anc==0)
                    {
                            $Alerte = new Alerte_Produit();

                            $em = $this->getDoctrine()->getManager();


                            $Alerte->setProduit($product);

                            $em->persist($Alerte);

                            $em->flush();
                    }
            }


            $product->setNomProduitPrixVente($product->getCategorie()->getlibelleCategorie() . " " . ' - ' . " " . $product->getNomProduit());

            $this->addFlash('notice','Edition reussie');

            $enregistrement->flush();



            return $this->redirectToRoute('addProduct');

            }else
            {
                $this->addFlash('notice', 'Enregistrement échoué.Stock minimum de produit négative!!');

                return $this->redirectToRoute('addProduct');
            }

        }
        else
        {
            $this->addFlash('notice', 'Enregistrement échoué.Quantite de produit négative!!');

            return $this->redirectToRoute('addProduct');
        }
        }else
        {
             $this->addFlash('notice', 'Produit deja existant!!');

             return $this->redirectToRoute('addProduct');

        }

    }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();


        $today=new \DateTime('now');


        return $this->render('productAdd.html.twig',['Catform'=>$formView2,'form'=>$formView,'Alertes_Produit'=>$Alertes_Produit,'Products'=>$Products,'today'=>$today]);
    }
    /**
     *
     *
     * @return Response
     *
     * @Route("/delete/{id}",name="supprimer")
     *
     *
     *
     */

    public function delete(Product $product)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        foreach($Alertes_Produit as $alerte){
            if($alerte->getProduit()==$product)
            {
                $product->removeAlerte($alerte);
            }
        }
        $enregistrement->remove($product);
        $enregistrement->flush();
        $this->addFlash('notice','Suppression reussie');


        return $this->redirectToRoute('addProduct');


    }




      /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/editCategorie/{id}",name="edit_Categorie")
     *
     *
     *
     */

    public function editCategory(Request $request, Categorie $Categorie)
    {
        
        $form = $this->createform(CategorieType::class,$Categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $repository= $this->getDoctrine()->getRepository('AppBundle:Categorie');

            $Categories= $repository->findAll();

            $bool=0;

            foreach ($Categories as $c)
            {
                if($c->getLibelleCategorie()==$Categorie->getLibelleCategorie() && $c->getId()!=$Categorie->getId())
                {
                    $bool=1;
                }
            }

            if($bool==0)
            {
            $enregistrement = $this->getDoctrine()->getManager();


            $this->addFlash('notice','Edition reussie');


            $enregistrement->flush();

            return $this->redirectToRoute('addProduct');

            }else
            {
                $this->addFlash('notice', 'Categorie deja existant!!');

                return $this->redirectToRoute('addProduct');

            }

        }

        $formView= $form->createView();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $today=new \DateTime('now');



        return $this->redirectToRoute('addProduct');
    }


     /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/deleteRAVITALLEMENT/{id}",name="supprimer_RAVITALLEMENT")
     *
     *
     *
     */

    public function deleteRavitaillement(RAVITALLEMENT $RAVITALLEMENT)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
        $qt=$RAVITALLEMENT->getProduct()->getQuantiteProduit();
        $RAVITALLEMENT->getProduct()->setQuantiteProduit($qt-$RAVITALLEMENT->getQuantite());
        if( $RAVITALLEMENT->getProduct()->getQuantiteProduit() <= $RAVITALLEMENT->getProduct()->getStockMinimum() )
        {
          $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

          $ale= $repository->findOneBy(['Produit'=>$RAVITALLEMENT->getProduct()]);

          //var_dump($ale);

          if($ale == null)
          {

          $Alerte = new Alerte_Produit();

          $em = $this->getDoctrine()->getManager();

          $Alerte->setProduit($RAVITALLEMENT->getProduct());

          $em->persist($Alerte);

          $em->flush();

          }

          

        }
        $enregistrement->remove($RAVITALLEMENT);
        $enregistrement->flush();


        $this->addFlash('notice','Suppression reussie');


        return $this->redirectToRoute('addProduct');



    }


        /**
     *
     *
     * @return Response
     *
     * 
     *
     * @Route("/deleteCategorie/{id}",name="supprimer_Categorie")
     *
     *
     *
     */

    public function deleteCategorie(Categorie $Categorie)
    {
        

        $enregistrement = $this->getDoctrine()->getManager();
        $enregistrement->remove($Categorie);
        $enregistrement->flush();

        $this->addFlash('notice','Suppression reussie');

        return $this->redirectToRoute('addProduct');



    }



    /**
     *
     *
     * @Route("/add_vente/{fact}",name="vente_add")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */

    public function addVente(Request $request, $fact)
    {



        $bill= json_decode($fact, true);

        $caisse=$bill["caisse"];

        $enregistrement = $this->getDoctrine()->getManager();

        $Facture= new Facture();

        $Facture->setDate(new \DateTime('now'));

        $Facture->setMontantEncaisse($caisse[0]["client"]);

        $Facture->setMonnaieRendue($caisse[0]["remi"]);

        $Facture->setRemise($caisse[0]["remise"]);

        if($caisse[0]["remi"]==$caisse[0]["monnaie"]){
            $Facture->setEtat(0);
        }else
        {
            $Facture->setEtat(1);
        }
        $Facture->setTotal($caisse[0]["total"]);

        $Facture->setUser($this->getUser());

        $idfacture=$Facture->getId();

        $enregistrement->persist($Facture);

        $enregistrement->flush();


        $ga=0;


        foreach($bill["produit"] as $produit)
        {
          //var_dump($produit);


            $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

            $enregistrement = $this->getDoctrine()->getManager();

            $Prdt= $repository->findOneBy(['nomProduitPrixVente'=>$produit["nom"]]);

            $vente= new Vente();

            $vente->setProduit($Prdt);

            $vente->setfacture($Facture);

            $vente->setQuantite($produit["quantite"]);

            $Vent = $Prdt->getPrixVente();

            $Acha = $Prdt->getPrixAchat();

            $gainfinal = (($Vent - $Acha) * $produit["quantite"]);

            $vente->setGain($gainfinal);

            $qte = $Prdt->getQuantiteProduit();

            $stock = $vente->getProduit()->getQuantiteProduit();

            $qteVendu = $produit["quantite"];

            $Prdt->setQuantiteProduit($stock - $qteVendu);

            $reste = $stock - $qteVendu;

            if (($reste == $Prdt->getStockMinimum() or $reste < $Prdt->getStockMinimum()) and $qte > $Prdt->getStockMinimum()) {

                $Alerte = new Alerte_Produit();


                $em = $this->getDoctrine()->getManager();

                $Alerte->setProduit($Prdt);

                $em->persist($Alerte);

                $em->flush();
            }
            $vente->setTotal($vente->getQuantite()*$vente->getProduit()->getPrixVente());

            $enregistrement->persist($vente);
            $enregistrement->flush();

            $ga=$vente->getGain()+$ga;

        }


          $repository= $this->getDoctrine()->getRepository('AppBundle:Statistique');

            $Statistiques= $repository->findAll();
            $b=0;
            foreach($Statistiques as $statis)
            {
                $aujour=(new \DateTime('now'))->format('d-m-Y');

                if($statis->getDate()->format('d-m-Y')== $aujour)
                {
                    $b=1;
                }
                else
                {
                    $b=0;
                }
            }


            if($b==1)
            {
                $e= $this->getDoctrine()->getManager();
                $tota=$statis->getTotalvente();
                $kai=$statis->getCaisse();
                $g=$statis->getGain();
                $statis->setTotalvente( $caisse[0]["total"] + $tota );
                $statis->setGain( ($ga-$caisse[0]["remise"])+$g );
                $statis->setCaisse( $caisse[0]["total"] +$kai );
                $e->flush();

            }

            if($b==0)
            {
                $e= $this->getDoctrine()->getManager();
                $stat = new Statistique();
                $stat->setDate(new \DateTime('now'));
                if( ($ga-$caisse[0]["remise"]) > 0)
                {
                  $stat->setGain($ga-$caisse[0]["remise"]);
                }
                else
                {
                  $stat->setGain(0);
                }
                $stat->setTotalvente($caisse[0]["total"]);
                $stat->setCaisse( $caisse[0]["total"] );
                $e->persist($stat);
                $e->flush();
            }

         $repository= $this->getDoctrine()->getRepository('AppBundle:Alerte_Produit');

        $Alertes_Produit= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Product');

        $Products= $repository->findAll();

        $repository= $this->getDoctrine()->getRepository('AppBundle:Vente');

        $ventes= $repository->findBy(['facture'=>$Facture]);


        $today=new \DateTime('now');



        $this->addFlash('notice','Vente effectué avec succès');

        return $this->render('impression.html.twig',['Facture'=>$Facture,'ventes'=>$ventes,'caisse'=>$caisse,'Alertes_Produit'=>$Alertes_Produit,'Products'=>$Products,'today'=>$today]);



    }






}