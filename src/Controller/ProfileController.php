<?php

namespace App\Controller;

use App\Entity\Offers;
use App\Entity\User;
use App\Form\EditUserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage): Response
    {
        $user = $tokenStorage->getToken()->getUser();

        $offres = $user->getApply();

        $candidatures = [];
        foreach ($offres as $offre) {
            $candidatures[] = $offre;
        }

        return $this->render('profile/index.html.twig', [
            'candidatures' => $candidatures,
        ]);
    }

    #[Route('/profile/{id?}', name: 'app_profile_delete')]
    public function delete(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage, INT $id): Response
    {
        $offre = $entityManager->getRepository(Offers::class)->find($id);

        $user = $tokenStorage->getToken()->getUser();

        $user->removeApply($offre);
        $entityManager->persist($user);
        $entityManager->flush($user);

        $offres = $user->getApply();

        $candidatures = [];
        foreach ($offres as $offre) {
            $candidatures[] = $offre;
        }

        return $this->render('profile/index.html.twig', [
            'candidatures' => $candidatures,
        ]);
    }

    #[Route('/profile/edit/{id}', name: 'app_profile_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage, INT $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        $form = $this->createForm(EditUserFormType::class, $user );

        $form = $form->handleRequest($request);

        if($form->isSubmitted()){

            //enregistrer en BDD
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/edit.html.twig', [
            'form' => $form,
        ]);
    }

}
