<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function list() {
        return BookResource::collection(Book::with('author')->get());
    }

    public function show($id) {
        $book = Book::with(['author', 'genres'])->where('id', $id)->first();
        if ($book == null)
            return response()->json(['message' => 'Книга с таким id не найдена'], 400);
        return BookResource::make($book);
    }

    public function update(Request $request, $id) {
        $book = Book::find($id);

        $data = $request->validate([
            'title' => 'min:3|max:250'
        ]);

        if (!empty($data))
            $book->update($data);

        return BookResource::make($book);
    }

    public function destroy($id) {
        $book = Book::find($id);

        $book->delete();

        return response()->json(['message' => 'Книга была удалена'],200);
    }
}
