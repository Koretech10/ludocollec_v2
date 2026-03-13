<?php

declare(strict_types=1);

namespace App\Controller;

use App\Cookie\DisplayListTypeCookie;
use App\Entity\User\User;
use App\Enum\User\DisplayListType;
use App\Repository\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    #[Route('/display/set/{displayListType}', name: 'user.set_display_list_type')]
    public function setDisplayListType(Request $request, int $displayListType): RedirectResponse
    {
        /** @var ?User $user */
        $user = $this->getUser();
        $displayListTypeEnum = DisplayListType::from($displayListType);

        if (null !== $user) {
            $user->setDisplayListType($displayListTypeEnum);
            $this->userRepository->flush();
        }

        $response = $this->redirect($request->headers->get('referer', '/'));
        $response->headers->setCookie(DisplayListTypeCookie::create($displayListTypeEnum));

        return $response;
    }
}
