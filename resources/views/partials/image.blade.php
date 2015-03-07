@if ($type == 'link')
	<a href="{{ $link }}" class="{{ $class }}" style="background-image:url({{ $url }})"></a>
@else
	<div class="{{ $class }}" style="background-image:url({{ $url }})"></div>
@endif