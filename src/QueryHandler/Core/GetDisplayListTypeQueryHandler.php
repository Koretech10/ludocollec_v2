<?php

declare(strict_types=1);

namespace App\QueryHandler\Core;

use App\Cookie\DisplayListTypeCookie;
use App\Enum\User\DisplayListType;
use App\Query\Core\GetDisplayListTypeQuery;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class GetDisplayListTypeQueryHandler
{
    public function __construct(
        private RequestStack $requestStack,
    ) {
    }

    public function __invoke(GetDisplayListTypeQuery $query): DisplayListType
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null === $request) {
            return DisplayListType::default();
        }

        $displayListType = $request->cookies->getInt(DisplayListTypeCookie::DISPLAY_LIST_COOKIE_NAME);

        return DisplayListType::fromCookie($displayListType);
    }
}
