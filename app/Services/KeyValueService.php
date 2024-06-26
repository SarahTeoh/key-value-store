<?php

namespace App\Services;

use App\Interfaces\KeyValueRepositoryInterface;
use App\Interfaces\KeyValueServiceInterface;
use Carbon\CarbonImmutable;

class KeyValueService implements KeyValueServiceInterface
{
    public function __construct(private KeyValueRepositoryInterface $keyValueRepository) {}

    public function store(string $key, string $value)
    {
        $timestamp = CarbonImmutable::now('UTC')->timestamp;

        return $this->keyValueRepository->store($key, $value, $timestamp);
    }

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
