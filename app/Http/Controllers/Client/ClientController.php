<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
use App\Enums\DemographicsType;
use App\Services\ManageData\TerritoryService;
use App\Services\Statistics\DemographService;

class ClientController extends Controller
{
  public function __construct(protected DemographService $demographService, protected TerritoryService $territoriesService) {}

  public function index()
  {
    return view('index');
  }
  public function infrastructure()
  {
    return view('client.infrastructure');
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
