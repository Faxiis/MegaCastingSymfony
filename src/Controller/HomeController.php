<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\ContractType;
use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, ?string $query): Response
    {
        $offre = $entityManager->getRepository(Offers::class)->findAll();

        $offersSearch = $entityManager->getRepository(Offers::class)->findSearch($query);

        return $this->render('home/index.html.twig', [
            'offres' => $offre,
            'rechercheOffre' => $offersSearch,
        ]);
    }

    #[Route('/search/', name: 'app_home_search')]
    public function search(EntityManagerInterface $entityManager, Request $request): Response
    {
        $query = $request->get('query');

        $offersSearch = $entityManager->getRepository(Offers::class)->findSearch($query);

        if($query == ""){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/search.html.twig', [
            'recherche' => $offersSearch,
        ]);
    }




}
