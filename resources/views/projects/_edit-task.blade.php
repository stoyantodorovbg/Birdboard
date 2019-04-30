<form method="POST"
      action="{{ $task->path }}">
    @method('PATCH')
    @csrf
    <div class="flex">
        <input class="w-full {{ $task->completed ? 'text-grey' : '' }}"
               name="body"
               value="{{ $task->body }}">
        <input type="checkbox"
               name="completed"
               value="1"
               {{ $task->completed ? 'checked' : '' }}
               onChange="this.form.submit()">
    </div>
</form>