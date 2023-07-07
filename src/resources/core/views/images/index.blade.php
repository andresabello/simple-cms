@inject('presenter', 'Piboutique\SimpleCMS\Presenters\PagePresenter')

@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', 'Images')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-12 py-5">
                <images></images>
            </div>
        </div>
    </div>
@endsection