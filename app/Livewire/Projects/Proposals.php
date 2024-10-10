<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Proposal;
use Livewire\Component;

class Proposals extends Component
{
    public Project $project;
    public Proposal $proposal;

    public function render()
    {
        return view('livewire.projects.proposals');
    }
}
