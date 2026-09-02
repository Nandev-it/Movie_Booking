<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    public function index(Request $request)
    {
        $genre = $request->query('genre');

        $movies = Movie::when($genre, function ($query, $genre) {
            return $query->where('genre', $genre);
        })->paginate(12);

        $genres = Movie::distinct()->pluck('genre')->filter();

        return view('welcome', compact('movies', 'genres', 'genre'));
    }
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    public function lists()
    {
        $movies = Movie::all();

        return response()->json($movies);
    }


public function search(Request $request)
{
    $query = $request->input('q');

    $movies = Movie::where('title', 'LIKE', "%{$query}%")
        ->limit(10)
        ->get();

    return response()->json($movies);
}

    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'genre'        => ['nullable', 'string', 'max:255'],
            'duration'     => ['nullable', 'integer', 'min:1'],
            'release_date' => ['nullable', 'date'],
            'poster'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('poster')) {
            if ($movie->poster && !str_starts_with($movie->poster, 'http')) {
                Storage::disk('public')->delete($movie->poster);
            }

            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($data);

        return back()->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        if ($movie->poster && !str_starts_with($movie->poster, 'http')) {
            Storage::disk('public')->delete($movie->poster);
        }

        $movie->delete();

        return back()->with('success', 'Movie deleted successfully.');
    }
}
