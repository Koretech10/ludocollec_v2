<?php

declare(strict_types=1);

namespace App\Cookie;

use App\Enum\User\DisplayListType;
use Symfony\Component\HttpFoundation\Cookie;

readonly class DisplayListTypeCookie
{
    private const int DISPLAY_LIST_COOKIE_EXPIRATION = 31536000; // 1 an

    public const string DISPLAY_LIST_COOKIE_NAME = 'display_list';

    public static function create(DisplayListType $displayListType): Cookie
    {
        return Cookie::create(
            name: self::DISPLAY_LIST_COOKIE_NAME,
            value: (string) $displayListType->value,
            expire: \time() + self::DISPLAY_LIST_COOKIE_EXPIRATION,
        );
    }
}
