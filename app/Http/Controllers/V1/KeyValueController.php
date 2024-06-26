<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\KeyValueResource;
use App\Interfaces\KeyValueServiceInterface;
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
}
