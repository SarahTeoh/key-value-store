<?php

namespace App\Interfaces;

interface KeyValueServiceInterface
{
    public function store(string $key, string $value);

    public function getValue(string $key, ?string $timestamp = '');

    public function getAll();
}
