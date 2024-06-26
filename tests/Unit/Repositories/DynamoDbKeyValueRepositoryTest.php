<?php

use App\Models\KeyValue;
use App\Repositories\DynamoDbKeyValueRepository;
use Illuminate\Database\Eloquent\Collection;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->mockModel = Mockery::mock(KeyValue::class);
    $this->repository = new DynamoDbKeyValueRepository($this->mockModel);
});

it('can store a key-value pair', function () {
    $this->mockModel->shouldReceive('create')->once()->with([
        'key' => 'test_key',
        'value' => 'test_value',
        'timestamp' => 1231244,
    ]);

    $this->repository->store('test_key', 'test_value', 1231244);
});

it('can get the latest value for a key', function () {
    $mockedKeyValue = new KeyValue(['key' => 'test_key', 'value' => 'latest_value']);

    $this->mockModel->shouldReceive('where')->once()->with('key', 'test_key')->andReturnSelf();
    $this->mockModel->shouldReceive('decorate')->once()->andReturnSelf();
    $this->mockModel->shouldReceive('firstOrFail')->once()->andReturn($mockedKeyValue);

    $result = $this->repository->getKeyLatest('test_key');

    expect($result)->toBe($mockedKeyValue);
});

it('throws ModelNotFoundException when getting by timestamp for non-existing key and timestamp', function () {
    $this->mockModel->shouldReceive('findOrFail')->once()->andThrow(ModelNotFoundException::class);

    $this->expectException(ModelNotFoundException::class);

    $this->repository->getByTimestamp('non_existing_key', time());
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
