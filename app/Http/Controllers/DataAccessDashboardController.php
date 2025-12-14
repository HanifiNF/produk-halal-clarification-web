<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataAccessDashboardController extends Controller
{
    /**
     * Display the data access dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('data-access.dashboard');
    }
}