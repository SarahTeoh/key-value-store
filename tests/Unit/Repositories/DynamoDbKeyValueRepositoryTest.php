<?php

use App\Models\KeyValue;
use App\Repositories\DynamoDbKeyValueRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->mockModel = Mockery::mock(KeyValue::class);
    $this->repository = new DynamoDbKeyValueRepository($this->mockModel);
});

it('can get all key-value pairs', function () {
    $mockedCollection = new Collection([
        new KeyValue(['key' => 'key1', 'value' => 'value1']),
        new KeyValue(['key' => 'key2', 'value' => 'value2']),
    ]);

    $this->mockModel->shouldReceive('all')->once()->andReturn($mockedCollection);

    $result = $this->repository->getAll();

    expect($result)->toBeInstanceOf(Collection::class);
});