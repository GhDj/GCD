<?php

namespace GCDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use GCDBundle\Entity\Dentiste;
use GCDBundle\Form\DentisteType;

use GCDBundle\Entity\Patient;
use GCDBundle\Form\PatientType;

use GCDBundle\Entity\Secretaire;
use GCDBundle\Form\SecretaireType;

use GCDBundle\Entity\Rdv;
use GCDBundle\Form\RdvType;

use GCDBundle\Entity\ActMedical;
use GCDBundle\Form\ActMedicalType;

use GCDBundle\Entity\Ordonnance;
use GCDBundle\Form\OrdonnanceType;

use GCDBundle\Entity\User;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class FicheController extends Controller
{
    public function AjoutOrdonnanceAction(Request $request)
    {
            $am =new Ordonnance();
             $patient=new Patient();           
        
            $form = $this->createForm(new OrdonnanceType(),$am);
            
            $request = $this->getRequest();
        
            $form->handleRequest($request);
        
            if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                //$idp = $form->get('idPatient').getData() ;
                //$libelle = $form->get('libelle')->getData();
                $description = $form->get('contenu')->getData();
                $p = $form->get('idpatient')->getData();
                //$p = $form->get('nomPatient')->getViewData();
                //$idr = $formP->get('idPatient').getData().$form->get('dateRdv')->getData();
                //$rep = $this->getDoctrine()->getManager()->getRepository('GCDBundle:Patient');
                //$pat =new Patient(); 
                //$pat = $rep->findOneBy(array('nomPatient'=>$p->getNomPatient()));
               // $idp= $pat->getIdPatient();
                
                //$am->setLibelle($libelle);
                $am->setContenu($description);
                $am->setIdpatient($p);
                              
               
                $em = $this->getDoctrine()->getManager();
                $em->persist($am);
                $em->flush();
                
                
                //return new Response($nom.' ajouté à la base');
                return $this->render('GCDBundle:Ajout:Ordonnance.html.twig',array('name'=>"Ordonnance Ajoutée",'form'=>$form->createView(),'Patient'=>$patient));
                
            }
        }
            
               /* $form->bind($request);
                $dentiste = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($dentiste);
                $em->flush();
                return $this->redirect($this->generateUrl('app_liste_dentiste'));*/

        //$am =$this->getDoctrine()-> getRepository('GCDBundle:Ordonnance')->findAll();
       $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();
        return $this->render('GCDBundle:Ajout:Ordonnance.html.twig',array('form'=>$form->createView(),'Patient'=>$patient));
 
    }

    



    public function ConfirmationAction(Request $request){
         $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('Vous n\'avez pas accées pour cette page.');
        }

        return $this->render('GCDBundle:Ajout:confirmation.html.twig', array(
            'user' => $user,
        ));
    }
    
    public function ajoutPatientAction(Request $request){
        $patient=new Patient();
        $user = new User();
       
        
        $form = $this->createForm(new PatientType(),$patient);
        
        $request = $this->getRequest();
        
        $form->handleRequest($request);
        
        if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                $nom = $form->get('nomPatient')->getData();
                $prenom = $form->get('prenomPatient')->getData();
                $adresse = $form->get('adressePatient')->getData();
                $datenaiss = $form->get('dateNaiss')->getData();
                $telPatient = $form->get('telPatient')->getData();
                $idF = $form->get('idFiche')->getData();
                $cnam = $form->get('cnam')->getData();
                $sexe = $form->get('sexe')->getData();
                $email = $form->get('emailPatient')->getData();
                 /*$pwpatient = $form->get('pwPatient')->getData();*/

                $idF = $nom+$prenom+$cnam;
                  
                $patient->setNomPatient($nom);
                $patient->setPrenomPatient($prenom);
                $patient->setDateNaiss($datenaiss);
                $patient->setAdressePatient($adresse);
                $patient->setTelPatient($telPatient);
                $patient->setIdFiche($idF);
                $patient->setCnam($cnam);
                $patient->setSexe($sexe);
                $patient->setEmailPatient($email);
                $patient-> setPwPatient($telPatient);
                
                
                
                $userManager = $this->get('fos_user.user_manager');
                $dispatcher = $this->get('event_dispatcher');
                $user = $userManager->createUser();
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                $user->setPlainPassword($telPatient);
                $user->setEnabled(true);
                $user->addRole('ROLE_PATIENT');
                $event = new GetResponseUserEvent($user, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
              
                $em = $this->getDoctrine()->getManager();
                $em->persist($patient);
                $em->flush();
                
                $emu = $this->getDoctrine()->getManager();
                $emu->persist($user);
                $emu->flush();
                
                if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('gcd_ajout_confirmation');
                    $response = new RedirectResponse($url);
                }
               // $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                return $response;
                }
                
                //return new Response($nom.' ajouté à la base');
                return $this->render('GCDAuthentificationBundle:Default:notification.html.twig',array('name'=>$nom));
                
            }
        }
            
               /* $form->bind($request);
                $dentiste = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($dentiste);
                $em->flush();
                return $this->redirect($this->generateUrl('app_liste_dentiste'));*/

        return $this->render('GCDBundle:Ajout:AjoutPatient.html.twig',array('form'=>$form->createView()));

     }
    
    public function AjoutActMAction(Request $request){
             $am =new ActMedical();
             $patient=new Patient();           
        
            $form = $this->createForm(new ActMedicalType(),$am);
            
            $request = $this->getRequest();
        
            $form->handleRequest($request);
        
            if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                //$idp = $form->get('idPatient').getData() ;
                $libelle = $form->get('libelle')->getData();
                $description = $form->get('description')->getData();
                $p = $form->get('idPatient')->getData();
                //$p = $form->get('nomPatient')->getViewData();
                //$idr = $formP->get('idPatient').getData().$form->get('dateRdv')->getData();
                $rep = $this->getDoctrine()->getManager()->getRepository('GCDBundle:Patient');
                //$pat =new Patient(); 
                $pat = $rep->findOneBy(array('nomPatient'=>$p->getNomPatient()));
                $idp= $pat->getIdPatient();
                
                $am->setLibelle($libelle);
                $am->setDescription($description);
                $am->setIdPatient($pat);
                //$rdv->setDateRdv($daterdv);
               // $rdv->setHorraireRdv($horrairerdv);
                //$rdv->setIdPatient($idp);
                
               
                $em = $this->getDoctrine()->getManager();
                $em->persist($am);
                $em->flush();
                
                
                //return new Response($nom.' ajouté à la base');
                return $this->render('GCDBundle:Ajout:ActMedical.html.twig',array('name'=>"Act Ajoutée"));
                
            }
        }
            
               /* $form->bind($request);
                $dentiste = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($dentiste);
                $em->flush();
                return $this->redirect($this->generateUrl('app_liste_dentiste'));*/

        $am =$this->getDoctrine()-> getRepository('GCDBundle:ActMedical')->findAll();
       $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();
        return $this->render('GCDBundle:Ajout:ActMedical.html.twig',array('am'=> $am,'form'=>$form->createView(),'Patient'=>$patient));
 
 
   }
   
   
   
   public function FichePatientAction(Request $request, $id)
   {
       $patient = new Patient();
       $act = new ActMedical();
       $ord = new Ordonnance();
       $patient = $this->getDoctrine()->getRepository('GCDBundle:Patient')->find($id);
       //$act = $this->getDoctrine()->getRepository('GCDBundle:ActMedical')->findOneBy(array('idPatient'=>$id));
       $act = $this->getDoctrine()->getRepository('GCDBundle:ActMedical')->findAll();
       $ord = $this->getDoctrine()->getRepository('GCDBundle:Ordonnance')->findBy(array('idpatient'=>$id));
       $rdv = new Rdv();
       $rdv = $this->getDoctrine()->getRepository('GCDBundle:RDV')->findBy(array('idPatient'=>$id));

       return $this->render('GCDBundle::FichePatient.html.Twig',array('Patient'=>$patient,'act'=>$act,'ord'=>$ord,'rdv'=>$rdv));
       
   }
}
