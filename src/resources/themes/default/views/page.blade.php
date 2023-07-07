@extends('layouts.frontend')
@section('title', $page->title)
@section('content')
    @if($view)
        {!! $view !!}
    @else
        Please add content
    @endif
@endsection
