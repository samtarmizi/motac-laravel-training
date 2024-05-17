@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Dashboard') }}
                    
                </div>

                <div class="card-body">
                    <p>Total Task in Tables: {{ $tasks->count() }}</p>
                    <p>Total Current User Tasks: {{ auth()->user()->tasks()->count() }}</p>

                    @foreach($users as $user)
                        <p>{{ $user->name }} : {{ $user->tasks()->count() }} tasks</p>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Index Tasks') }}
                    @can('create', App\Models\Task::class)
                    <span style="float:right;">
                        <a href="{{ route('tasks.create') }}" class="btn btn-light">+ Create Task</a>
                    </span>
                    @endcan
                    
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Task Title</th>
                                <th>Task Description</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $key => $task)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>
                                        @can('view', $task)
                                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-primary">View</a>
                                        @endcan
                                        @can('update', $task)
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-success">Edit</a>
                                        @endcan
                                        @can('delete', $task)
                                            <a onclick="return confirm('Are you sure to delete')" href="{{ route('tasks.destroy', $task) }}" class="btn btn-danger">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
