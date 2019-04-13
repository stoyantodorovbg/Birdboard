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
        @include('projects._list-items')
    </div>

@endsection