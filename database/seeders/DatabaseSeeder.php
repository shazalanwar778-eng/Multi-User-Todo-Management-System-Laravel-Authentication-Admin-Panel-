<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create regular users
        $john = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_active' => true,
        ]);

        $jane = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_active' => true,
        ]);

        // Assign existing todos to users (if any exist)
        $existingTodos = Todo::whereNull('user_id')->get();
        if ($existingTodos->count() > 0) {
            foreach ($existingTodos as $index => $todo) {
                $user = $index % 2 == 0 ? $john : $jane;
                $todo->update(['user_id' => $user->id]);
            }
        }

        // Create some sample todos for each user
        Todo::create([
            'user_id' => $john->id,
            'title' => 'Learn Laravel',
            'description' => 'Study Laravel framework basics',
        ]);

        Todo::create([
            'user_id' => $john->id,
            'title' => 'Build Todo App',
            'description' => 'Create a complete todo application',
        ]);

        Todo::create([
            'user_id' => $jane->id,
            'title' => 'Write Documentation',
            'description' => 'Document the project features',
        ]);

        Todo::create([
            'user_id' => $jane->id,
            'title' => 'Test Application',
            'description' => 'Test all functionality thoroughly',
        ]);
    }
}
