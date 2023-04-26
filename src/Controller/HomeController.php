<?php

namespace App\Controller;

use App\Entity\Offers;
use App\Form\FilterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, ?string $query, PaginatorInterface $paginator, Request $request, TokenStorageInterface $tokenStorage): Response
    {

        $currentDate = new \DateTime(); // Récupère la date actuelle
        $endDate = clone $currentDate; // Crée une copie de la date actuelle
        $endDate->modify('+30 days'); // Ajoute 30 jours à la copie de la date actuelle

        $dql = "SELECT o FROM App\Entity\Offers o WHERE o.offerStartDate > :currentDate AND o.offerEndDate < :endDate ORDER BY o.parutionDateTime DESC";
        $query = $entityManager->createQuery($dql);
        $query->setParameter('currentDate', $currentDate);
        $query->setParameter('endDate', $endDate);
        $offre = $query->getResult();

        $offre = $paginator->paginate(
            $offre, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            16 // Nombre de résultats par page
        );

        $form = $this->createForm(FilterFormType::class);

        $form = $form->handleRequest($request);


        if($form->isSubmitted()){
            $test = $form->getData();
            $contrat = $test['contract'];
            $activity = $test['activity'];
            $activityDomain = $test['domain'];
            $level = $test['level'];

            $user = $tokenStorage->getToken()->getUser()->getProfesionalLevel();

            $offre = $entityManager->getRepository(Offers::class)->findByContractType($contrat, $activity, $level, $user);


            $offre = $paginator->paginate(
                $offre, // Requête contenant les données à paginer (ici nos articles)
                $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
                16 // Nombre de résultats par page
            );

            return $this->render('home/index.html.twig', [
                'offres' => $offre,
                'form' => $form,
            ]);

        }else{

            return $this->render('home/index.html.twig', [
                'offres' => $offre,
                'form' => $form,
            ]);
        }


    }

    #[Route('/search/', name: 'app_home_search')]
    public function search(EntityManagerInterface $entityManager, Request $request, PaginatorInterface $paginator): Response
    {
        $query = $request->get('query');

        $offersSearch = $entityManager->getRepository(Offers::class)->findSearch($query);

        $offersSearch = $paginator->paginate(
            $offersSearch, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            16 // Nombre de résultats par page
        );

        if($query == ""){
            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/search.html.twig', [
            'recherche' => $offersSearch,
        ]);
    }
}
