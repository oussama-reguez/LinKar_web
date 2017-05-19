<?php

namespace UserBundle\Controller;


use LinkarBundle\Entity\Membre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use LinkarBundle\Entity\User;
use LinkarBundle\Entity\Demande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Form\DemandeType;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class DemandeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function AjoutDemandeAction(Request $request){
        $dem = new Demande();
        $form = $this->createForm('UserBundle\Form\DemandeType',$dem);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $dem->setEtat(false);
            $dem->setEtatDate(false);
            //$dem->setDateDemande(new \Datetime());
            $dem->setIdMembre($this->getUser());
            $em->persist($dem);
            $em->flush();
            return $this->redirectToRoute('Afficher_MesDemandes');
        }

        return $this->render("UserBundle:Demande:AjoutDemande.html.twig", array("f"=>$form->createView()));


    }


    public function AjoutDemande1Action(Request $request){
        $dem = new Demande();
        $res= new Response();
        $depart=$request->get('depart');
        $approdep=$request->get('approdep');
        $destination=$request->get('destination');
        $approdest=$request->get('approdest');
        $date_demande=$request->get('date_demande');

        $fumeur=$request->get('fumeur');
        $bavard=$request->get('bavard');
        $men_only=$request->get('men_only');
        $women_only=$request->get('women_only');
        $animaux=$request->get('animaux');
        $description=$request->get('description');
        $idMembre=$request->get('idMembre');
        $etat=$request->get('etat');
        $etat_date=$request->get('etat_date');
        $tarif=$request->get('tarif');
        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository("LinkarBundle:Membre")->find($idMembre);
        $dem->setDepart($depart);
        $dem->setApprodep($approdep);
        $dem->setDestination($destination);
        $dem->setApprodest($approdest);
        $dem->setDateDemande(\DateTime::createFromFormat('Y-m-d',$date_demande));
        $dem->setFumeur(boolval($fumeur));
        $dem->setBavard(boolval($bavard));
        $dem->setMenOnly(boolval($men_only));
        $dem->setWomenOnly(boolval($women_only));
        $dem->setAnimaux(boolval($animaux));
        $dem->setDescription($description);
        $dem->setIdMembre($user);
        $dem->setTarif($tarif);

        $em = $this->getDoctrine()->getManager();
        $dem->setEtat(false);
        $dem->setEtatDate(false);
        //$dem->setDateDemande(new \Datetime());
        //      $dem->setIdMembre();
        $em->persist($dem);
        $em->flush();
        return $res->setContent('success') ;


        return $this->render("UserBundle:Demande:AjoutDemande.html.twig", array("f"=>$form->createView()));


    }

    public function listDemandeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $recherche = $request->get('rech');
        if ($recherche != "")
        {
            $query = $em->createQuery(
                "SELECT d
                      FROM LinkarBundle:Demande d
                           WHERE (d.depart LIKE :alike
                                or d.destination LIKE :alike)"
            )->setParameter('alike', '%' . $recherche . '%');
            $dem = $query->getResult();
            return $this->render("UserBundle:Demande:AfficherDemande.html.twig", array("b"=>$dem));;
        }
        else
        {
            $query = $em->createQuery(
                "SELECT d
                      FROM LinkarBundle:Demande d
                           WHERE (d.dateDemande > =  :datecourante)"
            )->setParameter('datecourante', new \Datetime('now'));
            $rateall = $query->getResult();

            return $this->render("UserBundle:Demande:AfficherDemande.html.twig", array("b"=>$rateall));
        }





    }

    public function listDemandeAllAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $recherche = $request->get('rech');
        $reponse = new Response ();
        $query = $em->createQuery(
            "SELECT d
                      FROM LinkarBundle:Demande d
                          "
        );
        $dem = $query->getResult();

        return$reponse->setContent('sdfsdf') ;

        //$rateall = $query->getResult();

        return $this->render("UserBundle:Demande:AfficherDemande.html.twig", array("b"=>$rateall));
    }
    public function listMesDemandesAction(){
        $em = $this->getDoctrine()->getManager();
        $dem = $em->getRepository("LinkarBundle:Demande")->findBy(array("idMembre"=>$this->getUser()));
        return $this->render("UserBundle:Demande:AfficherMesDemandes.html.twig", array("b"=>$dem));
    }
    public function listMesReponsesAction(){
        $em = $this->getDoctrine()->getManager();
        $dem = $em->getRepository("LinkarBundle:Demande")->findBy(array("idrep"=>$this->getUser()));
        return $this->render("UserBundle:Demande:AfficherMesRepDemandes.html.twig", array("b"=>$dem));

    }
    function suppDemandeAction($idDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $dem=$em->getRepository('LinkarBundle:Demande')->find($idDemande) ;
        $em->remove($dem);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Demande Supprimée!'
        );
        return $this->redirectToRoute('Afficher_MesDemandes');

    }
    function repDemandeAction($idDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $dem=$em->getRepository('LinkarBundle:Demande')->find($idDemande) ;

        if($this->getUser()!=$dem->getIdMembre())
        {
            $dem->setEtat(true);
            $dem->setIdrep($this->getUser());
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Réponse Envoyée!'
            );
            return $this->redirectToRoute('Afficher_MesReponses');
        }
        else
            return $this->redirectToRoute('Afficher_Demande');

    }
    function editDemandeAction(Request $req,$idDemande)
    {   $em=$this->getDoctrine()->getManager();
        $dem=$em->getRepository('LinkarBundle:Demande')->find($idDemande) ;

        $form=$this->createForm(DemandeType::class,$dem);
        if($form->handleRequest($req)->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($dem); //comme insert into modele
            $em->flush(); //comme exec de la requete
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Demande Modifiée!'
            );
            return $this->redirectToRoute('Afficher_MesDemandes');
        }
        return $this->render("UserBundle:Demande:ModifierDemande.html.twig", array("f"=>$form->createView()));
    }
    function mapsAction($idDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $dem=$em->getRepository('LinkarBundle:Demande')->find($idDemande) ;

        return $this->render("UserBundle:Demande:Mapsdemande.html.twig", array("a"=>$dem));
    }
    function mapsmobileAction($idDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $dem=$em->getRepository('LinkarBundle:Demande')->find($idDemande) ;

        return $this->render("UserBundle:Demande:MapsMobile.html.twig", array("a"=>$dem));
    }

    //////////////////ADMIN///////////////

    public function DemandesAdminAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $dem = $em->getRepository("LinkarBundle:Demande")->findAll();
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate($dem, $request->query->getInt('page', 1),5);
        return $this->render("UserBundle:BackOffice:TrajetDemandes.html.twig", array("c"=>$result));
    }

    function suppDemandesAdminAction($idDemande)
    {
        $em=$this->getDoctrine()->getManager();
        $dem=$em->getRepository('LinkarBundle:Demande')->find($idDemande) ;
        $em->remove($dem);
        $em->flush();
        return $this->redirectToRoute('admindemandes');
    }

}

