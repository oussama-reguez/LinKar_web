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


    public function chartLineAction()

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
            array("name" => "Data Serie Name",    "data" => $tab2),
            array("name" => "Data Serie Name",    "data" => array(1,5,9,10))
        );

        $categorie = array(
            array("name" => "Data Serie Name",    "data" => array('2015','2016')),
            array("name" => "Data Serie Name",    "data" => array('2015','2016','df','dfd'))

        );

        dump($tab);
        dump($tab2);
        $ob = new Highchart();
        $ob->chart->renderTo('chart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);
        $ob->xAxis->categories($tab);



        return $this->render('StatBundle:stat:graphe.html.twig',

            array(

                'chart' => $ob

            ));

    }




    public function barChartAction() {
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
        $ob->title->text('Bénéfices du 21/06/2013 au 27/06/2013');
        $ob->chart->type('column');

        $ob->yAxis->title(array('text' => "Bénéfices (millions d'euros)"));

        $ob->xAxis->title(array('text' => "Date du jours"));
        $ob->xAxis->categories($dates);

        $ob->series($series);

        return $this->render('StatBundle:stat:graphe.html.twig', array(
            'chart' => $ob
        ));
    }


    public function pieUsersChartAction() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getStatCreatedUsersbyYearDql();

        $total= intval($em->getRepository('LinkarBundle:Membre')->countNbrUsers());
        $annoncers= intval($em->getRepository('LinkarBundle:Membre')->countAnnouncers());
        $others=intval($total-$annoncers);

        $data= array();

        foreach ($users as $classe) {


            array_push($data, intval($classe[1]));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('annonceurs', $annoncers),
            array('Membres inactives', 26.8),
            array('Chrome', 12.8),

        );

        return $this->render('StatBundle:stat:graphe.html.twig', array(
            'chart' => $ob
        ));
    }


    public function pieGenderChartAction() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Membre')->getStatnbrUsersbyGender();



        $data= array();

        foreach ($users as $classe) {


            array_push($data, array($classe['gender'],intval($classe[1])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('chart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render('StatBundle:stat:graphe.html.twig', array(
            'chart' => $ob
        ));
    }

    public function pieDestinationChartAction() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Annonce')->getPopularDestination();



        $data= array();

        foreach ($users as $classe) {


            array_push($data, array($classe['destination'],intval($classe['cnt'])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('chart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render('StatBundle:stat:graphe.html.twig', array(
            'chart' => $ob
        ));
    }

    public function pieDepartChartAction() {
        $em=$this->getDoctrine()->getManager();
        $users=$em->getRepository('LinkarBundle:Annonce')->getPopularDepart();



        $data= array();

        foreach ($users as $classe) {


            array_push($data, array($classe['depart'],intval($classe['cnt'])));



        }



        $ob = new Highchart();
        $ob->chart->renderTo('chart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render('StatBundle:stat:graphe.html.twig', array(
            'chart' => $ob
        ));
    }

    public function chartLineAnnounceAction()

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

            array_push($series, array("name" => "Data Serie Name",    "data" => $tab2) );


        }



        $categorie = array(
        '01','02','03','04','05','06','07','08','09','10','11','12'

        );


        dump($tab2);
        $ob = new Highchart();
        $ob->chart->renderTo('chart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);
        $ob->xAxis->categories($categorie);



        return $this->render('StatBundle:stat:graphe.html.twig',

            array(

                'chart' => $ob

            ));

    }



}
