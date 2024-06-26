<?php

namespace App\Interfaces;

interface KeyValueServiceInterface
{
    public function getValue(string $key, ?string $timestamp = '');

    public function getAll();
}
