<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Tests\Infrastructure\Http;

use PHPUnit\Framework\TestCase;

class PostControllerTest extends TestCase
{
    public function testPost()
    {
        $a = 1;

        $this->assertEquals(1, $a);
    }

}
