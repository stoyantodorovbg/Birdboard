@extends("layouts.app")

@section('title', $project->title)

@section('content')

    @include('projects._header-project')

    <main>
        <div class="lg:flex mt-4">
            <div class="lg:w-3/4">
                <div class="mb-6">
                    <h2 class="text-grey text-lg font-normal mb-3">
                        Tasks
                    </h2>
                    @forelse($project->tasks as $task)
                        <div class="card ml-0 mb-2">{{ $task->body }}</div>
                    @empty
                        <div class="text-grey">No assigned tasks</div>
                    @endforelse
                    <div class="card ml-0 mb-2">
                        <form method="POST" action="{{ route('tasks.store', $project->id) }}">
                            @csrf
                            <input name="body" placeholder="Add a task...">
                        </form>
                    </div>
                </div>
                <div class="mb-8 mr-3">
                    <h2 class="text-grey text-lg font-normal mb-3">
                        General Notes
                    </h2>
                    <textarea class="card ml-0 w-full min-h-200">Lorem ipsum</textarea>
                </div>
            </div>
            @include('projects._item')
        </div>
        <a href="{{ route('projects.index') }}">
            <button type="button" class="btn btn-light">Go Back</button>
        </a>
    </main>

@endsection
