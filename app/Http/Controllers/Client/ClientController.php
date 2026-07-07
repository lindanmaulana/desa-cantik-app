<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\HomeService;
use App\Services\Summary\CitizenSummaryService;
use App\Services\Summary\HousingProfileSummaryService;
use App\Services\Summary\MsmeSummaryService;
use App\Services\Summary\TerritorySummaryService;

class ClientController extends Controller
{
    public function __construct(protected HomeService $homeService, protected CitizenSummaryService $citizenSumaryService, protected TerritorySummaryService $territorySummaryService, protected HousingProfileSummaryService $housingProfileSummaryService, protected MsmeSummaryService $msmeSummaryService) {}

    public function index()
    {
        $stats = [
            ...$this->citizenSumaryService->getSummary(),
            ...$this->territorySummaryService->getSummary(),
            ...$this->housingProfileSummaryService->getSummary(),
            ...$this->msmeSummaryService->getSummary(),
        ];

        return view('index', compact('stats'));
    }
    public function spacialData()
    {
        return view('client.spacial-data');
    }
    public function analisis()
    {
        return view('client.analisis');
    }
}
