<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerDashboardController extends Controller
{
    public function openOwnerDashboard()
    {
        return view('owner/owner-dashboard');
    }
}
