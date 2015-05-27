<?php


namespace GCDBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TBController extends Controller {
public function DentisteAction(Request $request)
    {
                 return $this->render('GCDBundle:TB:Dentiste.html.twig',array('name'=>'name'));
   
    }
public function SecretaireAction(Request $request)
    {
                 return $this->render('GCDBundle:TB:Secretaire.html.twig',array('name'=>'name'));
   
    }
public function PatientAction(Request $request)
    {
                 return $this->render('GCDBundle:TB:Patient.html.twig',array('name'=>'name'));
   
    }
public function AdminAction(Request $request)
    {
                 return $this->render('GCDBundle:TB:Admin.html.twig',array('name'=>'name'));
   
    }
}