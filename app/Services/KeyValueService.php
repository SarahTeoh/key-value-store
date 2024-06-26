<?php

namespace App\Services;

use App\Interfaces\KeyValueRepositoryInterface;
use App\Interfaces\KeyValueServiceInterface;

class KeyValueService implements KeyValueServiceInterface
{
    public function __construct(private KeyValueRepositoryInterface $keyValueRepository) {}

    public function getValue(string $key, ?string $timestamp = '')
    {
        if ($timestamp) {
            $data = $this->keyValueRepository->getByTimestamp($key, (int) $timestamp);
        } else {
            $data = $this->keyValueRepository->getKeyLatest($key);
        }

        return $data;
    }

    public function getAll()
    {
        return $this->keyValueRepository->getAll();
    }
}
