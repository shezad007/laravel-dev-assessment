<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\Skill;
use App\Models\JobPosting;
use App\Models\JobExtra;
use App\Models\JobSkill;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra, $company_name, $logo, $skills = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'experience' => 'required|string',
        'salary' => 'required|string',
        'location' => 'required|string',
        'extra' => 'nullable|string',
        'company_name' => 'required|string|max:255',
        'logo' => 'nullable|image|max:1024',
        'skills' => 'required|array',
    ];

    public function submit()
    {
        $this->validate();

        $logoPath = $this->logo ? $this->logo->store('logos', 'public') : null;

        $extras = explode(',', $this->extra);

        $newJob = JobPosting::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'company_name' => $this->company_name,
            'company_logo' => $logoPath,
        ]);

        foreach ($extras as $extra) {
            JobExtra::create([
                'job_posting_id' => $newJob->id,
                'extra' => $extra,
            ]);
        }

        foreach ($this->skills as $skill) {
            JobSkill::create([
                'job_posting_id' => $newJob->id,
                'skill' => $skill,
            ]);
        }

        session()->flash('message', 'Job posting created successfully.');

        return redirect()->route('admin.jobs.index');
    }
    
    public function render()
    {
        return view('livewire.pages.jobs.create', [
            'default_skills' => Skill::all(),
        ]);
    }
}
