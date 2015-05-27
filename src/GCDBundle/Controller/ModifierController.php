<?php


namespace GCDBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use GCDBundle\Entity\Dentiste;
use GCDBundle\Form\DentisteType;

use GCDBundle\Entity\Patient;
use GCDBundle\Form\PatientType;

use GCDBundle\Entity\Secretaire;
use GCDBundle\Form\SecretaireType;


class ModifierController extends Controller {
public function ModifDentisteAction(Request $request,$id)
    {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Dentiste');
        $repu = $this->getDoctrine()->getRepository('GCDBundle:User');
        $dentiste=new Dentiste(); 
        $dentiste = $rep->find($id);
        $user = $repu->findOneBy(array("email"=>$dentiste->getEmailDentiste()));
        $formd = $this->createForm(new DentisteType(),$dentiste);
        $request = $this->getRequest();        
        $formd->handleRequest($request);
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);
        if($request->getMethod() == "POST" ) {
            if ($formd->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $nom = $formd->get('nomDentiste')->getData();
                $prenom = $formd->get('prenomDentiste')->getData();
                $adresse = $formd->get('adresseDentiste')->getData();
                $email = $formd->get('emailDentiste')->getData();
                $teld = $formd->get('telDentiste')->getData();
                $telc = $formd->get('telCabinet')->getData();
                $adressec = $formd->get('adresseCabinet')->getData();
                $password = $formd->get('password')->getData();
                $dentiste = $rep->find($user->getId());

                $dentiste->setNomDentiste($nom);                
                $dentiste->setPrenomDentiste($prenom);
                $dentiste->setAdresseDentiste($adresse);
                $dentiste->setAdresseCabinet($adressec);
                $dentiste->setTelCabinet($telc);
                $dentiste->setTelDentiste($teld);
                $dentiste->setEmailDentiste($email);


                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();

                $user->setEmail($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                $user->setPlainPassword($password);
                $userManager = $this->get('fos_user.user_manager');
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('gcd_liste_dentistes');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->render('GCDBundle:Modifier:modifierDentiste.html.twig', array('dentiste'=> $dentiste,'form'=>$formd->CreateView()));
   
         /*$rep = $this->getDoctrine()->getRepository('GCDBundle:Dentiste');
         $dentiste = $rep->find($id);
    	 $em = $this->getDoctrine()->getEntityManager();
         $em->flush();
        return $this->render('GCDBundle:Modifier:modifierDentiste.html.twig',array('dentiste'=> $dentiste));*/
   
   
   
    }
    
public function ModifPatientAction(Request $request,$id)
    {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Patient');
        $repu = $this->getDoctrine()->getRepository('GCDBundle:User');
        $patient=new Patient(); 
        $patient = $rep->find($id);
        $user = $repu->findOneBy(array("email"=>$patient->getEmailPatient()));
        $formd = $this->createForm(new PatientType(),$patient);
        $request = $this->getRequest();        
        $formd->handleRequest($request);
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);
        if($request->getMethod() == "POST" ) {
            if ($formd->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $nom = $formd->get('nomPatient')->getData();
                $prenom = $formd->get('prenomPatient')->getData();
                $adresse = $formd->get('adressePatient')->getData();
                $email = $formd->get('emailPatient')->getData();
                $teld = $formd->get('telPatient')->getData();
                $password = $formd->get('pwPatient')->getData();
                $cnam = $formd->get('cnam')->getData();
                $sexe = $formd->get('sexe')->getData();
                $patient = $rep->findOneBy(array('emailPatient'=>$user->getEmail()));
                //$secretaire = $rep->find(5);
                
                $patient->setNomPatient($nom); 
                
                $patient->setPrenomPatient($prenom);
              
                $patient->setAdressePatient($adresse);
                
                $patient->setTelPatient($teld);
                
                $patient->setEmailPatient($email);
              
                $patient->setPwPatient($password);
                
                $patient->setSexe($sexe);
                
                $patient->setCnam($cnam);

               
               
                       $user->setEmail($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                
               
                $user->setPlainPassword($password);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                $userManager = $this->get('fos_user.user_manager');
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('gcd_liste_patients');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->render('GCDBundle:Modifier:modifierPatient.html.twig', array('patient'=> $patient,'form'=>$formd->CreateView()));
    }
    
public function ModifSecretaireAction(Request $request,$id)
    {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Secretaire');
        $repu = $this->getDoctrine()->getRepository('GCDBundle:User');
        $secretaire=new Patient(); 
        $secretaire = $rep->find($id);
        $user = $repu->findOneBy(array("email"=>$secretaire->getEmailSecretaire()));
        $formd = $this->createForm(new SecretaireType(),$secretaire);
        $request = $this->getRequest();        
        $formd->handleRequest($request);
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);
        if($request->getMethod() == "POST" ) {
            if ($formd->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $nom = $formd->get('nomSecretaire')->getData();
                $prenom = $formd->get('prenomSecretaire')->getData();
                $adresse = $formd->get('adresseSecretaire')->getData();
                $email = $formd->get('emailSecretaire')->getData();
                $teld = $formd->get('telSecretaire')->getData();
                $password = $formd->get('pwSecretaire')->getData();
                $sexe = $formd->get('sexe')->getData();
                $secretaire = $rep->findOneBy(array('emailSecretaire'=>$user->getEmail()));
                //$secretaire = $rep->find(5);   
                $secretaire->setNomSecretaire($nom);                
                $secretaire->setPrenomSecretaire($prenom);
                $secretaire->setAdresseSecretaire($adresse);
                $secretaire->setTelSecretaire($teld);
                $secretaire->setEmailSecretaire($email);
                $secretaire->setPwSecretaire($password);
                $secretaire->setSexe($sexe);

               

                $user->setEmail($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                $user->setPlainPassword($password);
                 $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                $userManager = $this->get('fos_user.user_manager');
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('gcd_liste_secretaires');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->render('GCDBundle:Modifier:modifierSecretaire.html.twig', array('secretaire'=> $secretaire,'form'=>$formd->CreateView()));
    }
}