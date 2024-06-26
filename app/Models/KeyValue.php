<?php

namespace App\Models;

use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeyValue extends DynamoDbModel
{
    use HasFactory;

    /**
     * The composite key of the table in form of ['hash_key', 'range_key'].
     *
     * @var array
     */
    protected $compositeKey = ['key', 'timestamp'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['key', 'timestamp', 'value'];
}
