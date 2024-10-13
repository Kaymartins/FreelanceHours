<?php

namespace App\Livewire\Proposals;


use App\Actions\ArrangePositions;
use App\Models\Project;
use App\Models\Proposal;
use App\Notifications\newProposal;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
class Create extends Component
{
    public Project $project;

    public bool $modal = false;

    #[Validate(['required', 'email'])]
    public string $email = '';
    #[Validate(['required', 'numeric', 'min:1'], as: 'Horas')]
    public int $hours = 0;
    public bool $checkboxAgreement = false;

    public function save()
    {
        $this->validate();

        if(!$this->checkboxAgreement){
            $this->addError('checkboxAgreement', "Você precisa concordar com os termos de uso");
            return;
        }

        //verifica se email existe, se existir atualiza o registro, se nao cria novo
        DB::transaction(function () {
            $proposal = $this->project->proposals()
                ->updateOrCreate(['email' => $this->email],[
                    'hours' => $this->hours],
                );

            $this->arrangePositions($proposal);
        });

        $this->project->author->notify(new newProposal($this->project));

         $this->dispatch('proposal-created');
         $this->modal = false;
    }

    public function arrangePositions(Proposal $proposal)
    {
        $query = DB::select("
            SELECT *, row_number() over (order by hours asc) as newPosition
            from proposals
            where project_id = :project
            ", ['project' => $this->project->id]);

        $position = collect($query)->where('id', '=', $proposal->id)->first();
        $otherProposalInNewPosition = collect($query)->where('position', '=', $position->newPosition)->first();

        if($otherProposalInNewPosition){
            $proposal->update(['position_status' => 'up']);
            Proposal::query()->where('id', $otherProposalInNewPosition->id)->update(['position_status' => 'down']);

            ArrangePositions::run($proposal->project->id);
        }
    }

    public function render()
    {
        return view('livewire.proposals.create');
    }
}
