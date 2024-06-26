<?php

use App\Interfaces\KeyValueRepositoryInterface;
use App\Services\KeyValueService;

beforeEach(function () {
    $this->mockRepository = mock(KeyValueRepositoryInterface::class);
    $this->service = new KeyValueService($this->mockRepository);
});

it('can get all key-value pairs', function () {
    $this->mockRepository->shouldReceive('getAll')->once()->andReturn(['key1' => 'value1', 'key2' => 'value2']);

    $result = $this->service->getAll();

    expect($result)->toBe(['key1' => 'value1', 'key2' => 'value2']);
});
