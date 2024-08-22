<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class BusinessOwnerController extends Controller
{
    /**
     * Display the dashboard for business owners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.business');
    }

    // Add additional methods specific to business owners here
    // For example, methods to manage businesses, view reports, etc.
}
