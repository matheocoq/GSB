<?php

namespace App\Controller;

use App\Entity\Visiteur;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        
        $lastUsername=$authenticationUtils->getLastUsername();
        $errors=$authenticationUtils->getLastAuthenticationError();
        return $this->render('connexion/login.html.twig',['lastUsername'=>$lastUsername,'errors'=>$errors]);
    }

    
    
    

    /**
     * @Route("/accueil", name="Accueil")
     */
    public function accueil(Request $request): Response
    {
        $cookies = $request->cookies;
        \dump($cookies);
        return $this->render('accueil.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);
    }

    /**
     * @Route("/logout",name="security_logout")
     */
    public function logout()
{
}

   
}
