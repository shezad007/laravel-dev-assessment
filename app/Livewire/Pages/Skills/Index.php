<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public $skill_name;

    public function render()
    {
        return view('livewire.pages.skills.index', [
            'skills' => Skill::all(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'skill_name' => 'required|string|max:255',
        ]);

        Skill::create(['name' => $this->skill_name]);

        $this->skill_name = '';

        session()->flash('success', 'Skill added successfully!');
    }
}
