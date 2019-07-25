@extends('admin.master')
@section('style')
  <link href="{{ asset('css/admin/usertable.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('messages.createproduct') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/stores') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="">{{ __('messages.name') }}</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="category" class=" col-form-label text-md-right">{{ __('messages.category') }}</label>

                            <div class="">
                                <input id="category" type="category" class="form-control @error('category') is-invalid @enderror" name="category" required autocomplete="category" autofocus>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price" class=" col-form-label text-md-right">{{ __('messages.price') }}</label>

                            <div class="">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price" autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price_sale" class=" col-form-label text-md-right">{{ __('messages.price_sale') }}</label>

                            <div class="">
                                <input id="price_sale" type="number" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" required autocomplete="price_sale" autofocus>

                                @error('price_sale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity" class=" col-form-label text-md-right">{{ __('messages.quantity') }}</label>

                            <div class="">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" required autocomplete="quantity" autofocus>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class=" col-form-label text-md-right">{{ __('messages.description') }}</label>

                            <div class="">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description" autofocus>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="preview-mode">
                            <ul id="image-preview" class="gallery-image-list">

                            </ul>
                        </div>


                        <div class="form-group">

                            <div class="custom d-flex">
                                <div class="input-file">
                                    <label for="postImage">{{ __('messages.image') }}</label>
                                    <input type="file" class="custom-file-input" id="postImage" lang="in" multiple="multiple" name='image[]'>
                                    <input type="hidden" name="list_image" value="" id="listImage">
                                </div>
                              <button type="button" class="btn-video">{{ __('Video') }}</button>

                            </div>

                        </div>

                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="store_id" value="{{ $store->id }}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')

<script src="{{ asset('js/admin/jquery-ui.min.js') }}"></script>
<script>

    Array.prototype.remove = function() {
      var what, a = arguments, L = a.length, ax;
      while (L && this.length) {
          what = a[--L];
          while ((ax = this.indexOf(what)) !== -1) {
              this.splice(ax, 1);
          }
      }
      return this;
    };
    $( '#postImage' ).change( function () {
    var val = $('#listImage').val();
    var arrayImage = [];
    var position = 0;
    if ( val !== '' ) {
      arrayImage = val.split(',');
       position = arrayImage.length;
       $.each(arrayImage, function(index, value) {
          $('.image-item').each(function(){
              if ( $(this).attr('data-item') == value ) {
                $(this).find('.image-position').attr('val', index + 1);
                $(this).find('.image-position').html(index + 1);
              }
          });
       })
    }

    var fileData = $(this).prop("files");
    var formData = new FormData();
      for (var x = 0; x < fileData.length; x++) {
          formData.append("image[]", fileData[x]);
      }
    formData.append('_token', '{{csrf_token()}}');
    $.ajax({
        url: "/media-store",
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,

        success: function (data) {

            $.each(data.data, function(index, value) {

                arrayImage.push(value.id);

                position = position + 1;

                $('#image-preview').append(
                    '<li data-item="' + value.id + '" class="image-item ui-sortable-handle">'
                        + '<div class="image-wrapper">'
                            + '<div class="preview-action">'
                                +'<span val="' + position + '" class="image-position">' + position
                                + '</span>'
                                + '<a href="#" class="action-delete-image fa fa-times" data-id="'+ value.id + '">'
                                + '</a>'
                                + '<span class="action-update-image  fa fa-undo"><input type="file" class="input-update" name="image" data-id="' + value.id + '">'
                                + '</span>'
                            + '</div>'
                            + '<div class="image">'
                                + '<img src={{ url("/")}}'+value.image_path+'>'
                            + '</div>'
                        + '</div>'
                    + '</li>'
                    );

            });

              $('#listImage').val(arrayImage);

            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });

    });

  // UI SORTABLE
    $('.gallery-image-list').sortable({
      cursor: "move",
       update: function(event, ui) {
          var result = $(this).sortable('toArray', {attribute: 'data-item'});
          $('#listImage').val(result);
          $.each(result, function(index, value){
              $('.image-item').each(function(){
                  if ( $(this).attr('data-item') == value ) {
                    $(this).find('.image-position').attr('val', index + 1);
                    $(this).find('.image-position').html(index + 1);
                  }
              });
          })
        }
    });

  // AJAX UPDATE IMAGE
    $(".gallery-image-list").on('change', '.input-update', function (e) {
        e.preventDefault();
        var $this = $(this);
        var fileData = $(this).prop("files");
        var formData = new FormData();
        formData.append("image", fileData[0]);
        formData.append('_token', '{{csrf_token()}}');
        formData.append('_method', 'PUT');
        formData.append('type','post');
        var $imgID = $(this).attr('data-id');
         $.ajax({
            url: "/media-store/" + $imgID,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
              var image = $this.parents( '.image-wrapper' ).find('img');
              image.attr('src', data.data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

    // AJAX DELETE IMAGE

    $(".gallery-image-list").on( 'click', '.action-delete-image', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var token = $("meta[name='csrf-token']").attr("content");
        var btn = $(this);
        var val = $('#listImage').val();
        var arrayImage = [];
        if ( val !== '' ) {
            arrayImage = val.split(',');
        }
        $.ajax(
        {
            url: "/media-store/"+id,
            type: 'POST',
            data: {
                "_method": 'delete',
                "_token": token,
                "id": id,
            },
            success: function ($data){

                btn.parents('.image-item').remove();
                arrayImage.remove(id);
                $('#listImage').val(arrayImage);

                $.each(arrayImage, function (index, value) {
                    $('.image-item').each(function(){
                        if ( $(this).attr('data-item') == value ) {
                            $(this).find('.image-position').attr('val', index + 1);
                            $(this).find('.image-position').html(index + 1);
                        }
                    });
                });
            }
        });
    });

    // AJAX DELETE IMAGE
    $( '.btn-video' ).on( 'click', function () {
        var video = prompt( 'Link Youtube: ' );
        var link = 'https://www.youtube.com/watch?v=';
        var start = link.length;
        var id = video.substr( start, 11 );
        var path = 'https://img.youtube.com/vi/' + id +'/sddefault.jpg';
        var formData = new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('image_path', path);
        formData.append('video_path', video);
          var val = $('#listImage').val();
          var arrayImage = [];
          var position = 1;
          if ( val !== '' ) {
            arrayImage = val.split(',');
            position = arrayImage.length + 1;

          }
         $.ajax({
            url: "/video-store",
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {

            console.log(data);
            arrayImage.push(data.id);
            $('#listImage').val(arrayImage);

                $('#image-preview').append(
                    '<li data-item="' + data.id + '" class="image-item ui-sortable-handle">'
                        + '<div class="image-wrapper">'
                            + '<div class="preview-action">'
                                +'<span val="' + position + '" class="image-position">' + position
                                + '</span>'
                                + '<a href="#" class="action-delete-image fa fa-times" data-id="'+ data.id + '">'
                                + '</a>'

                            + '</div>'
                            + '<div class="image image-video">'
                                + '<img src="{{ url("/")}}'+ data.image_path +'">'
                            + '</div>'
                        + '</div>'
                    + '</li>'
                    );
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    } );
</script>

@endsection
