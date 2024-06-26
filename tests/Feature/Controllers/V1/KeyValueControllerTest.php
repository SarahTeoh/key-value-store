<?php

use App\Interfaces\KeyValueServiceInterface;
use Mockery\MockInterface;

beforeEach(function () {
    $this->mock(KeyValueServiceInterface::class, function (MockInterface $mock) {
        $mock->shouldReceive('getAll')->andReturn(collect([
            (object) ['key' => 'key1', 'value' => 'value1', 'timestamp' => 1625236523],
            (object) ['key' => 'key2', 'value' => 'value2', 'timestamp' => 1625237000],
        ]));

        $mock->shouldReceive('store')->andReturnUsing(function ($key, $value) {
            return (object) ['key' => $key, 'value' => $value, 'timestamp' => now()->timestamp];
        });

        $mock->shouldReceive('getValue')->andReturnUsing(function ($key, $timestamp = null) {
            if ($timestamp) {
                return (object) ['key' => $key, 'value' => 'value1', 'timestamp' => $timestamp];
            }

            return (object) ['key' => $key, 'value' => 'latest_value', 'timestamp' => now()->timestamp];
        });
    });
});

it('can fetch all key-value pairs', function () {
    $response = $this->get('/api/v1/get_all_records');

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                ['key' => 'key1', 'value' => 'value1', 'timestamp' => 1625236523],
                ['key' => 'key2', 'value' => 'value2', 'timestamp' => 1625237000],
            ],
        ]);
});

it('can fetch the latest value for a key', function () {
    $response = $this->get('/api/v1/object/mykey');

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'key' => 'mykey',
                'value' => 'latest_value',
            ],
        ]);
});

it('can fetch the value for a key at a specific timestamp', function () {
    $timestamp = 1625236523;

    $response = $this->get('/api/v1/object/mykey?timestamp=' . $timestamp);

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'key' => 'mykey',
                'value' => 'value1',
                'timestamp' => $timestamp,
            ],
        ]);
});
