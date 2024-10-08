<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->inRandomOrder()->limit(10)->get()
           ->each(fn (User $user) => Project::factory()->create(['created_by' => $user->id]));
    }
}
