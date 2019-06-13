<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteMovie extends Model {
    public $table = 'favorite_movies';
    public $fillable = ['user_id', 'movie_id'];
    public $searchable = ['user_id', 'movie_id'];
    public $timestamps = false;

    public function movieExists($id) {
      $movieId = $this->select('movie_id')->where('movie_id', $id)->first();
      return $movieId;
    }
}
