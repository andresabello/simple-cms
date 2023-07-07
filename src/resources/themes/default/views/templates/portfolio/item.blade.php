<div class="container">
	<div class="row">
		<article class="col-md-12">
			<h1>{{ $item->title }}</h1>
			<p>
				Created for <a href="{{ $item->url }}" title="{{ $item->client }}">{{ $item->client }}</a> 
			</p>
			<div class="row">	
				@foreach ($item->images as $image)
					<div class="col-md-6">
						<img src="{{ $image->filePath }}" alt="{{ $image->title }}" class="img-responsive">
					</div>
	            @endforeach
			</div>

			{!! $item->present()->bodyHtml() !!}
		</article>
	</div>
</div>