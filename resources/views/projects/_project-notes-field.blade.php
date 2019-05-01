<form method="POST" action="{{ route('projects.update-notes', $project->id) }}">
    @csrf
    @method('PATCH')
    <textarea class="card ml-0 w-full min-h-200"
              name="notes">
                            {{ $project->notes }}
                        </textarea>
    @include('partials.validation-errors', ['bag' => 'project'])
    <button type="submit" class="button">Save</button>
</form>
