<div class="xtra">
	@if ( ! empty($item->metadata->image1))
		<?php $preview = '/assets/'.$item->metadata->image1;?>
	@else
		<?php $preview = asset('images/previews/space'.rand(1, 13).'.jpg');?>
	@endif
	
	{{ View::make('partials.image')->withType(false)->withUrl($preview)->withClass('item-preview') }}

	{{ $item->user->present()->avatar(['type' => 'link', 'link' => route('account.profile', [$item->user->username]), 'class' => 'avatar xtra-avatar img-circle']) }}

	<h4 class="xtra-heading">{{ $item->present()->name }}</h4>
	<div class="text-center">
		{{ $item->present()->productAsLabel }}
		{{ $item->present()->typeAsLabel }}
	</div>
	<div class="xtra-desc">
		<p><a href="{{ route('item.show', [$item->user->username, $item->slug]) }}" class="btn btn-lg btn-block btn-default">More Info</a></p>
	</div>
</div>