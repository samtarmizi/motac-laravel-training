@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks Show') }}</div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input value="{{ $task->title }}" type="text" name="title" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" 
                                class="form-control" 
                                rows="5"
                                readonly
                        >{{ $task->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Index Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
