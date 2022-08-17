@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($data['users'] as $user)
                    <div class="card mb-2">
                        <div class="card-header"><a href="{{ route('admin.user.show', $user->id) }}">{{ $user->firstname }} {{ $user->lastname }}</a> (всего книг: {{ $user->books()->count() }})</div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.user.create') }}">Добавить нового пользователя</a>
        </div>
    </div>
@endsection
