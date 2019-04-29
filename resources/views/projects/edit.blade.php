@extends("layouts.app")

@section('title', 'Create project')

@section('content')

    <div>
        <h1 class="text-2xl font-normal mb-10 text-center">
            Edit Project
        </h1>

        <form method="POST"
              action="{{ route('projects.update', $project) }}"
              class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
            @method('PATCH')
            @include('projects._form-fields')

            <button type="submit" class="button">Edit</button>
            <a href="{{ route('projects.index') }}">
                <button type="button" class="btn btn-light">Cancel</button>
            </a>
        </form>
    </div>

@endsection
