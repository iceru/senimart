<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Projects::all();
        return view('projects', compact('projects'));
    }

    public function show($project) {
        $project = Projects::where('id', $project)->get();

        return view('projectdetail',compact('project'));
    }
}
