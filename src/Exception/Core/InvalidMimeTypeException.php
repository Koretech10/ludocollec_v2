<?php

declare(strict_types=1);

namespace App\Exception\Core;

class InvalidMimeTypeException extends \Exception
{
    public static function expectsImage(string $mimeType): self
    {
        return new self(\sprintf('Le type MIME « %s » est invalide. Type MIME attendu : « image/* ». ', $mimeType));
    }
}
