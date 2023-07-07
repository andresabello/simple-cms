@inject('presenter', 'Piboutique\SimpleCMS\Presenters\PagePresenter')

@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', 'Blog Posts')

@section('content')

    <div class="container pt-3 px-4 ml-sm-auto">
        @if($posts->isEmpty())
            <div class="row">
                <div class="col-xl-12">
                    <div class="jumbotron mt-5 bg-white">
                        <h1 class="display-3">There are no posts</h1>
                        <p class="lead">Start by adding posts to your website</p>
                        <p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg">
                                Create a new post &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-5">
                <div class="col-xl-12">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg float-right">
                        Create a new Post &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped bg-white">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Published Date</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        {{ $post->title }}
                                    </td>
                                    <td>
                                        {{ $post->slug }}
                                    </td>
                                    <td>
                                        {{ $post->published_at }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('posts.edit', $post->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a @click.prevent="deletePost({{ $post->id }})" href="#delete-post">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

