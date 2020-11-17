<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $project_id)
    {
        // returning all project records from the database
        return Task::where('project_id', $project_id)
            ->orderBy('created_at', 'desc')->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $task = new Task;

        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->projectId;

        $task->save();

        // returning all project records from the database including the recently created
        return $this->index($request->projectId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();

        return $this->index($task->project_id);
    }

    /**
     * Show the form for toggling isCompleted flag in database of the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function isCompleted($id)
    {
        //
        $task = Task::findOrFail($id);
        $task->isCompleted = 1 - $task->isCompleted;
        $task->save();

        return $this->index($task->project_id);
    }
}
