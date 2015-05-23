<?php

namespace GCDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GCDBundle:Default:index.html.twig');
    }
}
