@if ($breadcrumbs)
	<p>
		@foreach ($breadcrumbs as $index => $breadcrumb)
			@if ($breadcrumb->url)
				<a href="{{ $breadcrumb->url }}" title="{{ $breadcrumb->title }}">
					{{ $breadcrumb->title }}
				</a>
			@else
				{{ $breadcrumb->title }}
			@endif
			@if($index < count((array)$breadcrumbs)-1)
				<i class="fa fa-caret-right"></i>
			@endif
		@endforeach
	</p>
@endif