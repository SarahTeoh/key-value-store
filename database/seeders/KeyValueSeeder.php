<?php

namespace Database\Seeders;

use BaoPham\DynamoDb\Facades\DynamoDb;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initialData = File::json(base_path('database/seeders/data/initial-data.json'));
        $tableName = config('dynamodb.table_name');
        $putRequests = [];

        foreach ($initialData as $item) {
            $query = DynamoDb::newQuery()
                ->setItem(DynamoDb::marshalItem($item))
                ->prepare()
                    ->query;
            $putRequests[] = ['PutRequest' => $query];
        }

        DynamoDb::newQuery()
            ->setRequestItems([$tableName => $putRequests])
            ->prepare()
            ->batchWriteItem();

    }
}
