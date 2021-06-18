<?php

namespace App\Http\Controllers;

class StatsController extends Controller
{
    /**
     * Render the welcome view with the current stats.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome');
    }
}
