<?php

namespace App\Factories\Concerns;

trait ForCurrentBarangay
{
    public function forCurrentBarangay(): static
    {
        return $this->for(auth()->user()?->barangay);
    }
}
