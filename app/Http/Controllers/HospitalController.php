<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HospitalApiService;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
    //
    public function __construct(
        protected HospitalApiService $apiService
    ) {}


    
}
