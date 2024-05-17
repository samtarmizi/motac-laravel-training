<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Mail\TaskCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        \info(auth()->user()->name.' click tasks index');

        // get tasks from authenticated user
        // $user = auth()->user();
        // $tasks = $user->tasks;

        $tasks = Task::all();

        $users = User::all();

        \info('User has ' . $tasks->count() . ' tasks');

        // return to view with $tasks
        // resources/views/tasks/index.blade.php + $tasks
        return view('tasks.index', compact('tasks', 'users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class);
        
        \info('User click tasks create');

        // show form tasks/create.blade.php
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        // store in database using Model Task
        // POPO - Plain Old PHP Object
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->save();

        // send email to user
        Mail::to($task->user->email)->send(new TaskCreatedMail($task));

        // return to index tasks
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        \info(auth()->user()->name.' click tasks show '. $task->id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        // resources/views/tasks/edit.blade.php + $task
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        // $user = auth()->user();
        // if($user->id != $task->user_id) {
        //     abort(403);
        // }

        $task->delete();

        return redirect()->route('tasks.index');
    }
}
