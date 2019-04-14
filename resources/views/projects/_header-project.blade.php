<header class="flex justify-between items-end">
    <p class="text-grey-darker text-sm font-thin">
        <a class="text-grey-darker text-sm font-thin no-underline"
           href="{{ route('projects.index') }}">
            My Projects
        </a> / {{ $project->title }}
    </p>
    <a class="button mr-3"
       href="{{ route('projects.create') }}">
        Create New Project
    </a>
</header>
