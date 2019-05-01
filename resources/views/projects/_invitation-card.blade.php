<div class="card pb-0">
    <h3 class="font-normal text-xl py-3 -ml-4 border-l-4 border-blue-light pl-4 h-16">
        Invite an User
    </h3>
    <form action="{{ route('projects.invite', $project) }}" method="POST" class="h-32 text-right">
        @csrf
        <input type="email"
            name="email"
            class="border border-grey rounded p-2 mb-4 w-full"
            placeholder="Enter a valid User email">
        <button type="submit" class="text-xs button mt-8">Invite</button>
    </form>
    @include('partials.validation-errors', ['bag' => 'invitation'])
</div>
