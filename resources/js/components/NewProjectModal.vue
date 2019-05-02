<template>
    <modal name="new-project"
           classes="p-10 bg-card rounded-lg"
           height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">
            Let's Start Something New
        </h1>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input type="text"
                               v-model="form.title"
                               name="title"
                               id="title"
                               :class="form.errors.title ? 'border-error' : ''"
                               class="border border-muted-light p-2 text-xs block w-full rounded">
                        <span v-if="form.errors.title"
                            v-text="form.errors.title[0]"
                            class="text-xs italic text-error"></span>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea name="description"
                                  v-model="form.description"
                                  id="description"
                                  rows="7"
                                  :class="form.errors.description ? 'border-error' : ''"
                                  class="border border-muted-light p-2 text-xs block w-full rounded"></textarea>
                        <span v-if="form.errors.description"
                              v-text="form.errors.description[0]"
                              class="text-xs italic text-error"></span>
                    </div>
                </div>
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Need Some Tasks?</label>
                        <input v-for="task in form.tasks"
                               v-model="task.body"
                               type="text"
                               class="border border-muted-light mb-2 p-2 text-xs block w-full rounded"
                               placeholder="Task 1">
                    </div>
                    <button class="text-xs button mt-8 mb-5"
                            @click="addTask"
                            type="button">
                        Add New Task Field
                    </button>
                </div>
            </div>
            <footer class="flex justify-end">
                <button
                    class="button mr-3 is-outlined"
                    @click="$modal.hide('new-project')"
                    type="button">
                    Cancel
                </button>
                <button type="submit"
                        class="button">
                    Create Project
                </button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import BirdboardForm from '../utilities/BirdboardForm';

    export default {
        data() {
            return {
                form: new BirdboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body: ''}
                    ]
                }),
            }
        },

        methods: {
            addTask() {
                this.form.tasks.push({ body: ''})
            },

            async submit() {
                if(! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }

                this.form.submit('/projects', 'post')
                    .then(response => {
                        location = response.data.path;
                    }).catch(error => {
                        console.log('Something went wrong.')
                    });
            }
        }
    }
</script>
