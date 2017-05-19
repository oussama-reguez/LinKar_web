<?php

namespace EmailBundle\Controller;

use LinkarBundle\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmailBundle:Default:index.html.twig');
    }
    public function sendMailAction()
    {
        $user = $this->getUser();
        $userID = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('LinkarBundle:Membre')->findOneById($userID);
        $code = $member-> getSmsCode();
        $email = $member-> getEmail();
        $name= $member-> getLastName();
        $subject="LinKar: Email de vérification";
        $message='Bonjour '.$name.'! Veuillez saisir ce code pour valider votre adresse email: '.$code;

        $transport=\Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
            ->setUsername('linkar.contact@gmail.com')
            ->setPassword('Nana0511');
        $mailer=\Swift_Mailer::newInstance($transport);
        $message=\Swift_Message::newInstance('Test')
            ->setSubject($subject)
            ->setFrom('linkar.contact@gmail.com')
            ->setTo($email)
            ->setBody($message);
        $this->get('mailer')->send($message);
        return $this->redirectToRoute('emailValidationPage');
    }
    public function ValidateMailAction(Request $req)
    {
        $user = $this->getUser();
        $userID = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository('LinkarBundle:Membre')->findOneById($userID);
        $code_sms = $member-> getSmsCode();
        if ($req->isMethod('POST')) {
            $code=$req->get('code');
            if ($code == $code_sms) {
                $em = $this->getDoctrine()->getManager();
                $qb = $em->createQueryBuilder();
                $qb->update('LinkarBundle:Membre', 'u')
                    ->set('u.verifEmail', '?1')
                    ->where('u.id = ?2')
                    ->setParameter(1, 1)
                    ->setParameter(2, $userID)
                    ->getQuery()->getResult();
                $this->addFlash(
                    'success',
                    'Votre email a été validé avec succès!');
                return $this->redirectToRoute('member_homepage');
            } else {
                $this->addFlash(
                    'danger',
                    'Code erroné');
            }
        }
        return $this->render('EmailBundle:Email:ValidateEmailPage.html.twig');
    }
}
