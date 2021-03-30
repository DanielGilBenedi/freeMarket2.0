<?php


namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Principal extends AbstractController
{
    /**
     * @Route("/", name="principal")
     */
    public function index()
    {
        return $this->render('principal/index.html.twig');
    }

}