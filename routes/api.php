<?php

use App\Http\Controllers\V1\KeyValueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('get_all_records', [KeyValueController::class, 'index']);
Route::get('object/{key}', [KeyValueController::class, 'show']);
Route::post('object', [KeyValueController::class, 'store']);

Route::fallback(function () {
    return response()->json([
        'message' => 'Endpoint Not Found. If error persists, contact admin'], 404);
});
