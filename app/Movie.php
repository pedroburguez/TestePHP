<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    public $table = 'movies';
    public $fillable = [
      'id', 'title',
      'poster_path', 'overview',
      'movie_db_id'
    ];
    public $searchable = [
      'id', 'title',
      'poster_path', 'overview',
      'movie_db_id'
    ];
    public $timestamps = false;


    public function favoriteMovie() {
      return $this->hasMany('App\FavoriteMovie');
    }
}
