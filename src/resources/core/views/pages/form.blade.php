@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', isset($page) && $page->id ? 'Editing ' . $page->title : 'Create a new Page')

@section('content')

    <div class="container">
        @if(isset($page))
            <edit-page-form :pages="{{ $orderPages }}" :templates="{{ $templates }}"
                            :page="{{json_encode($page) }}"></edit-page-form>
        @else
            <edit-page-form :pages="{{ $orderPages }}" :templates="{{ $templates }}"></edit-page-form>
        @endif

    </div>
@endsection