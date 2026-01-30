<?php

namespace Tests\Unit;

use App\Services\MathOperationsService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class MathOperationsServiceTest extends TestCase
{
    private MathOperationsService $service;

    protected function setUp(): void
    {
        $this->service = new MathOperationsService();
    }

    public static function additionProvider(): array
    {
        return [
            [2, 3, 5],
            [-1, 1, 0],
            [0, 0, 0],
            [-2, -3, -5],
        ];
    }

    /**
     * @dataProvider additionProvider
     */
    public function testAdd_ReturnsCorrectSum(int $numberOne, int $numberTwo, int $expected): void
    {
        $this->assertEquals($expected, $this->service->add($numberOne, $numberTwo));
    }

    public function testDivide_ByNonZero_ReturnsCorrectQuotient(): void
    {
        $this->assertEquals(2.0, $this->service->divide(6, 3));
        $this->assertEquals(2.5, $this->service->divide(5, 2));
    }

    public function testDivide_ByZero_ThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->divide(5, 0);
    }
    
    public function testGetOddNumbers_WithValidLimit_ReturnsCorrectOddNumbers(): void
    {
        $this->assertEquals([1, 3, 5], $this->service->getOddNumbers(5));
        $this->assertEquals([], $this->service->getOddNumbers(0));
        $this->assertEquals([1], $this->service->getOddNumbers(1));
    }

    public function testGetOddNumbers_WithNegativeLimit_ThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->service->getOddNumbers(-5);
    }

}