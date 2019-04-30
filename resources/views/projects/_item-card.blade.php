<div class="card">
    <h3 class="font-normal text-xl py-3 -ml-4 border-l-4 border-blue-light pl-4 h-32">
        <a class="text-black no-underline"
           href="{{ $project->path }}">
            {{ $project->title }}
        </a>
    </h3>
    <div class="text-grey-dark">
        {{ $description }}
    </div>
</div>