<?php

declare(strict_types=1);

namespace App\EventSubscriber\Security;

use App\Cookie\DisplayListTypeCookie;
use App\Entity\User\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LoginSuccessSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => 'initializeDisplayListCookie',
        ];
    }

    public function initializeDisplayListCookie(LoginSuccessEvent $event): void
    {
        /** @var User $user */
        $user = $event->getUser();
        $response = $event->getResponse();

        if (null === $response) {
            return;
        }

        $response->headers->setCookie(DisplayListTypeCookie::create($user->getDisplayListType()));
    }
}
