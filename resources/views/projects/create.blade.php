@extends("layouts.app")

@section('title', 'Create project')

@section('content')

    <div>
        <h1>Create a Project</h1>

        <form method="POST" action="{{ route('projects.store') }}">
            @include('projects._form-fields')

            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('projects.index') }}">
                <button type="button" class="btn btn-light">Cancel</button>
            </a>
        </form>
    </div>

@endsection
