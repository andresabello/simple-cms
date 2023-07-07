<div class="container">
	<div class="row">
		<div class="col-md-12">
            <ul class="portfolio-sorting list-inline text-center">
                <li><a href="#" data-group="all" class="active">All</a></li>
                @if($categories)    
                    @foreach ($categories as $category) 
                        <li><a href="#" data-group="{{ $category->id }}">{{ ucwords($category->name) }}</a></li>
                    @endforeach
                @endif
            </ul>
		</div>
	</div> 
    <div class="portfolio-wrapper">
        <div class="portfolio-items list-unstyled" id="grid">
        	@foreach($items as $item)
                <div class="portfolio-item col-md-4 col-sm-4 col-xs-6" data-groups="'{{ $item->categories->lists('id') }}'">
                    @foreach ($images as $image)
                        @if($image->item_id == $item->id)
                            <img src="{{ $image->filePath }}" alt="{{ $image->title }}" class="img-responsive">
                        @endif
                    @endforeach
                    <div class="portfolio-item__details">
                        <span class="portfolio-item__title">{{ $item->title }}</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 shuffle_sizer"></div>
        	@endforeach
        </div>
    </div>
</div>

