<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Entity;
use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
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
                'email' => 'test1@example.com',
                'password' => bcrypt('password'),
                'first_name' => 'Test',
                'last_name' => 'User',
                'billing_address' => '',
                'phone_number' => '1234567890',
                'role' => 0,
                'street_address' => '',
                'apt' => '',
                'city' => '',
                'state' => '',
                'zip_code' => ''
            ]);
        } catch (UniqueConstraintViolationException $e) {
            $this->command->info("Test User already exists, skipping.");
        }

        try {
            User::factory()->create([
                'email' => 'test2@example.com',
                'password' => bcrypt('password'),
                'first_name' => 'Test',
                'last_name' => 'User 2',
                'billing_address' => '',
                'phone_number' => '0987654321',
                'role' => 0,
                'street_address' => '',
                'apt' => '',
                'city' => '',
                'state' => '',
                'zip_code' => ''
            ]);
        }
        catch (UniqueConstraintViolationException $e) {
            $this->command->info("Test User 2 already exists, skipping.");
        }

        if (count(DB::table('projects')->where('name', '=', 'Test project')->where('user_id', '=', 1)->get()) != 0) {
            $this->command->info("Test project already exists, skipping.");
        } else {
            Project::factory()->create([
                'name' => 'Test project',
                'description' => 'Default description',
                'user_id' => 1
            ]);
        }

        if (count(DB::table('entities')->where('name', '=', 'Test entity')->where('project_id', '=', 1)->get()) != 0) {
            $this->command->info("Test entity already exists, skipping.");
        } else {
            Entity::factory()->create([
                'name' => 'Test entity',
                'description' => 'Default description',
                'table_name' => 'test_entity',
                'singular_name' => 'test entity',
                'is_private' => false,
                'project_id' => 1
            ]);
        }
    }
}
