@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', 'Dashboard')

@section('content')
    <div class="container pt-3 px-4 ml-sm-auto">
        <div class="row">
            <div class="col-xl-12">
                <div class="jumbotron mt-5 bg-white">
                    <h1 class="display-3">Welcome to Simple CMS</h1>
                    <p class="lead">A CMS created to make life easier. Add it to any existing Laravel application
                        and create websites on the fly powered by Laravel</p>
                    <p>
                        <a class="btn btn-primary btn-lg" href="http://piboutique.com" role="button">
                            Learn more <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection