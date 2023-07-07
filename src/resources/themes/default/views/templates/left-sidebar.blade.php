<div class="container">
	<div class="row">
		<div class="col-xl-4">
			{{--        Todo add the sidebar dynamically--}}
			Sidebar here
		</div>
		<div class="col-xl-8">
			@foreach($page->rows->sortBy('order') as $row)
				<section class="section {!! !empty($row->class) ? $row->class : null  !!}">
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
								@endif
							</div>
						@endforeach
					</div>
				</section>
			@endforeach
		</div>
	</div>
</div>