<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class Timer extends Component
{

    public Project $project;

    public function timer()
    {

    }
    public function render()
    {
        $timeRemainingForReceivingProposal = now()->diff($this->project->ends_at);

        return view('livewire.projects.timer',[
            'days' => $timeRemainingForReceivingProposal->d,
            'hours' => $timeRemainingForReceivingProposal->h,
            'minutes' => $timeRemainingForReceivingProposal->i,
            'seconds' => $timeRemainingForReceivingProposal->s,
        ]);
    }
}
