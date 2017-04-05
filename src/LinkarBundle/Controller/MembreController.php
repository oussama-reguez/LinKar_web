<?php

namespace LinkarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MembreController extends Controller
{
    public function index2Action()
    {
        return $this->render('LinkarBundle:Compte:compte.html.twig');
    }

    public function exempleAction()
    {
        return $this->render('LinkarBundle:Default:index.html.twig');
    }

    public function verificationAction()
    {
        return $this->render('LinkarBundle:Compte:verification.html.twig');
    }

    public function personnelAction()
    {
        return $this->render('LinkarBundle:Compte:informationPersonnel.html.twig');
    }
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $user=$this->getUser();
        $user->setPlainPassword('oussama');
        //  $userManager->updateUser($user);






       // $dd= $encoder->encodePassword('oussama',null);
       // var_dump($encoder);
        //var_dump($dd);
        return new Response();
    }

    public function changePasswordAction(Request $req)
    {
        $userManager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
        $user=$this->getUser();
        $encoder = $factory->getEncoder($user);
        if($req->isMethod('Post')){

            $password =$req->get('passwordinput');
            $newPassword=$req->get('newpasswordinput');var_dump($password);;var_dump($newPassword);
            ;var_dump($user->getPassword());
            ;var_dump( $encoder->encodePassword($password,null));




            if( $encoder->isPasswordValid($user->getPassword(),$password,null)){
                $user->setPlainPassword($newPassword);
                $userManager->updateUser($user);
                return $this->render('LinkarBundle:Compte:changePassword.html.twig',array('m'=>$user,'success'=>true));
            }
            else{
                return $this->render('LinkarBundle:Compte:changePassword.html.twig',array('m'=>$user,'validatePassword'=>true));
            }

        }

        return $this->render('LinkarBundle:Compte:changePassword.html.twig');
    }




    public function uploadAction(Request $req)
    {


       $response = new Response();

        $uploadedFile = $req->files->get('upfile'); //upfile must be the value of the name attribute in the <input> tag
        if (null != $uploadedFile){

        $path = $uploadedFile->getPathname();
        if($uploadedFile->getMimeType()=='image/jpeg') {
            rename($path, 'C:\wamp\www\upload\uploads\\'.$uploadedFile->getFileName().'.jpg' );
        }
        else
            if ($uploadedFile->getMimeType()=='image/png'){
                rename($path, 'C:\wamp\www\upload\uploads\\'.$uploadedFile->getFileName().'.png' );
            }
            else{
               $response->setContent('err');
            }

        var_dump( $uploadedFile);

        }
dump($uploadedFile);

        return $response;
    }


    public function verifierCompteAction(Request $req)
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
        var_dump($user);

        if($req->isMethod('Post')){
            $uploadedFile = $req->files->get('upfile'); //upfile must be the value of the name attribute in the <input> tag

            if (null != $uploadedFile){

                $path = $uploadedFile->getPathname();
                if($uploadedFile->getMimeType()=='image/jpeg') {
                    rename($path, 'C:\wamp\www\upload\uploads\\'.$uploadedFile->getFileName().'.jpg' );
                    $user->setUrlCin('http://localhost/upload/uploads/'.$uploadedFile->getFileName().'.jpg');

                }
                else
                    if ($uploadedFile->getMimeType()=='image/png'){
                        rename($path, 'C:\wamp\www\upload\uploads\\'.$uploadedFile->getFileName().'.png' );
                        $user->setUrlCin('http://localhost/upload/uploads/'.$uploadedFile->getFileName().'.png');
                    }
                    else{
                        return $this->render('@Linkar/Compte/verifierCompte.html.twig',array('m'=>$user,'error'=>true));
                    }


                $em=$this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();//execution de la requete
                return $this->render('@Linkar/Compte/verifierCompte.html.twig',array('m'=>$user,'success'=>true));
            }



        }



        return $this->render('@Linkar/Compte/verifierCompte.html.twig',array('m'=>$user));


    }



    public function unverifiedUsersAction()

    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getUnverifiedUsers();

        return $this->render('@Linkar/gestionUtilisateur/verificationUtilisateur.html.twig',array('m'=>$users));



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
              $verify=$req->get('verify');
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

              if(isset($verify)){
                  if($verify=='on'){
                      $check=true;
                      $user->setVerifCin(true);
                  }
                  if($verify=='off'){
                      $check=true;
                      $user->setVerifCin(false);
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
