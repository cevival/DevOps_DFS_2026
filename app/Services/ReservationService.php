<?php

namespace App\Services;

class Reservation
{
    public User $madeBy;

    public function __construct(User $madeBy)
    {
        $this->madeBy = $madeBy;
    }

    public function canBeCancelledBy(User $user): bool
    {
        return $user->isAdmin || $this->madeBy === $user;
    }
}
