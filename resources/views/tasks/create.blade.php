@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks Create') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" 
                                    class="form-control" 
                                    rows="5"
                                    required
                            ></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Store my Form</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-info">Cancel</a>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
