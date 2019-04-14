<main class="md:flex md:flex-wrap -mx-2 mt-2">
    @forelse($projects as $project)
        @include('projects._item')
    @empty
        <p>No projects yet</p>
    @endforelse
</main>