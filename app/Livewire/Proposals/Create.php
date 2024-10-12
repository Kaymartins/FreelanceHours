<?php

namespace App\Livewire\Proposals;

use App\Models\Project;
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
         $this->project->proposals()
            ->updateOrCreate(['email' => $this->email],[
                'hours' => $this->hours],
            );
    }

    public function render()
    {
        return view('livewire.proposals.create');
    }
}
