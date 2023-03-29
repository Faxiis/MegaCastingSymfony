<?php

namespace App\Controller;

use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Model\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    #[Route('/api/offres', name: 'app_api_offre', methods: ['GET'])]
    #[OA\Get(
        summary: 'Liste des offres de casting',
    )]
    #[OA\Response(
        response: 200,
        description: 'Liste des offres de casting',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: Offers::class))
        )
    )]
    #[OA\Tag(name: 'Offres de casting')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $offre = $entityManager->getRepository(Offers::class)->findBy([],['parutionDateTime' => 'desc']);


        return $this->json($offre);
    }
}
