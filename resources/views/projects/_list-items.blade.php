<main class="md:flex md:flex-wrap mt-2">
    @forelse($projects as $project)
        @include('projects._item', ['description' => \Illuminate\Support\Str::limit($project->description, 70)])
    @empty
        <p>No projects yet</p>
    @endforelse
</main>