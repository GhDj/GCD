<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

use GCDBundle\Entity\Secretaire;
use GCDBundle\Form\SecretaireType;

use GCDBundle\Entity\Patient;
use GCDBundle\Form\PatientType;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class CompteController extends Controller
{
    /**
     * Show the user
     */
    public function ModifierCompteAction(Request $request)
    {
        $user = $this->getUser();
            
        
        if (!is_object($user) || !$user instanceof UserInterface) {
            //throw new AccessDeniedException('This user does not have access to this section.');
            return $this->render('GCDBundle:Compte:compte_erreur.html.twig');
        }
        
        
        $id = $user->getId();
        $securityContext = $this->container->get('security.context');
        if ($securityContext->isGranted('ROLE_DENTISTE')) {
           $rep = $this->getDoctrine()->getRepository('GCDBundle:Dentiste');
        $dentiste=new Dentiste(); 
        $dentiste = $rep->find($id);
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
                    $url = $this->generateUrl('gcd_homepage');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->render('GCDBundle:Compte:Dentiste.html.twig', array('dentiste'=> $dentiste,'form'=>$formd->CreateView()));
   
        }
            
        
         if ($securityContext->isGranted('ROLE_SECRETAIRE')) {
           $rep = $this->getDoctrine()->getRepository('GCDBundle:Secretaire');
        $secretaire=new Secretaire(); 
        $secretaire = $rep->findOneBy(array('emailSecretaire'=>$user->getEmail()));
        //$secretaire = $rep->find(5);
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
                    $url = $this->generateUrl('gcd_homepage');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->render('GCDBundle:Compte:Secretaire.html.twig', array('secretaire'=> $secretaire,'form'=>$formd->CreateView()));
   
        }
        
        if ($securityContext->isGranted('ROLE_PATIENT')) {
        $rep = $this->getDoctrine()->getRepository('GCDBundle:Patient');
        $patient =new Patient(); 
        $patient = $rep->findOneBy(array('emailPatient'=>$user->getEmail()));
        //$secretaire = $rep->find(5);
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
                if (!($nom == ""))
                $patient->setNomPatient($nom); 
                if (!($prenom == ""))
                $patient->setPrenomPatient($prenom);
                if (!($adresse == ""))
                $patient->setAdressePatient($adresse);
                if (!($teld == ""))
                $patient->setTelPatient($teld);
                if (!($email == ""))
                $patient->setEmailPatient($email);
                if (!($password == ""))
                $patient->setPwPatient($password);
                if (!($sexe == ""))
                $patient->setSexe($sexe);
                if (!($cnam == ""))
                $patient->setCnam($cnam);

               
                if (!($email == "")){
                       $user->setEmail($email);
                $user->setUsername($email);
                $user->setUsernameCanonical($email);
                }
                if (!($password == ""))
                $user->setPlainPassword($password);
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                $userManager = $this->get('fos_user.user_manager');
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('gcd_homepage');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->render('GCDBundle:Compte:Patient.html.twig', array('patient'=> $patient,'form'=>$formd->CreateView()));
   
        }
       
        
        return $this->render('GCDBundle:Compte:compte_erreur.html.twig');
        
        
        }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

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

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
