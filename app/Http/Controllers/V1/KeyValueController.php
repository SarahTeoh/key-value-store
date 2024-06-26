<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\KeyValueResource;
use App\Interfaces\KeyValueServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class KeyValueController extends Controller
{
    public function __construct(private KeyValueServiceInterface $keyValueService) {}

    /**
     * Display all values
     */
    public function index(): ResourceCollection
    {
        $data = $this->keyValueService->getAll();

        return KeyValueResource::collection($data);
    }

    /**
     * Accept a key and return the corresponding latest value.
     * When given a key AND a timestamp,return whatever the value of the key at the time was.
     */
    public function show(Request $request, string $key): KeyValueResource
    {
        $timestamp = $request->query('timestamp');
        $data = $this->keyValueService->getValue($key, $timestamp);

        return new KeyValueResource($data);
    }
}
