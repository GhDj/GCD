<?php


namespace GCDBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use GCDBundle\Entity\Patient;
use GCDBundle\Form\PatientType;

class ListeController extends Controller {
    
 public function DentistesAction()
    {
        $dentiste=$this->getDoctrine()-> getRepository('GCDBundle:Dentiste')->findAll();
        
            return $this->render('GCDBundle:Listes:dentistes.html.twig',array('dentiste'=> $dentiste));
    }
    
  public function PatientsAction(Request $request)
    {
      
      $forms = $this->createFormBuilder()
        ->add('search', 'text')
        ->add('Recherche','submit')
        ->getForm();
      
        if($request->getMethod() == "POST" ) {
            
                // find by search criteria
                $p = $forms->get('search')->getData();
               // the query builder is returned, do something with it ($qb->getQuery()->getResult())
                $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findBy(array('nomPatient'=>$p));
                 //$patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();
        
            return $this->render('GCDBundle:Listes:patients.html.twig',array('patient'=> $patient,'forms'=>$forms->createView(),'p'=>$p));
            
        }
        
        $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();
        
        return $this->render('GCDBundle:Listes:patients.html.twig',array('patient'=> $patient,'forms'=>$forms->createView()));
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