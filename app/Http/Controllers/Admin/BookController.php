<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Book\StoreRequest;
use App\Http\Requests\Admin\Book\UpdateRequest;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'books' => Book::with(['author', 'genres'])->get(),
        ];
        return view('admin.book.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'authors' => User::all(),
            'genres' => Genre::all(),
        ];
        return view('admin.book.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if (empty($data['genre_ids']))
            $genreIds = [];
        else {
            $genreIds = $data['genre_ids'];
            unset($data['genre_ids']);
        }
//        dd($data);
        $newBook = Book::create($data);
        if (!empty($genreIds))
            $newBook->genres()->attach($genreIds);
        return redirect()->route('admin.book.show', $newBook->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'book' => Book::with(['author', 'genres'])->where('id', $id)->first(),
        ];
        return view('admin.book.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'book' => Book::with(['author', 'genres'])->where('id', $id)->first(),
            'authors' => User::all(),
            'genres' => Genre::all(),

        ];

        return view('admin.book.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $book = Book::find($id);

        if (empty($data['genre_ids']))
            $genreIds = [];
        else {
            $genreIds = $data['genre_ids'];
            unset($data['genre_ids']);
        }

        $book->update($data);
        $book->genres()->sync($genreIds);

        return redirect()->route('admin.book.show', $book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('admin.book.index');
    }
}
