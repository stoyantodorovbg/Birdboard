<form method="POST" action="{{ route('tasks.store', $project->id) }}">
    @csrf
    <input class="w-full" type="text" name="body" placeholder="Add a task...">
</form>
