<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Statistics\DemographService;

class ClientController extends Controller
{
  public function __construct(protected DemographService $demographService) {}

  public function index()
  {
    return view('index');
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
