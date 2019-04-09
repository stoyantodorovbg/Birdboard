@extends("layouts.app")

@section('content')

    @forelse($projects as $project)
        <a href="{{ $project->path }}">
            <h2>{{ $project->title }}</h2>
        </a>
    @empty
        <p>No projects yet</p>
    @endforelse

@endsection