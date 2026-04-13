<?php

declare(strict_types=1);

namespace App\Tests\Util\Core;

use App\Entity\User\User;
use App\Util\Core\ClassNameExtractor;
use PHPUnit\Framework\TestCase;

class ClassNameExtractorTest extends TestCase
{
    public function testItReturnsClassBaseName(): void
    {
        $user = new User();

        self::assertSame('User', ClassNameExtractor::getClassBaseName($user::class));
    }
}
