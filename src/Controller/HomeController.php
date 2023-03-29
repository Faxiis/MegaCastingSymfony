<?php

namespace App\Controller;

use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, ?string $query, PaginatorInterface $paginator, Request $request): Response
    {
        $offre = $entityManager->getRepository(Offers::class)->findBy([],['parutionDateTime' => 'desc']);

        $offersSearch = $entityManager->getRepository(Offers::class)->findSearch($query);

        $offre = $paginator->paginate(
            $offre, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            16 // Nombre de résultats par page
        );

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
