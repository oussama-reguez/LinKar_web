<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminCarController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function ViewCarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var \Doctrine\ORM\QueryBuilder $qb
         */
        $qb = $em->createQueryBuilder();
        $qb
            ->select('r')
            ->from('LinkarBundle:Voiture', 'r')
            ->orderBy('r.idVoiture', 'DESC');
        if($request->isMethod("POST")) {
                $request->request->get('search');
                $type = $request->get('recherche');
                $critere = $request->get('critere');
                if ($type == "Membre") {
                    $qb->where("r.idMember ='$critere'");
                }
                if ($type == "Modèle voiture") {
                    $qb->where("r.model LIKE '%$critere%'");
                }
                if ($type == "Référence voiture") {
                    $qb->where("r.brand LIKE '%$critere%'");
                }
        }

        $car = $qb->getQuery()->getResult();
        return $this->render('AdminBundle:Car:viewCars.html.twig', array('m' => $car));

    }

    function DeleteCarAction($idCar){
        $em=$this->getDoctrine()->getManager();
        $voiture=$em->getRepository('LinkarBundle:Voiture')->find($idCar);

        $em->remove($voiture);
        $em->flush();
        return $this->redirectToRoute('viewCarAdmin');
    }
}
