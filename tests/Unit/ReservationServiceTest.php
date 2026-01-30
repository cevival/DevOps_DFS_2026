<?php

namespace Tests\Unit;

use App\Services\ReservationService;
use App\Services\User;
use PHPUnit\Framework\TestCase;

class ReservationServiceTest extends TestCase
{
    private ReservationService $service;
    private User $userMakingReservation;

    protected function setUp(): void
    {
        $this->userMakingReservation = new User();
        $this->userMakingReservation->isAdmin = false;
        $this->service = new ReservationService($this->userMakingReservation);
    }
    public function testCanBeCancelledBy_ByOwner_ReturnsTrue(): void
    {
        $this->assertTrue($this->service->canBeCancelledBy($this->userMakingReservation));
    }

    public function testCanBeCancelledBy_ByOtherNonAdmin_ReturnsFalse(): void
    {
        $other = new User();
        $other->isAdmin = false;

        $this->assertFalse($this->service->canBeCancelledBy($other));
    }

    public function testCanBeCancelledBy_ByAdmin_ReturnsTrue(): void
    {
        $admin = new User();
        $admin->isAdmin = true;

        $this->assertTrue($this->service->canBeCancelledBy($admin));
    }

    public function testCanBeCancelledBy_Null_ThrowsTypeError(): void
    {
        $this->expectException(\TypeError::class);
        $this->service->canBeCancelledBy(null);
    }
}