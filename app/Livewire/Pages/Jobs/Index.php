<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\JobPosting;

class Index extends Component
{
    public array $jobs = [];

    public function mount()
    {
        $this->jobs = JobPosting::with(['extras', 'skills'])->latest()->get()->toArray();
    }

    public function render()
    {
        return view('livewire.pages.jobs.index');
    }

    public function deleteJob($jobId)
    {
        $job = JobPosting::find($jobId);

        if ($job) {
            $job->delete();
            session()->flash('message', 'Job deleted successfully.');

        } else {
            session()->flash('error', 'Job not found.');
        }
        return redirect()->route('admin.jobs.index');
    }
}
