@php
    $image = $post->images()->first();
@endphp

<div class="container">
    <div class="row">
        <article class="col-xl-12 py-5">
            <header class="row mb-5">
                <div class="col-xl-8 offset-xl-2">
                    <h1>{{ $post->title }}</h1>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="profile">
                                <div class="row">
                                    <div class="col-xl-2">
                                        <i class="fas fa-user-circle fa-2x mt-2"></i>
                                    </div>
                                    <div class="col-xl-10">
                                        {{ $post->author->name }} <br>
                                        {{ date('M d', strtotime($post->published_at))}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 text-right social-media">
                            <a href="https://twitter.com/intent/tweet?url={{ rawurlencode(url()->current()) }}&text={{$post->title}}&via=andresab3llo"
                               target="_blank">
                                <i class="fab fa-twitter text-dark"></i>
                            </a>

                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ rawurlencode(url()->current()) }}&title={{$post->title}}&summary={{$post->excerpt}}"
                               target="_blank">
                                <i class="fab fa-linkedin text-dark"></i>
                            </a>

                            <a href="https://facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}"
                               target="_blank">
                                <i class="fab fa-facebook-square text-dark"></i>
                            </a>
                            @if($image)
                                <a href="http://pinterest.com/pin/create/button/?url={{rawurlencode(url()->current())}}&media={{rawurlencode(url($image->url))}}&description={{$post->excerpt}}"
                                   target="_blank">
                                    <i class="fab fa-pinterest text-dark"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </header>
            @if($image)
                <div class="image-wrapper text-center mb-5">
                    <img src="{{ url($image->url) }}" alt="{{ $image->title }}" class="img img-fluid">
                </div>
            @endif
            <div class="content row">
                <main class="col-xl-8 offset-xl-2">
                    @foreach($post->rows->sortBy('order') as $row)
                        <section class="section {!! !empty($row->class) ? $row->class : null  !!}">
                            <div class="container">
                                <div class="row">
                                    @foreach($row->divisions as $column)
                                        <div class="col-xl {!! $column->class !!}">
                                            @if($column->type === 'content')
                                                {!! $column->content !!}
                                            @elseif($column->type === 'image')
                                                @php
                                                    $image = $column->images()->first()
                                                @endphp
                                                <img src="{!! url($image->url) !!}"
                                                     alt="{!! $image->description !!}" class="img img-fluid">
                                            @elseif($column->type === 'code')
                                                <pre class="copy-to-clipboard"><code class="language-js">{!! $column->content !!}</code></pre>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endforeach
                </main>
            </div>
            <footer class="row">
                <div class="col-xl-8 offset-xl-2">
                    {{--                    <div class="row mb-5">--}}
                    {{--                        <div class="col-xl-12">--}}
                    {{--                            <div class="tags">--}}
                    {{--                                Tags here--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="row mb-5">
                        <div class="col-xl-6"></div>
                        <div class="col-xl-6 text-right social-media">
                            <a href="https://twitter.com/intent/tweet?url={{ rawurlencode(url()->current()) }}&text={{$post->title}}&via=andresab3llo"
                               target="_blank">
                                <i class="fab fa-twitter text-dark"></i>
                            </a>

                            <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ rawurlencode(url()->current()) }}&title={{$post->title}}&summary={{$post->excerpt}}"
                               target="_blank">
                                <i class="fab fa-linkedin text-dark"></i>
                            </a>

                            <a href="https://facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}"
                               target="_blank">
                                <i class="fab fa-facebook-square text-dark"></i>
                            </a>
                            @if($image)
                                <a href="http://pinterest.com/pin/create/button/?url={{rawurlencode(url()->current())}}&media={{rawurlencode(url($image->url))}}&description={{$post->excerpt}}"
                                   target="_blank">
                                    <i class="fab fa-pinterest text-dark"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="row profile mb-5">
                        <div class="col-xl-2 text-center">
                            <i class="fas fa-user-circle fa-3x mt-2"></i>
                        </div>
                        <div class="col-xl-10">
                            {{ $post->author->name }} <br>
                            {{ date('M d', strtotime($post->published_at))}}
                        </div>
                    </div>

                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-xl-12">--}}
                    {{--                            <div class="responses">--}}
                    {{--                                Responses here--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </footer>

        </article>
    </div>
</div>