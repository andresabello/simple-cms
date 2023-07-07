@extends('layouts.frontend')
@section('title', $post->title)
@section('content')
    @if($view)
        {!! $view !!}
    @else
        Please add content
    @endif
@endsection
