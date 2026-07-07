<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Summary\CitizenSummaryService;
use App\Services\Summary\HousingProfileSummaryService;
use App\Services\Summary\MsmeSummaryService;
use App\Services\Summary\TerritorySummaryService;

class HomeController extends Controller
{
    public function __construct(protected CitizenSummaryService $citizenSumaryService, protected TerritorySummaryService $territorySummaryService, protected HousingProfileSummaryService $housingProfileSummaryService, protected MsmeSummaryService $msmeSummaryService) {}

    public function index()
    {
        $stats = [
            ...$this->citizenSumaryService->getSummary(),
            ...$this->territorySummaryService->getSummary(),
            ...$this->housingProfileSummaryService->getSummary(),
            ...$this->msmeSummaryService->getSummary(),
        ];

        return view('dashboard.index', compact('stats'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
