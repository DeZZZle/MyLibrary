@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">{{ $data['genre']->title }}
                    </div>

                    <div class="card-body">
                        Книги этого жанра:
                        @foreach($data['genre']->books as $book)
                            <li>{{ $book->title }}</li>
                        @endforeach<br>
                        <a href="{{ route('admin.genre.edit', $data['genre']->id) }}" class="btn btn-primary">Редактировать</a>
                        <form action="{{ route('admin.genre.destroy', $data['genre']->id) }}" method="POST">
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
