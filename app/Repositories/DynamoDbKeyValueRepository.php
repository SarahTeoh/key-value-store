<?php

namespace App\Repositories;

use App\Interfaces\KeyValueRepositoryInterface;
use App\Models\KeyValue;
use BaoPham\DynamoDb\RawDynamoDbQuery;
use Illuminate\Database\Eloquent\Collection;

class DynamoDbKeyValueRepository implements KeyValueRepositoryInterface
{
    public function __construct(private KeyValue $model) {}

    public function store(string $key, string $value, int $timestamp)
    {
        return $this->model->create([
            'key' => $key,
            'timestamp' => $timestamp,
            'value' => $value,
        ]);
    }

    public function getKeyLatest(string $key)
    {
        // @phpstan-ignore-next-line
        return $this->model->where('key', $key)
            ->decorate(function (RawDynamoDbQuery $raw) {
                $raw->query['ScanIndexForward'] = false;
            })->firstOrFail();
    }

    public function getByTimestamp(string $key, int $timestamp)
    {
        return $this->model->findOrFail(['key' => $key, 'timestamp' => $timestamp]);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
