<div class="md:w-1/2 lg:w-1/3">
    <div class="bg-white p-4 m-3 rounded-lg shadow h-300">
        <h3 class="font-normal text-xl py-3 -ml-4 border-l-4 border-blue-light pl-4 h-32">
            <a class="text-black no-underline"
                href="{{ $project->path }}">
                {{ $project->title }}
            </a>
        </h3>
        <div class="text-grey-dark">
            {{ \Illuminate\Support\Str::limit($project->description, 70) }}
        </div>
    </div>
</div>
