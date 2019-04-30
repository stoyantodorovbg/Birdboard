<ul class="card text-xs list-reset p-3">
    @foreach($activities as $activity)
        <li class="m-2 text-grey-dark">
            <p>
                {{ $activity->action }}
            </p>
            <p class="m-1 pb-2 italic">
                {{ $activity->created_at->diffForHumans() }}
            </p>
        </li>
    @endforeach
</ul>