<main class="md:flex md:flex-wrap mt-2">
    @forelse($projects as $project)
        @include('projects._item')
    @empty
        <p>No projects yet</p>
    @endforelse
</main>