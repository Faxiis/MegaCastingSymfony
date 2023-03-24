<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\ContractType;
use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $offre = $entityManager->getRepository(Offers::class)->findAll();

        return $this->render('home/index.html.twig', [
            'offres' => $offre,
        ]);
    }
}
