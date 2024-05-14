<h1>This is tasks index</h1>

@foreach($tasks as $task)
    <p>{{ $task->title }} - {{ $task->description }}</p>
@endforeach