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
                        <div class="card ml-0 mb-2">
                            @include('projects._edit-task')
                        </div>
                    @empty
                        <div class="text-grey">No assigned tasks</div>
                    @endforelse
                    <div class="card ml-0 mb-2">
                        @include('projects._add-task')
                    </div>
                    @include('partials.validation-errors', ['bag' => 'task'])
                </div>
                <div class="mb-8 mr-3">
                    <h2 class="text-grey text-lg font-normal mb-3">
                        General Notes
                    </h2>
                    @include('projects._project-notes-field')
                </div>
            </div>
            <div class="md:w-1/2 lg:w-1/3">
                @include('projects._item-card', ['description' => $project->description])
                @can('manage', $project)
                    @include('projects._invitation-card')
                @endcan
                @include('activities._activity-card', ['activities' => $project->activities])
            </div>
        </div>
        <a href="{{ route('projects.index') }}">
            <button type="button" class="btn btn-light">Go Back</button>
        </a>
    </main>

@endsection
