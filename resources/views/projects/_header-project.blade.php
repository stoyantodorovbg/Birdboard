<header class="flex justify-between items-end">
    <p class="text-grey-darker text-sm font-thin">
        <a class="text-grey-darker text-sm font-thin no-underline"
           href="{{ route('projects.index') }}">
            My Projects
        </a> / {{ $project->title }}
    </p>
    <div class="flex items-center">
        @foreach($project->members as $member)
            <img src="{{ $member->gravatar_img_src }}"
                 alt="{{ $member->name }}'s avatar"
                 class="rounded-full w-8 mr-2">
        @endforeach
        <img src="{{ $project->owner->gravatar_img_src }}"
             alt="{{ $project->owner->name }}'s avatar"
             class="rounded-full w-8 mr-2">
        <a class="button mr-3 ml-4"
            href="{{ route('projects.edit', $project) }}">
            Edit Project
        </a>
    </div>
</header>
