<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\VoitureModelType;
use LinkarBundle\Entity\VoitureModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ModelController extends Controller
{

    public function AddModelAction(Request $request){

        $model = new VoitureModel() ;
        $form = $this->createForm(\AdminBundle\Form\VoitureModelType::class, $model) ;
        $form->handleRequest($request);
        //$user = $this->container->get('security.context')->getToken()->getUser();
        //$userID = $user->getUser()->getId();

        if ($form->isSubmitted() && $form->isValid()){


            $em = $this->getDoctrine()->getManager();

            $em->persist($model);
            $em->flush();
            return $this->redirectToRoute('viewModel');
        }

        return $this->render('@Admin/VoitureModel/addModel.html.twig', array('form' => $form->createView()));

    }
    public function EditModelAction($ModelId, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $model=$em->getRepository('LinkarBundle:VoitureModel')->find($ModelId);
        $form=$this->createForm(VoitureModelType::class,$model);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($model);
            $em->flush();
            return $this->redirectToRoute('viewModel');

        }
        return $this->render('@Admin/VoitureModel/editModel.html.twig', array('form'=>$form->createView()));
    }
    public function ViewModelAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $model = $em->getRepository('LinkarBundle:VoitureModel')->findAll();
        return $this->render('@Admin/VoitureModel/viewModel.html.twig', array('m' => $model));
    }
    function DeleteModelAction($ModelId){
        $em=$this->getDoctrine()->getManager();
        $model=$em->getRepository('LinkarBundle:VoitureModel')->find($ModelId);

        $em->remove($model);
        $em->flush();
        return $this->redirectToRoute('viewModel');
    }
}
