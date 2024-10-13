<?php

namespace Database\Seeders;

use App\Actions\ArrangePositions;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::query()->inRandomOrder()->limit(100)->get()
            ->each(function (Project $project) {
                Proposal::factory(random_int(4,45))->create(['project_id' => $project->id]);

                ArrangePositions::run($project->id);

            });
    }
}
