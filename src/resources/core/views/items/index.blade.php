@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', 'Portfolio Items')

@section('content')

    <div class="container pt-3 px-4 ml-sm-auto">
        @if($items->isEmpty())
            <div class="row">
                <div class="col-xl-12">
                    <div class="jumbotron mt-5 bg-white">
                        <h1 class="display-3">There are no portfolio items</h1>
                        <p class="lead">Start by adding portfolio items to your website</p>
                        <p>
                            <a href="{{ route('items.create') }}" class="btn btn-primary btn-lg">
                                Create a new item &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="row my-5">
                <div class="col-xl-12">
                    <a href="{{ route('items.create') }}" class="btn btn-primary btn-lg float-right">
                        Create a new item &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="items">
                        @foreach($items as  $item)
                            <div class="item bg-white border rounded p-3 mb-5">
                                <div class="row">
                                    <div class="col-xl-10">
                                        <h2>
                                            {{ $item->title }}
                                        </h2>
                                        <p>
                                            URL: {{ $item->url }} | Website: {{ $item->website }} |
                                            Slug: {{ $item->slug }}
                                        </p>
                                        <p>
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                    <div class="col-xl-2 text-right">
                                        <a href="{{ route('items.edit', $item->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $items->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection

