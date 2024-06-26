<?php

namespace App\Services;

use App\Interfaces\KeyValueRepositoryInterface;
use App\Interfaces\KeyValueServiceInterface;

class KeyValueService implements KeyValueServiceInterface
{
    public function __construct(private KeyValueRepositoryInterface $keyValueRepository) {}

    public function getAll()
    {
        return $this->keyValueRepository->getAll();
    }
}
