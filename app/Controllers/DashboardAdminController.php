<?php

namespace App\Controllers;

class DashboardAdminController extends BaseController
{
    public function index()
    {
        return view('pages/dashboard');
    }
}