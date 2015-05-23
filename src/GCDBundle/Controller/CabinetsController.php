<?php


namespace GCDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use GCDBundle\Entity\Dentiste;
use GCDBundle\Form\DentisteType;

use GCDBundle\Entity\Cabinets;
use GCDBundle\Form\CabinetsType;


class CabinetsController extends Controller
{

public function AjoutCabinetAction(Request $request)
    {
        $cabinet =new Cabinets();
        $Dentiste=new Dentiste();

        $form = $this->createForm(new CabinetsType(),$cabinet);
        $formD = $this->createForm(new DentisteType(),$Dentiste);

        $request = $this->getRequest();
        
        $form->handleRequest($request);
        
        if($request->getMethod() == "POST" ) {
            if ($form->isValid()){
                $nomCabinet = $form->get('nomCabinet')->getData();
                $adresseCabinet = $form->get('adresseCabinet')->getData();
                $telCabinet = $form->get('telCabinet')->getData();
                $nomDentiste = $form->get('nomDentiste')->getData();
                $horraireOuverture = $form->get('horraireOuverture')->getData();
              
                $horraireFermeture = $form->get('horraireFermeture')->getData();

                $cabinet->setNomCabinet($nomCabinet);
                $cabinet->setAdresseCabinet($adresseCabinet);
                $cabinet->setTelCabinet($telCabinet);
                $cabinet->setNomDentiste($nomDentiste);                
                
                

                $cabinet->setHorraireOuverture($horraireOuverture);
                $cabinet->setHorraireFermeture($horraireFermeture);

                $em = $this->getDoctrine()->getManager();
                $em->persist($cabinet);
                $em->flush();
                
              
                $url = $this->generateUrl('gcd_ajout_confirmation');
                $response = new RedirectResponse($url);
                return $response;
                //return new Response($nom.' ajouté à la base');
               
                
            }

            
        }
          $Dentiste=$this->getDoctrine()-> getRepository('GCDBundle:Dentiste')->findAll();
        return $this->render('GCDBundle:Ajout:AjoutCabinet.html.twig',array('form'=>$form->createView(),'formD'=>$formD->createView(),'Dentiste'=>$Dentiste));

    }
}