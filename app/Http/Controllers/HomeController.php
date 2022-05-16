<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show content
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        User::factory()->make()->save();
        dd('a');
        // $projects = Project::limit(3)->get();

        // return view('user.home', compact('projects'));
    }
}
