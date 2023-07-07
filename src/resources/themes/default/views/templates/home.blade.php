@foreach($page->rows->sortBy('order') as $row)
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
                            @php
                                $image = $column->images()->first()
                            @endphp
                            {!! $column->content !!}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endforeach
