<?php

declare(strict_types=1);

namespace App\Enum\Accessory;

use App\Enum\Core\LabeledEnum;

enum Type: int implements LabeledEnum
{
    case CONTROLLER = 1;
    case WHEEL = 2;
    case KEYBOARD = 3;
    case MOUSE = 4;
    case JOYSTICK = 5;
    case SPECIAL_CONTROLLER = 6;
    case STORAGE_DEVICE = 7;
    case CONNECTIONS = 8;
    case BATTERY = 10;
    case EXTENSION = 12;
    case HEADSET = 13;
    case STAND = 14;
    case MAINTENANCE = 17;
    case PROTECTION = 18;
    case STORAGE_SPACE = 19;
    case PACK = 20;
    case OTHER = 21;
    case ARCADE_STICK = 22;

    public function label(): string
    {
        return match ($this) {
            self::CONTROLLER => 'Manette',
            self::WHEEL => 'Volant',
            self::KEYBOARD => 'Clavier',
            self::MOUSE => 'Souris',
            self::JOYSTICK => 'Joystick',
            self::SPECIAL_CONTROLLER => 'Contrôleur spécial',
            self::STORAGE_DEVICE => 'Stockage',
            self::CONNECTIONS => 'Connectique',
            self::BATTERY => 'Batterie',
            self::EXTENSION => 'Extension',
            self::HEADSET => 'Casque',
            self::STAND => 'Support',
            self::MAINTENANCE => 'Entretien',
            self::PROTECTION => 'Protection',
            self::STORAGE_SPACE => 'Rangement',
            self::PACK => 'Pack',
            self::OTHER => 'Autres',
            self::ARCADE_STICK => 'Stick arcade',
        };
    }
}
