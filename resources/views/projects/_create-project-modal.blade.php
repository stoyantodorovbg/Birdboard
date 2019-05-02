<modal name="hello-world"
       classes="p-10 bg-card rounded-lg"
       height="auto">
    <h1 class="font-normal mb-16 text-center text-2xl">
        Let's Start Something New
    </h1>
    <div class="flex">
        <div class="flex-1 mr-4">
            <div class="mb-4">
                <label for="title" class="text-sm block mb-2">Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="border border-muted-light p-2 text-xs block w-full rounded">
            </div>
            <div class="mb-4">
                <label for="description" class="text-sm block mb-2">Description</label>
                <textarea name="description"
                          id="description"
                          rows="7"
                          class="border border-muted-light p-2 text-xs block w-full rounded"></textarea>
            </div>
        </div>
        <div class="flex-1 mr-4">
            <div class="mb-4">
                <label for="title" class="text-sm block mb-2">Need Some Tasks?</label>
                <input type="text"
                       name="title"
                       class="border border-muted-light p-2 text-xs block w-full rounded"
                       placeholder="Task 1">
            </div>
            <button type="button" class="text-xs button mt-8">Add New Task Field</button>
        </div>
    </div>
    <footer class="flex justify-end">
        <button class="button mr-3 is-outlined">Cancel</button>
        <button class="button">Create Project</button>
    </footer>
</modal>
<a href="" @click.prevent="$modal.show('hello-world')">modal</a>
