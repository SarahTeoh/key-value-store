<?php

namespace App\Repositories;

use App\Interfaces\KeyValueRepositoryInterface;
use App\Models\KeyValue;
use Illuminate\Database\Eloquent\Collection;

class DynamoDbKeyValueRepository implements KeyValueRepositoryInterface
{
    public function __construct(private KeyValue $model) {}

    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
