@if (Session::has('flash.message'))
	<?php $type = Session::get('flash.level');?>
	<?php $content = Session::get('flash.message');?>
@endif

<div class="alert alert-{{ $type }}">
	{{ $content }}
</div>