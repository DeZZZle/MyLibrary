@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <div class="card-header">{{ $data['book']->title }}
                    </div>

                    <div class="card-body">
                        Автор: {{ $data['book']->author->firstname }} {{ $data['book']->author->lastname }} ({{ $data['book']->author->id }})<br>
                        Жанры:
                        @foreach($data['book']->genres as $genre)
                            <li>{{ $genre->title }}</li>
                        @endforeach<br>
                        <a href="{{ route('admin.book.edit', $data['book']->id) }}" class="btn btn-primary">Редактировать</a>
                        <form action="{{ route('admin.book.destroy', $data['book']->id) }}" method="POST">
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
