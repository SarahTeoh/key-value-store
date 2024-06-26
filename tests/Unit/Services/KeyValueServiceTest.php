<?php

use App\Interfaces\KeyValueRepositoryInterface;
use App\Services\KeyValueService;
use Carbon\CarbonImmutable;

beforeEach(function () {
    $this->mockRepository = mock(KeyValueRepositoryInterface::class);
    $this->service = new KeyValueService($this->mockRepository);
});

it('can store a key-value pair', function () {
    $this->mockRepository->shouldReceive('store')->once()->with('test_key', 'test_value', Mockery::type('int'));

    $this->service->store('test_key', 'test_value');
});

it('can get the latest value for a key', function () {
    $this->mockRepository->shouldReceive('getKeyLatest')->once()->with('test_key')->andReturn('latest_value');

    $result = $this->service->getValue('test_key');

    expect($result)->toBe('latest_value');
});

it('can get the value for a key at a specific timestamp', function () {
    $timestamp = CarbonImmutable::now('UTC')->timestamp;
    $this->mockRepository->shouldReceive('getByTimestamp')->once()->with('test_key', $timestamp)->andReturn('value_at_timestamp');

    $result = $this->service->getValue('test_key', (string) $timestamp);

    expect($result)->toBe('value_at_timestamp');
});

it('can get all key-value pairs', function () {
    $this->mockRepository->shouldReceive('getAll')->once()->andReturn(['key1' => 'value1', 'key2' => 'value2']);

    $result = $this->service->getAll();

    expect($result)->toBe(['key1' => 'value1', 'key2' => 'value2']);
});
