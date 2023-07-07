@inject('presenter', 'Piboutique\SimpleCMS\Presenters\PagePresenter')

@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', 'Pages')

@section('content')

    <div class="container pt-3 px-4 ml-sm-auto">
        @if($pages->isEmpty())
            <div class="row">
                <div class="col-xl-12">
                    <div class="jumbotron mt-5 bg-white">
                        <h1 class="display-3">There are no pages</h1>
                        <p class="lead">Start by adding pages to your website</p>
                        <p>
                            <a href="{{ route('pages.create') }}" class="btn btn-primary btn-lg">
                                Create a new page &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-5">
                <div class="col-xl-12">
                    <a href="{{ route('pages.create') }}" class="btn btn-primary btn-lg float-right">
                        Create a new page &nbsp;<i class="fas fa-plus-circle" aria-hidden="true"></i>
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
                                <th>URI</th>
                                <th>Name</th>
                                <th>Template</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr class="{{ $page->hidden ? 'warning' : '' }}">
                                    <td>
                                        {!! $presenter->linkToPaddedTitle($page->id) !!}
                                    </td>
                                    <td>
                                        <a href="{{ url($page->url) }}">{{ $presenter->prettyUri($page->id) }}</a>
                                    </td>
                                    <td>{{ $page->name ?? 'None' }}</td>
                                    <td>{{ $page->template ?? 'None' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pages.edit', $page->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href=""><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $pages->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection

