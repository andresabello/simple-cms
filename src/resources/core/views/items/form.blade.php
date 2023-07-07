@extends('vendor.simple-cms.backend.layouts.backend')

@section('title', isset($item) && $item->id ? 'Editing ' . $item->title : 'Create a new Item')

@section('content')

    <div class="container">
        @if(isset($item))
            <edit-item-form :item="@php echo htmlspecialchars(json_encode($item))@endphp"></edit-item-form>
        @else
            <edit-item-form></edit-item-form>
        @endif

    </div>
@endsection