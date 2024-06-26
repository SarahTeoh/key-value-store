<?php

use App\Http\Resources\KeyValueResource;
use Illuminate\Http\Request;

it('transforms the resource into array', function () {
    $request = Request::create('/api/v1/mykey', 'GET');

    $resource = new KeyValueResource((object) [
        'key' => 'mykey',
        'value' => 'myvalue',
        'timestamp' => 1625236523,
    ]);

    $data = $resource->toArray($request);

    expect($data)->toBe([
        'key' => 'mykey',
        'value' => 'myvalue',
        'timestamp' => 1625236523,
    ]);
});

it('handles json string type value', function () {
    $request = Request::create('/api/v1/mykey', 'GET');

    $resource = new KeyValueResource((object) [
        'key' => 'jsonkey',
        'value' => json_encode(['field1' => 'value1', 'field2' => 'value2']),
        'timestamp' => 1625237500,
    ]);

    $data = $resource->toArray($request);

    expect($data)->toBe([
        'key' => 'jsonkey',
        'value' => '{"field1":"value1","field2":"value2"}',
        'timestamp' => 1625237500,
    ]);
});
