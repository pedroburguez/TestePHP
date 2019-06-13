$(document).ready(function(){

  $('.add-favorite').on('click', function(e){
    e.preventDefault();
    var movie_id = $(this).attr('data-movie'),
        user_id = $(this).attr('data-user'),
        token = $('._token').val(),
        button = $(this);

    $.ajax({
      url: '/add-favorite',
      type: 'post',
      data: {
        movie_id: movie_id,
        user_id: user_id,
        _token: token
      },
      dataType: 'JSON',
      success: function(data){
        $('[name="add-favorite['+movie_id+']"]').addClass('d-none');
        $('[name="remove-favorite['+movie_id+']"]').removeClass('d-none');
      },
    });
  });

  $('.remove-favorite').on('click', function(e){
    e.preventDefault();
    var movie_id = $(this).attr('data-movie'),
        user_id = $(this).attr('data-user'),
        token = $('._token').val(),
        button = $(this),
        favorite_page = $('[name="favorite-movies"]').val();

    $.ajax({
      url: '/delete-favorite-ajax',
      type: 'delete',
      data: {
        movie_id: movie_id,
        user_id: user_id,
        _token: token
      },
      dataType: 'JSON',
      success: function(data){
        if (favorite_page) {
          location.reload();
        }else {
          $('[name="remove-favorite['+movie_id+']"]').addClass('d-none');
          $('[name="add-favorite['+movie_id+']"]').removeClass('d-none');
        }
      },
    });
  });
});
