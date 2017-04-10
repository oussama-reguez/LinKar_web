<?php

namespace NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session;

class NotificationController extends Controller
{

    public function handleNotificationAction()
    {
        $session  = $this->get("session");
      $notification=null;
      $not=$session->get('notification');
      if(!isset($not)){
          $session->set("notification",0);
      }

        $oldCount = intval($session->get('notification'));
        $em=$this->getDoctrine()->getManager();
        $count=intval($em->getRepository('LinkarBundle:Notification')->countNotification(14)[1]);



       if( $count > $oldCount) {


            $notification =$em->getRepository('LinkarBundle:Notification')->getNotifications(14,$count-$oldCount);
           $session->set("notification",$count);

                return $this->render('NotificationBundle:Notification:notificationDialog.html.twig',array('m'=>$notification));
        }


        return $this->render('NotificationBundle:Notification:notificationDialog.html.twig',array('m'=>$notification));
    }

    public function getNotificationsAction(){

        $em=$this->getDoctrine()->getManager();
        $notifications =$em->getRepository('LinkarBundle:Notification')->getAllNotifications(14);

        return $this->render('NotificationBundle:Notification:notificationCenter.html.twig',array('m'=>$notifications));
    }


    public function showNotificationAction(){



        return $this->render('NotificationBundle:Notification:showNotification.html.twig');
    }

    public function displayNotifCenterAction(){



        return $this->render('@Notification/Notification/displayNotifCenter.html.twig');
    }



}
