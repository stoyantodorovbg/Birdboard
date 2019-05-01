@if($errors->{ $bag ?? 'default' }->any())
    <ul class="field mb-6 list-reset">
        @foreach($errors->{ $bag ?? 'default' }->all() as $error)
            <li class="text-red">{{ $error }}</li>
        @endforeach
    </ul>
@endif
