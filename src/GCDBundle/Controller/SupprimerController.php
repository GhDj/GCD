<?php


namespace GCDBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SupprimerController extends Controller {
public function SuppDentisteAction(Request $request,$id)
    {
         $rep = $this->getDoctrine()->getRepository('GCDBundle:Dentiste');
         $repu = $this->getDoctrine()->getRepository('GCDBundle:User');
         $dentisteAsup = $rep->find($id);
         $userAsup = $repu->findOneBy(array("email"=>$dentisteAsup->getEmailDentiste()));
    	 $em = $this->getDoctrine()->getEntityManager();
         $em->remove($dentisteAsup);
         $em->flush();
         $emu = $this->getDoctrine()->getEntityManager();
         $emu->remove($userAsup);
         $emu->flush();
         return $this->redirect($this->generateUrl('gcd_liste_dentistes'));
   
    }
public function SuppPatientAction(Request $request,$id)
    {
         $rep = $this->getDoctrine()->getRepository('GCDBundle:Patient');
         $repu = $this->getDoctrine()->getRepository('GCDBundle:User');
         $dentisteAsup = $rep->find($id);
         $userAsup = $repu->findOneBy(array("email"=>$dentisteAsup->getEmailpatient()));
    	 $em = $this->getDoctrine()->getEntityManager();
         $em->remove($dentisteAsup);
         $em->flush();
         $emu = $this->getDoctrine()->getEntityManager();
         $emu->remove($userAsup);
         $emu->flush();
         return $this->redirect($this->generateUrl('gcd_liste_patients'));
   
    }
 public function SuppSecretaireAction(Request $request,$id)
    {
         $rep = $this->getDoctrine()->getRepository('GCDBundle:Secretaire');
         $repu = $this->getDoctrine()->getRepository('GCDBundle:User');
         $dentisteAsup = $rep->find($id);
         $userAsup = $repu->findOneBy(array("email"=>$dentisteAsup->getEmailSecretaire()));
    	 $em = $this->getDoctrine()->getEntityManager();
         $em->remove($dentisteAsup);
         $em->flush();
         $emu = $this->getDoctrine()->getEntityManager();
         $emu->remove($userAsup);
         $emu->flush();
         return $this->redirect($this->generateUrl('gcd_liste_secretaires'));
   
    }
 public function SuppCabinetAction(Request $request,$id)
    {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Cabinets');
         $dentisteAsup = $rep->find($id);
    	 $em = $this->getDoctrine()->getEntityManager();

         $em->remove($dentisteAsup);
         $em->flush();
         return $this->redirect($this->generateUrl('gcd_liste_cabinets'));
         
         
   
    }
    public function SuppRdvAction(Request $request,$id)
    {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Rdv');
         $dentisteAsup = $rep->find($id);
    	 $em = $this->getDoctrine()->getEntityManager();

         $em->remove($dentisteAsup);
         $em->flush();
         $securityContext = $this->container->get('security.context');
         if ($securityContext->isGranted('ROLE_SECRETAIRE')) 
            return $this->redirect($this->generateUrl('gcd_secretaire'));
         if ($securityContext->isGranted('ROLE_DENTISTE')) 
             return $this->redirect($this->generateUrl('gcd_dentiste'));
         return $this->redirect($this->generateUrl('gcd_homepage'));  
    }
    
    public function SuppOrdAction(Request $request,$id)
    {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Ordonnance');
         $dentisteAsup = $rep->find($id);
    	 $em = $this->getDoctrine()->getEntityManager();

         $em->remove($dentisteAsup);
         $em->flush();
         $securityContext = $this->container->get('security.context');
         if ($securityContext->isGranted('ROLE_SECRETAIRE')) 
            return $this->redirect($this->generateUrl('gcd_secretaire'));
         if ($securityContext->isGranted('ROLE_DENTISTE')) 
             return $this->redirect($this->generateUrl('gcd_dentiste'));
         return $this->redirect($this->generateUrl('gcd_homepage'));  
    }
}