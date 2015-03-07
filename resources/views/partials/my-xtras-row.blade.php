<div class="data-table data-table-striped data-table-bordered">
@foreach ($items as $item)
	<div class="row {{ $item->product->present()->nameAsSlug }}">
		<div class="col-md-8">
			<p class="lead">{{ $item->present()->name }}</p>
			<p>{{ $item->present()->ratingAsLabel }}</p>
			{{ $item->present()->disabledLabel }}
			{{ $item->present()->adminDisabledLabel }}
		</div>
		<div class="col-md-4">
			<div class="btn-toolbar pull-right">
				<div class="btn-group">
					<a href="{{ route('item.show', [$item->user->username, $item->slug]) }}" class="btn btn-default">View</a>
				</div>

				@if ($_currentUser->can('xtras.item.edit') or $_currentUser->can('xtras.admin'))
					<div class="btn-group">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default">Edit <span class="caret"></span></a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="{{ route('item.edit', [$item->user->username, $item->slug]) }}">Edit Xtra</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('item.quick-update', [$item->user->username, $item->slug]) }}">Quick Update</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('item.messages.index', [$item->user->username, $item->slug]) }}">Manage Messages</a></li>
							<li><a href="{{ route('item.files.index', [$item->user->username, $item->slug]) }}">Manage Files</a></li>
							<li><a href="{{ route('item.images.index', [$item->user->username, $item->slug]) }}">Manage Images</a></li>
						</ul>
					</div>
				@endif

				@if ($_currentUser->can('xtras.item.delete') or $_currentUser->can('xtras.admin'))
					<div class="btn-group">
						<a href="#" class="btn btn-danger js-remove-item" data-id="{{ $item->id }}">Remove</a>
					</div>
				@endif
			</div>
		</div>
	</div>
@endforeach
</div>