<span class="rating">
	{{ Form::radio("rating-input-{$id}", 5, ($r and (int) $r->rating === 5), ['class' => 'rating-input', 'id' => "rating-input-{$id}-5", 'data-item' => $id]) }}
	<label for="rating-input-{{ $id }}-5" class="rating-star" data-icon="s"></label>

	{{ Form::radio("rating-input-{$id}", 4, ($r and (int) $r->rating === 4), ['class' => 'rating-input', 'id' => "rating-input-{$id}-4", 'data-item' => $id]) }}
	<label for="rating-input-{{ $id }}-4" class="rating-star" data-icon="s"></label>

	{{ Form::radio("rating-input-{$id}", 3, ($r and (int) $r->rating === 3), ['class' => 'rating-input', 'id' => "rating-input-{$id}-3", 'data-item' => $id]) }}
	<label for="rating-input-{{ $id }}-3" class="rating-star" data-icon="s"></label>

	{{ Form::radio("rating-input-{$id}", 2, ($r and (int) $r->rating === 2), ['class' => 'rating-input', 'id' => "rating-input-{$id}-2", 'data-item' => $id]) }}
	<label for="rating-input-{{ $id }}-2" class="rating-star" data-icon="s"></label>

	{{ Form::radio("rating-input-{$id}", 1, ($r and (int) $r->rating === 1), ['class' => 'rating-input', 'id' => "rating-input-{$id}-1", 'data-item' => $id]) }}
	<label for="rating-input-{{ $id }}-1" class="rating-star" data-icon="s"></label>
</span>