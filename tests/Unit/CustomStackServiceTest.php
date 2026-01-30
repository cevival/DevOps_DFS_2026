<?php

namespace Tests\Unit;

use App\Services\CustomStackService;
use App\Services\StackCantBeEmptyException;
use PHPUnit\Framework\TestCase;

class CustomStackServiceTest extends TestCase
{
    private CustomStackService $service;

    protected function setUp(): void
    {
        $this->service = new CustomStackService();
    }
    
    public function testCount_ReturnsZeroForNewStack(): void
    {
        $this->assertEquals(0, $this->service->count());
    }
    public function testPush_IncreasesCount(): void
    {
        $this->service->push(10);
        $this->assertEquals(1, $this->service->count());

        $this->service->push(20);
        $this->assertEquals(2, $this->service->count());
    }
    public function testPop_DecreasesCountAndReturnsValue(): void
    {
        $this->service->push(10);
        $this->service->push(20);

        $poppedValue = $this->service->pop();
        $this->assertEquals(20, $poppedValue);
        $this->assertEquals(1, $this->service->count());

        $poppedValue = $this->service->pop();
        $this->assertEquals(10, $poppedValue);
        $this->assertEquals(0, $this->service->count());
    }
    public function testPop_ThrowsExceptionWhenStackIsEmpty(): void
    {
        $this->expectException(StackCantBeEmptyException::class);
        $this->service->pop();
    }
    
    public function testInterleavedPushPop_MaintainsLifo(): void
    {
        $this->service->push(1);
        $this->service->push(2);
        $this->assertEquals(2, $this->service->pop());
        $this->service->push(3);
        $this->assertEquals(3, $this->service->pop());
        $this->assertEquals(1, $this->service->pop());
    }

    public function testPushAcceptsNegativeAndZero(): void
    {
        $this->service->push(0);
        $this->service->push(-5);
        $this->assertEquals(-5, $this->service->pop());
        $this->assertEquals(0, $this->service->pop());
    }

    public function testDuplicateValues_PopIsLifo(): void
    {
        $this->service->push(10);
        $this->service->push(20);
        $this->service->push(10);
        $this->assertEquals(10, $this->service->pop());
        $this->assertEquals(20, $this->service->pop());
        $this->assertEquals(10, $this->service->pop());
    }

    public function testBulkPushPop_CountAccuracy(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $this->service->push($i);
        }
        $this->assertEquals(50, $this->service->count());
        for ($i = 0; $i < 50; $i++) {
            $this->service->pop();
        }
        $this->assertEquals(0, $this->service->count());
    }

    public function testPushNonInt_ThrowsTypeError(): void
    {
        $this->expectException(\TypeError::class);
        $this->service->push('string');
    }
}
