<?php

namespace StatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;

class GrapheController extends Controller
{
    public function indexAction()
    {
        return $this->render('StatBundle:Default:index.html.twig');
    }


    public function userChartLine()

    {


        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getStatCreatedUsersDql();



        $tab= array();
        foreach ($users as $classe) {

            array_push($tab, $classe['d']);



        }

        $tab2= array();
        $num=0;
        foreach ($users as $classe) {
         $num+=   intval($classe[1]);

            array_push($tab2, $num);



        }


        $series = array(
            array("name" => "Les utilisateurs inscrits",    "data" => $tab2),

        );



        dump($tab);
        dump($tab2);
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Evolution mensuelle du nombre des utilisateurs inscrits');
        $ob->xAxis->title(array('text'  => "date"));
        $ob->yAxis->title(array('text'  => "nombre dutilisateur"));
        $ob->series($series);
        $ob->xAxis->categories($tab);


return $ob;

    }




    public function barChart() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getStatCreatedUsersbyYearDql();

        $data= array();

        foreach ($users as $classe) {


            array_push($data, intval($classe[1]));



        }


        $series = array(
            array("name" => "Data Serie Name",    "data" => $data)
        );



        $dates= array();
        foreach ($users as $classe) {

            array_push($dates, $classe['d']);



        }
        $ob = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $ob->chart->renderTo('barchart');
        $ob->title->text('Nombre totale des utilisateurs groupés par année');
        $ob->chart->type('column');

        $ob->yAxis->title(array('text' => "nombre d'utilisateur"));

        $ob->xAxis->title(array('text' => "Année"));
        $ob->xAxis->categories($dates);

        $ob->series($series);

       return $ob;
    }




    public function pieGenderChart() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getStatnbrUsersbyGender();



        $data= array();

        foreach ($users as $classe) {


            array_push($data, array($classe['gender'],intval($classe[1])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('genderpiechart');
        $ob->title->text('Nombre totale des utilisateurs par sexe');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

       return $ob;
    }

    public function pieDestinationChart() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Annonce')->getPopularDestination();



        $data= array();

        foreach ($users as $classe) {


            array_push($data, array($classe['destination'],intval($classe['cnt'])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('destinationpiechart');
        $ob->title->text('Les villes de destination les plus populaires');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $ob;
    }

    public function pieDepartChart() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Annonce')->getPopularDepart();



        $data= array();

        foreach ($users as $classe) {


            array_push($data, array($classe['depart'],intval($classe['cnt'])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('departpiechart');
        $ob->title->text('Les villes de départ les plus populaires ');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $ob;
    }


    public function pieStateChart() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Annonce')->countAnnonceByState();

        dump($users);

        $data= array();

        foreach ($users as $classe) {
            $i=intval($classe['etat']);
            $etat='';
            if($i==0){
                $etat="terminé" ;
            }
            if($i==1){
                $etat="en cours" ;
            }

            if($i==2){
                $etat="supprimé" ;
            }

            array_push($data, array($etat,intval($classe[1])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('statepiechart');
        $ob->title->text('Nombre des annonces selon leur état');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $ob;
    }

    public function chartLineAnnounce()

    {


        $em=$this->getDoctrine()->getManager();

        $years=$em->getRepository('LinkarBundle:Annonce')->getYears();
        $series= array();

        foreach ($years as $year) {

        $users=$em->getRepository('LinkarBundle:Annonce')->getStatAnnonceByYear($year['d']);

        $tab2= array();
        $lastMonth= intval(end($users)['d']);
        for ($i = 1; $i <= $lastMonth; $i++) {
            array_push($tab2, 0);
        }

        $num=0;

        foreach ($users as $classe) {
            $num+=   intval($classe[1]);

            $tab2[intval($classe['d'])-1]=$num;




        }

            array_push($series, array("name" => $year['d'],    "data" => $tab2) );


        }



        $categorie = array(
        '01','02','03','04','05','06','07','08','09','10','11','12'

        );


        dump($tab2);
        $ob = new Highchart();
        $ob->chart->renderTo('annoncelinechart');  // The #id of the div where to render the chart
        $ob->title->text('Evolution mensuel des nombres d’annonces groupé par année');
        $ob->xAxis->title(array('text'  => "Mois"));
        $ob->yAxis->title(array('text'  => "Nombre d'annonce"));
        $ob->series($series);
        $ob->xAxis->categories($categorie);

        return $ob;


    }

   public function  AnnounceStatAction(){
        $em=$this->getDoctrine()->getManager();

       $count=$em->getRepository('LinkarBundle:Annonce')->countNbrAnnonce()[1];
 $ob =$this->chartLineAnnounce();
       $ob2 =$this->pieDestinationChart();
       $ob3=$this->pieDepartChart();
       $ob4=$this->pieStateChart();






       return $this->render('StatBundle:stat:annonceStat.html.twig', array( 'nbrannonce'=>$count,
           'annoncelinechart' => $ob ,   'destinationpiechart' => $ob2 ,   'departpiechart' => $ob3 , 'statepiechart' => $ob4
       ));

    }


    public function  UserStatAction(){
        $em=$this->getDoctrine()->getManager();

        $nbrTotal=$em->getRepository('LinkarBundle:Membre')->countNbrUsers()[1];
        $blocked=$em->getRepository('LinkarBundle:Membre')->countBlockedUsers()[1];;
        $inactive=$em->getRepository('LinkarBundle:Membre')->countInactiveUsers()[1];
        $users=$em->getRepository('LinkarBundle:Membre')->getActiveUsers();
        $ob =$this->userChartLine();
        $ob2 =$this->barChart();
        $ob3=$this->pieGenderChart();







        return $this->render('StatBundle:stat:userStat.html.twig', array( 'nbrusers'=>$nbrTotal,'nbrblocked'=>$blocked,'nbrinactive'=>$inactive,
            'linechart' => $ob ,   'barchart' => $ob2 ,   'genderpiechart' => $ob3 , 'users' => $users
        ));

    }

}
