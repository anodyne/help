<div class="visible-xs visible-sm">
	@if (count($data) > 0)
		@foreach ($data as $group)
			@foreach ($group as $item)
				<p><a href="{{ $item['link'] }}" class="{{ $item['class'] }} btn-lg btn-block">{{ $item['text'] }}</a></p>
			@endforeach
		@endforeach
	@endif
</div>

<div class="visible-md visible-lg">
	<div class="btn-toolbar">
		@if (count($data) > 0)
			@foreach ($data as $group)
				<div class="btn-group">
					@foreach ($group as $item)
						<a href="{{ $item['link'] }}" class="{{ $item['class'] }}">{{ $item['text'] }}</a>
					@endforeach
				</div>
			@endforeach
		@endif
	</div>
</div>