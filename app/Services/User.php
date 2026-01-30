<?php

namespace App\Services;

class User
{
    public bool $isAdmin;

    public function __construct(bool $isAdmin = false)
    {
        $this->isAdmin = $isAdmin;
    }
}
