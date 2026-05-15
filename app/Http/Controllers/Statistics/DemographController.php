<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemographController extends Controller
{
    public function index()
    {
        return view('dashboard.statistics.demographics.index');
    }
}
