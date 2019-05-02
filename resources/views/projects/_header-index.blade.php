<header class="flex justify-between items-end">
    <h2 class="text-grey-darker text-sm font-thin">
        My Projects
    </h2>
    <a href=""
       @click.prevent="$modal.show('new-project')"
       class="button mr-3">
        Create New Project
    </a>
</header>
