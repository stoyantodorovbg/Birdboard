@extends("layouts.app")

@section('title', $project->title)

@section('content')

    <div>
        <h1>{{ $project->title }}</h1>
        <p>{{ $project->description }}</p>

        <a href="{{ route('projects.index') }}">
            <button type="button" class="btn btn-light">Go Back</button>
        </a>
    </div>

@endsection
