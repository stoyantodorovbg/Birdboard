<div class="flex mt-5">
    @forelse($projects as $project)
        @include('projects._item')
    @empty
        <p>No projects yet</p>
    @endforelse
</div>