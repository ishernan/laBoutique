<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResgisterController extends AbstractController
{
    #[Route('/inscriptions', name: 'register')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class,$user);

        return $this->render('resgister/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
