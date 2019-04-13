@extends("layouts.app")

@section('content')

    <div class="container">
        <h1>Create a Project</h1>

        <form method="POST" action="{{ route('projects.store') }}">
            @include('projects._form-fields')

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection
