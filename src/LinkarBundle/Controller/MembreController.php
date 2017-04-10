<?php

namespace LinkarBundle\Controller;

use LinkarBundle\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \DateTime;

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

    public function personnelAction(Request $req)
    {
        $user=$this->getUser();

        $this->denyAccessUnlessGranted('ROLE_USER');

        if($req->isMethod('POST')){
            $nom=$req->get('nom');
            $prenom=$req->get('prenom');
            $birth=$req->get('birth');
            $address=$req->get('address');
            $email=$req->get('email');
            $user=$this->getUser();


            $userManager = $this->get('fos_user.user_manager');
            $user->setFirstName($prenom);
            $user->setLastName($nom);
            $user->setAddress($address);
            if(  $birth = DateTime::createFromFormat('d/m/Y', $birth)){
        $user->setBirth($birth);
            }

            $user->setEmail($email);


            //handle upload if clicked
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
                       // $user->setUrlCin('http://localhost/upload/uploads/'.$uploadedFile->getFileName().'.png');
                        var_dump('http://localhost/upload/uploads/\'.$uploadedFile->getFileName().\'.png\'');
                    }
                    else{

                    }




            }
            else {
                var_dump('nulllllll');
            }
            $userManager->updateUser($user);

        }

        return $this->render('LinkarBundle:Compte:informationPersonnel.html.twig');
    }


    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();

        $dateDebut= new DateTime('02/31/2011');
        $dateFin= new DateTime('04/08/2017');
        $users=$em->getRepository('LinkarBundle:Membre')->autoCompleteByCriteria('',1,null,$dateFin,'asc','all');
        dump($users);
        $tab =[];
        $t =[];


        return new Response();
    }

    public function changePasswordAction(Request $req)
    {

        $user=$this->getUser();

        $this->denyAccessUnlessGranted('ROLE_USER');

$userManager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
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



        }


        return $response;
    }


    public function verifierCompteAction(Request $req)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();


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
















}
