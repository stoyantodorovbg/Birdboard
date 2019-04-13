@extends("layouts.app")

@section('title', 'My projects')

@section('content')
    <div>
        <div class="items-center">
            <h1 class="mt-3">My Projects</h1>
            <a href="{{ route('projects.create') }}">
                <button type="button" class="btn btn-primary">Create New Project</button>
            </a>
        </div>
        @forelse($projects as $project)
            <a href="{{ $project->path }}">
                <h2>{{ $project->title }}</h2>
            </a>
        @empty
            <p>No projects yet</p>
        @endforelse
    </div>

@endsection