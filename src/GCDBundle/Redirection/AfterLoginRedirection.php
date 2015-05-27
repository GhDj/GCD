<?php
/**
 * @copyright  Copyright (c) 2009-2014 Steven TITREN - www.webaki.com
 * @package    Webaki\UserBundle\Redirection
 * @author     Steven Titren <contact@webaki.com>
 */
 
namespace GCDBundle\Redirection;
 
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
 
class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;
 
    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
 
    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // On récupère la liste des rôles d'un utilisateur
        $roles = $token->getRoles();
        // On transforme le tableau d'instance en tableau simple
        $rolesTab = array_map(function($role){ 
          return $role->getRole(); 
        }, $roles);
        // S'il s'agit d'un admin ou d'un super admin on le redirige vers le backoffice
        if (in_array('ROLE_ADMIN', $rolesTab, true) || in_array('ROLE_SUPER_ADMIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('gcd_admin'));
        // sinon, s'il s'agit d'un commercial on le redirige vers le CRM
        elseif (in_array('ROLE_DENTISTE', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('gcd_dentiste'));
        // sinon il s'agit d'un membre
        elseif (in_array('ROLE_SECRETAIRE', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('gcd_secretaire'));
        elseif (in_array('ROLE_PATIENT', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('gcd_patient'));
        // sinon il s'agit d'un membre
        else
            $redirection = new RedirectResponse($this->router->generate('GCD_homepage'));
 
        return $redirection;
    }
}