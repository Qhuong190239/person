<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
=======
<<<<<<< HEAD
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]

=======
>>>>>>> d0b3d43489e35b3beb64207560b37cc71100fdea

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
<<<<<<< HEAD
=======
>>>>>>> 105a50fa63f3924d23399a44a0d4fdd76f722ae2
>>>>>>> d0b3d43489e35b3beb64207560b37cc71100fdea
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
