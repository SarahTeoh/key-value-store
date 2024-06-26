<?php

namespace App\Interfaces;

interface KeyValueRepositoryInterface
{
    public function getKeyLatest(string $key);

    public function getByTimestamp(string $key, int $timestamp);

    public function getAll();
}
