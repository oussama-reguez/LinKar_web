<?php

namespace MessageBundle\Controller;

use LinkarBundle\Entity\Membre;
use LinkarBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{

    public function indexAction()


    {
        $em=$this->getDoctrine()->getManager();
        $membres=$em->getRepository('LinkarBundle:Message')->getSendersDQL(14);
        $data=array();
        foreach ($membres as $membre){

            $date=$em->getRepository('LinkarBundle:Message')->getLastDate(14,$membre->getId()['d']);
            $count=$em->getRepository('LinkarBundle:Message')->getCountMessages(14,$membre->getId()[1]);
            array_push($data,array($membre,$count,$date));
        }

        dump($data);
        return new \Symfony\Component\HttpFoundation\Response();
    }


    public function inBoxAction()


    {
        return $this->render('@Message/Message/displayInbox.html.twig');
    }


    public function getConversationAction(Request $req)
    {
        if($req->isMethod('GET')){
            $r=$req->get('sender');
            $send=$req->get('message');
            if(isset($r)){

                if(isset($send)){

                    $em=$this->getDoctrine()->getManager();
                    $message= new Message();
                    $receiver=$em->getRepository('LinkarBundle:Membre')->find($r);
                    $sender=$em->getRepository('LinkarBundle:Membre')->find(14);
                    $message->setReceiver($receiver);
                    $message->setSender($sender);
                    $message->setDate(new \DateTime('now'));
                    $message->setSeen(false);
                    $message->setText($req->get('message'));
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($message);
                    $em->flush();
                }


                $em=$this->getDoctrine()->getManager();
                $senders=$em->getRepository('LinkarBundle:Message')->showAllSendersMessagesDQL(14,$r);
                $receivers=$em->getRepository('LinkarBundle:Message')->showAllReceiversMessagesDQL(14,$r);
                $result = array_merge($senders,  $receivers);

                uasort($result,function ($a, $b) {
                    if ($a->getDate() == $b->getDate()) {
                        return 0;
                    }

                    return ($a->getDate() < $b->getDate()) ? -1 : 1;
                } );
                dump($result);
                return $this->render('MessageBundle:Message:conversation.html.twig',array('m'=>$result,'sender'=>$r));


            }
            return $this->render('MessageBundle:Message:erreur.html.twig');





        }



    }


    public function getListMembersAction(Request $req)
    {
        $em=$this->getDoctrine()->getManager();
        $membres=$em->getRepository('LinkarBundle:Message')->getSendersDQL(14);
        $data=array();
        foreach ($membres as $membre){
            $id=$membre->getId();
            $date=$em->getRepository('LinkarBundle:Message')->getLastDate(14,$id);
            $count=$em->getRepository('LinkarBundle:Message')->getCountMessages(14,$id);
            array_push($data,array($membre,$count,$date));
        }


        return $this->render('MessageBundle:Message:messages.html.twig',array('m'=>$data));
    }





}
