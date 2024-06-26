<?php

namespace App\Interfaces;

interface KeyValueRepositoryInterface
{
    public function store(string $key, string $value, int $timestamp);

    public function getKeyLatest(string $key);

    public function getByTimestamp(string $key, int $timestamp);

    public function getAll();
}
