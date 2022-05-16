<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset = (($request->page ?? 1) - 1) * 10;
        $projects = Project::offset($offset)->paginate(10);

        return view('admin.project.index', compact('projects', 'offset'));
    }

    /**
     * Display a create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.project.create');
    }
}
