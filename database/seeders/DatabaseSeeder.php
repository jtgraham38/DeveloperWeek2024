<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Entity;
use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test1@example.com',
                'password' => bcrypt('password')
            ]);
        } catch (UniqueConstraintViolationException $e) {
            Log::info("Test User already exists, skipping.");
        }

        try {
            User::factory()->create([
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'password' => bcrypt('password')
            ]);
        }
        catch (UniqueConstraintViolationException $e) {
            Log::info("Test User 2 already exists, skipping.");
        }

        Project::factory()->create([
            'name' => 'Test project',
            'description' => 'Default description',
            'user_id' => 1
        ]);

        Entity::factory()->create([
            'name' => 'Test entity',
            'description' => 'Default description',
            'table_name' => 'test_entity',
            'is_private' => false,
            'project_id' => 1
        ]);
    }
}
