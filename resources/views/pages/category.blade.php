@extends('layouts.base')

@section('title', $tag_name)

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
  <link rel="stylesheet" href="{{ asset('css/category-v2.css') }}" />
@endsection

@section('content')
  <div class="content-category">
    <div class="header-container" onloadedmetadata="">
      <img class="header-img" alt="about-img" src="{{ asset('/img/headlineB&W.png') }}">
      <div class="header-overlay"></div>
      <div class="header-text">
        <h1><span style="color: #ff8702;">/</span>{{ $tag_name }}<span style="color: #ff8702;">/</span></h1>
      </div>
    </div>
    <div class="list">
      <div class="row">

      @foreach( $posts as $index=>$post )
        <div class="card-wrapper col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
          <article class="card">
            <a href="/article/{{ $post->id }}">
              <picture class="card__background">
                <img src="{{ asset($post->pict) }}" />
              </picture>
              <div class="card__category">
                {{ $post->tags->implode('name', ' | ') }}
              </div>
              <h3 class="card__title">{{ $post->title }}</h3>
              <div class="card__duration">
                {{ $post->created_at->formatLocalized('%B %Y') }}
              </div>
            </a>
          </article>
        </div>
      @endforeach

      </div>
    </div>
  </div>
@endsection

@section('extra-js')

@endsection
