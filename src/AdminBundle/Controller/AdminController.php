<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \DateTime;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class AdminController extends Controller
{



    public function dashBoardAction()

    {


        return $this->render('@Admin/layout.html.twig');



    }


    public function testAction()

    {


        return $this->render('@Admin/test.html.twig');



    }


    public function unverifiedUsersAction()

    {



        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getUnverifiedUsers();

        return $this->render('@Admin/verificationCompte/verificationUtilisateur.html.twig',array('m'=>$users));



    }

    public function showAllAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->findAll();

        return $this->render('@Admin/gestionUtilisateur/gestionUtilisateur.html.twig',array('m'=>$users));
    }

    public function searchAction(Request $req)
    {
        if($req->isMethod('GET')){
            $em=$this->getDoctrine()->getManager();
            $name=$req->get('name');
            $type=$req->get('type');
            $order=$req->get('order');
            $dateDebut=$req->get('dateDebut');
            $dateFin=$req->get('dateFin');
            $status=$req->get('status');


            if(isset($name)){

                $n=0 ;
                //verifier si les parametres existe et correcte
                if (isset($type)){
                    if($type=='1'|| $type=='2' || $type=='3'){
                        $n+=1;

                    }

                }

                if(isset($order)){
                    if($order == 'asc'|| $order=='desc'){

                        $n+=1;
                    }
                }

                if(isset($dateFin)){
                    try {
                      if(  $dateFin = DateTime::createFromFormat('d/m/Y', $dateFin)){
                          $n+=1;
                      }


                    } catch (Exception $e) {
                        //error default false
                    }
                }
                if(isset($dateDebut)){
                    if(  $dateDebut = DateTime::createFromFormat('d/m/Y', $dateDebut)){

                    }else{
                        $dateDebut=null;
                    }

                }

                if(isset($status)){
                    if($status=='all'|| $status=='active' || $status=='blocked'){
                        $n+=1;
                    }
                }

                if($n==4){
                    $users=$em->getRepository('LinkarBundle:Membre')->findByCriteria($name,$type,$dateDebut,$dateFin,$order,$status);
                }
                else{
                    return $this->render('AdminBundle:Default:index.html.twig');
                }



            }
            else {
                //change these !!!!!
                return $this->render('AdminBundle:Default:index.html.twig');
            }



        }
        else {
           //change these !!!!!
            return $this->render('AdminBundle:Default:index.html.twig');
        }



        return $this->render('@Admin/gestionUtilisateur/userTable.html.twig',array('m'=>$users));

    }
    public function autoCompleteAction(Request $req)
    {
        if($req->isMethod('GET')){
            $em=$this->getDoctrine()->getManager();
            $name=$req->get('name');
            $type=$req->get('type');
            $order=$req->get('order');
            $dateDebut=$req->get('dateDebut');
            $dateFin=$req->get('dateFin');
            $status=$req->get('status');


            if(isset($name)){

                $n=0 ;
                //verifier si les parametres existe et correcte
                if (isset($type)){
                    if($type=='1'|| $type=='2' || $type=='3'){
                        $n+=1;

                    }

                }

                if(isset($order)){
                    if($order == 'asc'|| $order=='desc'){

                        $n+=1;
                    }
                }

                if(isset($dateFin)){
                    try {
                        if(  $dateFin = DateTime::createFromFormat('d/m/Y', $dateFin)){
                            $n+=1;
                        }


                    } catch (Exception $e) {
                        //error default false
                    }
                }
                if(isset($dateDebut)){
                    if(  $dateDebut = DateTime::createFromFormat('d/m/Y', $dateDebut)){

                    }else{
                        $dateDebut=null;
                    }

                }

                if(isset($status)){
                    if($status=='all'|| $status=='active' || $status=='blocked'){
                        $n+=1;
                    }
                }

                if($n==4){
                    $users=$em->getRepository('LinkarBundle:Membre')->autoCompleteByCriteria($name,$type,$dateDebut,$dateFin,$order,$status);
                }
                else{
                    return $this->render('AdminBundle:Default:index.html.twig');
                }


        $tab =[];
        $t =[];

        foreach ( $users as $a ){
            array_push($t,$a['firstName'].''.$a['lastName']);
        }
        $tab['search']=$t;
        $json =json_encode($tab);

        $res =new Response();
        $res->setContent($json);
        return $res;
    }

        }
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
                   $user->setRoles(array());
                   $user->addRole("ROLE_ADMIN");

                   $check=true;
                //   $user->setRoles()
               }

                  if($role=='membre' ){
                      $user->setRole(false);
                      $user->setRoles(array());

                      $user->addRole("ROLE_USER");
                      //   $user->setRoles()
                      $check=true;
                  }
              }

              if(isset($status)){
                 if($status=='active'){
                     $check=true;
                     $user->setStatut(true);
                     $user->setEnabled(true);
                 }
                  if($status=='blocked'){
                      $check=true;
                      $user->setStatut(false);
                      $user->setEnabled(false);
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

    public function AafficherAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var \Doctrine\ORM\QueryBuilder $qb
         */
        $qb = $em->createQueryBuilder();
        $qb
            ->select('r')
            ->from('LinkarBundle:Reclamation', 'r')
            ->orderBy('r.dateReclamation', 'DESC');

        if($request->isMethod("POST"))
        {
            if ($type = $request->get('recherche'))
            {
                $qb->where('r.type = ?1');
                $qb->setParameter('1', $type);
            }
        }


        $reclamation = $qb->getQuery()->getResult();


        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $reclamation,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit',10)


        );


        return $this->render('@Admin/ReclamationAdmin/starter.html.twig', array('reclamations' => $reclamation
        , 'reclamations'=>$result));


    }

    public function AdsupprimerAction($idReclamation)

    {
        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('LinkarBundle:Reclamation')->find($idReclamation);
        $em->remove($reclamation);
        $em->flush();

        return $this->redirectToRoute('AdafficherRecla');

    }

    public function exAction(Request $request)
    {
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Id_Reclamation')
            ->setCellValue('B1', 'Nom utilisateur')
            ->setCellValue('C1', 'Sujet')
            ->setCellValue('D1', 'Le contenu de la reclamation')
            ->setCellValue('E1', 'Date')
            ->setCellValue('F1', 'Reponse')




        ;;


        $em=$this->getDoctrine()->getManager();
        $reclamation=$em->getRepository('LinkarBundle:Reclamation')->findAll();

        $aux=2;
        foreach ($reclamation as $reclamations){
            $phpExcelObject->setActiveSheetIndex(0)->setCellValue('A'.$aux, $reclamations->getIdReclamation())->setCellValue('B'.$aux, $reclamations->getMembre()->getLastName())
                ->setCellValue('C'.$aux, $reclamations->getSubject())->setCellValue('E'.$aux, $reclamations->getDateReclamation())->setCellValue('D'.$aux, $reclamations->getText())
                ->setCellValue('F'.$aux, $reclamations->getReponse())


            ;
            $aux++;


        };
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'La liste des reclamations.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    public function repondreAction(Request $request)
    {
        $rec_id = $request->get('idReclamation');
        $rec_reponse = $request->get('reponse');

        $em=$this->getDoctrine()->getManager();
        /**
         * @var reclamations $reclamation
         */
        $reclamation=$em->getRepository('LinkarBundle:Reclamation')->find($rec_id);
        $reclamation->setReponse($rec_reponse);
        $em->persist($reclamation);
        $em->flush();

        return $this->redirectToRoute('AdafficherRecla');
    }



}
