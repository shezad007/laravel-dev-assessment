<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use DB;

class DashboardController extends Controller
{
    const ELEMENTS_PER_PAGE = Controller::DEFAULT_ELEMENTS_PER_PAGE;

    public function getJobs($count = self::ELEMENTS_PER_PAGE){
        $pageNumber = request()->get('page') ? request()->get('page') : 1;
        $data = JobPosting::select(DB::raw('job_postings.*'))
            ->with(['extras', 'skills'])
            ->paginate($count, ['*'], 'page', $pageNumber);
        return $this->sendResponse($data, 'Inventory Added Successfully!');
    }
}
