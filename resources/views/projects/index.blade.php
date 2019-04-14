@extends("layouts.app")

@section('title', 'My projects')

@section('content')
    <div>
        @include('projects._header-index')
        @include('projects._list-items')
    </div>

@endsection