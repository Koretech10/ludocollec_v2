<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Command\User\UserEditPasswordCommand;
use App\Command\User\UserEditProfileCommand;
use App\Entity\User\User;
use App\Form\User\UserEditPasswordType;
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

    #[Route('/show/{id}', name: 'user_show')]
    // ToDo IsGranted avec Voter pour vérif si Admin ou User actuel
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
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

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit_profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}/password', name: 'user_edit_password')]
    // ToDo IsGranted avec Voter pour vérif si User actuel
    public function editPassword(Request $request, User $user): Response
    {
        $command = new UserEditPasswordCommand($user);

        $form = $this->createForm(UserEditPasswordType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($command);

            // ToDo SuccessFlash

            return $this->redirectToRoute('user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
