<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Command\User\UserEditProfileCommand;
use App\Entity\User\User;
use App\Form\User\UserEditProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    #[Route('/edit/{id}/profile', name: 'user_update_profile')]
    // ToDo IsGranted avec Voter pour vérif si Admin ou User actuel
    public function editProfile(Request $request, User $user): Response
    {
        $command = new UserEditProfileCommand($user);

        $form = $this->createForm(UserEditProfileType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($command);

            // ToDo SuccessFlash

            // ToDo Redirect vers action READ
        }

        return $this->render('user/edit_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
