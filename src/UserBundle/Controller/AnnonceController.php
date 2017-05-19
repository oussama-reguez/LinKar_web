<?php

namespace UserBundle\Controller;


use LinkarBundle\Entity\Voiture;
use LinkarBundle\Entity\Membre;
use LinkarBundle\Entity\Annonce;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LinkarBundle\Entity\User;
use UserBundle\Form\AnnonceType;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceController extends Controller
{
    public function indexAction(Request $request,$name)
    {
        return $this->render('', array('name' => $name));
    }

    public function AjoutAnnonceAction(Request $request){
        $ann = new Annonce();
        $form = $this->createForm(AnnonceType::class,$ann);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            // $ann->setDateAnnonce(new \DateTime());
            $ann->setIdMembre($this->getUser());
            $em->persist($ann);
            $em->flush();
            return $this->redirectToRoute('Afficher_MesAnnonce');
        }
        return $this->render("UserBundle:Annonce:AjoutAnnonce.html.twig", array("f"=>$form->createView()));
    }

    public function listAnnonceAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $recherche = $request->get('rech');
        if ($recherche != "")
        {
            $query = $em->createQuery(
                "SELECT a
                      FROM LinkarBundle:Annonce a
                           WHERE (a.depart LIKE :alike
                                or a.destination LIKE :alike)"
            )->setParameter('alike', '%' . $recherche . '%');
            $ann = $query->getResult();
            return $this->render("UserBundle:Annonce:AfficherAnnonce.html.twig", array("c"=>$ann));
        }
        else
        {
            $query = $em->createQuery(
                "SELECT a
                      FROM LinkarBundle:Annonce a
                           WHERE (a.dateAnnonce > =  :datecourante)"
            )->setParameter('datecourante', new \Datetime('now'));
            $rateall = $query->getResult();

            return $this->render("UserBundle:Annonce:AfficherAnnonce.html.twig", array("c"=>$rateall));
        }
    }

    public function listMesAnnoncesAction(){
        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("LinkarBundle:Annonce")->findBy(array("idMembre"=>$this->getUser()));
        return $this->render("UserBundle:Annonce:AfficherMesAnnonces.html.twig", array("c"=>$ann));
    }

    public function listMesParticipationsAction(){
        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("LinkarBundle:Annonce")->findBy(array("place1"=>$this->getUser(),"place2"=>$this->getUser(),"place3"=>$this->getUser(),"place4"=>$this->getUser()));
        return $this->render("UserBundle:Annonce:AfficherMesParticipations.html.twig", array("c"=>$ann));

    }

    function suppAnnonceAction($idAnnonce)
    {
        $em=$this->getDoctrine()->getManager();
        $ann=$em->getRepository('LinkarBundle:Annonce')->find($idAnnonce) ;
        $em->remove($ann);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Annonce Supprimée!'
        );
        return $this->redirectToRoute('Afficher_MesAnnonce');

    }

    function editAnnonceAction(Request $req,$idAnnonce)
    {
        $em=$this->getDoctrine()->getManager();
        $ann=$em->getRepository('LinkarBundle:Annonce')->find($idAnnonce) ;
        //$ann->setDateAnnonce(new \DateTime());
        $form=$this->createForm(AnnonceType::class,$ann);
        if($form->handleRequest($req)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($ann);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Annonce Modifiée!'
            );
            return $this->redirectToRoute('Afficher_MesAnnonce');
        }
        return $this->render("UserBundle:Annonce:ModifierAnnonce.html.twig", array("f"=>$form->createView()));
    }

    function repAnnonceAction($idAnnonce)
    {
        $em=$this->getDoctrine()->getManager();
        $ann=$em->getRepository('LinkarBundle:Annonce')->find($idAnnonce) ;

        if($ann->getPlaces()>=1)
        {

            if ($ann->getPlace1()==NULL)
            {
                $ann->setPlace1($this->getUser());
                {
                    $ann->setPlaces($ann->getPlaces()-1);
                }
            }
            elseif($ann->getPlace2()==NULL)
            {
                if($ann->getPlace1()!=$this->getUser())
                {
                    $ann->setPlace2($this->getUser());
                    $ann->setPlaces($ann->getPlaces() - 1);
                }
            }
            elseif($ann->getPlace3()==NULL)
            {
                if( ($ann->getPlace1()!=$this->getUser()) && ($ann->getPlace2()!=$this->getUser()))
                {
                    $ann->setPlace3($this->getUser());
                    $ann->setPlaces($ann->getPlaces() - 1);
                }

            }
            elseif ($ann->getPlace4()==NULL)
            {
                if( ($ann->getPlace1()!=$this->getUser()) && ($ann->getPlace2()!=$this->getUser()) && ($ann->getPlace3()!=$this->getUser()))
                {
                    $ann->setPlace4($this->getUser());
                    $ann->setPlaces($ann->getPlaces() - 1);
                }
            }
        }

        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Réponse Envoyée!'
        );
        return $this->redirectToRoute('Afficher_Annonce');

    }

    ///////////////////// PARTIE ADMIN /////////////////////////

    public function AnnoncesAdminAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $ann = $em->getRepository("LinkarBundle:Annonce")->findAll();

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate($ann, $request->query->getInt('page', 1),5);
        return $this->render("UserBundle:BackOffice:TrajetAnnonces.html.twig", array('c'=>$result));
    }

    function suppAnnonceAdminAction($idAnnonce)
    {
        $em=$this->getDoctrine()->getManager();
        $ann=$em->getRepository('LinkarBundle:Annonce')->find($idAnnonce) ;
        $em->remove($ann);
        $em->flush();
       // $sms_sender = $this->get('jhg_nexmo_sms');
       // $sms_sender->sendText('+21620300741', 'Bonjour '.$this->getUser()->getUsername().' Votre Annonce vient detre signalee et supprimée', 'Linkar');
        return $this->redirectToRoute('adminannonces');
    }



}
