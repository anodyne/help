@extends('layouts.master')

@section('title')
    {{ $product }}
@stop

@section('content')
    <h1>{{ $product }} <small>{{ $count }} Articles</small></h1>

    <dl>
    @forelse ($articles as $article)
        {{ partial('article', ['article' => $article, 'rating' => true]) }}
    @empty
        {{ alert('warning', "No articles found.") }}
    @endforelse
    </dl>
@stop
