<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jenssegers\Mongodb\Connection;
use Illuminate\Support\Facades\Config;

class TestMongoDBConnection extends Command
{
    protected $signature = 'mongodb:test';

    protected $description = 'Test MongoDB Connection';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Connection $connection)
    {
        $this->line('hello');
        // $config = Config::get('database.connections.mongodb'); // Get the MongoDB connection configuration
        // $connection = new Connection($config);
        // try {
        //     $collections = $connection->listCollections();
        //     $this->info('MongoDB connection is successful. Collections found:');
        //     foreach ($collections as $collection) {
        //         $this->line($collection->getName());
        //     }
        // } catch (\Exception $e) {
        //     $this->error('MongoDB connection failed: ' . $e->getMessage());
        // }
    }
}
