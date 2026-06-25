<?php

declare(strict_types=1);

namespace App\Enum\Core;

use App\Exception\Core\IconNotFoundException;

enum Icon: string
{
    /** ICÔNES D'ACTIONS */
    case log_sign_in = 'box-arrow-in-right';
    case log_out = 'box-arrow-left';
    case filter = 'funnel';
    case filter_active = 'funnel-fill';
    case sort = 'sort-down';
    case cancel = 'x-lg';

    /** ICÔNES GÉNÉRIQUES */
    case hall_of_fame = 'heart-fill';
    case help = 'question-circle-fill';
    case administration = 'kanban-fill';
    case database = 'database-fill';
    case members = 'people-fill';
    case logged_in_user = 'person-circle';
    case profile = 'person-lines-fill';
    case stats = 'graph-up';
    case grid = 'file-image-fill';
    case imaged_list = 'file-richtext-fill';
    case list = 'file-text-fill';
    case arrow_left = 'arrow-left';
    case arrow_right = 'arrow-right';

    /** ICÔNES EXTERNES */
    case twitter_x = 'twitter-x';
    case youtube = 'youtube';
    case twitch = 'twitch';
    case discord = 'discord';
    case github = 'github';

    /** ICÔNES D'ENTITÉS */
    case game = 'dpad-fill';
    case extension = 'puzzle-fill';
    case console = 'hdd-fill';
    case accessory = 'joystick';
    case toy = 'person-walking';
    case collection = 'collection-fill';
    case wishlist = 'bookmarks-fill';
    case user_list = 'journals';

    /**
     * @throws IconNotFoundException
     */
    public static function fromName(string $name): Icon
    {
        foreach (self::cases() as $icon) {
            if ($name === $icon->name) {
                return $icon;
            }
        }

        throw IconNotFoundException::forName($name);
    }

    /**
     * @return list<string>
     */
    public static function names(): array
    {
        return \array_map(static function (self $icon): string {
            return $icon->name;
        }, self::cases());
    }
}
