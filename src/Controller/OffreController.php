<?php

namespace App\Controller;

use App\Entity\Offers;
use App\Form\OffersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    #[Route('/offre/{id?}', name: 'app_offre', requirements: ['id' => '\d+'])]
    public function index($id, EntityManagerInterface $entityManager): Response
    {
        $offre = $entityManager->getRepository(Offers::class)->find($id);


        return $this->render('offre/index.html.twig', [
            'offre' => $offre,
        ]);
    }

    #[Route('/offre/new', name: 'app_offre_new')]
    public function new(Request $request): Response
    {
        $offer = new Offers();

        $form = $this->createForm(OffersType::class, $offer);

        return $this->render('offre/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/offre/edit/{id?}', name: 'app_offre_edit')]
    public function edit($id , EntityManagerInterface $entityManager,Request $request): Response
    {

        $offre = new Offers();

        if ($id != null){
            $offre = $entityManager->getRepository(Offers::class)->find($id);
        }

        $form = $this->createForm(OffersType::class, $offre );

        $form = $form->handleRequest($request);

        if($form->isSubmitted()){

            //enregistrer en BDD
            $offre = $form->getData();
            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('offre/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/offre/delete/{id}', name: 'app_offre_delete')]
    public function delete($id ,EntityManagerInterface $entityManager): Response
    {
        if($id != null){
            $offre = $entityManager->getRepository(Offers::class)->find($id);
            $entityManager->remove($offre);
            $entityManager->flush();



            return $this->redirectToRoute('app_home');
        }

        $offres = $entityManager->getRepository(Offers::class)->findAll();

        return $this->render('home/index.html.twig', [
            'offres' => $offres,
        ]);
    }

    #[Route('/offre/test', name: 'app_offre_test')]
    public function search(EntityManagerInterface $entityManager): Response
    {
        $offers = $entityManager->getRepository(Offers::class)->findSearch('Batteur');
        dd($offers);

    }
}
