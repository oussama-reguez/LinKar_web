<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:HomePage:login.html.twig');
    }
    public function index2Action()
    {
        return $this->render('UserBundle:Default:index2.html.twig');
    }
    public function index3Action()
    {
        return $this->render('UserBundle:HomePage:Home.html.twig');
    }
}
