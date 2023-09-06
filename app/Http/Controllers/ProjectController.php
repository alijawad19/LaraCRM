<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(20);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get(['id', 'name']);
        $status = Project::STATUS;
        return view('projects.create', compact('users', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => 'required|string|max:255',
            "assigned_to" => 'required|numeric',
            "description" => 'required',
            "deadline" => 'required',
            "status" => 'required',
            'remarks' => 'required',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $status = Project::STATUS;

        return view('projects.edit', compact('project', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            "title" => 'required|string|max:255',
            "assigned_to" => 'required|numeric',
            "description" => 'required',
            "deadline" => 'required',
            "status" => 'required',
            'remarks' => 'required',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted');
    }
}
