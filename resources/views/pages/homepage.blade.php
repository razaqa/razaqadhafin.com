@extends('layouts.base')

@section('title', 'Welcome')

@section('extra-fonts')
@endsection

@section('prerender-js')
  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  <script type="text/javascript">
    function getBlogData(index) {
      @foreach( $posts as $key=>$post )
        if( {{$key}} == index ) {
          changeMetaContent("twitter:title", "{{$post->title}}");
          changeMetaContent("twitter:description", `{!! \Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 150, $end = '...') !!}`);
          changeMetaContent("twitter:image", "{{ asset($post->pict) }}");
          bodyPost = `{!! $post->body !!}`;
          title = "<a href='/article/{{$post->id}}'>{{$post->title}}</a>";
          pict = "{{asset($post->pict)}}";
          category = "{{$post->tags->implode('name', ' | ')}}";
          date = "{{$post->created_at->formatLocalized('%A, %d %B %Y')}}";
          likesCount = "{{$post->likes->count()}}";
          commentsCount = "{{$post->comments->count()}}";
          comments = `{!! $post->comments->implode('body', '</p><hr><p>') !!}`;
          commentRoute = "{{ route('comment', ['post' => $post->id]) }}";
          likeRoute = "{{ route('like', ['post' => $post->id]) }}";
          fbRoute = "https://www.facebook.com/sharer/sharer.php?u={{urlencode($url)}}&picture={{urlencode(asset($post->pict))}}&title={{urlencode($post->title)}}&quote={!! urlencode(\Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 150, $end = '...')) !!}&description={!! urlencode(\Illuminate\Support\Str::limit(strip_tags($post->body), $limit = 150, $end = '...')) !!}";
          twitterRoute = "https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fdeveloper.twitter.com%2Fen%2Fdocs%2Ftwitter-for-websites%2Ftweet-button%2Foverview&ref_src=twsrc%5Etfw&related=twitterapi%2Ctwitter&tw_p=tweetbutton&text={{urlencode($post->title)}}&url={{urlencode($url)}}"
        }
      @endforeach
      return {
        bodyPost: bodyPost,
        title: title,
        pict: pict,
        date: date,
        category: category,
        likesCount: likesCount,
        commentsCount: commentsCount,
        comments: comments,
        commentRoute: commentRoute,
        likeRoute: likeRoute,
        fbRoute: fbRoute,
        twitterRoute: twitterRoute
      };
    }
  </script>

<script type="text/javascript">
    function getWorkData(index) {
      @foreach( $work_posts->posts->sortByDesc('created_at') as $key=>$work_post )
        if( {{$key}} == index ) {
          bodyPost = `{{$work_post->body}}`;
          title = "<a href='/article/{{$post->id}}'>{{$work_post->title}}</a>";
          pict = "{{asset($work_post->pict)}}";
          category = "{{$work_post->tags->implode('name', ' | ')}}";
          date = "{{$work_post->created_at->formatLocalized('%B %Y')}}";
        }
      @endforeach
      return {
        bodyPost: bodyPost,
        title: title,
        pict: pict,
        date: date,
        category: category
      };
    }
  </script>
@endsection

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/headline.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/blog_section.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/work_section.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/contact_section.css') }}" />
@endsection

@section('content')
  <div class="loader"></div>
  <div id="content">

    <section class="section-to-scroll headline" id="headline">
      <div class="c-glitch" style="background-image: url({{ asset('/img/headlineB&W.png') }});">
        <p class="text-center headline-text" id="headline-text1">I'm a software engineer.</p>
        <p class="text-center headline-text" id="headline-text2">Hi! I'm Dhafin.</p>
        <div class="c-glitch__img" style="background-image: url({{ asset('/img/headlineB&W.png') }});"></div>
        <div class="c-glitch__img" style="background-image: url({{ asset('/img/headline.png') }}); filter: brightness(65%);"></div>
        <div class="c-glitch__img" style="background-image: url({{ asset('/img/headline.png') }}); filter: brightness(65%);"></div>
        <div class="c-glitch__img" style="background-image: url({{ asset('/img/headlineB&W.png') }});"></div>
        <div class="c-glitch__img" style="background-image: url({{ asset('/img/headlineB&W.png') }});"></div>
      </div>
      <div class="c-intro">
        <p class="c-fe30">
          I'm a passionate software engineer. Slide down to know all my stories, thoughts, and works . . .
        </p>
      </div>
      <div class="arrow text-center">
        <a href="#blog" class="scroll-down-btn">
          <span class="text-center"></span>
          <span class="text-center"></span>
          <span class="text-center"></span>
        </a>
      </div>
    </section>

    <section class="section-to-scroll blog" id="blog">
      <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
          <symbol id="icon-cross" viewBox="0 0 32 32">
            <title>close</title>
            <path
              d="M31.7 25.7L22 16l9.7-9.7a1 1 0 0 0 0-1.4L27.1.3a1 1 0 0 0-1.4 0L16 10 6.3.3a1 1 0 0 0-1.4 0L.3 4.9a1 1 0 0 0 0 1.4L10 16 .3 25.7a1 1 0 0 0 0 1.4l4.6 4.6a1 1 0 0 0 1.4 0L16 22l9.7 9.7a1 1 0 0 0 1.4 0l4.6-4.6a1 1 0 0 0 0-1.4z"
            />
          </symbol>
        </defs>
      </svg>
      <div class="section-title">
        <h3>
          <span class="underline underline--stars">
            &nbsp;&nbsp;&nbsp;&nbsp;{
          </span>
          blog
          <span class="underline underline--stars">
            }&nbsp;&nbsp;&nbsp;&nbsp;
          </span>
        </h3>
        <div class="select-category">
          <label for="category-select-post">filter by category:</label>
          <select id="category-select-post" name="category">
            @foreach ($tags as $tag)
              <option value="/category/{{$tag->name}}">{{$tag->name}}</option>
            @endforeach
            </select>
          <button onclick="siteRedirectPost()"><i class="fa fa-chevron-circle-right"></i></button>
        </div>
        <!-- <p class="section-description">
          **swipe horizontally to browse and click to read**
        </p> -->
      </div>
      <div class="page" data-modal-state="closed">
        <div class="blog-container">
          <div class="card-slider">

          @foreach( $posts as $index=>$post )
            @if( $post->category->is_special == false )
            <div class="card-wrapper">
              <article class="card" id="blog-{{ $index }}">
                <picture class="card__background">
                  <img src="{{asset($post->pict)}}" />
                </picture>
                <div class="card__category">
                  {{ $post->tags->implode('name', ' | ') }}
                </div>
                <h3 class="card__title">{{ $post->title }}</h3>
                <div class="card__duration">
                  {{ $post->created_at->formatLocalized('%A, %d %B %Y') }}
                </div>
              </article>
            </div>
            @endif
          @endforeach

          </div>
        </div>
        <div class="overlay"></div>
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
                  <img src="{{ asset('img/dummy-img.png') }}" />
                </div>
                <div class="card__category">
                  Category
                </div>
                <h1 class="card__title">Title</h1>
                <div class="card__duration">
                  Date
                </div>
              </header>
              <main class="modal__content">
                <div class="paragraph">
                  Content
                </div>
                <br>
                <div class="content-footer">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                      <ul class="list-unstyled list-inline social text-center">
                        <li class="list-inline-item">
                          <form id="like-form" action="" method="POST">
                            @csrf
                            <button><i id="likes-count" class="fa fa-heart badge-fa"></i></button>
                          </form>
                        </li>
                        <li class="list-inline-item">
                          <a id="fb-route" href="" target="_blank"> <i class="fa fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                          <a id="twitter-route" href="" target="_blank"><i class="fa fa-twitter"></i></a>
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
                      <form action="" method="POST">
                        @csrf
                        <div class="comment-post-title text-center">
                          wanna share your thought? please let me know!
                        </div>
                        <div class="row">
                          <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
                            <textarea rows="1" type="text" name="body" required="true"></textarea>
                            <label>Comment</label>
                          </div>
                          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
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
                    there are no comments so far...
                  </div>
                  <hr>
                </div>
              </main>
            </div>
          </div>
        </div>
      </div>
      <div class="arrow text-center">
        <a href="#work" class="scroll-down-btn">
          <span class="text-center"></span>
          <span class="text-center"></span>
          <span class="text-center"></span>
        </a>
      </div>
    </section>

    <section class="section-to-scroll work" id="work">
      <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
          <symbol id="icon-cross" viewBox="0 0 32 32">
            <title>close</title>
            <path
              d="M31.7 25.7L22 16l9.7-9.7a1 1 0 0 0 0-1.4L27.1.3a1 1 0 0 0-1.4 0L16 10 6.3.3a1 1 0 0 0-1.4 0L.3 4.9a1 1 0 0 0 0 1.4L10 16 .3 25.7a1 1 0 0 0 0 1.4l4.6 4.6a1 1 0 0 0 1.4 0L16 22l9.7 9.7a1 1 0 0 0 1.4 0l4.6-4.6a1 1 0 0 0 0-1.4z"
            />
          </symbol>
        </defs>
      </svg>
      <div class="section-title">
        <h3>
          <span class="underline underline--stars">
            &nbsp;&nbsp;&nbsp;&nbsp;{
          </span>
          works
          <span class="underline underline--stars">
            }&nbsp;&nbsp;&nbsp;&nbsp;
          </span>
        </h3>
        <div class="select-category">
          <label for="category-select-work">filter by category:</label>
          <select id="category-select-work" name="category">
            @foreach ($work_tags as $tag)
              <option value="/category/{{$tag->name}}">{{$tag->name}}</option>
            @endforeach
            </select>
          <button onclick="siteRedirectWork()"><i class="fa fa-chevron-circle-right"></i></button>
        </div>
        <!-- <p class="section-description">
          **swipe horizontally to browse and click to read**
        </p> -->
      </div>
      <div class="page" data-modal-state="closed">
        <div class="blog-container">
          <div class="card-slider">

          @foreach( $work_posts->posts->sortByDesc('created_at') as $index=>$work_post )
            <div class="card-wrapper">
              <article class="card" id="work-{{ $index }}">
                <picture class="card__background">
                  <img src="{{ asset($work_post->pict) }}" />
                </picture>
                <div class="card__category">
                  {{ $work_post->tags->implode('name', ' | ') }}
                </div>
                <h3 class="card__title">{{ $work_post->title }}</h3>
                <div class="card__duration">
                  {{ $work_post->created_at->formatLocalized('%B %Y') }}
                </div>
              </article>
            </div>
          @endforeach

          </div>
        </div>
        <div class="overlay"></div>
        <div class="modal-wrapper">
          <div class="modal-work">
            <button class="modal__close-button" type="button">
              <svg class="icon icon-cross">
                <use xlink:href="#icon-cross"></use>
              </svg>
            </button>
            <div class="modal__scroll-area">
              <header class="modal__header">
                <div class="card__background">
                  <img src="{{ asset('img/dummy-img.png') }}" />
                </div>
                <div class="card__category">
                  Category
                </div>
                <h1 class="card__title">Title</h1>
                <div class="card__duration">
                  Date
                </div>
              </header>
              <main class="modal__content">
                Content
              </main>
            </div>
          </div>
        </div>
      </div>
      <div class="arrow text-center">
        <a href="#contact" class="scroll-down-btn">
          <span class="text-center"></span>
          <span class="text-center"></span>
          <span class="text-center"></span>
        </a>
      </div>
    </section>

    <section class="section-to-scroll contact" id="contact">
      <div class="section-title">
        <h3>
          <span class="underline underline--stars">
            &nbsp;&nbsp;&nbsp;&nbsp;{
          </span>
          contact
          <span class="underline underline--stars">
            }&nbsp;&nbsp;&nbsp;&nbsp;
          </span>
        </h3>
        <p class="section-description">
          **get in touch with me anonymously or via google**
        </p>
      </div>
      <div class="login-box">
        @if(Auth::user() == null)
          <h4>Anonymous Message</h4>
        @else
          <div class="avatar-wrapper">
          @if(Auth::user()->avatar)
            <img class="avatar" src="{{ Auth::user()->avatar }}" alt="avatar">
          @else
            <img class="avatar" src="{{ asset('img/anon-avatar.png') }}" alt="avatar">
          @endif
          </div>
        @endif
        <form action="{{ route('message') }}" method="POST">
          @csrf
          <div class="user-box">
            @if(Auth::user() == null)
              <input type="text" name="name" required="true" autocomplete="off">
            @else
              <input type="text" name="name" value="{{Auth::user()->name}}" required="true">
            @endif
            <label>From</label>
          </div>
          <div class="message-box">
            <textarea rows="3" type="text" name="body" required="true"></textarea>
            <label>Message</label>
          </div>
          @if(Auth::user() == null)
            <a href="{{ route('login.provider', 'google') }}">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              Google
            </a>
          @else
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
              Logout
            </a>
          @endif
          <button type="submit" style="float: right;">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Submit
          </button>
        </form>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
      <div class="arrow text-center">
        <a href="#footer" class="scroll-down-btn">
          <span class="text-center"></span>
          <span class="text-center"></span>
          <span class="text-center"></span>
        </a>
      </div>
    </section>
  </div>
@endsection

@section('extra-js')
  <script>
    function siteRedirectPost() {
      var selectbox = document.getElementById("category-select-post");
      var selectedValue = selectbox.options[selectbox.selectedIndex].value;
      window.location.href = selectedValue;
    }
    function siteRedirectWork() {
      var selectbox = document.getElementById("category-select-work");
      var selectedValue = selectbox.options[selectbox.selectedIndex].value;
      window.location.href = selectedValue;
    }
  </script>
  <script src="{{ asset('js/scroll.js') }}"></script>
  <script src="{{ asset('js/homepage.js') }}"></script>
  <script src="{{ asset('js/blog_section.js') }}"></script>
  <script src="{{ asset('js/work_section.js') }}"></script>
@endsection
