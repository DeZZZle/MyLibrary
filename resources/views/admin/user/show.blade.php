@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">Пользователь</div>
                    <div class="card-body">
                        Имя: {{ $data['user']->firstname }}<br>
                        Фамилия: {{ $data['user']->lastname }}<br>
                        Книги этого автора:
                        @foreach($data['user']->books as $book)
                            <li>{{ $book->title }}</li>
                        @endforeach<br>
                        <a href="{{ route('admin.user.edit', $data['user']->id) }}" class="btn btn-primary">Редактировать</a>
                        <form action="{{ route('admin.user.destroy', $data['user']->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="Удалить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
