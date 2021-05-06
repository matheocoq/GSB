<?php

namespace app\Tests;

use App\Repository\TypeRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppTest extends KernelTestCase
{
    public function testTestsAreWorking()
    {
        self::bootKernel();
        $nb=self::$container->get(TypeRepository::class)->count([]);
        $this->assertEquals(4,$nb);
    }
}