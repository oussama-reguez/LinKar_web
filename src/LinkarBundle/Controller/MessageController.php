<?php

namespace LinkarBundle\Controller;

use LinkarBundle\Entity\Membre;
use LinkarBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller
{
    public function indexAction()
    {
        return $this->render('LinkarBundle:Default:index.html.twig');
    }

    public function messageAction()
    {
        $em=$this->getDoctrine()->getManager();
        $messages=$em->getRepository('LinkarBundle:Message')->showAllSendersMessagesDQL(14,12);
        dump($messages);
        return $this->render('LinkarBundle:Message:index.html.twig');

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
                $senders=$em->getRepository('LinkarBundle:Message')->showAllSendersMessagesDQL(14,12);
                $receivers=$em->getRepository('LinkarBundle:Message')->showAllReceiversMessagesDQL(14,12);
                $result = array_merge($senders,  $receivers);

                uasort($result,function ($a, $b) {
                    if ($a->getDate() == $b->getDate()) {
                        return 0;
                    }

                    return ($a->getDate() < $b->getDate()) ? -1 : 1;
                } );
                dump($result);
                return $this->render('LinkarBundle:Message:conversation.html.twig',array('m'=>$result,'sender'=>$r));


            }
            return $this->render('LinkarBundle:Message:erreur.html.twig');





        }



    }


    public function getListMembersAction(Request $req)
    {
        $em=$this->getDoctrine()->getManager();
        $messages=$em->getRepository('LinkarBundle:Message')->getSendersDQL(14);

        return $this->render('LinkarBundle:Message:messages.html.twig',array('m'=>$messages));
    }

    public function getConversation2Action(Request $req)
    {
        if($req->isMethod('GET')){
            $r=$req->get('sender');
            if(isset($r)){


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
                return $this->redirectToRoute('messages');

            }


        }

        return $this->render('LinkarBundle:Message:conversation2.html.twig');

    }



}
