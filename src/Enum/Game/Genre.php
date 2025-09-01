<?php

declare(strict_types=1);

namespace App\Enum\Game;

use App\Enum\Core\LabeledEnum;

enum Genre: int implements LabeledEnum
{
    // Action
    case ACTION__ACTION_ADVENTURE = 8;
    case ACTION__ARCADE = 33;
    case ACTION__BEAT_EM_UP = 5;
    case ACTION__FIGHTING = 4;
    case ACTION__FPS = 2;
    case ACTION__STEALTH = 6;
    case ACTION__PLATFORMER = 1;
    case ACTION__SHOOT_EM_UP = 32;
    case ACTION__SURVIVAL_HORROR = 7;
    case ACTION__TPS = 3;

    // Autres
    case OTHER__OTHER = 29;
    case OTHER__CASUAL = 30;
    case OTHER__COMPILATION = 50;
    case OTHER__EDUCATIONAL = 51;
    case OTHER__BOARD_GAME = 52;
    case OTHER__PARTY_GAME = 36;
    case OTHER__RHYTHM = 28;
    case OTHER__SANDBOX = 37;

    // Aventure
    case ADVENTURE__GRAPHIC = 10;
    case ADVENTURE__TEXTUAL = 9;
    case ADVENTURE__INTERACTIVE = 12;
    case ADVENTURE__VISUAL_NOVEL = 11;

    // Jeu de rôle
    case ROLE_PLAYING__ACTION_RPG = 13;
    case ROLE_PLAYING__HACK_N_SLASH = 31;
    case ROLE_PLAYING__MMORPG = 14;
    case ROLE_PLAYING__ROGUE_LIKE = 15;
    case ROLE_PLAYING__RPG = 38;
    case ROLE_PLAYING__TACTICAL = 16;

    // Réflexion
    case PUZZLE__RIDDLE = 40;
    case PUZZLE__LABYRINTH = 35;
    case PUZZLE__PUZZLE_GAME = 34;

    // Simulation
    case SIMULATION__OTHER = 43;
    case SIMULATION__MANAGEMENT = 17;
    case SIMULATION__GOD_GAME = 19;
    case SIMULATION__DRIVING = 20;
    case SIMULATION__LIFE = 18;
    case SIMULATION__PET = 39;

    // Sports
    case SPORTS__RACING = 26;
    case SPORTS__OTHER = 27;

    // Stratégie
    case STRATEGY__4X = 24;
    case STRATEGY__GRAND_STRATEGY = 23;
    case STRATEGY__MOBA = 53;
    case STRATEGY__TURN_BASED = 21;
    case STRATEGY__REAL_TIME = 22;
    case STRATEGY__WARGAME = 25;

    public function label(): string
    {
        return match ($this) {
            self::ACTION__ACTION_ADVENTURE => 'Action | Action-Aventure',
            self::ACTION__ARCADE => 'Action | Arcade',
            self::ACTION__BEAT_EM_UP => 'Action | Beat’em up',
            self::ACTION__FIGHTING => 'Action | Combat',
            self::ACTION__FPS => 'Action | FPS',
            self::ACTION__STEALTH => 'Action | Infiltration',
            self::ACTION__PLATFORMER => 'Action | Plateformes',
            self::ACTION__SHOOT_EM_UP => 'Action | Shoot’em up',
            self::ACTION__SURVIVAL_HORROR => 'Action | Survival Horror',
            self::ACTION__TPS => 'Action | TPS',
            self::OTHER__OTHER => 'Autres | Autre',
            self::OTHER__CASUAL => 'Autres | Casual',
            self::OTHER__COMPILATION => 'Autres | Compilation',
            self::OTHER__EDUCATIONAL => 'Autres | Éducation',
            self::OTHER__BOARD_GAME => 'Autres | Jeux de société',
            self::OTHER__PARTY_GAME => 'Autres | Party Game / Mini-jeux',
            self::OTHER__RHYTHM => 'Autres | Rythme / Musique',
            self::OTHER__SANDBOX => 'Autres | Sandbox',
            self::ADVENTURE__GRAPHIC => 'Aventure | Aventure graphique',
            self::ADVENTURE__TEXTUAL => 'Aventure | Aventure textuelle',
            self::ADVENTURE__INTERACTIVE => 'Aventure | Fiction/film interactif',
            self::ADVENTURE__VISUAL_NOVEL => 'Aventure | Visual Novel',
            self::ROLE_PLAYING__ACTION_RPG => 'Jeu de rôle | Action RPG',
            self::ROLE_PLAYING__HACK_N_SLASH => 'Jeu de rôle | Hack ’n’ Slash',
            self::ROLE_PLAYING__MMORPG => 'Jeu de rôle | MMORPG',
            self::ROLE_PLAYING__ROGUE_LIKE => 'Jeu de rôle | Rogue-like',
            self::ROLE_PLAYING__RPG => 'Jeu de rôle | RPG',
            self::ROLE_PLAYING__TACTICAL => 'Jeu de rôle | Tactical RPG',
            self::PUZZLE__RIDDLE => 'Réflexion | Casse-têtes et Énigmes',
            self::PUZZLE__LABYRINTH => 'Réflexion | Labyrinthe',
            self::PUZZLE__PUZZLE_GAME => 'Réflexion | Puzzle Game',
            self::SIMULATION__OTHER => 'Simulation | Autre',
            self::SIMULATION__MANAGEMENT => 'Simulation | Gestion',
            self::SIMULATION__GOD_GAME => 'Simulation | God Game',
            self::SIMULATION__DRIVING => 'Simulation | Simulation de véhicule',
            self::SIMULATION__LIFE => 'Simulation | Simulation de vie',
            self::SIMULATION__PET => 'Simulation | Virtual Pet',
            self::SPORTS__RACING => 'Sports | Course',
            self::SPORTS__OTHER => 'Sports | Sports spécifiques',
            self::STRATEGY__4X => 'Stratégie | 4X',
            self::STRATEGY__GRAND_STRATEGY => 'Stratégie | Grande Stratégie',
            self::STRATEGY__MOBA => 'Stratégie | MOBA',
            self::STRATEGY__TURN_BASED => 'Stratégie | Stratégie au Tour par Tour',
            self::STRATEGY__REAL_TIME => 'Stratégie | Stratégie en Temps Réel',
            self::STRATEGY__WARGAME => 'Stratégie | Wargame',
        };
    }
}
