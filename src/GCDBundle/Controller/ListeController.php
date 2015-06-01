<?php


namespace GCDBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListeController extends Controller {
    
 public function DentistesAction()
    {
        $dentiste=$this->getDoctrine()-> getRepository('GCDBundle:Dentiste')->findAll();
        
            return $this->render('GCDBundle:Listes:dentistes.html.twig',array('dentiste'=> $dentiste));
    }
    
  public function PatientsAction()
    {
        $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();
        
            return $this->render('GCDBundle:Listes:patients.html.twig',array('patient'=> $patient));
    }
    public function SecretairesAction()
    {
        $secretaire=$this->getDoctrine()-> getRepository('GCDBundle:Secretaire')->findAll();
        
            return $this->render('GCDBundle:Listes:secretaires.html.twig',array('secretaire'=> $secretaire));
    }
    public function CabinetsAction()
    {
        $cabinet=$this->getDoctrine()-> getRepository('GCDBundle:Cabinets')->findAll();
        
            return $this->render('GCDBundle:Listes:cabinets.html.twig',array('cabinet'=> $cabinet));
    }
    
    public function RdvsAction()
    {
        $rdv=$this->getDoctrine()-> getRepository('GCDBundle:Rdv')->findAll();
        $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();

        return $this->render('GCDBundle:Listes:rdvs.html.twig',array('rdv'=> $rdv,'patient'=>$patient));
    }
}