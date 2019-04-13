<div class="bg-white mr-3 p-4 rounded shadow w-1/3">
    <h3 class="font-normal text-xl py-3 mb-4">{{ $project->title }}</h3>
    <div class="text-grey-dark">
        {{ \Illuminate\Support\Str::limit($project->description, 70) }}
    </div>
</div>
