<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResgisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/inscriptions', name: 'register')]

    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class,$user);

        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){

            $user = $form->getData();

            $password = $passwordHasher->hashPassword($user,$user->getPassword());
            $user->setPassword($password);

            //$doctrine = $this->getDoctrine()->getManager();

            $this->entityManager->persist($user);
            $this->entityManager->flush();


        }


        return $this->render('resgister/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
