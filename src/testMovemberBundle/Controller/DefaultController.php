<?php

namespace testMovemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('testMovemberBundle:Default:index.html.twig');
    }
}
