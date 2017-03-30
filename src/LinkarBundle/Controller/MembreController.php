<?php

namespace LinkarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MembreController extends Controller
{
    public function indexAction()

    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->gettBlockedUsers();
        var_dump($users);
        return new Response();
    }

    public function showAllAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->findAll();

        return $this->render('LinkarBundle:gestionUtilisateur:gestionUtilisateur.html.twig',array('m'=>$users));
    }



    public function searchAction(Request $req)
    {
        if($req->isMethod('GET')){
            $name=$req->get('name');


            if(isset($name)){
                $em=$this->getDoctrine()->getManager();
                $users=$em->getRepository('LinkarBundle:Membre')->findByfullNameDQL($name);
            }
            else {
                return $this->render('LinkarBundle:Default:index.html.twig');
            }



        }
        else {
            return $this->render('LinkarBundle:Default:index.html.twig');
        }

//dump($name);
//var_dump($users);
        return $this->render('LinkarBundle:gestionUtilisateur:userTable.html.twig',array('m'=>$users));

    }


    public   function EditUserAction(Request $req){
        $response = new Response();
          if($req->isMethod('GET')){
              $id=$req->get('id');
              $role=$req->get('role');
              $status=$req->get('status');
                $check=false;

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
                   $check=true;
                //   $user->setRoles()
               }

                  if($role=='membre' ){
                      $user->setRole(false);
                      //   $user->setRoles()
                      $check=true;
                  }
              }

              if(isset($status)){
                 if($status=='active'){
                     $check=true;
                     $user->setStatut(true);
                 }
                  if($status=='blocked'){
                      $check=true;
                      $user->setStatut(false);
                  }
              }

          }
          if ($check){
              $em=$this->getDoctrine()->getManager();
              $em->persist($user);
              $em->flush();//execution de la requete


              $response->setContent('success');
              $response->setStatusCode(Response::HTTP_OK);
          }
          else{
              $response->setStatusCode(Response::HTTP_NOT_IMPLEMENTED);
              $response->setContent('error');
          }

          return $response;



          }



}
