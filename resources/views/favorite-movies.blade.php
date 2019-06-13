@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1>Aqui estão seus filmes favoritos!</h1>
      </div>
    </div>
    <div class="row">
      <input type="hidden" name="favorite-movies" value="1">
      <input type="hidden" name="token" class="_token"value="{{csrf_token() }}">
      @foreach ($favoriteMovies as $movie)
      <div id="form-movie[{{$movie->id}}]" class="col-md-4 mt-4 form-movie">
        <div class="row">
          <div class="col-12 text-center mt-3">
            <img class="rounded mx-auto d-block" src="http://image.tmdb.org/t/p/w185/{{$movie->poster_path}}" alt="">
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <h3>{{$movie->title}}</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <p>{{$movie->overview}}</p>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <button type="submit" name="remove-favorite[{{$movie->id}}]" data-movie="{{$movie->id}}" data-user="{{$userId}}" class="align-self-center btn btn-danger remove-favorite">Remover</button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection
