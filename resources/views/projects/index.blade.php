@extends("layouts.app")

@section('title', 'My projects')

@section('content')
    <div>
        <header class="flex justify-between items-center">
            <h2 class="text-grey-darker text-sm font-thin">
                My Projects
            </h2>
            <a class="button"
                href="{{ route('projects.create') }}">
                Create New Project
            </a>
        </header>
        @include('projects._list-items')
    </div>

@endsection