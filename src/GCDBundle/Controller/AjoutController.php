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

use GCDBundle\Entity\User;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class AjoutController extends Controller
{
    public function AjoutDentisteAction(Request $request)
    {
       $dentiste=new Dentiste();
       $user = new User();
        
       $formFactory = $this->get('fos_user.registration.form.factory');
        $form = $this->createForm(new DentisteType(),$dentiste);
     
        $request = $this->getRequest();
        
        $form->handleRequest($request);
        
        if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                $nom = $form->get('nomDentiste')->getData();
                $prenom = $form->get('prenomDentiste')->getData();
                $adresse = $form->get('adresseDentiste')->getData();
                $email = $form->get('emailDentiste')->getData();
                $teld = $form->get('telDentiste')->getData();
                $telc = $form->get('telCabinet')->getData();
                $adressec = $form->get('adresseCabinet')->getData();
                $pass = $form->get('password')->getData();
                $sexe = $form->get('sexe')->getData();
                
                $dentiste->setNomDentiste($nom);
                
                $dentiste->setPrenomDentiste($prenom);
                $dentiste->setAdresseDentiste($adresse);
                $dentiste->setAdresseCabinet($adressec);
                $dentiste->setEmailDentiste($email);
                
                $userManager = $this->get('fos_user.user_manager');
                $dispatcher = $this->get('event_dispatcher');
                $user = $userManager->createUser();
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                $user->setEnabled(true);
                $user->addRole('ROLE_DENTISTE');
                $event = new GetResponseUserEvent($user, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        
                
                //$user->setUsername($email);
               // $user->setPassword($pass);
                
               // $user->setDroit('Dentiste');
                
                $dentiste->setTelCabinet($telc);
                $dentiste->setTelDentiste($teld);
                $dentiste->setPassword($pass);
                $user->setPlainPassword($pass);
                $dentiste->setSexe($sexe);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dentiste);
                $em->flush();
                if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('gcd_ajout_confirmation');
                    $response = new RedirectResponse($url);
                }
                //$dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                return $response;
                }
                
              /*  $emu = $this->getDoctrine()->getManager();
                $emu->persist($user);
                $emu->flush();*/
                
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



 
        
        return $this->render('GCDBundle:Ajout:AjoutDentiste.html.twig',array('form'=>$form->createView()));
    } 
    
    public function AjoutSecretaireAction(Request $request)
    {
        $secretaire =new Secretaire();
        $user = new User();
        $formFactory = $this->get('fos_user.registration.form.factory');
        $form = $this->createForm(new SecretaireType(),$secretaire);
        
        $request = $this->getRequest();
        
        $form->handleRequest($request);
        
        if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                $nom = $form->get('nomSecretaire')->getData();
                $prenom = $form->get('prenomSecretaire')->getData();
                $adresse = $form->get('adresseSecretaire')->getData();
                $email = $form->get('emailSecretaire')->getData();
                $teld = $form->get('telSecretaire')->getData();
              
                $pass = $form->get('pwSecretaire')->getData();
                $sexe = $form->get('sexe')->getData();
                
                $secretaire->setNomSecretaire($nom);
                $secretaire->setPrenomSecretaire($prenom);
                $secretaire->setAdresseSecretaire($adresse);
                $secretaire->setEmailSecretaire($email);
                
                $userManager = $this->get('fos_user.user_manager');
                $dispatcher = $this->get('event_dispatcher');
                $user = $userManager->createUser();
                $user->setEmail($email);
                $user->setEmailCanonical($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                $user->setEnabled(true);
                $user->addRole('ROLE_SECRETAIRE');
                $event = new GetResponseUserEvent($user, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
                
                $secretaire->setTelSecretaire($teld);
                $secretaire->setPwSecretaire($pass);
                $secretaire->setSexe($sexe);
                $user->setPlainPassword($pass);
                $em = $this->getDoctrine()->getManager();
                $em->persist($secretaire);
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
                //return $this->render('GCDAuthentificationBundle:Default:notification.html.twig',array('name'=>$nom));

            
                
            }
            
        }       
        return $this->render('GCDBundle:Ajout:AjoutSecretaire.html.twig',array('form'=>$form->createView()));
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
    
   public function AjoutRDVAction(Request $request){
             $rdv=new Rdv();
             $patient=new Patient();

             
        
            $form = $this->createForm(new RdvType(),$rdv);
            $formP = $this->createForm(new PatientType(),$patient);
            
            $request = $this->getRequest();
        
        $form->handleRequest($request);
        
        if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                //$idp = $form->get('idPatient').getData() ;
                $daterdv = $form->get('dateRdv')->getData();
                $horrairerdv = $form->get('horraireRdv')->getData();
                //$idr = $formP->get('idPatient').getData().$form->get('dateRdv')->getData();

                
                $rdv->setDateRdv($daterdv);
                $rdv->setHorraireRdv($horrairerdv);
                //$rdv->setIdPatient($idp);
                
               
                $em = $this->getDoctrine()->getManager();
                $em->persist($rdv);
                $em->flush();
                
                
                //return new Response($nom.' ajouté à la base');
                return $this->render('GCDBundle:Ajout:Confirmationrdv.html.twig',array('name'=>$daterdv));
                
            }
        }
            
               /* $form->bind($request);
                $dentiste = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($dentiste);
                $em->flush();
                return $this->redirect($this->generateUrl('app_liste_dentiste'));*/

        $rdv=$this->getDoctrine()-> getRepository('GCDBundle:RDV')->findAll();
        $patient=$this->getDoctrine()-> getRepository('GCDBundle:Patient')->findAll();
        return $this->render('GCDBundle:Ajout:Rdv.html.twig',array('rdv'=> $rdv,'form'=>$form->createView(),'Patient'=>$patient));
 
 
   }
}
