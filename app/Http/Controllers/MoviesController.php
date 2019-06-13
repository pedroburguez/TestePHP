<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FavoriteMovie;
use GuzzleHttp\Client;
use App\Movie;
use Auth;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
      $i = 1;
      $data = [];

      while ($i <= 2) {
        $client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/movie/now_playing',
        ]);
        $response = $client->request('GET', '?api_key=2452fdd1070fd0eae52ad1b5c50398df&page=' . $i);
        $body = $response->getBody();
        $movies = json_decode($body->getContents());

        foreach ($movies->results as $movie) {
          $users = DB::table('movies')->select('*')->where('movie_db_id', $movie->id)->get();
          if (!$users->count() > 0) {
            $model = new Movie();
            $data = [
              'title' => $movie->title,
              'poster_path' => $movie->poster_path,
              'overview'  => $movie->overview,
              'movie_db_id' => $movie->id
            ];
            $model->fill($data);
            $model->save();
          }
        }
        $i++;
      }

      $allMovies = Movie::all();
      $userId = Auth::id();
      $favorite = new FavoriteMovie();
      return view('home', compact('allMovies', 'userId', 'favorite'));
    }

    public function showFavoriteMovies() {
      $favoriteMovies = DB::table('favorite_movies')
                    ->join('movies', 'favorite_movies.movie_id', 'movies.id')
                    ->select('movies.id', 'movies.poster_path', 'movies.title', 'movies.overview')
                    ->get();
      $userId = Auth::id();

      return view('favorite-movies', compact('favoriteMovies', 'userId'));
    }

    public function addFavorite(Request $request) {
      $data = $request->all();
      $favorite = new FavoriteMovie();
      $success = false;
      $msg = 'Ocorreu algum erro!';

      $favorite->fill(array(
        'user_id' => $data['user_id'],
        'movie_id' => $data['movie_id']
      ));

      if ($favorite->save()) {
        $success = true;
        $msg = 'Filme adicionado aos favoritos!';
      }

      return response()->json(['success' => $success, 'msg' => $msg]);
    }

    public function deleteFavoriteAjax(Request $request) {
      $data = $request->all();
      $delete = FavoriteMovie::where('movie_id', $data['movie_id'])->where('user_id', $data['user_id'])->delete();
      $success = false;
      $msg = 'Ocorreu algum erro!';

      if ($delete) {
        $success = true;
        $msg = 'Filme removido';
      }
      return response()->json(['success' => $success, 'msg' => $msg]);
    }
}
