@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', isset($post) && $post->id ? 'Editing ' . $post->title : 'Create a new Post')

@section('content')

    <div class="container">
        @if(isset($post))
            <edit-post-form :post="@php echo htmlspecialchars(json_encode($post))@endphp"></edit-post-form>
        @else
            <edit-post-form></edit-post-form>
        @endif
    </div>
@endsection