<?php

namespace LinkarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MembreController extends Controller
{
    public function indexAction()
    {
        return $this->render('LinkarBundle:Default:index.html.twig');
    }

    public function showAllAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->findAll();

        return $this->render('LinkarBundle:gestionUtilisateur:gestionUtilisateur.html.twig',array('m'=>$users));
    }


    public   function EditUserAction($req){
          if($req->isMethod('GET')){
              $id=$req->get('id');
              $role=$req->get('role');
              $status=$req->get('status');


              if(isset($id)){
                  $em=$this->getDoctrine()->getManager();
                  $user=$em->getRepository('LinkarBundle:Membre')->find($id);
              }
              else {
                  //erreur
              }

              if(isset($role)){
               if($role=='admin' ){
                   $user->setRole(true);
                //   $user->setRoles()
               }

                  if($role=='user' ){
                      $user->setRole(false);
                      //   $user->setRoles()
                  }
              }

              if(isset($status)){
                 if($status=='active'){
                     $user->setStatut(true);
                 }
                  if($status=='blocked'){
                      $user->setStatut(false);
                  }
              }

          }


          $em=$this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();//execution de la requete
          return $this->render('LinkarBundle:Default:index.html.twig');



          }



}
