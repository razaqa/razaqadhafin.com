@extends('layouts.base')

@section('title', $post->title)

@section('extra-fonts')

@endsection

@section('prerender-js')
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  <script>
    function changeMetaContent(metaName, newMetaContent) {
      $("meta").each(function() {

        if($(this).attr("name") == metaName) {
          $(this).attr("content" , newMetaContent);
        };
      });
    }
    changeMetaContent("twitter:title", "{{$post->title}}");
    changeMetaContent("twitter:description", `{!! \Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 150, $end = '...') !!}`);
    changeMetaContent("twitter:image", "{{ asset($post->pict) }}");
  </script>
@endsection

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('css/article.css') }}" />
@endsection

@section('content')
  <div class="modal-wrapper">
    <div class="modal-blog">
      <button class="modal__close-button" type="button">
        <svg class="icon icon-cross">
          <use xlink:href="#icon-cross"></use>
        </svg>
      </button>
      <div class="modal__scroll-area">
        <header class="modal__header">
          <div class="card__background">
            <img src="{{ asset($post->pict) }}" />
          </div>
          <div class="card__category">
            {{$post->tags->implode('name', ' | ')}}
          </div>
          <h1 class="card__title">{{$post->title}}</h1>
          <div class="card__duration">
            {{$post->created_at->formatLocalized('%A, %d %B %Y')}}
          </div>
        </header>
        <main class="modal__content">
          <div class="paragraph">
            {!! $post->body !!}
          </div>
          <br>

          @if ($post->tags->where('for_work', false)->count() > 0)
          <div class="content-footer">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <ul class="list-unstyled list-inline social text-center">
                  <li class="list-inline-item">
                    <form id="like-form" action="{{ route('like', ['post' => $post->id]) }}" method="POST">
                      @csrf
                      <button><i id="likes-count" class="fa fa-heart badge-fa"></i></button>
                    </form>
                  </li>
                  <li class="list-inline-item">
                    <a id="fb-route" href="https://www.facebook.com/sharer/sharer.php?u={{urlencode($url)}}&picture={{urlencode(asset($post->pict))}}&title={{urlencode($post->title)}}&quote={!! urlencode(\Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 150, $end = '...')) !!}&description={!! urlencode(\Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 150, $end = '...')) !!}" target="_blank"> <i class="fa fa-facebook"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <a id="twitter-route" href="https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fdeveloper.twitter.com%2Fen%2Fdocs%2Ftwitter-for-websites%2Ftweet-button%2Foverview&ref_src=twsrc%5Etfw&related=twitterapi%2Ctwitter&tw_p=tweetbutton&text={{urlencode($post->title)}}&url={{urlencode($url)}}" target="_blank"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li class="list-inline-item">
                    <i id="comments-count" class="fa fa-comment badge-fa"></i>
                  </li>
                </ul>
              </div>
            </div>
            <hr>
            <div class="row comment-field">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="route('comment', ['post' => $post->id])" method="POST">
                  @csrf
                  <div class="comment-post-title text-center">
                    wanna share your thought? please let me know!
                  </div>
                  <div class="row">
                    <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10 col-xl-11">
                      <textarea rows="1" type="text" name="body" required="true"></textarea>
                      <label>Comment</label>
                    </div>
                    <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                      <button type="submit" class="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="comment-post-title text-center">
              comments
            </div>
            <hr>
            <div class="comments-list">
              @if ($post->comments->count() == 0)
                <i>there are no comments so far...</i>
                <hr>
              @else
                <p>
                @foreach ($post->comments as $comment)
                  {{ $comment->body }}
                  </p>
                  <hr>
                  <p>
                @endforeach
                <p>
              @endif
            </div>
          </div>
          @endif
          
        </main>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script>
    $(".content-footer #likes-count").attr('likes-number', "{{ $post->likes->count() }}");
    $(".content-footer #comments-count").attr('comments-number', "{{ $post->comments->count() }}");
  </script>
@endsection
