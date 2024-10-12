<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Proposal;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Proposals extends Component
{
    public Project $project;
    public Proposal $proposal;
    public int $proposalQuantity = 5;

    #[Computed]
    public function proposals()
    {
        return $this->project->proposals()
            ->orderBy('hours')
            ->paginate($this->proposalQuantity);
    }

    #[Computed]
    public function mostRecentProposal()
    {
        return $this->project->proposals()->latest()->first();
    }

    public function loadMore()
    {
        $this->proposalQuantity += 5;
    }

    #[On('proposal-created')]
    public function render()
    {
        return view('livewire.projects.proposals');
    }
}
