<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Books;

class BookController extends Controller
{

    public function index()
    {
        $books = Books::all();
        return response()->json($books, 200);
    }




    public function store(Request $request)
    {
        $book = new Books();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->publish_date = $request->publish_date;
        $book->save();

        return response()->json([
            'message' => 'Livro criado com sucesso',
        ], 201);
    }


    public function show(string $id)
    {
        $book = Books::find($id);
        if (!empty($book)) {
            return response()->json($book, 200);
        } else {
            return response()->json([
                'message' => 'Livro não encontrado',
            ], 404);
        }
    }


    public function update(Request $request, string $id)
    {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->name = is_null($request->name) ? $book->name : $request->name;
            $book->author = is_null($request->author) ? $book->author : $request->author;
            $book->publish_date = is_null($request->publish_date) ? $book->publish_date : $request->publish_date;
            $book->save();
            return response()->json([
                'message' => 'Livro atualizado com sucesso'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Livro não encontrado'
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        if (Books::where('id', $id)->exists()) {
            $book = Books::find($id);
            $book->delete();
            return response()->json([
                'message' => 'Livro excluido com sucesso'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Livro não encontrado'
            ], 404);
        }
    }
}
