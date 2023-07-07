<div class="container">
    <div class="row p-5">
        <div class="col-xl-8 offset-xl-2">
            <h1 class="text-center mb-5">Blog</h1>
        </div>
        @foreach($posts as $post)
            <article class="col-xl-6 px-4">
                @if($post->image)
                    <a href="{{ route($post->slug) }}" class="text-dark text-center d-block">
                        <img src="{{ url($post->image->url) }}" alt="{{ $post->image->alt }}"
                             class="img img-fluid border mb-4" style="height: 300px;">
                    </a>
                @endif
                <h2 class="my-3">
                    <a href="{{ route($post->slug) }}" class="text-dark">{{ $post->title }}</a>
                </h2>
                <main>
                    <a href="{{ route($post->slug) }}" class="text-muted">
                        {!! $post->excerpt !!}...
                    </a>
                </main>
                <div class="row profile my-3">
                    <div class="col-xl-2 text-center">
                        <i class="fas fa-user-circle fa-2x mt-2"></i>
                    </div>
                    <div class="col-xl-10">
                        {{ $post->author_name }} <br>
                        {{ date('M d', strtotime($post->published_at))}}
                    </div>
                </div>
            </article>
        @endforeach
    </div>
    <div class="row">
        <div class="col-xl-12">

        </div>
    </div>
</div>


