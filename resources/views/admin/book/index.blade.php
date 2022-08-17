@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($data['books'] as $book)
                    <div class="card mb-2">
                        <div class="card-header"><a
                                href="{{ route('admin.book.show', $book->id) }}">{{ $book->title }}</a></div>

                        <div class="card-body">
                            Автор: {{ $book->author->firstname }} {{ $book->author->lastname }}<br>
                            Жанр:
                            @foreach($book->genres as $genre)
                                <a href="{{ route('admin.genre.show', $genre->id) }}">{{ $genre->title }}</a>
                            @endforeach
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.book.create') }}">Добавить новую книгу</a>
        </div>
    </div>
@endsection
