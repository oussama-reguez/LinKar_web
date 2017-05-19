<?php

namespace LinkarBundle\Controller;

use LinkarBundle\Form\VoitureType;
use LinkarBundle\LinkarBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LinkarBundle\Entity\Voiture;
use LinkarBundle\Repository\voitureRepository;


class CarController extends Controller
{
    public function AddCarAction(Request $request){

        $voiture = new Voiture() ;
        $voiture->setIdMember(1);
        $form = $this->createForm(VoitureType::class, $voiture) ;
        $form->handleRequest($request);
        $user = $this->getUser();
        $userID = $user->getId();

        if ($form->isSubmitted() && $form->isValid()){

            $file = $voiture->getUrlCarSelfie();
            $fileName = $this->get('app.carpictures_uploader')->upload($file);
            $voiture->setUrlCarSelfie($fileName);


            $em = $this->getDoctrine()->getManager();
            $voiture->setUrlCarSelfie($fileName);
            $voiture->setIdMember($userID);

            $em->persist($voiture);
            $em->flush();
            $this->addFlash(
                'success1',
                'Voiture ajoutée');
            return $this->redirectToRoute('viewVoiture');
        }

        return $this->render('LinkarBundle:Car:Ajout.html.twig', array('form' => $form->createView()));

    }
    public function EditCarAction($idVoiture, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository('LinkarBundle:Voiture')->find($idVoiture);
        $form=$this->createForm(VoitureType::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $file = $voiture->getUrlCarSelfie();
            $fileName = $this->get('app.carpictures_uploader')->upload($file);
            $voiture->setUrlCarSelfie($fileName);

            $em = $this->getDoctrine()->getManager();

            $em->persist($voiture);
            $em->flush();
            $this->addFlash(
                'success2',
                'Voiture modifiée');
            return $this->redirectToRoute('viewVoiture');

        }
        return $this->render('LinkarBundle:Car:Edit.html.twig', array('form'=>$form->createView()));
    }
    public function ViewCarAction()
    {
        $user = $this->getUser();
        $userID = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('LinkarBundle:Voiture')->findBy(array("idMember"=>$userID)); //remplacer 1 par &user

        return $this->render('LinkarBundle:Car:View.html.twig', array('m' => $voiture));
    }
    function DeleteCarAction($idVoiture){
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository('LinkarBundle:Voiture')->find($idVoiture);

        $em->remove($voiture);
        $em->flush();
        $this->addFlash(
            'success3',
            'Voiture supprimée');
        return $this->redirectToRoute('viewVoiture');
    }
}
